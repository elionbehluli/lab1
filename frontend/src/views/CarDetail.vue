<template>
  <div v-if="car" class="max-w-4xl mx-auto mt-8 p-6 bg-white rounded-lg shadow-xl">
    <div class="mb-6">
      <Carousel :images="car.images" />
    </div>
    <div class="px-6 py-4 bg-gray-100 rounded-lg shadow-md flex justify-between items-center">
      <div>
        <h1 class="text-3xl font-bold mb-4 text-gray-800">{{ car.brand_name }} {{ car.model }}</h1>
        <p class="text-lg text-gray-700"><span class="font-semibold">Year:</span> {{ car.year }}</p>
        <p class="text-lg text-gray-700"><span class="font-semibold">Color:</span> {{ car.color }}</p>
        <p class="text-lg text-gray-700"><span class="font-semibold">Milage:</span> {{ car.mileage }}</p>
        <p class="text-lg text-gray-700"><span class="font-semibold">Transmission Type:</span> {{ car.transmission_type }}</p>
        <p class="text-lg text-gray-700"><span class="font-semibold">Fuel Type:</span> {{ car.fuel_type }}</p>
        <p class="text-lg text-gray-700"><span class="font-semibold">Engine Size:</span> {{ car.engine_size }}</p>
        <div v-if="car.features && car.features.length > 0" class="mt-4">
          <span class="font-semibold">Features:</span>
          <ul class="list-disc list-inside">
            <li v-for="feature in car.features" class="text-lg text-gray-700">{{ feature }}</li>
          </ul>
        </div>
      </div>
      <div class="text-right">
        <p class="text-2xl text-gray-700"><span class="font-semibold"></span> {{ car.price }}€</p>
      </div>
    </div>
    <div v-if="authStore.isAdmin" class="flex space-x-4 mt-6">
      <button
        @click="showDeleteConfirmation = true"
        class="bg-red-500 text-white px-6 py-3 rounded hover:bg-red-700 transition duration-300"
      >
        Delete Item
      </button>
      <button
        @click="showEditForm = true"
        class="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-700 transition duration-300"
      >
        Edit
      </button>
    </div>
    <DeleteConfirmation
      :isVisible="showDeleteConfirmation"
      @confirm="handleDeletion"
      @cancel="showDeleteConfirmation = false"
    />
    <EditCarForm
      :isVisible="showEditForm"
      :car="car"
      @confirm="handleEdit"
      @cancel="showEditForm = false"
    />
  </div>
</template>

<script lang="ts" setup>
import DeleteConfirmation from '@/components/DeleteConfirmation.vue';
import EditCarForm from '@/components/EditCarForm.vue';
import Carousel from '@/components/Carousel.vue';
import { ref, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { useCarStore } from '@/stores/useCarStore';
import { useAuthStore } from '@/stores/useAuthStore';

const car = ref<Car>();
const route = useRoute();
const router = useRouter();
const { show, update, storeImages, deleteImages } = useCarStore();
const carStore = useCarStore();
const authStore = useAuthStore();
const showDeleteConfirmation = ref(false);
const showEditForm = ref(false);

onMounted(async () => {
  const carId = route.params.id;
  try {
    const response = await show(parseInt(carId as string));
    if (response) {
      car.value = response;
    }
  } catch {
    console.error('error');
  }
});

const handleDeletion = async () => {
  const carId = route.params.id;
  try {
    const response = await carStore.delete(parseInt(carId as string));
    console.log('Item deleted', response);
    showDeleteConfirmation.value = false;
    router.push('/cars');
  } catch (error) {
    console.error('Failed to delete item:', error);
  }
};

const handleEdit = async ({ car: editedCar, newImages, deletedImageIds }: { car: Car; newImages: File[]; deletedImageIds: number[] }) => {
  try {
    console.log('New images:', newImages);
    console.log('Deleted image IDs:', deletedImageIds);

    // Update the car details
    const response = await update(editedCar.id, editedCar) as Car | any;

    // Store the new images
    if (newImages.length > 0) {
      await storeImages(editedCar.id, newImages);
    }

    // Delete the specified images
    if (deletedImageIds.length > 0) {
      await deleteImages(deletedImageIds);
    }

    if (response) {
      car.value = response;
      showEditForm.value = false;
    }
  } catch (error) {
    console.error('Failed to edit item:', error);
  }
};
</script>

<style scoped>
.carousel-container {
  max-height: 400px; /* Adjust based on your preference */
  overflow: hidden;
  border-radius: 0.5rem;
}

.carousel-image {
  object-fit: cover;
  width: 100%;
  height: auto;
}

button {
  transition: transform 0.2s ease;
}

button:hover {
  transform: scale(1.05);
}
</style>
