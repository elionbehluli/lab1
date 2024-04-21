<template>
  <div class="m-20">
    <h1 class="mb-10 text-2xl">CARS</h1>
    <div class="grid grid-cols-3 gap-4">
      <CarCard v-for="(car, index) in cars" :key="index" :car="car" :card-width="cardWidth" />
    </div>
  </div>
</template>

<script setup lang="ts">
import CarCard from '@/components/CarCard.vue'
import { useCarStore } from '@/stores/useCarStore'

const { cars } = useCarStore()
const cardWidth = 'calc(25% - 10px)'
</script>
