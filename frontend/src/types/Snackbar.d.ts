interface SnackbarState {
  message: string
  type: 'success' | 'error' | 'info'
  isVisible: boolean
  countdown: number
  timeoutId: Timeout
}

interface SnackbarParams {
  message: string
  type: 'success' | 'error' | 'info'
  duration?: number
}
