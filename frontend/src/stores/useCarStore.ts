import { useApiFetch } from '@/composables/useApiFetch'
import { defineStore } from 'pinia'
import { useSnackbarStore } from './useSnackbarStore'
import type { AxiosError } from 'axios'
import axios from 'axios'

export const useCarStore = defineStore('car', {
  state: () => ({
    cars: [] as Car[],
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

        const { data } = await useApiFetch<CarResponse>('GET', 'cars')

        if (data.data) {
          this.cars = data.data
        }
      } catch (error: unknown | Error | AxiosError) {
        this.catchError(error)
      } finally {
        this.isLoading = false
      }
    },

    async show(id: number) {
      try {
        this.isLoading = true

        const { data } = await useApiFetch<ShowCarResponse>('GET', `cars/${id}`)

        if (data.data) {
          return data.data
        }
      } catch (error: unknown | Error | AxiosError) {
        this.catchError(error)
      } finally {
        this.isLoading = false
      }
    },

    async store(body: CarRequest) {
      try {
        this.isLoading = true

        const bodyToSend = {
          ...body,
          features: JSON.stringify(body.features),
        };

        const { data } = await useApiFetch<CarResponse>('POST', 'cars', {
          data: bodyToSend
        })
        console.log(data);
        if (data.data) {
          this.callSnackBar({
            message: `Car has been created successfully`,
            type: 'success'
          })
        }

        
      } catch (error: unknown | Error | AxiosError) {
        this.catchError(error)
      } finally {
        this.isLoading = false
      }
    },

    async update(id: number, body: CarRequest) {
      try {
        this.isLoading = true
        
        const bodyToSend = {
          ...body,
          features: JSON.stringify(body.features),
        };

        const { data } = await useApiFetch<CarResponse>('PUT', `cars/${id}`, {
          headers: {
            'Content-Type': 'application/json'
          },
          data: bodyToSend
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

        const { data } = await useApiFetch<CarResponse>('DELETE', `cars/${id}`)

        if (data.data) {
          return data.data
        }
      } catch (error: unknown | Error | AxiosError) {
        this.catchError(error)
      } finally {
        this.isLoading = false
      }
    }
  },
  persist: true
})
