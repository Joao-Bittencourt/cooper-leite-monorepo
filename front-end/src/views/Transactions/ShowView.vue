<template>
  <content-header title="Movimentação" />
  <content>
    <div class="card">
      <div class="card-header">
        <div>
          <h3 class="card-title">Tranções</h3>
        </div>
        <div class="card-actions">
          <router-link to="/transactions" class="btn btn-primary"> Voltar </router-link>
        </div>

      </div>
      <div v-if="loading" class="text-center my-4">
        <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>
      <div class="card-body">
        <div v-if="transaction">
          <div class="datagrid">
            <div class="datagrid-item">
              <div class="datagrid-title">Cod</div>
              <div class="datagrid-content">{{ transaction.id }}</div>
            </div>
            <div class="datagrid-item">
              <div class="datagrid-title">Produto</div>
              <div class="datagrid-content">{{ transaction.product.name }}</div>
            </div>
            <div class="datagrid-item">
              <div class="datagrid-title">Quantidade</div>
              <div class="datagrid-content">{{ transaction.amount }}</div>
            </div>
            <div class="datagrid-item">
              <div class="datagrid-title">Entrada / Saída</div>
              <div class="datagrid-content">{{ transaction.type }}</div>
            </div>

            <div class="datagrid-item">
              <div class="datagrid-title">Criado em</div>
              <div class="datagrid-content">{{ formatDate(transaction.created_at) }}</div>
            </div>
            <div class="datagrid-item">
              <div class="datagrid-title">Atualizado em</div>
              <div class="datagrid-content">{{ formatDate(transaction.updated_at) }}</div>
            </div>
          </div>
        </div>
        <div v-else-if="!loading" class="text-center">Movimentação nãoencontrada.</div>
      </div>

    </div>
  </content>
</template>

<script>
import { getTransaction } from '@/services/TransactionService.js'

export default {
  data() {
    return {
      transaction: null,
      loading: false,
    }
  },
  methods: {
    async fetchData() {
      try {
        this.loading = true
        const transactionId = this.$route.params.id
        const response = getTransaction(transactionId)
        const data = await response
        this.transaction = data
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