<template>
  <v-card :style="{ width: cardWidth }" class="car-card">
    <!-- Car Photo -->
    <div class="image-container">
      <img 
        :src="car.photo" 
        :alt="car.name" 
        class="car-photo"
      />
    </div>

    <!-- Car Details -->
    <v-card-text>
      <div class="car-details">
        <!-- Brand and Model -->
        <div class="car-title bg-navy text-white">
          <span class="brand">{{ car.brand }}</span>
          <span class="model">{{ car.model }}</span>
        </div>

        <!-- Additional Information -->
        <div class="info text-navy">
          <div>{{ car.mileage }} miles</div>
          <div>{{ car.year }}</div>
          <div>{{ car.transmission_type }}</div>
          <!-- Add more information fields here -->
        </div>
      </div>
    </v-card-text>
  </v-card>
</template>

<script setup lang="ts">
import { defineProps } from 'vue';

// Define props using defineProps
const props = defineProps({
  car: Object,
  cardWidth: {
    type: String,
    default: '300px'
  }
});
</script>

<style scoped lang="scss">
.car-card {
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
}

.image-container {
  width: 100%;
  height: 200px;
  overflow: hidden;
}

.car-photo {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.car-details {
  padding: 20px;
}

.car-title {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px;
  border-radius: 8px 8px 0 0;
}

.brand {
  font-weight: bold;
  font-size: 1.2rem;
}

.model {
  font-size: 1rem;
}

.info {
  padding: 10px;
  display: flex;
  justify-content: space-between;
}

.bg-navy {
  background-color: #001f3f;
}

.text-white {
  color: #fff;
}

.text-navy {
  color: #001f3f;
}
</style>