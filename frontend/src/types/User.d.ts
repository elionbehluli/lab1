interface User {
  id: number
  name: string
  email: string
  email_verified_at: string
  role: string
  updated_at: Date
  created_at: Date
}

interface LoginCredentials {
  email: string
  password: string
}

type RegistrationCredentials = {
  name: string
  email: string
  password: string
  password_confirmation: string
}
