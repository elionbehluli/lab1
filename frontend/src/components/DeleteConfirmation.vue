<template>
  <div
    v-if="isVisible"
    class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50"
  >
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm mx-auto">
      <h3 class="text-lg font-semibold mb-4">Confirm Deletion</h3>
      <p class="mb-6">Are you sure you want to delete this item? This action cannot be undone.</p>
      <div class="flex justify-end space-x-4">
        <button
          @click="confirmDeletion"
          class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700"
        >
          Delete
        </button>
        <button
          @click="cancelDeletion"
          class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400"
        >
          Cancel
        </button>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { defineEmits } from 'vue'

defineProps<{
  isVisible: boolean
}>()

const emit = defineEmits<{
  (e: 'confirm'): void
  (e: 'cancel'): void
}>()

const confirmDeletion = () => {
  emit('confirm')
}

const cancelDeletion = () => {
  emit('cancel')
}
</script>

<style scoped>
/* If you have any scoped styles, include them here */
</style>
