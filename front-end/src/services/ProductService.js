import { apiRoutes } from './variables.js'

export const getProducts = () => {
  let result = fetch(apiRoutes.products, {
    method: 'GET',
    headers: {
      'Content-Type': 'application/json',
      Authorization: 'Bearer ' + localStorage.getItem('token'),
    },
  }).then((response) => {
    if (response.ok) {
      return response.json()
    }

    throw new Error(response.statusText)
  })

  return result
}

export const getProduct = (id) => {
  let result = fetch(apiRoutes.product + '/' + id, {
    method: 'GET',
    headers: {
      'Content-Type': 'application/json',
      Authorization: 'Bearer ' + localStorage.getItem('token'),
    },
  }).then((response) => {
    if (response.ok) {
      return response.json()
    }

    throw new Error(response.statusText)
  })

  return result
}

export const createProduct = (product) => {
  let result = fetch(apiRoutes.productCreate, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      Authorization: 'Bearer ' + localStorage.getItem('token'),
    },
    body: JSON.stringify(product),
  }).then((response) => {
    if (response.ok) {
      return response.json()
    }

    throw new Error(response.statusText)
  })

  return result
}

export const updateProduct = (id, product) => {
  let result = fetch(apiRoutes.product + '/' + id, {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json',
      Authorization: 'Bearer ' + localStorage.getItem('token'),
    },
    body: JSON.stringify(product),
  }).then((response) => {
    if (response.ok) {
      return response.json()
    }

    throw new Error(response.statusText)
  })

  return result
}
