import { useApiFetch } from '@/composables/useApiFetch'
import router from '@/router'
import { defineStore } from 'pinia'
import { useSnackbarStore } from './useSnackbarStore'
import type { AxiosError } from 'axios'
import axios from 'axios'

export const useServiceStore = defineStore('service', {
  state: () => ({
    services: [] as Service[],
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

        const { data } = await useApiFetch<ServiceResponse>('GET', 'services')

        if (data.data) {
          this.services = data.data
        }
      } catch (error: unknown | Error | AxiosError) {
        this.catchError(error)
      } finally {
        this.isLoading = false
      }
    },

    async store(body: ServiceRequest) {
      try {
        this.isLoading = true
  
        const { data } = await useApiFetch<ServiceResponse>('POST', 'services', {
          data: body,
        })
        
        if (data.data) {
          this.callSnackBar({
            message: `Service has been created successfully`,
            type: 'success'
          })
          return data.data;
        }
           
      } catch (error: unknown | Error | AxiosError) {
        this.catchError(error)
      } finally {
        this.isLoading = false
      }
    },

    async update(id: number, body: ServiceRequest) {
      try {
        this.isLoading = true
        
        const { data } = await useApiFetch<ServiceResponse>('PUT', `services/${id}`, {
          headers: {
            'Content-Type': 'application/json'
          },
          data: body
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

        const { data } = await useApiFetch<ServiceResponse>('DELETE', `services/${id}`)

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
