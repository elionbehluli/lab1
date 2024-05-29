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

interface BrandResponse {
  data: Brand[]
}

interface ShowBrandResponse {
  data: Brand
}