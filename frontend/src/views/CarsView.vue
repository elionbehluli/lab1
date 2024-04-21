<template>
  <div class="car-container">
    <h1 class="page-title">CARS</h1>
    <div class="car-grid">
      <CarCard v-for="(car, index) in cars" :key="index" :car="car" :cardWidth="cardWidth" />
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import CarCard from '@/components/CarCard.vue'; // Import the CarCard component

const cars = ref([
  {
    photo: 'http://127.0.0.1:8000/storage/car_images/3/8kWNrSkpVRmcONv5f24pGua5EoKuomDVMgEV0UVg.jpg',
    brand: 'Toyota',
    model: 'Camry',
    mileage: '50,000',
    year: '2018',
    transmission_type: 'automatic'
  },
  {
    photo: 'http://example.com/photo2.jpg',
    brand: 'Honda',
    model: 'Accord',
    mileage: '40,000',
    year: '2018',
    transmission_type: 'automatic'
  },
  {
    photo: 'http://example.com/photo3.jpg',
    brand: 'Ford',
    model: 'Mustang',
    mileage: '60,000',
    year: '2018',
    transmission_type: 'automatic'
  },
  {
    photo: 'http://example.com/photo4.jpg',
    brand: 'Chevrolet',
    model: 'Camaro',
    mileage: '70,000',
    year: '2018',
    transmission_type: 'automatic'
  },
  {
    photo: 'http://example.com/photo5.jpg',
    brand: 'Tesla',
    model: 'Model S',
    mileage: '30,000',
    year: '2018',
    transmission_type: 'automatic'
  }
]);

const cardWidth = 'calc(25% - 10px)'; // Adjust card width to fit 4 cards per row
</script>

<style scoped lang="scss">
.car-container {
  margin: 20px;
}

.page-title {
  font-size: 24px;
  margin-bottom: 20px;
}

.car-grid {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
}

/* Card styling */
.car-card {
  border: 2px solid #ddd;
  border-radius: 8px;
  overflow: hidden;
  width: calc(25% - 10px); /* Adjust card width to fit 4 cards per row */
  margin-bottom: 20px;
  transition: transform 0.3s ease-in-out, border-width 0.3s ease-in-out;

  @media (max-width: 992px) {
    width: calc(33.33% - 10px); /* Adjust card width to fit 3 cards per row on smaller screens */
  }

  @media (max-width: 768px) {
    width: calc(50% - 10px); /* Adjust card width to fit 2 cards per row on smaller screens */
  }
}
</style>

