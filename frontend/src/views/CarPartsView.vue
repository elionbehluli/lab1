<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Car Parts</h1>
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
      <table class="min-w-full">
        <thead class="bg-gray-50">
          <tr>
            <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Name</th>
            <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Description</th>
            <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Price</th>
            <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Year of production</th>

          </tr>
        </thead>
        <tbody>
          <tr v-if="carParts.length === 0">
            <td colspan="4" class="py-2 px-4 text-center text-gray-500">No car parts found</td>
          </tr>
          <tr v-for="carPart in carParts" :key="carPart.id" class="border-t">
            <!-- <td class="py-2 px-4">{{ carPart.name }}</td> -->
            <!-- <td class="py-2 px-4">
              <router-link :to="'/car-detail/' + carPart.id" class="text-blue-500 hover:underline">
                {{ carPart.name }}
              </router-link>
            </td> -->
            <td class="py-2 px-4">
              <router-link :to="{ name: 'CarPartsDetail', params: { id: carPart.id } }" class="text-blue-500 hover:underline">
                {{ carPart.name }}
              </router-link>
         </td>
            <td class="py-2 px-4">{{ carPart.description }}</td>
            <td class="py-2 px-4">{{ carPart.price }}</td>
            <td class="py-2 px-4">{{ carPart.year_of_production }}</td>


          </tr>
        </tbody>
      </table>
    </div>
    <div v-if="authStore.isAdmin">
      <router-link to="/add-car-parts" class="text-black hover:text-gray-300">
        <button class="py-1 px-2 bg-blue-500 text-white rounded hover:bg-blue-600 hover:text-white">Add</button>
      </router-link>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { useCarPartsStore } from '@/stores/useCarPartsStore'; // Adjust based on your store path
import { useRouter } from 'vue-router';
// import { CarParts } from '@/types'; // Adjust based on your type definitions
import { useAuthStore } from '@/stores/useAuthStore'

const { carParts } = useCarPartsStore();
const router = useRouter();
const authStore = useAuthStore();

console.log(carParts)
</script>

<style scoped>
/* Add any additional styling here if needed */
</style>
