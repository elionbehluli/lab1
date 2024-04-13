import { useApiFetch } from '@/composables/useApiFetch'
import router from '@/router'
import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useAuthStore = defineStore('auth', () => {
  const user = ref<User | null>(null)

  async function login(credentials: Credentials) {
    try {
      const data = await useApiFetch('POST', 'auth/login', {
        data: credentials
      })

      if (data.data) {
        router.push('/')
      }
    } catch (error) {
      console.error(error)
    }
  }

  return {
    user,
    login
  }
})
