<template>
  <content-header title="Perfil" />
  <content>
    <div class="card">
      <div class="card-header">Usuário</div>

      <div class="card-body">
        <div v-if="loading" class="text-center my-4">
          <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
        </div>
        <div v-if="user">
          <div class="datagrid">
            <div class="datagrid-item">
              <div class="datagrid-title">Cod</div>
              <div class="datagrid-content">{{ user.id }}</div>
            </div>
            <div class="datagrid-item">
              <div class="datagrid-title">Nome</div>
              <div class="datagrid-content">{{ user.name }}</div>
            </div>
            <div class="datagrid-item">
              <div class="datagrid-title">Email</div>
              <div class="datagrid-content">{{ user.email }}</div>
            </div>
            <div class="datagrid-item">
              <div class="datagrid-title">Verificado</div>
              <div class="datagrid-content">{{ user.email_verified_at ? 'Sim' : 'Não' }}</div>
            </div>
            <div class="datagrid-item">
              <div class="datagrid-title">Criado em</div>
              <div class="datagrid-content">{{ formatDate(user.created_at) }}</div>
            </div>
            <div class="datagrid-item">
              <div class="datagrid-title">Atualizado em</div>
              <div class="datagrid-content">{{ formatDate(user.updated_at) }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </content>
</template>

<script>
import { getUser } from '../services/UserService.js'

export default {
  data() {
    return {
      user: null,
      loading: false,
    }
  },
  methods: {
    async fetchData() {
      try {
        this.loading = true
        const response = getUser()
        const data = await response
        this.user = data
      } catch (error) {
        console.error(error)
      } finally {
        this.loading = false
      }
    },
    formatDate(dateString) {
      const options = {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
      }
      return new Date(dateString).toLocaleDateString('pt-BR', options)
    },
  },
  created() {
    this.fetchData()
  },
}
</script>
