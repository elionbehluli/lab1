<template>
    <div class="min-h-screen flex items-center">
      <div class="card mx-auto w-full max-w-5xl shadow-xl">
        <div class="grid md:grid-cols-2 grid-cols-1 rounded-xl divide-slate-300 divide-x md:py-5">
          <div class="p-6 flex flex-col items-center justify-center">
            <h1 class="text-3xl font-semibold mb-8">
              Register a new Car
            </h1>
            <div class="w-full max-w-md">
              <form class="text-center" @submit.prevent="handleRegister" novalidate>
                <label for="brand_id">
                  <select v-model="form.brand_id" class="input-field border-red-500" required>
                    <option value="" disabled>Select a brand</option>
                    <option v-for="brand in brands" :key="brand.id" :value="brand.id">{{ brand.name }}</option>
                  </select>
                  <span class="text-sm text-red-500" v-if="!form.brand_id">Please select a brand</span>
                </label>

  
                <label for="model" class="mb-4">
                  <input
                    v-model="form.model"
                    type="text"
                    placeholder="Model"
                    class="input-field border-red-500"
                    required
                  />
                  <span class="text-sm text-red-500" v-if="!form.model">Please enter a model</span>
                </label>
                <label for="color">
                <input
                  v-model.number="form.color"
                  type="text"
                  placeholder="Color"
                  class="input-field border-red-500"
                  required
                />
                <span class="text-sm text-red-500" v-if="!form.color">Please enter a color</span>
              </label>

              <label for="year" class="mb-4">
                <input
                  v-model.number="form.year"
                  type="number"
                  placeholder="Year"
                  class="input-field border-red-500"
                  required
                />
                <span class="text-sm text-red-500" v-if="!form.year">Please enter a valid year</span>
              </label>

              <label for="price">
                <input
                  v-model.number="form.price"
                  type="number"
                  placeholder="Price"
                  class="input-field border-red-500"
                  required
                />
                <span class="text-sm text-red-500" v-if="!form.price">Please enter a valid price</span>
              </label>

              <label for="mileage" class="mb-4">
                <input
                  v-model.number="form.mileage"
                  type="number"
                  placeholder="Mileage"
                  class="input-field border-red-500"
                  required
                />
                <span class="text-sm text-red-500" v-if="!form.mileage">Please enter valid mileage</span>
              </label>

              <label for="transmission_type">
                <input
                  v-model="form.transmission_type"
                  type="text"
                  placeholder="Transmission Type"
                  class="input-field border-red-500"
                  required
                />
                <span class="text-sm text-red-500" v-if="!form.transmission_type">Please enter transmission type</span>
              </label>

              <label for="fuel_type" class="mb-4">
                <input
                  v-model="form.fuel_type"
                  type="text"
                  placeholder="Fuel Type"
                  class="input-field border-red-500"
                  required
                />
                <span class="text-sm text-red-500" v-if="!form.fuel_type">Please enter fuel type</span>
              </label>

              <label for="engine_size">
                <input
                  v-model.number="form.engine_size"
                  type="number"
                  step="0.01"
                  placeholder="Engine Size"
                  class="input-field border-red-500"
                  required
                />
                <span class="text-sm text-red-500" v-if="!form.engine_size">Please enter engine size</span>
              </label>

              <label for="number_of_seats" class="mb-4">
                <input
                  v-model.number="form.number_of_seats"
                  type="number"
                  placeholder="Number of Seats"
                  class="input-field border-red-500"
                  required
                />
                <span class="text-sm text-red-500" v-if="!form.number_of_seats">Please enter number of seats</span>
              </label>

              <label for="body_type">
                <input
                  v-model="form.body_type"
                  type="text"
                  placeholder="Body Type"
                  class="input-field border-red-500"
                  required
                />
                <span class="text-sm text-red-500" v-if="!form.body_type">Please enter body type</span>
              </label>
              <!-- Display added features -->
              <div>
              <button v-if="!showFeatures" @click="showFeatures = true" class="bg-green-500 text-white px-2 py-1 rounded">Add Feature</button>

              <div v-if="showFeatures">
                <div v-for="(feature, index) in form.features" :key="index" class="mb-2">
                  <label :for="'feature-' + index">Feature {{ index + 1 }}:</label>
                  <input type="text" :id="'feature-' + index" v-model="form.features[index]" class="border rounded-md px-2 py-1">
                  <button type="button" @click="removeFeature(index)" class="bg-red-500 text-white px-2 py-1 rounded">Remove</button>
                </div>
                <button type="button" @click="addFeature" class="bg-green-500 text-white px-2 py-1 rounded">Add Feature</button>
              </div>
            </div>

              <label for="featured">
                <input
                  v-model="form.featured"
                  type="checkbox"
                  class="border-red-500"
                />
                <span class="text-sm text-red-500" v-if="!form.featured">Please select whether featured or not</span>
                Featured
              </label>

  
                <!-- Add other car registration fields here -->
  
                <div class="flex flex-col space-y-4 pt-4">
                  <button
                    type="submit"
                    :disabled="isRegisterButtonDisabled"
                    :class="{
                      'py-2 px-5 flex justify-center bg-blue-300 text-white rounded-lg cursor-not-allowed':
                        isRegisterButtonDisabled,
                      'btn-primary': !isRegisterButtonDisabled
                    }"
                  >
                    Register
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup lang="ts">
  import { ref, onMounted } from 'vue'
  import { useRouter } from 'vue-router'
  import { useCarStore } from '@/stores/useCarStore'
  import { useBrandStore } from '@/stores/useBrandStore'
  
  const { index } = useBrandStore()

  onMounted(async () => {
  // TODO: Replace this funciton in Admin dashboard after creating a car
  await index()
})
  
  const { store } = useCarStore()
  const { brands } = useBrandStore()

  console.log(brands);
  const form = ref({
    brand_id: 0,
    model: '',
    color: '',
    year: 0,
    price: 0,
    mileage: 0,
    transmission_type: '',
    fuel_type: '',
    engine_size: 0,
    number_of_seats: 0,
    body_type: '',
    features: [''],
    featured: false,


    // Add other car registration fields here
  })
  
  const router = useRouter()
  
  const isRegisterButtonDisabled = ref(true)
  
  const handleRegister = () => {
    store({
      brand_id: form.value.brand_id,
      model: form.value.model,
      color: form.value.color,
      year: form.value.year,
      price: form.value.price,
      mileage: form.value.mileage,
      transmission_type: form.value.transmission_type,
      fuel_type: form.value.fuel_type,
      engine_size: form.value.engine_size,
      number_of_seats: form.value.number_of_seats,
      body_type: form.value.body_type,
      features: form.value.features,
      featured: form.value.featured,
    })
    // Perform car registration logic here
    console.log('Registering car:', form.value);
  }

  const showFeatures = ref(false);

  const addFeature = () => {
    form.value.features.push('');
  };

  const removeFeature = (index: number) => {
    form.value.features.splice(index, 1);
  };
  </script>
  
  <style lang="scss" scoped>
  .input-field {
    @apply w-full mb-2 px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500;
  }
  
  .btn-primary {
    @apply w-full px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:outline-none;
  }
  
  .input-field:focus ~ .text-red-500 {
    display: none;
  }
  
  .btn-primary.cursor-not-allowed {
    @apply bg-blue-300 text-gray-400;
  }
  </style>
  