<template>
  <div v-if="isVisible">
    <form @submit.prevent="saveCarParts" class="card-container">
      <div class="card-content">
        <h1>Edit Car Parts</h1>
        <label for="model">Name:</label>
        <input type="text" id="model" v-model="editedCarParts.name" class="border rounded-md px-2 py-1">

        <label for="color">Price:</label>
        <input type="text" id="color" v-model="editedCarParts.price" class="border rounded-md px-2 py-1">

        <label for="year">Description:</label>
        <input type="text" id="year" v-model="editedCarParts.description" class="border rounded-md px-2 py-1">

        <label for="price">Year of Production:</label>
        <input type="text" id="price" v-model="editedCarParts.year_of_production" class="border rounded-md px-2 py-1">

        <!-- Photo upload section -->
        <!-- <div class="drop-area border-2 border-dashed border-gray-300 p-4 text-center" @dragover.prevent @dragenter.prevent @drop="handleDrop">
          <input id="file-input" type="file" accept="image/*" ref="fileInput" class="hidden" @change="handleFiles" />
          <p>Drag & Drop photos here or click to browse</p>
          <button type="button" @click="openFileInput" class="bg-blue-500 text-white px-4 py-2 rounded-md mt-4">Browse</button>
          <div v-for="(photo, index) in photos" :key="index" class="mt-4">
            <img :src="photo.url" alt="Uploaded Photo" class="max-w-full h-auto"/>
            <button type="button" @click="deletePhoto(index)" class="mt-2 bg-red-500 text-white px-4 py-2 rounded-md">Delete</button>
          </div>
        </div> -->

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md mt-4">Save</button>
        <button type="button" @click="$emit('cancel')" class="bg-gray-500 text-white px-4 py-2 rounded-md mt-4 ml-2">Cancel</button>
      </div>
    </form>
  </div>
</template>


<script setup lang="ts">
import { defineProps, defineEmits, ref } from 'vue';

const props = defineProps<{
  carParts: CarParts;
  isVisible: boolean;
}>();

const emits = defineEmits(['confirm', 'cancel']);

const editedCarParts = ref({ ...props.carParts });

const saveCarParts = () => {
  // Exclude image_url from the editedCarParts object
  const { image_url, ...carPartsWithoutImage } = editedCarParts.value;
  emits('confirm', { carParts: carPartsWithoutImage });
};

// const photos = ref<{ url: string }[]>([]);
// const images = ref<File[]>([]);

// const openFileInput = () => {
//   const fileInput = document.querySelector<HTMLInputElement>('#file-input');
//   if (fileInput) {
//     fileInput.click();
//   }
// };

// const handleFiles = (event: Event) => {
//   const files = (event.target as HTMLInputElement).files;
//   if (!files) return;
//   processFiles(files);
// };

// const handleDrop = (event: DragEvent) => {
//   event.preventDefault();
//   const files = event.dataTransfer?.files;
//   if (!files) return;
//   processFiles(files);
// };

// const processFiles = (files: FileList) => {
//   if (photos.value.length === 0) {
//     for (let i = 0; i < files.length; i++) {
//       const file = files[i];
//       if (file.type.startsWith('image/')) {
//         const reader = new FileReader();
//         reader.onload = () => {
//           photos.value.push({ url: reader.result as string });
//         };
//         reader.readAsDataURL(file);
//         images.value.push(file);
//       }
//     }
//   }
// };

// const deletePhoto = (index: number) => {
//   photos.value.splice(index, 1);
//   images.value.splice(index, 1);
// };

</script>


<style scoped>
.card-container {
  max-width: 600px;
  margin: 20px auto;
  background-color: #ffffff;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  padding: 20px;
}

.card-content {
  text-align: center;
  font-family: 'Arial', sans-serif;
}

.card-content h1 {
  font-size: 36px;
  margin-bottom: 10px;
  color: #333333;
}

.card-content label {
  display: block;
  margin-top: 10px;
  font-weight: bold;
}

.card-content input[type="text"] {
  width: 100%;
  max-width: 100%;
  padding: 8px;
  margin-top: 4px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

.drop-area {
  margin-top: 20px;
  border: 2px dashed #ccc;
  padding: 20px;
}

.drop-area p {
  margin-bottom: 10px;
}

.drop-area button {
  margin-top: 10px;
}

.drop-area img {
  max-width: 100%;
  height: auto;
  margin-top: 10px;
}

.action-button {
  margin-right: 10px;
  padding: 8px 16px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.bg-blue-500 {
  background-color: #1890ff;
  color: #ffffff;
}

.bg-gray-500 {
  background-color: #888888;
  color: #ffffff;
}

.bg-red-500 {
  background-color: #ff4d4f;
  color: #ffffff;
}

</style>
