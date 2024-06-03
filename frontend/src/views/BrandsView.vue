<template>
  <div class="m-20">
    <h1 class="mb-10 text-4xl font-bold text-gray-800">BRANDS</h1>
    <div class="grid grid-cols-3 gap-4">
      <BrandCard v-for="(brand, index) in brands" :key="index" :brand="brand" :card-width="cardWidth" />
    </div>
    <div v-if="authStore.isAdmin">
      <router-link to="/register-brand" class="text-black hover:text-gray-300">
        <button class="py-1 px-2">Register</button>
      </router-link>
    </div>
  </div>
</template>

<script setup lang="ts">
import BrandCard from '@/components/BrandCard.vue'
import { useBrandStore } from '@/stores/useBrandStore'
import { ref, computed } from 'vue'
import { useAuthStore } from '@/stores/useAuthStore';

const { brands } = useBrandStore()
const cardWidth = 'calc(25% - 10px)'
const authStore = useAuthStore();


</script>
