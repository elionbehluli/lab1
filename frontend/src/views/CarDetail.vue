<template>
  <div class="flex justify-center mt-8 space-x-6">
    <!-- Section on the Left -->
    <div class="w-1/4 bg-gray-200 p-4 rounded-lg shadow-md">
      <h2 class="text-2xl font-bold mb-4 text-gray-800">Service Histories</h2>
      <div 
        v-for="history in specificCarServiceHistories" 
        :key="history.id" 
        class="mb-4 p-4 bg-white rounded-lg shadow relative group"
      >
        <p class="text-lg text-gray-700"><span class="font-semibold">Service:</span> {{ history.name }}</p>
        <p class="text-lg text-gray-700"><span class="font-semibold">Mileage at Service:</span> {{ history.mileage_at_service }}</p>
        <p class="text-lg text-gray-700"><span class="font-semibold">Date:</span> {{ history.created_at }}</p>
        <div class="absolute bottom-full mb-2 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-sm rounded-lg p-2 shadow-md opacity-0 group-hover:opacity-100 transition-opacity duration-300">
          Description: {{ history.description }}
        </div>
        <div v-if="authStore.isAdmin" class="flex space-x-4 mt-6">
          <button
            @click="confirmServiceHistoryDeletion(history.id)"
            class="bg-red-500 text-white px-6 py-3 rounded hover:bg-red-700 transition duration-300"
          >
            Delete Item
          </button>
        </div>
        <DeleteConfirmation
          :isVisible="showDeleteConfirmationForServiceHistory"
          @confirm="handleDeletionServiceHistory"
          @cancel="showDeleteConfirmationForServiceHistory = false"
        />
      </div>
      <div v-if="authStore.isAdmin" class="mt-6">
        <button
          @click="showAddServiceHistoryForm = true"
          class="bg-green-500 text-white px-6 py-3 rounded hover:bg-green-700 transition duration-300"
        >
          Add Service History
        </button>
      </div>
      <AddServiceHistoryForm
        v-if="showAddServiceHistoryForm"
        @submit="handleAddServiceHistory"
        @cancel="showAddServiceHistoryForm = false"
      />
    </div>
    
    <!-- Main Car Details Box -->
    <div v-if="car" class="max-w-4xl w-3/4 p-6 bg-white rounded-lg shadow-xl">
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
              <li v-for="feature in car.features" :key="feature" class="text-lg text-gray-700">{{ feature }}</li>
            </ul>
          </div>
        </div>
        <div class="text-right">
          <p class="text-2xl text-gray-700"><span class="font-semibold"></span> {{ car.price }}€</p>
        </div>
      </div>
      <div v-if="authStore.isAdmin" class="flex space-x-4 mt-6">
        <button
          @click="showDeleteConfirmationForCar = true"
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
        :isVisible="showDeleteConfirmationForCar"
        @confirm="handleDeletionCar"
        @cancel="showDeleteConfirmationForCar = false"
      />
      
      <EditCarForm
        :isVisible="showEditForm"
        :car="car"
        @confirm="handleEdit"
        @cancel="showEditForm = false"
      />
    </div>
  </div>
</template>

<script lang="ts" setup>
import DeleteConfirmation from '@/components/DeleteConfirmation.vue';
import EditCarForm from '@/components/EditCarForm.vue';
import AddServiceHistoryForm from '@/components/AddServiceHistoryForm.vue';
import Carousel from '@/components/Carousel.vue';
import { ref, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { useCarStore } from '@/stores/useCarStore';
import { useServiceHistoryStore } from '@/stores/useServiceHistoryStore';
import { useAuthStore } from '@/stores/useAuthStore';

const car = ref<Car>();
const route = useRoute();
const router = useRouter();
const { show, update, storeImages, deleteImages } = useCarStore();
const carStore = useCarStore();
const { specificCarSerciveHistory, specificCarServiceHistories, delete: deleteServiceHistory, store: addServiceHistory } = useServiceHistoryStore();
const authStore = useAuthStore();
const showDeleteConfirmationForCar = ref(false);
const showDeleteConfirmationForServiceHistory = ref(false);
const showEditForm = ref(false);
const showAddServiceHistoryForm = ref(false);
const serviceHistoryIdToDelete = ref<number | null>(null);

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
  await specificCarSerciveHistory(parseInt(carId as string));
});

const confirmServiceHistoryDeletion = (id: number) => {
  serviceHistoryIdToDelete.value = id;
  showDeleteConfirmationForServiceHistory.value = true;
};

const handleDeletionCar = async () => {
  const carId = route.params.id;
  try {
    const response = await carStore.delete(parseInt(carId as string));
    console.log('Item deleted', response);
    showDeleteConfirmationForCar.value = false;
    router.push('/cars');
  } catch (error) {
    console.error('Failed to delete item:', error);
  }
};

const handleDeletionServiceHistory = async () => {
  const carId = route.params.id;
  try {
    if (serviceHistoryIdToDelete.value) {
      const response = await deleteServiceHistory(serviceHistoryIdToDelete.value);
      console.log('Item deleted', response);
      // Refresh service histories
      await specificCarSerciveHistory(parseInt(carId as string));
    }
    showDeleteConfirmationForServiceHistory.value = false;
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

const handleAddServiceHistory = async (serviceId: number) => {
  const carId = route.params.id;
  try {
    const car = await carStore.show(parseInt(carId as string));

    if (car) {
      const newServiceHistory = {
        car_id: parseInt(carId as string),
        service_id: serviceId,
        mileage_at_service: car?.mileage
      };
      await addServiceHistory(newServiceHistory);
    }

    showAddServiceHistoryForm.value = false;
    await specificCarSerciveHistory(parseInt(carId as string)); // Refresh service histories
  } catch (error) {
    console.error('Failed to add service history:', error);
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
