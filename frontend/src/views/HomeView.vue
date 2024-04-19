<template>
  <div>
    <!-- Featured Cars Section -->
    <section class="py-12 bg-gray-100">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Featured Cars</h2>
        <!-- Featured Cars Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
          <!-- Featured Car Card -->
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

    <!-- Reviews Section -->
    <section class="py-12 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Reviews</h2>
        <!-- Reviews Carousel or Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
          <!-- Review Card -->
          <div v-for="(review, index) in reviews" :key="index" class="bg-gray-100 p-6 rounded-lg">
            <p class="text-gray-700">{{ review.content }}</p>
            <p class="text-gray-600 mt-2">{{ review.author }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Short About Us Section -->
    <section class="py-12 bg-gray-100">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">About Us</h2>
        <!-- About Us Content -->
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

    <!-- Footer Section -->
    <footer class="bg-gray-800 py-12 text-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
          <!-- Footer Navigation Links -->
          <div>
            <h3 class="text-lg font-semibold mb-4">Navigation</h3>
            <ul>
              <li><router-link to="/" class="hover:underline">Home</router-link></li>
              <li><router-link to="/about" class="hover:underline">About Us</router-link></li>
              <li><router-link to="/services" class="hover:underline">Services</router-link></li>
              <li><router-link to="/contact" class="hover:underline">Contact</router-link></li>
            </ul>
          </div>
          <!-- Contact Information -->
          <div>
            <h3 class="text-lg font-semibold mb-4">Contact Us</h3>
            <p>123 Street Name, City, Country</p>
            <p>Email: info@example.com</p>
            <p>Phone: +123 456 7890</p>
          </div>
          <!-- Social Media Links -->
          <div>
            <h3 class="text-lg font-semibold mb-4">Follow Us</h3>
            <div class="flex space-x-4">
              <a href="#" class="text-white hover:text-gray-400"><i class="fab fa-facebook"></i></a>
              <a href="#" class="text-white hover:text-gray-400"><i class="fab fa-twitter"></i></a>
              <a href="#" class="text-white hover:text-gray-400"
                ><i class="fab fa-instagram"></i
              ></a>
              <a href="#" class="text-white hover:text-gray-400"><i class="fab fa-linkedin"></i></a>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'

const featuredCars = ref([
  {
    id: 1,
    name: 'Car 1',
    image: 'car1.jpg',
    description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
  },
  {
    id: 2,
    name: 'Car 2',
    image: 'car2.jpg',
    description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
  },
  {
    id: 3,
    name: 'Car 3',
    image: 'car3.jpg',
    description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
  }
])
// Sample reviews data
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
/* Add your custom styling here */
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
