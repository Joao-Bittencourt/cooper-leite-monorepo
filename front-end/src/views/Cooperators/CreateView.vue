<template>
  <content>
    <div class="card">
      <div class="card-header">
        <div>
          <h3 class="card-title">Cooperado</h3>
        </div>
        <div class="card-actions">
          <router-link to="/cooperators" class="btn btn-primary"> Voltar </router-link>
        </div>
      </div>

      <form action="/cooperators/create" method="post" @submit.prevent="cooperatorSubmit()">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-label">Nome</div>
              <input type="text" class="form-control" v-model="name" />
            </div>
            <div class="col-md-6">
              <div class="form-label">Email</div>
              <input type="email" class="form-control" v-model="email" />
            </div>
          </div>
        </div>
        <div class="card-footer bg-transparent mt-auto">
          <div class="btn-list justify-content-end">
            <button type="submit" class="btn btn-primary" :class="loading ? 'disabled' : ''">
              <div class="spinner-border text-white me-2" role="status" v-if="loading"></div>
              Salvar
            </button>
          </div>
        </div>
      </form>
    </div>
  </content>
</template>

<script>
import { createCooperator } from '../../services/CooperatorService.js'

export default {
  data() {
    return {
      name: '',
      email: '',
      loading: false,
    }
  },
  methods: {
    cooperatorSubmit() {
      this.loading = true

      let cooperator = {
        name: this.name,
        email: this.email,
        status: 1,
      }

      createCooperator(cooperator)
        .then((response) => {
          console.log(response)
        })
        .finally(() => {
          this.loading = false
        })
    },
  },
}
</script>
