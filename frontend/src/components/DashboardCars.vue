<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Cars List</h1>
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
      <table class="min-w-full">
        <thead class="bg-gray-50">
          <tr>
            <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Image</th>
            <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Brand Name</th>
            <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Model</th>
            <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Color</th>
            <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Year</th>
            <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Price</th>
            <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Mileage</th>
            <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Transmission</th>
            <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Fuel Type</th>
            <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Engine Size</th>
            <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Seats</th>
            <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Body Type</th>
            <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Features</th>
            <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="car in cars" :key="car.id" class="border-t">
            <td class="py-2 px-4" @click="showImagesModal(car)">
              <img
                :src="car.images[0].image_url"
                class="input bg-gray-50"
                style="width: 30em; height: 9em"
              />
            </td>
            <td class="py-2 px-4"><input v-model="car.brand_name" class="input bg-gray-50" /></td>
            <td class="py-2 px-4"><input v-model="car.model" class="input bg-gray-50" /></td>
            <td class="py-2 px-4"><input v-model="car.color" class="input bg-gray-50" /></td>
            <td class="py-2 px-4">
              <input v-model.number="car.year" type="number" class="input bg-gray-50" />
            </td>
            <td class="py-2 px-4">
              <input v-model.number="car.price" type="number" class="input bg-gray-50" />
            </td>
            <td class="py-2 px-4">
              <input v-model.number="car.mileage" type="number" class="input bg-gray-50" />
            </td>
            <td class="py-2 px-4">
              <input v-model="car.transmission_type" class="input bg-gray-50" />
            </td>
            <td class="py-2 px-4"><input v-model="car.fuel_type" class="input bg-gray-50" /></td>
            <td class="py-2 px-4">
              <input v-model.number="car.engine_size" type="number" class="input bg-gray-50" />
            </td>
            <td class="py-2 px-4">
              <input v-model.number="car.number_of_seats" type="number" class="input bg-gray-50" />
            </td>
            <td class="py-2 px-4"><input v-model="car.body_type" class="input bg-gray-50" /></td>
            <td class="py-2 px-4">
              <button
                @click="showFeatureModal(car)"
                class="bg-blue-500 text-white py-1 px-2 rounded hover:bg-blue-600"
              >
                Edit Features
              </button>
            </td>
            <td class="py-2 px-4">
              <button
                class="bg-blue-500 text-white py-1 px-2 rounded hover:bg-blue-600"
                @click="saveCar(car)"
              >
                Save
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <FeatureModal
      v-if="selectedCar"
      :features="selectedCar.features"
      :isVisible="isFeaturesModalVisible"
      @update-features="handleUpdatedFeatures"
      @cancel="isFeaturesModalVisible = false"
    />
    <CarImageModal
      v-if="selectedCar"
      :carImages="selectedCar.images"
      :isVisible="isImagesModalVisible"
      @update-images="handleUpdatedImages"
      @cancel="isImagesModalVisible = false"
    />
  </div>
</template>

<script setup lang="ts">
import { useCarStore } from '@/stores/useCarStore'
import FeatureModal from '@/components/FeatureModal.vue'
import CarImageModal from '@/components/CarImageModal.vue'

import { ref } from 'vue'

const { cars, update, storeImages, deleteImages } = useCarStore()

const selectedImages = ref<Image[]>([])
const selectedCar = ref<Car>()
const isFeaturesModalVisible = ref(false)
const isImagesModalVisible = ref(false)

function showFeatureModal(car: Car) {
  selectedCar.value = car
  console.log('Selected Car:', selectedCar.value.features)
  isFeaturesModalVisible.value = true
}

function handleUpdatedFeatures(updatedFeatures: any) {
  // Here you would update the features in your data/state
  console.log('Updated Features:', updatedFeatures)
  if (selectedCar.value) {
    // Now directly assigning updated features, handled through reactive props
    saveCar(selectedCar.value)
  }
  // Close the modal if needed
  isFeaturesModalVisible.value = false
}

function showImagesModal(car: Car) {
  selectedCar.value = car
  selectedImages.value = car.images
  isImagesModalVisible.value = true
}

async function handleUpdatedImages({ newImages, deletedImageIds }) {
  // Logic to update images in your backend
  console.log('New Images:', newImages)
  console.log('Deleted Image IDs:', deletedImageIds)
  if (newImages.length > 0) {
    if (selectedCar.value) {
      console.log('Selected Car:', selectedCar.value)
      await storeImages(selectedCar.value.id, newImages)
    }
  }

  // Delete the specified images
  if (deletedImageIds.length > 0) {
    await deleteImages(deletedImageIds)
  }
  isImagesModalVisible.value = false
}

async function saveCar(car: Car) {
  await update(car.id, car)
}
</script>

<style scoped>
.input {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
}
</style>
