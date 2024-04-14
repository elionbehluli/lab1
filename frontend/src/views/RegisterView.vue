<template>
  <div class="min-h-screen flex items-center">
    <div class="card mx-auto w-full max-w-5xl shadow-xl">
      <div class="grid md:grid-cols-2 grid-cols-1 rounded-xl divide-slate-300 divide-x md:py-5">
        <div class="hero min-h-full rounded-l-xl">
          <div class="hero-content py-12">
            <div class="max-w-md">
              <Vue3Lottie :animation-data="RegisterAnimation" :height="400" :width="400" />
            </div>
          </div>
        </div>
        <div class="p-6 flex flex-col items-center justify-center">
          <h1 class="text-3xl font-semibold mb-8">Register a new Account</h1>
          <div class="w-full max-w-md">
            <form class="text-center" @submit.prevent="handleRegister">
              <input v-model="form.name" type="text" placeholder="Full Name" class="input-field" />
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
              <input
                v-model="form.password_confirmation"
                :type="showPasswordField ? 'text' : 'password'"
                placeholder="Confirm your Password"
                class="input-field"
              />
              <div class="flex flex-col space-y-4 pt-4">
                <button type="submit" class="btn-primary">Register</button>
              </div>
              <div class="flex items-center justify-center pt-8">
                <button
                  @click="router.push('/login')"
                  class="text-sm text-blue-500 hover:text-blue-700 focus:outline-none"
                >
                  Back to Login
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
import RegisterAnimation from '../lottie/RegisterAnimation.json'
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const form = ref({
  name: '',
  email: '',
  password: '',
  password_confirmation: ''
})

const router = useRouter()

const showPasswordField = ref(false)

const authStore = useAuthStore()

const handleRegister = async () => {
  authStore.register({
    name: form.value.name,
    email: form.value.email,
    password: form.value.password,
    password_confirmation: form.value.password_confirmation
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
