import { useAuthStore } from '@/stores/useAuthStore'
import axios, { type AxiosRequestConfig, type AxiosResponse } from 'axios'
import { useCookies } from '@vueuse/integrations/useCookies'

const BASE_URL = import.meta.env.VITE_APP_BASE_URL

export function useApiFetch<T>(method: string, path: string, options: AxiosRequestConfig = {}) {
  const headers: Record<string, string> = {}
  const { jwtToken, setJWTTokenFromCookie } = useAuthStore()

  const cookie = useCookies(['jwtToken'])
  const token = cookie.get('jwtToken')

  if (!jwtToken && token) {
    headers.Authorization = `Bearer ${token}`
    setJWTTokenFromCookie(token)
  } else if (jwtToken) {
    headers.Authorization = `Bearer ${jwtToken}`
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
