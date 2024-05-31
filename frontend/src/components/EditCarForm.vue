<template>
  <div v-if="isVisible">
    <form @submit.prevent="saveCar">
      <!-- Form fields for editing car details -->
      <label for="model">Model:</label>
      <input type="text" id="model" v-model="editedCar.model" class="border rounded-md px-2 py-1">

      <label for="color">Color:</label>
      <input type="text" id="color" v-model="editedCar.color" class="border rounded-md px-2 py-1">

      <label for="year">Year:</label>
      <input type="text" id="year" v-model="editedCar.year" class="border rounded-md px-2 py-1">

      <label for="price">Price:</label>
      <input type="text" id="price" v-model="editedCar.price" class="border rounded-md px-2 py-1">

      <label for="mileage">Mileage:</label>
      <input type="text" id="mileage" v-model="editedCar.mileage" class="border rounded-md px-2 py-1">

      <label for="transmission_type">Transmission Type:</label>
      <input type="text" id="transmission_type" v-model="editedCar.transmission_type" class="border rounded-md px-2 py-1">

      <label for="fuel_type">Fuel Type:</label>
      <input type="text" id="fuel_type" v-model="editedCar.fuel_type" class="border rounded-md px-2 py-1">

      <label for="engine_size">Engine Size:</label>
      <input type="text" id="engine_size" v-model="editedCar.engine_size" class="border rounded-md px-2 py-1">

      <label for="number_of_seats">Number of Seats:</label>
      <input type="text" id="number_of_seats" v-model="editedCar.number_of_seats" class="border rounded-md px-2 py-1">

      <label for="body_type">Body Type:</label>
      <input type="text" id="body_type" v-model="editedCar.body_type" class="border rounded-md px-2 py-1">

      <div v-for="(feature, index) in editedCar.features" :key="index" class="mb-2">
        <label :for="'feature-' + index">Feature {{ index + 1 }}:</label>
        <input type="text" :id="'feature-' + index" v-model="editedCar.features[index]" class="border rounded-md px-2 py-1">
        <button type="button" @click="removeFeature(index)" class="bg-red-500 text-white px-2 py-1 rounded">Remove</button>
      </div>
      <button type="button" @click="addFeature" class="bg-green-500 text-white px-2 py-1 rounded">Add Feature</button>

      <!-- Photo upload section -->
      <div class="drop-area border-2 border-dashed border-gray-300 p-4 text-center" @dragover.prevent @dragenter.prevent @drop="handleDrop">
        <input id="file-input" type="file" accept="image/*" ref="fileInput" class="hidden" @change="handleFiles" />
        <p>Drag & Drop photos here or click to browse</p>
        <button type="button" @click="openFileInput" class="bg-blue-500 text-white px-4 py-2 rounded-md mt-4">Browse</button>
        <div v-for="(photo, index) in photos" :key="index" class="mt-4">
          <img :src="photo.url" alt="Uploaded Photo" class="max-w-full h-auto"/>
          <button type="button" @click="deletePhoto(index)" class="mt-2 bg-red-500 text-white px-4 py-2 rounded-md">Delete</button>
        </div>
      </div>

      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md mt-4">Save</button>
      <button type="button" @click="$emit('cancel')" class="bg-gray-500 text-white px-4 py-2 rounded-md mt-4 ml-2">Cancel</button>
    </form>
  </div>
</template>

<script setup lang="ts">
import { defineProps, defineEmits, ref } from 'vue';

const props = defineProps<{
  car: Car;
  isVisible: boolean;
}>();

const emits = defineEmits(['confirm', 'cancel']);

const editedCar = ref({ ...props.car });
const existingImages = ref<{ id: number, image_url: string }[]>([...props.car.images]);
const newImages = ref<File[]>([]);
const deletedImageIds = ref<number[]>([]);

const photos = ref(existingImages.value.map(img => ({ url: img.image_url })));

const saveCar = () => {
  emits('confirm', { 
    car: editedCar.value, 
    newImages: newImages.value,
    deletedImageIds: deletedImageIds.value
  });
};

const addFeature = () => {
  editedCar.value.features.push('');
};

const removeFeature = (index: number) => {
  editedCar.value.features.splice(index, 1);
};

const openFileInput = () => {
  const fileInput = document.querySelector<HTMLInputElement>('#file-input');
  if (fileInput) {
    fileInput.click();
  }
};

const handleFiles = (event: Event) => {
  const files = (event.target as HTMLInputElement).files;
  if (!files) return;
  processFiles(files);
};

const handleDrop = (event: DragEvent) => {
  event.preventDefault();
  const files = event.dataTransfer?.files;
  if (!files) return;
  processFiles(files);
};

const processFiles = (files: FileList) => {
  for (let i = 0; i < files.length; i++) {
    const file = files[i];
    if (file.type.startsWith('image/')) {
      const reader = new FileReader();
      reader.onload = () => {
        photos.value.push({ url: reader.result as string });
      };
      reader.readAsDataURL(file);
      newImages.value.push(file); // Push the file to the newImages array
    }
  }
};

const deletePhoto = (index: number) => {
  const photo = photos.value[index];
  const existingImageIndex = existingImages.value.findIndex(img => img.image_url === photo.url);
  if (existingImageIndex > -1) {
    const [removedImage] = existingImages.value.splice(existingImageIndex, 1);
    deletedImageIds.value.push(removedImage.id);
  } else {
    newImages.value.splice(index - existingImages.value.length, 1); // Adjust index for new images
  }
  photos.value.splice(index, 1);
};
</script>

<style scoped>
/* Add any necessary styling here */
</style>
