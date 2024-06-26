<template>
  <div class="min-h-screen flex items-center">
    <div class="card mx-auto w-full max-w-5xl shadow-xl">
      <div class="rounded-xl divide-slate-300 divide-x md:py-5">
        <div class="p-6 flex flex-col items-center justify-center">
          <h1 class="text-3xl font-semibold mb-8">Register a new Service</h1>
          <div class="w-full max-w-md">
            <form class="text-center" @submit.prevent="handleRegister" novalidate>
              <label for="model" class="mb-4">
                <input
                  v-model="form.name"
                  type="text"
                  placeholder="Name"
                  class="input-field border-red-500"
                  required
                />
                <span class="text-sm text-red-500" v-if="!form.name">Please enter a name</span>
              </label>
              <label for="model" class="mb-4">
                <input
                  v-model="form.description"
                  type="text"
                  placeholder="Description"
                  class="input-field border-red-500"
                  required
                />
                <span class="text-sm text-red-500" v-if="!form.description"
                  >Please enter a description</span
                >
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
import { ref, onMounted, computed } from 'vue'
import { useServiceStore } from '@/stores/useServiceStore'

const { isLoading, store } = useServiceStore()

const form = ref({
  name: '',
  description: ''
})

const isRegisterButtonDisabled = computed(() => {
  return !form.value.name || !form.value.description || isLoading
})

const handleRegister = () => {
  // Prepare data to be sent to the store method
  const serviceRequest = {
    name: form.value.name,
    description: form.value.description
  }

  // Call the store method to register the brand
  try {
    store(serviceRequest) // Assuming store method handles the form data and performs the API call
    console.log('Brand registered successfully.')
    // Clear form fields and uploaded photo after successful registration
    form.value.name = ''
    form.value.description = ''
  } catch (error) {
    console.error('Error registering brand:', error)
  }
}
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
