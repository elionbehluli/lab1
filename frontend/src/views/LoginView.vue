<template>
  <div class="min-h-screen flex items-center">
    <div class="card mx-auto w-full max-w-5xl shadow-xl border-0">
      <div class="grid md:grid-cols-2 grid-cols-1 rounded-xl divide-slate-300 divide-x md:py-5">
        <div class="hero min-h-full rounded-l-xl">
          <div class="hero-content py-12">
            <div class="max-w-md">
              <Vue3Lottie :animation-data="LoginAnimation" :height="400" :width="400" />
            </div>
          </div>
        </div>
        <div class="p-6 flex flex-col items-center justify-center">
          <h1
            class="text-3xl font-semibold mb-8 pointer-events-none"
            :class="{ 'text-gray-400': isLoading }"
          >
            Login to your Account
          </h1>
          <div class="w-full max-w-md">
            <form class="text-center" @submit.prevent="handleLogin" novalidate>
              <label for="email" class="mb-4">
                <input
                  v-model="form.email"
                  type="email"
                  placeholder="Email Adress"
                  class="input-field invalid:[&:not(:placeholder-shown):not(:focus)]:border-red-500 peer"
                  required
                  :disabled="isLoading"
                  :class="{
                    'placeholder-gray-300 border-gray-300 text-gray-400': isLoading,
                    'placeholder-gray-400 border-gray-500': !isLoading
                  }"
                  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                />
                <span
                  class="mb-2 hidden text-sm text-red-500 peer-[&:not(:placeholder-shown):not(:focus):invalid]:block"
                >
                  Please enter a valid email address
                </span>
              </label>

              <div class="relative">
                <input
                  v-model="form.password"
                  :type="showPasswordField ? 'text' : 'password'"
                  placeholder="Password"
                  class="input-field invalid:[&:not(:placeholder-shown):not(:focus)]:border-red-500 peer"
                  required
                  :disabled="isLoading"
                  :class="{
                    'placeholder-gray-300 border-gray-300 text-gray-400': isLoading,
                    'placeholder-gray-400 border-gray-500': !isLoading
                  }"
                  pattern=".{6,}"
                />
                <span
                  class="mb-2 hidden text-sm text-red-500 peer-[&:not(:placeholder-shown):not(:focus):invalid]:block"
                >
                  Please enter at least 6 characters
                </span>
                <button
                  type="button"
                  @click="showPasswordField = !showPasswordField"
                  class="absolute inset-y-0 right-0 flex mt-2 items-start justify-center w-10 text-gray-400 focus:outline-none"
                  :class="{
                    'hover:text-gray-600': !isLoading
                  }"
                  :disabled="isLoading"
                >
                  <svg
                    v-if="showPasswordField"
                    class="w-6 h-6"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                    ></path>
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                    ></path>
                  </svg>
                  <svg
                    v-else
                    class="w-6 h-6"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"
                    ></path>
                  </svg>
                </button>
              </div>

              <div class="mt-1 flex items-center justify-end">
                <button
                  type="button"
                  @click="router.push('/forgot-password')"
                  class="text-sm focus:outline-none"
                  :class="{
                    'text-blue-300': isLoading,
                    'hover:text-blue-700 text-blue-500': !isLoading
                  }"
                  :disabled="isLoading"
                >
                  Forgot password?
                </button>
              </div>

              <div class="flex flex-col space-y-4 pt-4">
                <button
                  type="submit"
                  :disabled="isLoginButtonDisabled"
                  :class="{
                    'py-2 px-5 pointer-events-none flex justify-center bg-blue-300 text-white rounded-lg':
                      isLoginButtonDisabled,
                    'btn-primary': !isLoginButtonDisabled
                  }"
                >
                  <template v-if="isLoading">
                    <div class="spinner"></div>
                  </template>
                  <template v-else> Login </template>
                </button>
              </div>
              <div class="flex items-center justify-center pt-8">
                <span class="pointer-events-none" :class="{ 'text-gray-400': isLoading }">
                  Don't have an account yet?
                </span>
                <button
                  @click="router.push('/register')"
                  class="text-sm focus:outline-none pl-2"
                  :class="{
                    'text-blue-300': isLoading,
                    'hover:text-blue-700 text-blue-500': !isLoading
                  }"
                  :disabled="isLoading"
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
import { useAuthStore } from '@/stores/useAuthStore'
import { Vue3Lottie } from 'vue3-lottie'
import LoginAnimation from '../lottie/LoginAnimation.json'
import { computed, ref } from 'vue'
import { useRouter } from 'vue-router'

const { isLoading, login } = useAuthStore()

const form = ref({
  email: '',
  password: ''
})

const router = useRouter()

const showPasswordField = ref(false)

const isLoginButtonDisabled = computed(() => {
  return !form.value.email || form.value.password.length < 6 || isLoading
})

const handleLogin = async () => {
  login({
    email: form.value.email,
    password: form.value.password
  })
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
