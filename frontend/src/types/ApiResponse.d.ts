interface APIResponse {
  token: string
  user: User
}

interface DeleteAPIResponse {
  message: string
}

interface CarResponse {
  data: Car[]
}

interface ShowCarResponse {
  data: Car
}

interface ImageUploadResponse {
  data: Image[]
}

interface BrandResponse {
  data: Brand[]
}

interface ShowBrandResponse {
  data: Brand
}

interface UserResponse {
  data: User[]
}

interface ServiceResponse {
  data: Service[]
}