<template>
  <div v-if="carParts">
    <div class="card-container">
      <div class="card-content">
        <h1>{{ carParts.name }}</h1>
        <p><strong>Description:</strong> {{ carParts.description }}</p>
        <p><strong>Price:</strong> ${{ carParts.price }}</p>
        <p><strong>Year of Production:</strong> {{ carParts.year_of_production }}</p>
        <div v-if="carParts.image_url" class="uploaded-photo">
          <img :src="carParts.image_url" :alt="'Car Part Image'" class="uploaded-image" />
        </div>
      </div>
      <div class="card-actions">
        <button v-if="!showEditForm" @click="showDeleteConfirmation = true" class="action-button delete-button">
          Delete Item
        </button>
        <DeleteConfirmation
          :isVisible="showDeleteConfirmation"
          @confirm="handleDeletion"
          @cancel="showDeleteConfirmation = false"
        />
        <button v-if="!showEditForm" @click="showEditForm = true" class="action-button edit-button">
          Edit
        </button>
      </div>
      <EditCarParts
        v-if="showEditForm"
        :isVisible="true"
        :carParts="carParts"
        @confirm="handleEdit"
        @cancel="showEditForm = false"
      />

      <!-- Display uploaded photos -->
      <div v-if="carParts.images && carParts.images.length > 0" class="uploaded-photos">
        <h2>Uploaded Photo:</h2>
        <div class="uploaded-photo">
          <img :src="carParts.images[0].image_url" :alt="'Uploaded Photo 1'" class="uploaded-image" />
        </div>
      </div>
    </div>
  </div>
</template>



<script lang="ts" setup>
import DeleteConfirmation from '@/components/DeleteConfirmation.vue';
import EditCarParts from '@/components/EditCarParts.vue';
import { ref, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { useCarPartsStore } from '@/stores/useCarPartsStore';
import { useAuthStore } from '@/stores/useAuthStore';

const carParts = ref<CarParts>();
const route = useRoute();
const router = useRouter();
const { show, update } = useCarPartsStore();
const carPartsStore = useCarPartsStore();
const authStore = useAuthStore();
const showDeleteConfirmation = ref(false);
const showEditForm = ref(false);

onMounted(async () => {
  const carPartsId = route.params.id;
  try {
    const response = await show(carPartsId);
    if (response) {
      carParts.value = response;
    }
  } catch {
    console.error('Error fetching car parts');
  }
});

const handleDeletion = async () => {
  const carPartsId = route.params.id;
  try {
    const response = await carPartsStore.delete(parseInt(carPartsId as string));
    console.log('Item deleted', response);
    showDeleteConfirmation.value = false;
    router.push('/car_parts');
  } catch (error) {
    console.error('Failed to delete item:', error);
  }
};

const handleEdit = async ({ carParts: editedCarParts }) => {
  try {
    const response = await update(editedCarParts.id, editedCarParts) as CarParts | any;
    if (response) {
      carParts.value = response;
      showEditForm.value = false;
    }
  } catch (error) {
    console.error('Failed to edit item:', error);
  }
};

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

.card-content p {
  font-size: 18px;
  line-height: 1.6;
  color: #555555;
}

.card-actions {
  margin-top: 20px;
  display: flex;
  justify-content: center;
}

.action-button {
  margin-right: 10px;
  padding: 8px 16px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.delete-button {
  background-color: #ff4d4f;
  color: #ffffff;
}

.edit-button {
  background-color: #1890ff;
  color: #ffffff;
}

.uploaded-photos {
  margin-top: 20px;
}

.uploaded-photo {
  margin-bottom: 10px;
}

.uploaded-image {
  max-width: 100%;
  height: auto;
}
</style>

