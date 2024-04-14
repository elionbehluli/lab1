import { useApiFetch } from '@/composables/useApiFetch'
import router from '@/router'
import { defineStore } from 'pinia'
import { useCookies } from '@vueuse/integrations/useCookies'

const cookies = useCookies(['jwtToken'])

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: {} as User,
    jwtToken: ''
  }),
  getters: {
    isLoggedIn: (state) => !!state.user.id
  },
  actions: {
    async login(credentials: LoginCredentials) {
      try {
        const { data } = await useApiFetch<LoginAPIResponse>('POST', 'auth/login', {
          data: credentials
        })

        if (data.user && data.token) {
          this.user = data.user
          this.jwtToken = data.token
          cookies.set('jwtToken', data.token)
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

        if (data.user && data.token) {
          this.user = data.user
          this.jwtToken = data.token
          cookies.set('jwtToken', data.token)
          router.push('/')
        }
      } catch (error) {
        console.error(error)
      }
    },

    async logout() {
      try {
        await useApiFetch('POST', 'auth/logout')
        this.user = {} as User
        this.jwtToken = ''
        cookies.remove('jwtToken')
        router.push('/')
      } catch (error) {
        console.error(error)
      }
    },

    setJWTTokenFromCookie(cookie: string) {
      this.jwtToken = cookie
    }
  },
  persist: true
})
