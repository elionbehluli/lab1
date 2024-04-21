<template>
  <div>
    <section class="py-12 bg-gray-100">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Featured Cars</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
          <div
            v-for="(car, index) in featuredCars"
            :key="index"
            class="bg-white shadow-md rounded-lg overflow-hidden"
          >
            <img :src="car.image" :alt="car.name" class="w-full h-48 object-cover" />
            <div class="p-4">
              <h3 class="text-lg font-semibold text-gray-800">{{ car.name }}</h3>
              <p class="text-sm text-gray-600">{{ car.description }}</p>
              <router-link
                :to="'/cars/' + car.id"
                class="mt-2 block text-blue-500 hover:underline view-details-btn"
                >View Details</router-link
              >
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="py-12 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Reviews</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
          <div v-for="(review, index) in reviews" :key="index" class="bg-gray-100 p-6 rounded-lg">
            <p class="text-gray-700">{{ review.content }}</p>
            <p class="text-gray-600 mt-2">{{ review.author }}</p>
          </div>
        </div>
      </div>
    </section>

    <section class="py-12 bg-gray-100">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">About Us</h2>
        <p class="text-gray-700">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam fermentum libero nec quam
          sodales, vitae feugiat ipsum tincidunt. Duis vel nisi nec eros gravida blandit ut nec
          lacus. Nullam ac libero ac elit aliquet faucibus. Phasellus suscipit vestibulum urna, eu
          facilisis leo cursus nec.
        </p>
        <p class="text-gray-700 mt-4">
          Suspendisse potenti. Pellentesque habitant morbi tristique senectus et netus et malesuada
          fames ac turpis egestas. Vivamus vel libero nec libero pellentesque tempor vitae sed
          tortor. Nulla nec purus id elit tincidunt venenatis.
        </p>
      </div>
    </section>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'

const featuredCars = ref([
  {
    id: 1,
    name: 'BMW M2 COUPÉ ',
    image: 'src/images/car1.png',
    description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
  },
  {
    id: 2,
    name: 'Mercedes-AMG G 63',
    image: 'src/images/car2.png',
    description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
  },
  {
    id: 3,
    name: 'Audi RS6',
    image: 'src/images/car3.png',
    description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
  }
])

const reviews = ref([
  {
    id: 1,
    content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
    author: 'John Doe'
  },
  {
    id: 2,
    content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
    author: 'Jane Doe'
  },
  {
    id: 3,
    content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
    author: 'Alex Smith'
  }
])
</script>

<style scoped>
.view-details-btn {
  background-color: #4a90e2;
  color: #fff;
  padding: 8px 16px;
  border-radius: 4px;
  text-align: center;
  text-decoration: none;
  transition: background-color 0.3s ease;
}

.view-details-btn:hover {
  background-color: #3579dc;
}
</style>
