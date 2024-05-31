<template>
  <div v-if="car">
    <h1>{{ car.brand_name }} {{ car.model }}</h1>
    <p>Year: {{ car.year }}</p>
    <p>Color: {{ car.color }}</p>
    <img v-if="car.images.length > 0" :src="car.images[0].image_url" width="100" height="100" />
    <div class="p-4" v-if="authStore.isAdmin">
      <button
        @click="showDeleteConfirmation = true"
        class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700"
      >
        Delete Item
      </button>
      <DeleteConfirmation
        :isVisible="showDeleteConfirmation"
        @confirm="handleDeletion"
        @cancel="showDeleteConfirmation = false"
      />
    </div>
    <div class="p-4" v-if="authStore.isAdmin">
      <button
        @click="showEditForm = true"
        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700"
      >
        Edit
      </button>
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
