<template>
  <div v-if="isVisible">
    <form @submit.prevent="saveCar">
      <!-- Form fields for editing car details -->
      <label for="model">Model:</label>
      <input type="text" id="model" v-model="editedCar.model" class="border rounded-md px-2 py-1">

      <label for="color">Color:</label>
      <input type="text" id="color" v-model="editedCar.color" class="border rounded-md px-2 py-1">

      <label for="year">Year:</label>
      <input type="text" id="year" v-model="editedCar.year" class="border rounded-md px-2 py-1">

      <label for="price">Price:</label>
      <input type="text" id="price" v-model="editedCar.price" class="border rounded-md px-2 py-1">

      <label for="mileage">Mileage:</label>
      <input type="text" id="mileage" v-model="editedCar.mileage" class="border rounded-md px-2 py-1">

      <label for="transmission_type">Transmission Type:</label>
      <input type="text" id="transmission_type" v-model="editedCar.transmission_type" class="border rounded-md px-2 py-1">

      <label for="fuel_type">Fuel Type:</label>
      <input type="text" id="fuel_type" v-model="editedCar.fuel_type" class="border rounded-md px-2 py-1">

      <label for="engine_size">Engine Size:</label>
      <input type="text" id="engine_size" v-model="editedCar.engine_size" class="border rounded-md px-2 py-1">

      <label for="number_of_seats">Number of Seats:</label>
      <input type="text" id="number_of_seats" v-model="editedCar.number_of_seats" class="border rounded-md px-2 py-1">

      <label for="body_type">Body Type:</label>
      <input type="text" id="body_type" v-model="editedCar.body_type" class="border rounded-md px-2 py-1">


      <div v-for="(feature, index) in editedCar.features" :key="index" class="mb-2">
        <label :for="'feature-' + index">Feature {{ index + 1 }}:</label>
        <input type="text" :id="'feature-' + index" v-model="editedCar.features[index]" class="border rounded-md px-2 py-1">
        <button type="button" @click="removeFeature(index)" class="bg-red-500 text-white px-2 py-1 rounded">Remove</button>
      </div>
      <button type="button" @click="addFeature" class="bg-green-500 text-white px-2 py-1 rounded">Add Feature</button>

      <!-- Add more form fields for other car details as needed -->

      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md mt-4">Save</button>
      <button type="button" @click="$emit('cancel')" class="bg-gray-500 text-white px-4 py-2 rounded-md mt-4 ml-2">Cancel</button>
    </form>
  </div>
</template>

<script setup lang="ts">
import { defineProps, defineEmits } from 'vue';
import { ref } from 'vue';

const props = defineProps<{
  car: Car;
  isVisible: boolean;
}>();

const emits = defineEmits(['confirm', 'cancel']);

const editedCar = ref({ ...props.car });

const saveCar = () => {
  emits('confirm', editedCar.value);
};

const addFeature = () => {
  editedCar.value.features.push('');
};

const removeFeature = (index: number) => {
  editedCar.value.features.splice(index, 1);
};
</script>
