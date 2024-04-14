import axios, { type AxiosRequestConfig, type AxiosResponse } from 'axios'

const BASE_URL = import.meta.env.VITE_APP_BASE_URL

export function useApiFetch<T>(method: string, path: string, options: AxiosRequestConfig = {}) {
  return axios({
    method,
    url: BASE_URL + path,
    withCredentials: true,
    ...options
  }) as Promise<AxiosResponse<T>>
}
