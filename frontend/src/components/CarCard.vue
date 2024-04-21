<template>
  <div class="bg-white shadow-lg rounded-lg overflow-hidden" @click="goToCar(car.id)">
    <img :src="car.images[0].image_url" :alt="car.model" class="w-full h-56 object-cover" />
    <div class="p-4">
      <h2 class="text-xl font-semibold text-gray-800">{{ car.model }}</h2>
      <p class="text-gray-600">{{ car.brand_name }}</p>
      <div class="mt-4 flex justify-between items-center">
        <span class="font-bold text-xl text-gray-800">{{ car.price }}</span>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { defineProps, type PropType } from 'vue'
import { useRouter } from 'vue-router'

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
