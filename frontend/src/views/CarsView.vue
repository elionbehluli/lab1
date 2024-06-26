<template>
  <div class="m-20">
    <h1 class="mb-10 text-4xl font-bold text-gray-800">CARS</h1>
    <div class="flex mb-4">
      <button @click="toggleSortOrder('price')" :class="{ 'bg-gray-800': sortCriterion === 'price'}" class="px-4 py-2 text-white font-semibold rounded hover:bg-blue-900 focus:outline-none focus:bg-blue-900">
        {{ sortButtonText('price') }}
      </button>
      <button @click="toggleSortOrder('mileage')" :class="{ 'bg-gray-800': sortCriterion === 'mileage' }" class="px-4 py-2 ml-4 text-white font-semibold rounded hover:bg-blue-900 focus:outline-none focus:bg-blue-900">
        {{ sortButtonText('mileage') }}
      </button>
    </div>
    <div class="grid grid-cols-3 gap-4">
      <CarCard v-for="(car, index) in sortedCars" :key="index" :car="car" :card-width="cardWidth" />
    </div>
  </div>
</template>

<script setup lang="ts">
import CarCard from '@/components/CarCard.vue'
import { useCarStore } from '@/stores/useCarStore'
import { ref, computed } from 'vue'
import { useSorted } from '@vueuse/core'

const { cars } = useCarStore()
const cardWidth = 'calc(25% - 10px)'
const isAscending = ref(false)
const sortCriterion = ref<'price' | 'mileage'>('price')

const sortedCars = computed(() => {
  return sortCriterion.value === 'price'
    ? isAscending.value
      ? useSorted(cars, (a, b) => a.price - b.price).value
      : useSorted(cars, (a, b) => b.price - a.price).value
    : isAscending.value
      ? useSorted(cars, (a, b) => a.mileage - b.mileage).value
      : useSorted(cars, (a, b) => b.mileage - a.mileage).value
})

const toggleSortOrder = (criteria: 'price' | 'mileage') => {
  if (sortCriterion.value === criteria) {
    isAscending.value = !isAscending.value
  } else {
    isAscending.value = true
    sortCriterion.value = criteria
  }
}

const sortButtonText = (criteria: 'price' | 'mileage') => {
  const ascendingText = criteria === 'price' ? 'by lowest price' : 'by lowest mileage'
  const descendingText = criteria === 'price' ? 'by highest price' : 'by highest mileage'
  return isAscending.value ? ascendingText : descendingText
}
</script>
