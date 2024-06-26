import { defineStore } from 'pinia';
import axios from 'axios';
import type { AxiosError } from 'axios';
import { useSnackbarStore } from './useSnackbarStore';
import { useApiFetch } from '@/composables/useApiFetch';
// import type { CarPartsResponse, ShowCarPartsResponse, CarPartsRequest } from '@/types'; // Adjust types as per your application

export const useCarPartsStore = defineStore('carParts', {
  state: () => ({
    carParts: [] as CarParts[],
    specificCarParts: [] as CarParts[],
    isLoading: false,
  }),

  actions: {
    catchError(error: unknown | Error | AxiosError) {
      if (axios.isAxiosError(error) && error.response && error.response.data) {
        const firstProperty = Object.values(error.response.data)[0];
        this.callSnackBar({
          message: `Error: ${firstProperty}`,
          type: 'error',
        });
      } else {
        this.callSnackBar({
          message: 'Error Occurred',
          type: 'error',
        });
      }
    },

    callSnackBar({ message, type, duration }: SnackbarParams) {
      const snackbarStore = useSnackbarStore();
      snackbarStore.showSnackbar({
        message,
        type,
        duration,
      });
    },

    async index() {
      try {
        this.isLoading = true;
        const { data } = await useApiFetch<CarPartsResponse>('GET', 'car_parts');
        if (data.data) {
          this.carParts = data.data;
        }
      } catch (error: unknown | Error | AxiosError) {
        this.catchError(error);
      } finally {
        this.isLoading = false;
      }
    },

    async specificCarCarParts(id: number) {
      try {
        this.isLoading = true

        const { data } = await useApiFetch<CarPartsResponse>('GET', `car_parts/${id}/car`)

        if (data.data) {
          this.specificCarParts = data.data
        }
      } catch (error: unknown | Error | AxiosError) {
        this.catchError(error)
      } finally {
        this.isLoading = false
      }
    },

    async store(body: CarPartsRequest) {
      try {
        this.isLoading = true;
        console.log(body);
        const { data } = await useApiFetch<ShowCarPartsResponse>('POST', 'car_parts', {
          data: body,
          headers: {
            'Content-Type': 'multipart/form-data',
          },
        });
        if (data.data) {
          this.callSnackBar({
            message: `Car part has been added successfully`,
            type: 'success',
          });
          return data.data;
        }
      } catch (error: unknown | Error | AxiosError) {
        this.catchError(error);
      } finally {
        this.isLoading = false;
      }
    },

    async update(id: number, body: CarPartsRequest) {
      try {
        this.isLoading = true;
        const { data } = await useApiFetch<CarPartsResponse>('PUT', `car_parts/${id}`, {
          headers: {
            'Content-Type': 'application/json',
          },
          data: body,
        });
        if (data.data) {
          return data.data;
        }
      } catch (error: unknown | Error | AxiosError) {
        this.catchError(error);
      } finally {
        this.isLoading = false;
      }
    },

    async delete(id: number) {
      try {
        this.isLoading = true;
        const { data } = await useApiFetch<CarPartsResponse>('DELETE', `car_parts/${id}`);
        if (data.data) {
          return data.data;
        }
      } catch (error: unknown | Error | AxiosError) {
        this.catchError(error);
      } finally {
        this.isLoading = false;
      }
    },

    async show(id: number) {
      try {
        this.isLoading = true;
        const { data } = await useApiFetch<CarPartsResponse>('GET', `car_parts/${id}`);
        if (data.data) {
          return data.data;
        }
      } catch (error: unknown | Error | AxiosError) {
        this.catchError(error);
      } finally {
        this.isLoading = false;
      }
    },

    async addCarParts(id: number, car_id: { car_id: number }) {
      try {
        this.isLoading = true
  
        const { data } = await useApiFetch<CarPartsResponse>('PUT', `car_parts/${id}/add`, {
          headers: {
            'Content-Type': 'application/json'
          },
          data: car_id
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
  },

  persist: true,
});
