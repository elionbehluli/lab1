interface CarParts {
  id: number
  name: string
  description: string
  price: float
  year_of_production: number
  image_url: string
  updated_at: Date
  created_at: Date
}

interface CarPartsRequest {
  name: string
  description: string
  price: number
  year_of_production: number
  image_url: File
}