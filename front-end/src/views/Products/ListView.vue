<template>
  <content>
    <div class="card">
      <div class="card-header">
        <div>
          <h3 class="card-title">Produtos</h3>
        </div>
        <div class="card-actions">
          <router-link to="/products/create" class="btn btn-primary"> cadastrar </router-link>
        </div>
      </div>
      <div class="card-body">
        <list-ajax :apiUrl="getUrl('products')" title="Items List" :columns="getConfigColumns()">
        </list-ajax>
      </div>
    </div>
  </content>
</template>

<script>
import ListAjax from '@/components/ListAjax.vue'
import { apiRoutes } from '@/services/variables'

export default {
  components: { ListAjax },
  methods: {
    getUrl(uri) {
      return apiRoutes[uri] ?? ''
    },
    getConfigColumns() {
      return [
        { name: 'id', label: 'Cod' },
        { name: 'name', label: 'Nome' },
        { name: 'description', label: 'Descrição' },
        { name: 'unit', label: 'Unidade' },
        { name: 'price', label: 'Preço' },
        {
          name: 'actions',
          label: 'Ações',
          actions: [{ name: 'view', icon: 'bi bi-eye', to: '/products/:id' }],
        },
      ]
    },
    viewItem(id) {
      alert(id)
    },
  },
}
</script>
