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
          <h1 class="text-3xl font-semibold mb-8">Login to your Account</h1>
          <div class="w-full max-w-md">
            <form class="text-center" @submit.prevent="handleLogin">
              <input
                v-model="form.email"
                type="email"
                placeholder="Email Adress"
                class="input-field"
              />
              <div class="relative">
                <input
                  v-model="form.password"
                  :type="showPasswordField ? 'text' : 'password'"
                  placeholder="Password"
                  class="input-field"
                />
                <button
                  type="button"
                  @click="showPasswordField = !showPasswordField"
                  class="absolute inset-y-0 right-0 flex mt-2 items-start justify-center w-10 text-gray-400 hover:text-gray-600 focus:outline-none"
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
                  class="text-sm text-blue-500 hover:text-blue-700 focus:outline-none"
                >
                  Forgot password?
                </button>
              </div>
              <div class="flex flex-col space-y-4 pt-4">
                <button type="submit" class="btn-primary">Login</button>
              </div>
              <div class="flex items-center justify-center pt-8">
                Don't have an account yet?
                <button
                  @click="router.push('/register')"
                  class="text-sm text-blue-500 hover:text-blue-700 focus:outline-none pl-2"
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
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const form = ref({
  email: '',
  password: ''
})

const router = useRouter()

const showPasswordField = ref(false)

const authStore = useAuthStore()

const handleLogin = async () => {
  authStore.login({
    email: form.value.email,
    password: form.value.password
  })
}
</script>

<style lang="scss" scoped>
.input-field {
  @apply w-full px-4 py-2 mb-4 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500;
}

.btn-primary {
  @apply w-full px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:outline-none;
}
</style>
