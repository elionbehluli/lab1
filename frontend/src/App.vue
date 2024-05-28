<template>
  <div>
    <RouterView />
    <Snackbar />
  </div>
</template>

<script setup lang="ts">
import Snackbar from '@/components/SnackBar.vue'
import { useCarStore } from './stores/useCarStore'
import { onMounted } from 'vue'

const carStore = useCarStore()

onMounted(async () => {
  // TODO: Replace this funciton in Admin dashboard after creating a car
  await carStore.index()
})
</script>

<style scoped></style>