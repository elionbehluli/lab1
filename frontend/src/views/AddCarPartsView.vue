<template>
  <div class="min-h-screen flex items-center">
    <div class="card mx-auto w-full max-w-5xl shadow-xl">
      <div class="rounded-xl divide-slate-300 divide-x md:py-5">
        <div class="p-6 flex flex-col items-center justify-center">
          <h1 class="text-3xl font-semibold mb-8">
            Add a new Car Part
          </h1>
          <div class="w-full max-w-md">
            <form class="text-center" @submit.prevent="handleRegister" novalidate>
              <label for="model" class="mb-4">
                <input
                  v-model="form.name"
                  type="text"
                  placeholder="Name"
                  class="input-field border-red-500"
                  required
                />
                <span class="text-sm text-red-500" v-if="!form.name">Please enter a name</span>
              </label>
              <label for="model" class="mb-4">
                <input
                  v-model="form.description"
                  type="text"
                  placeholder="Description"
                  class="input-field border-red-500"
                  required
                />
                <span class="text-sm text-red-500" v-if="!form.description">Please enter a description</span>
              </label>
              <label for="model" class="mb-4">
                <input
                  v-model="form.price"
                  type="number"
                  placeholder="Price"
                  class="input-field border-red-500"
                  required
                />
                <span class="text-sm text-red-500" v-if="!form.price">Please enter a price</span>
              </label>
              <label for="model" class="mb-4">
                <input
                  v-model="form.year_of_production"
                  type="text"
                  placeholder="Year of Production"
                  class="input-field border-red-500"
                  required
                />
                <span class="text-sm text-red-500" v-if="!form.year_of_production">Please enter year of production</span>
              </label>
              <div class="flex flex-col space-y-4 pt-4">
                <button
                  type="submit"
                  :disabled="isRegisterButtonDisabled"
                  :class="{
                    'py-2 px-5 flex justify-center bg-blue-300 text-white rounded-lg cursor-not-allowed':
                      isRegisterButtonDisabled,
                    'btn-primary': !isRegisterButtonDisabled
                  }"
                >
                  Register
                </button>
              </div>
            </form>
          </div>
        </div>
        <div
          class="drop-area border-2 border-dashed border-gray-300 p-4 text-center"
          @dragover.prevent
          @dragenter.prevent
          @drop="handleDrop"
          v-if="photos.length === 0" 
        >
          <input
            id="file-input"
            type="file"
            accept="image/*"
            ref="file-input"
            class="hidden"
            @change="handleFiles"
          />
          <p>Drag & Drop photos here or click to browse</p>
          <button @click="openFileInput" class="bg-blue-500 text-white px-4 py-2 rounded-md mt-4">Browse</button>
        </div>
        <div v-else> <!-- Display message if photo already present -->
          <p class="text-red-500">You can only upload one photo.</p>
        </div>
        <div v-for="(photo, index) in photos" :key="index" class="mt-4">
          <img :src="photo.url" alt="Uploaded Photo" class="max-w-full h-auto"/>
          <button @click="deletePhoto(index)" class="mt-2 bg-red-500 text-white px-4 py-2 rounded-md">Delete</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue';
import { useCarPartsStore } from '@/stores/useCarPartsStore';

const { isLoading, store } = useCarPartsStore();

const form = ref({
  name: '',
  description: '',
  price: 0, // Initialize price as a number
  year_of_production: '',
  image_url: '', // To store the image URL
});

const isRegisterButtonDisabled = computed(() => {
  return (
    !form.value.name ||
    !form.value.description ||
    !form.value.price ||
    !form.value.year_of_production ||
    isLoading
  );
});

const handleRegister = () => {
  // Prepare data to be sent to the store method
  const carPartsRequest = {
    name: form.value.name,
    description: form.value.description,
    price: form.value.price,
    year_of_production: form.value.year_of_production,
    image_url:  images.value[0] ,
  };

  // Call the store method to register the car part
  try {
    store(carPartsRequest); // Assuming store method handles the form data and performs the API call
    console.log('Car part registered successfully.');
    // Clear form fields after successful registration
    form.value.name = '';
    form.value.description = '';
    form.value.price = 0; // Reset price to 0 or an appropriate initial value
    form.value.year_of_production = '';
    form.value.image_url = ''; // Clear image_url after successful registration
    photos.value = [];
    images.value = [];
  } catch (error) {
    console.error('Error registering car part:', error);
  }
};

//photos
const photos = ref<{ url: string }[]>([]);
  const images = ref<File[]>([]);

  const openFileInput = () => {
  const fileInput = document.querySelector<HTMLInputElement>('#file-input');

  if (fileInput){
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
      images.value.push(file); // Push the file to the images array
    }
  }
};

const deletePhoto = (index: number) => {
  photos.value.splice(index, 1);
  images.value.splice(index, 1); // Remove the corresponding file from the images array
};

</script>

<style lang="scss" scoped>
.input-field {
  @apply w-full mb-2 px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500;
}

.btn-primary {
  @apply w-full px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:outline-none;
}

.input-field:focus ~ .text-red-500 {
  display: none;
}

.btn-primary.cursor-not-allowed {
  @apply bg-blue-300 text-gray-400;
}
</style>
