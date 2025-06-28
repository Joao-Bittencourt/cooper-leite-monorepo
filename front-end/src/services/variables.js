const API_URL = 'http://cpl-l.x10.mx/api'
//const API_URL = 'http://localhost:8000/api'

const apiUris = {
  login: '/login',
  register: '/register',
  user: '/user',
  products: '/products',
  productCreate: '/products',
  productsCount: '/products/active-count',
  cooperators: '/cooperatives',
  cooperatorsCreate: '/cooperatives',
  cooperatorsCount: '/cooperatives/active-count',
  transactions: '/transactions',
  transactionCreate: '/transactions',
  transactionsCount: '/transactions/active-count',
}

// Adiciona o protocolo e a URL base às URIs
const apiRoutes = Object.fromEntries(
  Object.entries(apiUris).map(([key, uri]) => [key, `${API_URL}${uri}`]),
)

export { API_URL, apiRoutes }
