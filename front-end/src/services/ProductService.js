import { apiRoutes } from './variables.js'
import Swal from 'sweetalert2'

export const getProducts = (params) => {
  let result = fetch(apiRoutes.products + '?' + params.query, {
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
  let result = fetch(apiRoutes.products + '/' + id, {
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
  })
    .then((response) => response.json())
    .then((data) => {
      if (!data.hasOwnProperty('errors')) {
        Swal.fire({
          title: 'Success!',
          text: 'Transaction created successfully',
          icon: 'success',
        }).then(() => {
          window.location.href = '/transactions'
        })
      }

      let messageErros = ''

      for (const [key, value] of Object.entries(data.errors)) {
        messageErros += `${key}: ${value[0]}<br>`
      }

      Swal.fire({
        title: 'Error!',
        html: messageErros,
        icon: 'error',
      })
    })



  return result
}

export const updateProduct = (id, product) => {
  let result = fetch(apiRoutes.products + '/' + id, {
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

export const countProducts = () => {
  let result = fetch(apiRoutes.productsCount, {
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