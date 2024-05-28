import { useApiFetch } from '@/composables/useApiFetch'
import { defineStore } from 'pinia'
import { useSnackbarStore } from './useSnackbarStore'
import type { AxiosError } from 'axios'
import axios from 'axios'

export const useCarStore = defineStore('car', {
  state: () => ({
    cars: [] as Car[]
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
        const { data } = await useApiFetch<CarResponse>('GET', 'cars')

        if (data.data) {
          this.cars = data.data
        }
      } catch (error: unknown | Error | AxiosError) {
        this.catchError(error)
      }
    },

    async show(id: number) {
      try {
        const { data } = await useApiFetch<ShowCarResponse>('GET', `cars/${id}`)

        if (data.data) {
          return data.data
        }
      } catch (error: unknown | Error | AxiosError) {
        this.catchError(error)
      }
    },

    async store(body: CarRequest) {
      try {
        const { data } = await useApiFetch<CarResponse>('POST', 'cars', {
          data: body
        })

        if (data.data) {
          return data.data
        }
      } catch (error: unknown | Error | AxiosError) {
        this.catchError(error)
      }
    },

    async update(id: number, body: CarRequest) {
      try {
        // Ensure features is a JSON string
        const bodyToSend = {
          ...body,
          features: JSON.stringify(body.features),
        };
        console.log(bodyToSend.features);

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
      }
    },

    async delete(id: number) {
      try {
        const { data } = await useApiFetch<CarResponse>('DELETE', `cars/${id}`)

        if (data.data) {
          return data.data
        }
      } catch (error: unknown | Error | AxiosError) {
        this.catchError(error)
      }
    }
  },
  persist: true
})
