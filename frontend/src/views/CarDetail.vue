<template>
  <div v-if="car">
    <h1>{{ car.brand_name }} {{ car.model }}</h1>
    <p>Year: {{ car.year }}</p>
    <p>Color: {{ car.color }}</p>
    <img v-if="car.images.length > 0" :src="car.images[0].image_url" width="100" height="100" />
  </div>
</template>

<script lang="ts" setup>
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import { useCarStore } from '@/stores/useCarStore'

const car = ref<Car>()
const route = useRoute()
const { show } = useCarStore()

onMounted(async () => {
  const carId = route.params.id
  try {
    const response = await show(parseInt(carId as string))
    if (response) {
      car.value = response
    }
  } catch {
    console.error('error')
  }
})
</script>
