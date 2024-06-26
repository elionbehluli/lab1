<template>
  <div
    style="position: fixed; width: 17em"
    class="bg-gray-800 text-white w-64 space-y-6 py-7 px-2 absolute inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition duration-200 ease-in-out h-screen"
  >
    <!-- Logo or Branding -->
    <a href="#" class="text-white flex items-center space-x-2 px-4">
      <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <!-- SVG content for logo -->
      </svg>
      <span class="text-2xl font-extrabold">Dashboard </span>
    </a>

    <!-- Navigation Links -->
    <nav>
      <RouterLink
        to="/"
        class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700"
      >
        Home
      </RouterLink>
      <RouterLink
        to="/"
        href="#"
        class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700"
      >
        Profile
      </RouterLink>
      <RouterLink
        to="/"
        href="#"
        class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700"
      >
        Settings
      </RouterLink>
      <RouterLink
        to="/"
        href="#"
        class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700"
      >
        Logout
      </RouterLink>
      <div v-if="isLoggedIn && isAdmin">
        <div class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
          <button @click="emitViewChange('users')">All users</button>
        </div>
        <div class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
          <button @click="emitViewChange('cars')">All cars</button>
        </div>
        <div class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
          <button @click="emitViewChange('add-car')">Add cars</button>
        </div>
        <div class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
          <button @click="emitViewChange('services')">Services</button>
        </div>
        <div class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
          <button @click="emitViewChange('add-service')">Add Service</button>
        </div>
      </div>
    </nav>
  </div>
</template>

<script setup lang="ts">
import { useAuthStore } from '../stores/useAuthStore'

const { isLoggedIn, isAdmin } = useAuthStore()
const emit = defineEmits(['change-view'])

function emitViewChange(viewName: string) {
  emit('change-view', viewName)
}
</script>

<style scoped>
@media (min-width: 768px) {
  .transform {
    transform: translateX(0) !important;
  }
}
</style>
