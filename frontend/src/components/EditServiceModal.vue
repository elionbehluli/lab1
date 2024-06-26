<template>
  <div class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
    <div class="bg-white p-6 rounded shadow-lg">
      <div class="mb-4">
        <label for="input1" class="block text-sm font-medium text-gray-700">Name</label>
        <input type="text" id="name" v-model="name" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
      </div>
      <div class="mb-4">
        <label for="input2" class="block text-sm font-medium text-gray-700">Description</label>
        <input type="text" id="description" v-model="description" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
      </div>
      <div class="flex justify-end">
        <button @click="$emit('close')" class="bg-gray-500 text-white px-4 py-2 rounded mr-2 hover:bg-gray-600">
          Cancel
        </button>
        <button @click="save" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
          Save
        </button>
      </div>
    </div>
  </div>
</template>


<script setup lang="ts">
import { ref, defineEmits } from 'vue';

defineProps({
  name: {
    type: String,
    required: true,
  },
  description: {
    type: String,
    required: true,
  }
});

const emit = defineEmits(['save', 'close']); // Define emits with the 'save' and 'close' events

const name = ref('');
const description = ref('');

const save = () => {
  // Create an object with all the values and emit it
  const body: ServiceRequest = {
    name: name.value,
    description: description.value
  };
  emit('save', body);
};
</script>

<style scoped>
/* Add any additional styling here if needed */
</style>
