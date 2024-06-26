import { useAuthStore } from '@/stores/useAuthStore'
import axios, { type AxiosRequestConfig, type AxiosResponse } from 'axios'
import { useCookies } from '@vueuse/integrations/useCookies'

const BASE_URL = import.meta.env.VITE_APP_BASE_URL

export function useApiFetch<T>(method: string, path: string, options: AxiosRequestConfig = {}) {
  const authStore = useAuthStore()
  const cookie = useCookies(['jwtToken'])
  const token = cookie.get('jwtToken')

  if (!authStore.jwtToken && token) {
    authStore.setJWTTokenFromCookie(token)
  }

  const headers: Record<string, string> = {
    'Content-Type': 'application/json'
  }

  if (authStore.jwtToken) {
    headers.Authorization = `Bearer ${authStore.jwtToken}`

    // Check token expiry
    const tokenData = JSON.parse(atob(authStore.jwtToken.split('.')[1]))
    const expiry = tokenData.exp * 1000 // Convert seconds to milliseconds
    if (Date.now() >= expiry) {
      authStore.$reset()
    }
  }

  const xsrfToken = cookie.get('XSRF-TOKEN')
  if (xsrfToken) {
    headers['X-XSRF-TOKEN'] = xsrfToken
  }

  return axios({
    method,
    url: BASE_URL + path,
    withCredentials: true,
    ...options,
    headers: {
      ...headers,
      ...options.headers
    }
  }) as Promise<AxiosResponse<T>>
}
