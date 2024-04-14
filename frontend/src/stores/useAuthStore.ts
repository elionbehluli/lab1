import { useApiFetch } from '@/composables/useApiFetch'
import router from '@/router'
import { defineStore } from 'pinia'

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: {} as User
  }),
  getters: {
    isLoggedIn: (state) => !!state.user
  },
  actions: {
    async login(credentials: LoginCredentials) {
      try {
        const { data } = await useApiFetch<LoginAPIResponse>('POST', 'auth/login', {
          data: credentials
        })

        if (data.user) {
          this.user = data.user
          router.push('/')
        }
      } catch (error) {
        console.error(error)
      }
    },

    async register(credentials: RegistrationCredentials) {
      try {
        const { data } = await useApiFetch<RegisterAPIResponse>('POST', 'auth/register', {
          data: credentials
        })

        if (data.user) {
          this.user = data.user
          router.push('/')
        }
      } catch (error) {
        console.error(error)
      }
    }
  },
  persist: true
})
