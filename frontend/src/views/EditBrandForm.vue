<template>
  <div class="min-h-screen flex items-center">
    <div class="card mx-auto w-full max-w-5xl shadow-xl">
      <div class="grid md:grid-cols-2 grid-cols-1 rounded-xl divide-slate-300 divide-x md:py-5">
        <div class="p-6 flex flex-col items-center justify-center">
          <h1 class="text-3xl font-semibold mb-8">Edit Brand</h1>
          <div class="w-full max-w-md">
            <form class="text-center" @submit.prevent="handleEdit" novalidate>
              <!-- Display existing brand data -->
              <label for="name" class="mb-4">
                <input v-model="form.name" type="text" placeholder="Name" class="input-field border-red-500" required />
                <span class="text-sm text-red-500" v-if="!form.name">Please enter a name</span>
              </label>
              <label for="country_of_origin" class="mb-4">
                <select v-model="form.country_of_origin" class="input-field border-red-500" required>
                  <option value="" disabled>Select a country</option>
                  <option v-for="country in countries" :key="country" :value="country">{{ country }}</option>
                </select>
                <span class="text-sm text-red-500" v-if="!form.country_of_origin">Please select a country</span>
              </label>
              <!-- Add other brand editing fields here -->

              <div class="flex flex-col space-y-4 pt-4">
                <button
                  type="submit"
                  :disabled="isEditButtonDisabled"
                  :class="{
                    'py-2 px-5 flex justify-center bg-blue-300 text-white rounded-lg cursor-not-allowed':
                      isEditButtonDisabled,
                    'btn-primary': !isEditButtonDisabled
                  }"
                >
                  Update
                </button>
              </div>
            </form>
          </div>
        </div>
        <!--photo-->
        <div
          v-if="photos.length === 0" 
          class="drop-area border-2 border-dashed border-gray-300 p-4 text-center"
          @dragover.prevent
          @dragenter.prevent
          @drop="handleDrop"
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
import { useBrandStore } from '@/stores/useBrandStore';
import { useRoute } from 'vue-router';

const { update } = useBrandStore()
const route = useRoute();



const form = ref({
  name: '',
  country_of_origin: ''
});

const isEditButtonDisabled = computed(() => {
  return !form.value.name || !form.value.country_of_origin;
});

const handleEdit = () => {
  // Prepare data to be sent to the store method
  const brandRequest = {
    name: form.value.name,
    country_of_origin: form.value.country_of_origin,
    logo_url: images.value[0] // Assuming only one image is allowed
  };
  const brandId = route.params.id;
  // Call the store method to register the brand
  try {
    update(parseInt(brandId as string), brandRequest); // Assuming store method handles the form data and performs the API call
    console.log('Brand registered successfully.');
    // Clear form fields and uploaded photo after successful registration
    form.value.name = '';
    form.value.country_of_origin = '';
    photos.value = [];
    images.value = [];
  } catch (error) {
    console.error('Error registering brand:', error);
  }
}
// Photos
const photos = ref<{ url: string }[]>([]);
const images = ref<File[]>([]);

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
  if (photos.value.length === 0) { // Check if a photo has already been uploaded
    for (let i = 0; i < files.length; i++) {
      const file = files[i];
      if (file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = () => {
          photos.value.push({ url: reader.result as string });
        };
        reader.readAsDataURL(file);
        images.value.push(file);
      }
    }
  }
};

const deletePhoto = (index: number) => {
  photos.value.splice(index, 1);
  images.value.splice(index, 1);
};

const countries = ["Kosova", "Shqiperia", "Japan"];
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
