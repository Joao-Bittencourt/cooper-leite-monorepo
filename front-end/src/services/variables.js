
const API_URL = 'http://cpl-l.x10.mx/api';

const apiUris = {
  login: '/login',
  register: '/register',
  user: '/user',
  products: '/products',
  product: '/product',
  ProductCreate: '/product/create',
}

// Adiciona o protocolo e a URL base às URIs
const apiRoutes = Object.fromEntries(
  Object.entries(apiUris).map(([key, uri]) => [key, `${API_URL}${uri}`]),
)

export { API_URL, apiRoutes }
