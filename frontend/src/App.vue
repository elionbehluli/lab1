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
import { useBrandStore } from './stores/useBrandStore'
import { useUserStore } from './stores/useUserStore'
import { useServiceStore } from './stores/useServiceStore'


const carStore = useCarStore()
const brandStore = useBrandStore()
const userStore = useUserStore()
const serviceStore = useServiceStore()


onMounted(async () => {
  // TODO: Replace this funciton in Admin dashboard after creating a car
  await carStore.index()
  await brandStore.index()
  await userStore.index()
  await serviceStore.index()
})
</script>

<style scoped></style>