<template>
  <content-header title="cooperado" />
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
      <div v-if="loading" class="text-center my-4">
        <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>
      <div class="card-body">
        <div v-if="cooperado">
          <div class="datagrid">
            <div class="datagrid-item">
              <div class="datagrid-title">Cod</div>
              <div class="datagrid-content">{{ cooperado.id }}</div>
            </div>
            <div class="datagrid-item">
              <div class="datagrid-title">Nome</div>
              <div class="datagrid-content">{{ cooperado.name }}</div>
            </div>
            <div class="datagrid-item">
              <div class="datagrid-title">Email</div>
              <div class="datagrid-content">{{ cooperado.email }}</div>
            </div>
            <div class="datagrid-item">
              <div class="datagrid-title">Verificado</div>
              <div class="datagrid-content">{{ cooperado.active ? 'Sim' : 'Não' }}</div>
            </div>
            <div class="datagrid-item">
              <div class="datagrid-title">Criado em</div>
              <div class="datagrid-content">{{ formatDate(cooperado.created_at) }}</div>
            </div>
            <div class="datagrid-item">
              <div class="datagrid-title">Atualizado em</div>
              <div class="datagrid-content">{{ formatDate(cooperado.updated_at) }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </content>
</template>

<script>
import { getCooperator } from '@/services/CooperatorService.js'

export default {
  data() {
    return {
      cooperado: null,
      loading: false,
    }
  },
  methods: {
    async fetchData() {
      try {
        this.loading = true
        const CooperadoId = this.$route.params.id
        const response = getCooperator(CooperadoId)
        const data = await response
        this.cooperado = data
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
