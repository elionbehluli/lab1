import { useApiFetch } from '@/composables/useApiFetch'
import router from '@/router'
import { defineStore } from 'pinia'
import { useCookies } from '@vueuse/integrations/useCookies'
import { useSnackbarStore } from './useSnackbarStore'
import type { AxiosError } from 'axios'
import axios from 'axios'

const cookies = useCookies(['jwtToken'])

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: {} as User,
    jwtToken: '',
    isLoading: false
  }),
  getters: {
    isLoggedIn: (state) => !!state.user.id
  },
  actions: {
    catchError(error: unknown | Error | AxiosError) {
      if (axios.isAxiosError(error) && error.response && error.response.data) {
        const firstProperty = Object.values(error.response.data)[0]
        this.callSnackBar({
          message: `Error: ${firstProperty}`,
          type: 'error'
        })
      } else {
        this.callSnackBar({
          message: 'Error Occured',
          type: 'error'
        })
      }
    },

    callSnackBar({ message, type, duration }: SnackbarParams) {
      const snackbarStore = useSnackbarStore()
      snackbarStore.showSnackbar({
        message,
        type,
        duration
      })
    },

    async login(credentials: LoginCredentials) {
      try {
        this.isLoading = true

        const { data } = await useApiFetch<APIResponse>('POST', 'auth/login', {
          data: credentials
        })

        if (data.user && data.token) {
          this.user = data.user
          this.jwtToken = data.token
          cookies.set('jwtToken', data.token)

          this.callSnackBar({
            message: 'Successfully logged in',
            type: 'success',
            duration: 3000
          })
          router.replace('/')
        }
      } catch (error: unknown | Error | AxiosError) {
        this.catchError(error)
      } finally {
        this.isLoading = false
      }
    },

    async register(credentials: RegistrationCredentials) {
      try {
        this.isLoading = true

        const { data } = await useApiFetch<APIResponse>('POST', 'auth/register', {
          data: credentials
        })

        if (data.user && data.token) {
          this.user = data.user
          this.jwtToken = data.token
          cookies.set('jwtToken', data.token)

          this.callSnackBar({
            message: 'Successfully registered',
            type: 'success',
            duration: 5000
          })
          router.replace('/')
        }
      } catch (error: unknown | Error | AxiosError) {
        this.catchError(error)
      } finally {
        this.isLoading = false
      }
    },

    async logout() {
      try {
        this.isLoading = true

        const { data } = await useApiFetch<DeleteAPIResponse>('POST', 'auth/logout')

        this.callSnackBar({
          message: data.message ? data.message : 'Successfully logged out',
          type: 'info',
          duration: 3000
        })

        this.user = {} as User
        this.jwtToken = ''
        cookies.remove('jwtToken')
        router.replace('/')
      } catch (error: unknown | Error | AxiosError) {
        this.catchError(error)
      } finally {
        this.isLoading = false
      }
    },
    async forgotPassword(email: string) {
      try {
        this.isLoading = true

        // Send a request to your backend API to initiate the password reset process
        await useApiFetch('POST', 'auth/password/forgot', {
          data: { email }
        })

        this.callSnackBar({
          message: 'Password reset link sent successfully',
          type: 'success',
          duration: 5000
        })
        // Redirect to a page indicating that the password reset link has been sent
        router.push('/forgot-password')
      } catch (error: unknown | Error | AxiosError) {
        this.catchError(error)
      } finally {
        this.isLoading = false
      }
    },
    async resetPassword({ email, token, password, password_confirmation }: ResetPasswordParams) {
      try {
        this.isLoading = true

        // Send a request to your backend API to reset the password
        await useApiFetch('POST', 'auth/password/reset', {
          data: { email, token, password, password_confirmation }
        })

        this.callSnackBar({
          message: 'Password reset successfully',
          type: 'success',
          duration: 5000
        })
        // Redirect to a login page or any other appropriate page
        router.push('/login')
      } catch (error: unknown | Error | AxiosError) {
        this.catchError(error)
      } finally {
        this.isLoading = false
      }
    },

    setJWTTokenFromCookie(cookie: string) {
      this.jwtToken = cookie
    }
  },
  persist: true
})
