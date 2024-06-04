import { useApiFetch } from '@/composables/useApiFetch'
import router from '@/router'
import { defineStore } from 'pinia'
import { useSnackbarStore } from './useSnackbarStore'
import type { AxiosError } from 'axios'
import axios from 'axios'

export const useUserStore = defineStore('user', {
  state: () => ({
    users: [] as User[],
    isLoading: false
  }),
  
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

    async index() {
      try {
        this.isLoading = true

        const { data } = await useApiFetch<UserResponse>('GET', 'users')

        if (data.data) {
          this.users = data.data
        }
      } catch (error: unknown | Error | AxiosError) {
        this.catchError(error)
      } finally {
        this.isLoading = false
      }
    },

    async editRole(id: number, role: { role: string }) {
      try {
        this.isLoading = true
        console.log(role);

        const { data } = await useApiFetch<UserResponse>('PUT', `users/${id}/edit-role`, {
          headers: {
            'Content-Type': 'application/json'
          },
          data: role
        })

        if (data.data) {
          return data.data
        }
      } catch (error: unknown | Error | AxiosError) {
        this.catchError(error)
      } finally {
        this.isLoading = false
      }
    },

    async delete(id: number) {
      try {
        this.isLoading = true

        const { data } = await useApiFetch<UserResponse>('DELETE', `users/${id}`)

        if (data.data) {
          return data.data
        }
      } catch (error: unknown | Error | AxiosError) {
        this.catchError(error)
      } finally {
        this.isLoading = false
      }
    },
    
  },
  persist: true
})
