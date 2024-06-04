interface Service {
  id: number
  name: string
  description: string
  updated_at: Date
  created_at: Date
}

interface ServiceRequest {
  name: string
  description: string
}