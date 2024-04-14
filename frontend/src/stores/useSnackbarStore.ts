import { defineStore } from 'pinia'

export const useSnackbarStore = defineStore('snackbar', {
  state: (): SnackbarState => ({
    message: '',
    type: 'info',
    isVisible: false,
    countdown: 10,
    timeoutId: undefined
  }),

  actions: {
    showSnackbar({ message, type = 'info', duration }: SnackbarParams) {
      this.message = message
      this.type = type
      this.isVisible = true
      this.countdown = Math.ceil((duration ? duration : 10000) / 1000)

      if (this.timeoutId) {
        clearTimeout(this.timeoutId)
      }

      this.updateCountdown()
    },

    updateCountdown() {
      if (this.countdown > 0 && this.isVisible) {
        this.timeoutId = setTimeout(() => {
          this.countdown--
          this.updateCountdown()
        }, 1000)
      } else {
        this.hideSnackbar()
      }
    },

    hideSnackbar() {
      this.isVisible = !this.isVisible
    }
  }
})
