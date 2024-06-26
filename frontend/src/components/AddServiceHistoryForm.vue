<template>
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
      <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
        <h2 class="text-2xl font-bold mb-4">Add Service History</h2>
        <form @submit.prevent="handleSubmit">
          <div class="mb-4">
            <label class="block text-gray-700">Service</label>
            <select v-model="selectedService" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500">
              <option v-for="service in services" :key="service.id" :value="service.id">{{ service.name }}</option>
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
  import { useServiceStore } from '@/stores/useServiceStore';
  
  // Define emits for the component
  const emit = defineEmits(['submit', 'cancel']);
  
  // Reactive variables
  const selectedService = ref<number | null>(null);
  const { services } = useServiceStore(); // Adjust according to your actual store logic
  
  // Handle form submission
  const handleSubmit = () => {
    if (selectedService.value !== null) {
      emit('submit', selectedService.value);
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
  