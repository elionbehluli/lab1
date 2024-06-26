<template>
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
      <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
        <h2 class="text-2xl font-bold mb-4">Add Car Part</h2>
        <form @submit.prevent="handleSubmit">
          <div class="mb-4">
            <label class="block text-gray-700">Car Part</label>
            <select v-model="selectedCarPart" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500">
              <option v-for="carPart in carParts" :key="carPart.id" :value="carPart.id">{{ carPart.name }}</option>
            </select>
          </div>
          <div class="flex justify-end space-x-4">
            <button @click="cancel" type="button" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700 transition duration-300">Cancel</button>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300">Add</button>
          </div>
        </form>
      </div>
    </div>
  </template>
  
  <script setup lang="ts">
  import { ref } from 'vue';
  import { useCarPartsStore } from '@/stores/useCarPartsStore';
  
  // Define emits for the component
  const emit = defineEmits(['submit', 'cancel']);
  
  // Reactive variables
  const selectedCarPart = ref<number | null>(null);
  const { carParts } = useCarPartsStore(); // Adjust according to your actual store logic
  
  // Handle form submission
  const handleSubmit = () => {
    if (selectedCarPart.value !== null) {
      emit('submit', selectedCarPart.value);
    }
  };
  
  // Handle cancel action
  const cancel = () => {
    emit('cancel');
  };
  </script>
  
  <style scoped>
  /* Add scoped styles as needed */
  </style>
  