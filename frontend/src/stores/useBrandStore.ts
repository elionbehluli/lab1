import { useApiFetch } from '@/composables/useApiFetch'
import { defineStore } from 'pinia'
import { useSnackbarStore } from './useSnackbarStore'
import type { AxiosError } from 'axios'
import axios from 'axios'

export const useBrandStore = defineStore('brands', {
  state: () => ({
    brands: [] as Brand[],
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

        const { data } = await useApiFetch<BrandResponse>('GET', 'brands')
        
        if (data.data) {
          this.brands = data.data
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

        const { data } = await useApiFetch<ShowBrandResponse>('GET', `brands/${id}`)

        if (data.data) {
          return data.data
        }
      } catch (error: unknown | Error | AxiosError) {
        this.catchError(error)
      } finally {
        this.isLoading = false
      }
    },

    async store(body: BrandRequest) {
      try {
        this.isLoading = true
        console.log(body)
        const { data } = await useApiFetch<ShowBrandResponse>('POST', 'brands', {
          data: body,
          headers: {
            'Content-Type': 'multipart/form-data',
          },
        })
        
        if (data.data) {
          this.callSnackBar({
            message: `Brand has been created successfully`,
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

    async update(id: number, body: BrandRequest) {
      try {
        this.isLoading = true
        
        const { data } = await useApiFetch<BrandResponse>('POST', `brands/${id}`, {
          headers: {
            'Content-Type': 'multipart/form-data',
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

        const { data } = await useApiFetch<BrandResponse>('DELETE', `brands/${id}`)

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
