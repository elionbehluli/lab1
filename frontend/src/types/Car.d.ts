interface Car {
  id: number
  brand_id: number
  brand_name: string
  model: string
  color: string
  year: number
  price: number
  mileage: number
  transmission_type: string
  fuel_type: string
  engine_size: number
  number_of_seats: number
  body_type: string
  features: Record<string>
  featured: boolean
  images: Image[]
  created_at: Date
  updated_at: Date
}

interface CarRequest {
  brand_id: number
  model: string
  color: string
  year: number
  price: number
  mileage: number
  transmission_type: string
  fuel_type: string
  engine_size: number
  number_of_seats: number
  featured: boolean
  body_type: string
  features: Record<string>
  featured: boolean
}

interface Image {
  id: number
  car_id: number
  image_url: string
  mime_type: string
  size: string
  created_at: string
  updated_at: string
}
