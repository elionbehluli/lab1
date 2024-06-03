<template>
  <div class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
    <div class="bg-white p-6 rounded shadow-lg">
      <h2 class="text-xl mb-4">Select User Role</h2>
      <div class="mb-4">
        <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
        <select v-model="selectedRole" id="role" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
          <option value="customer">customer</option>
          <option value="employee">employee</option>
        </select>
      </div>
      <div class="flex justify-end">
        <button @click="$emit('close')" class="bg-gray-500 text-white px-4 py-2 rounded mr-2 hover:bg-gray-600">
          Cancel
        </button>
        <button @click="saveRole" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
          Save
        </button>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, defineEmits } from 'vue';

const props = defineProps({
  initialRole: {
    type: String,
    required: true,
  },
});

const emit = defineEmits(['save', 'close']); // Define emits with the 'save' and 'close' events

const selectedRole = ref(props.initialRole);

const saveRole = () => {
  emit('save', selectedRole.value);
};
</script>

<style scoped>
/* Add any additional styling here if needed */
</style>
