import { useApiFetch } from '@/composables/useApiFetch'
import router from '@/router'
import { defineStore } from 'pinia'
import { useSnackbarStore } from './useSnackbarStore'
import type { AxiosError } from 'axios'
import axios from 'axios'

export const useServiceHistoryStore = defineStore('service-history', {
  state: () => ({
    serviceHistories: [] as ServiceHistory[],
    specificCarServiceHistories: [] as ServiceHistory[],
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

        const { data } = await useApiFetch<ServiceHistoryResponse>('GET', 'service-histories')

        if (data.data) {
          this.serviceHistories = data.data
        }
      } catch (error: unknown | Error | AxiosError) {
        this.catchError(error)
      } finally {
        this.isLoading = false
      }
    },

    async specificCarSerciveHistory(id: number) {
      try {
        this.isLoading = true

        const { data } = await useApiFetch<ServiceHistoryResponse>('GET', `service-histories/${id}/car`)

        if (data.data) {
          this.specificCarServiceHistories = data.data
        }
      } catch (error: unknown | Error | AxiosError) {
        this.catchError(error)
      } finally {
        this.isLoading = false
      }
    },

    async store(body: ServiceHistoryRequest) {
      try {
        this.isLoading = true
  
        const { data } = await useApiFetch<ServiceHistoryResponse>('POST', 'service-histories', {
          data: body,
        })
        
        if (data.data) {
          this.callSnackBar({
            message: `Service History has been created successfully`,
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

    async delete(id: number) {
      try {
        this.isLoading = true

        const { data } = await useApiFetch<ServiceHistoryResponse>('DELETE', `services-histories/${id}`)

        if (data.data) {
          await this.specificCarSerciveHistory(id);
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
