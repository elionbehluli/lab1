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
import { useAuthStore } from './stores/useAuthStore'
import { useServiceStore } from './stores/useServiceStore'
import { useCarPartsStore } from './stores/useCarPartsStore'


const carStore = useCarStore()
const brandStore = useBrandStore()
const userStore = useUserStore()
const authStore = useAuthStore()
const serviceStore = useServiceStore()
const carPartsStore = useCarPartsStore()


onMounted(async () => {
  // TODO: Replace this funciton in Admin dashboard after creating a car
  await carStore.index()
  await carPartsStore.index()
  await brandStore.index()
  await serviceStore.index()
  if (authStore.isLoggedIn && authStore.isAdmin) {
    await userStore.index()
  }
  await carPartsStore.index()
})
</script>

<style scoped></style>
