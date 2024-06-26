interface ServiceHistory {
  id: number
  car_id: number
  service_id: number
  mileage_at_service: number
  name: string
  description: string
  updated_at: Date
  created_at: Date
}

interface ServiceHistoryRequest {
  car_id: number
  service_id: number
  mileage_at_service: number
}