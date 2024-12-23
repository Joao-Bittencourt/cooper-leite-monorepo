<template>
  <content-header title="Produto" />
  <content>
    <div class="card">
      <div class="card-header">Produto</div>
      <div v-if="loading" class="text-center my-4">
        <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>
      <div class="card-body">
        <div v-if="produto">
          <div class="datagrid">
            <div class="datagrid-item">
              <div class="datagrid-title">Cod</div>
              <div class="datagrid-content">{{ produto.id }}</div>
            </div>
            <div class="datagrid-item">
              <div class="datagrid-title">Nome</div>
              <div class="datagrid-content">{{ produto.name }}</div>
            </div>
            <div class="datagrid-item">
              <div class="datagrid-title">Descrição</div>
              <div class="datagrid-content">{{ produto.description }}</div>
            </div>
            <div class="datagrid-item">
              <div class="datagrid-title">Preço</div>
              <div class="datagrid-content">{{ produto.price }}</div>
            </div>
            <div class="datagrid-item">
              <div class="datagrid-title">Verificado</div>
              <div class="datagrid-content">{{ produto.active ? 'Sim' : 'Não' }}</div>
            </div>
            <div class="datagrid-item">
              <div class="datagrid-title">Criado em</div>
              <div class="datagrid-content">{{ formatDate(produto.created_at) }}</div>
            </div>
            <div class="datagrid-item">
              <div class="datagrid-title">Atualizado em</div>
              <div class="datagrid-content">{{ formatDate(produto.updated_at) }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </content>
</template>

<script>
import { getProduct } from '@/services/ProductService.js'

export default {
  data() {
    return {
      produto: null,
      loading: false,
    }
  },
  methods: {
    async fetchData() {
      try {
        this.loading = true
        const productId = this.$route.params.id
        const response = getProduct(productId)
        const data = await response
        this.produto = data
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
