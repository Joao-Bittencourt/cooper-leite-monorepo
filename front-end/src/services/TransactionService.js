import { apiRoutes } from './variables.js'
import Swal from 'sweetalert2'

export const getTransactions = (params) => {
  let result = fetch(apiRoutes.transactions + '?' + params.query, {
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

export const getTransaction = (id) => {
  let result = fetch(apiRoutes.transactions + '/' + id, {
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

export const createTransaction = (transactions) => {
  let result = fetch(apiRoutes.transactionsCreate, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      Authorization: 'Bearer ' + localStorage.getItem('token'),
    },
    body: JSON.stringify(Transaction),
  })
    .then((response) => response.json())
    .then((data) => {
      if (!data.hasOwnProperty('errors')) {
        Swal.fire({
          title: 'Success!',
          text: 'Transaction created successfully',
          icon: 'success',
        }).then((result) => {
          window.location.href = '/Transactions'
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

export const updateTransaction = (id, transaction) => {
  let result = fetch(apiRoutes.transactions + '/' + id, {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json',
      Authorization: 'Bearer ' + localStorage.getItem('token'),
    },
    body: JSON.stringify(transaction),
  }).then((response) => {
    if (response.ok) {
      return response.json()
    }

    throw new Error(response.statusText)
  })

  return result
}
