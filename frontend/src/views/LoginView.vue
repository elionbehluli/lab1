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
              <input
                v-model="form.password"
                :type="showPasswordField ? 'text' : 'password'"
                placeholder="Password"
                class="input-field"
              />
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
