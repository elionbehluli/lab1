<template>
  <div v-if="snackbarStore.isVisible" class="items-center fixed bottom-0 left-0 right-0 py-8">
    <div
      :class="`mx-2 sm:mx-auto max-w-md flex flex-row items-center justify-between ${backgroundColor} p-4 text-base leading-none font-semibold rounded-xl whitespace-no-wrap`"
    >
      <div :class="`inline-flex items-center ${textColor}`">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-6 w-6 mr-4"
          viewBox="0 0 20 20"
          fill="currentColor"
        >
          <path fill-rule="evenodd" :d="svgIcon" clip-rule="evenodd" />
        </svg>
        {{ snackbarStore.message }}
      </div>
      <button @click="closeSnackbar" class="cursor-pointer">
        Close ({{ snackbarStore.countdown }}s)
      </button>
    </div>
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue'
import { useSnackbarStore } from '@/stores/useSnackbarStore'

const snackbarStore = useSnackbarStore()

const closeSnackbar = () => {
  clearTimeout(snackbarStore.timeoutId)
  snackbarStore.hideSnackbar()
}
const backgroundColor = computed(() => {
  if (snackbarStore.type === 'success') {
    return 'bg-green-200'
  } else if (snackbarStore.type === 'error') {
    return 'bg-red-200'
  } else if (snackbarStore.type === 'info') {
    return 'bg-blue-200'
  } else {
    return ''
  }
})

const textColor = computed(() => {
  if (snackbarStore.type === 'success') {
    return 'text-green-500'
  } else if (snackbarStore.type === 'error') {
    return 'text-red-500'
  } else if (snackbarStore.type === 'info') {
    return 'text-blue-500'
  } else {
    return ''
  }
})

const svgIcon = computed(() => {
  if (snackbarStore.type === 'success') {
    return 'M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z'
  } else if (snackbarStore.type === 'error') {
    return 'M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z'
  } else if (snackbarStore.type === 'info') {
    return 'M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z'
  } else {
    return ''
  }
})
</script>
