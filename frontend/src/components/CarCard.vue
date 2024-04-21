<template>
  <div class="shadow-lg rounded-lg overflow-hidden hover:transform hover:scale-105 transition duration-300 ease-in-out" @click="goToCar(car.id)">
    <img :src="car.images[0].image_url" :alt="car.model" class="w-full h-56 object-cover" />
    <div class="p-4">
      <div class="rounded-lg text-white bg-gray-800 flex justify-between mb-2">
        <div class="px-3 py-1 rounded-full inline-block">{{ car.brand_name }}</div>
        <div class="px-3 py-1 rounded-full inline-block">{{ car.model }}</div>
      </div>
      <div class="mt-2 flex justify-between items-center">
        <span class="font-bold text-xl">{{ car.price }}€</span>
        <span class="font-bold text-l">{{ car.mileage }}km</span>
        <span class="font-bold text-l">{{ car.transmission_type }}</span>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { defineProps, type PropType } from 'vue'
import { useRouter } from 'vue-router'
import { Car } from '@/types/Car'

defineProps({
  car: {
    type: Object as PropType<Car>,
    required: true,
    default: () => {}
  },
  cardWidth: {
    type: String,
    default: '300px'
  }
})

const router = useRouter()

function goToCar(id: number) {
  router.push(`/cars/${id}`)
}
</script>
