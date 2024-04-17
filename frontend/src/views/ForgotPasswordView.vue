<template>
    <div class="min-h-screen flex items-center justify-center">
      <div class="card mx-auto w-full max-w-md shadow-xl border-0">
        <div class="p-6 flex flex-col items-center justify-center">
          <h1 class="text-3xl font-semibold mb-8">Forgot Password</h1>
          <div class="w-full">
            <form class="text-center" @submit.prevent="handleForgotPassword" novalidate>
              <label for="email" class="mb-4">
                <input
                  v-model="email"
                  type="email"
                  placeholder="Email Address"
                  class="input-field"
                  required
                />
              </label>
              <div class="flex items-center justify-center pt-8">
                <button type="submit" :class="{'btn-primary': !isLoading}">
                  <template v-if="isLoading">
                    <div class="spinner"></div>
                  </template>
                  <template v-else>Reset Password</template>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup lang="ts">
  import { ref } from 'vue'
  import { useAuthStore } from '@/stores/useAuthStore'
  
  const email = ref('')
  const isLoading = ref(false)
  const authStore = useAuthStore()
  
  const handleForgotPassword = async () => {
    isLoading.value = true
    try {
      await authStore.forgotPassword(email.value)
      // Optionally, you can redirect the user to a page indicating that the password reset link has been sent
      // router.push('/password-reset-sent')
    } catch (error) {
      // Handle error
    } finally {
      isLoading.value = false
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
  
  .spinner {
    border: 4px solid rgba(255, 255, 255, 0.3);
    border-top: 4px solid #ffffff;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    animation: spin 2s linear infinite;
  }
  
  @keyframes spin {
    0% {
      transform: rotate(0deg);
    }
    100% {
      transform: rotate(360deg);
    }
  }
  </style>
  