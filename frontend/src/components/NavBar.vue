<template>
  <nav class="bg-gray-800 py-4">
    <div class="max-w-7xl mx-auto px-4">
      <div class="flex justify-between">
        <div class="flex space-x-4">
          <router-link to="/" class="text-white text-xl font-bold">Your Logo</router-link>

          <router-link to="/" class="page-link" :class="{ 'active-link': $route.path === '/' }"
            >Home</router-link
          >
          <router-link
            to="/about"
            class="page-link"
            :class="{ 'active-link': $route.path === '/about' }"
            >About</router-link
          >
          <router-link
            to="/services"
            class="page-link"
            :class="{ 'active-link': $route.path === '/services' }"
            >Services</router-link
          >
          <router-link
            to="/cars"
            class="page-link"
            :class="{ 'active-link': $route.path === '/cars' }"
            >Cars</router-link
          >
          <router-link
            to="/contact"
            class="page-link"
            :class="{ 'active-link': $route.path === '/contact' }"
            >Contact</router-link
          >
        </div>

        <div class="flex space-x-4" v-if="!authStore.user">
          <router-link to="/login" class="text-white hover:text-gray-300">
            <button
              class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-1 px-2 border border-blue-500 hover:border-transparent rounded"
            >
              Login
            </button>
          </router-link>
          <router-link to="/register" class="text-white hover:text-gray-300">
            <button class="py-1 px-2">Register</button>
          </router-link>
        </div>
        <div class="flex space-x-4" v-else>
          <router-link to="/login" class="text-white hover:text-gray-300">
            <button class="text-white hover:text-gray-300">Dashboard</button>
          </router-link>
          <router-link to="/register" class="text-white hover:text-gray-300">
            <button class="text-white hover:text-gray-300">Logout</button>
          </router-link>
        </div>
      </div>
    </div>
  </nav>
</template>

<script lang="ts" setup>
import { useAuthStore } from '@/stores/useAuthStore'

const authStore = useAuthStore()
</script>

<style>
.page-link,
.button {
  color: white;
  transition: all 0.3s ease;
}

.page-link:hover {
  background-color: rgb(59 130 246);
  border-radius: 8px;
  padding: 0.1em 0.5em;
}

.active-link {
  background-color: rgb(59 130 246);
  border-radius: 8px;
  padding: 0.1em 0.5em;
}
</style>
