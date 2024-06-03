interface Brand{
  id: number
  name: string
  country_of_origin: string
  logo_url: string
  created_at: Date
  updated_at: Date
}

interface BrandRequest{
  name: string
  country_of_origin: string
  logo_url: File
}

