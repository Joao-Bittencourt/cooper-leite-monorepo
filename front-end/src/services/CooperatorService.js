import { apiRoutes } from './variables.js'
import Swal from 'sweetalert2'

export const getCooperators = (params) => {
  let result = fetch(apiRoutes.cooperators + '?' + params.query, {
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

export const getCooperator = (id) => {
  let result = fetch(apiRoutes.cooperators + '/' + id, {
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

export const createCooperator = (cooperator) => {
  let result = fetch(apiRoutes.cooperatorsCreate, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      Authorization: 'Bearer ' + localStorage.getItem('token'),
    },
    body: JSON.stringify(cooperator),
  })
    .then((response) => response.json())
    .then((data) => {
      if (!data.hasOwnProperty('errors')) {
        Swal.fire({
          title: 'Success!',
          text: 'Cooperator created successfully',
          icon: 'success',
        }).then(() => {
          window.location.href = '/cooperators'
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

export const updateCooperator = (id, cooperator) => {
  let result = fetch(apiRoutes.cooperators + '/' + id, {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json',
      Authorization: 'Bearer ' + localStorage.getItem('token'),
    },
    body: JSON.stringify(cooperator),
  }).then((response) => {
    if (response.ok) {
      return response.json()
    }

    throw new Error(response.statusText)
  })

  return result
}
