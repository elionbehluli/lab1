<template>
  <nav class="bg-gray-800 py-4">
    <div class="max-w-7xl mx-auto px-4">
      <div class="flex justify-between">
        <div class="flex space-x-4">
          <router-link to="/" class="text-white text-xl font-bold">Your Logo</router-link>

          <router-link to="/" class="text-white hover:text-gray-300">Home</router-link>
          <router-link to="/about" class="text-white hover:text-gray-300">About</router-link>
          <router-link to="/services" class="text-white hover:text-gray-300">Services</router-link>
          <router-link to="/cars" class="text-white hover:text-gray-300">Cars</router-link>
          <router-link to="/contact" class="text-white hover:text-gray-300">Contact</router-link>
        </div>

        <div class="flex space-x-4" v-if="!authStore.user">
          <router-link to="/login" class="text-white hover:text-gray-300">
            <button class="text-white hover:text-gray-300">Login</button>
          </router-link>
          <router-link to="/register" class="text-white hover:text-gray-300">
            <button class="text-white hover:text-gray-300">Register</button>
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
