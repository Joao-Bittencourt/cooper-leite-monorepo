<template>
  <content>
    <div class="card">
      <div class="card-header">
        <div>
          <h3 class="card-title">Tranções</h3>
        </div>
        <div class="card-actions">
          <router-link to="/transactions/create" class="btn btn-primary"> cadastrar </router-link>
        </div>
      </div>
      <div class="card-body">
        <list-ajax
          :apiUrl="getUrl('transactions')"
          title="Items List"
          :columns="getConfigColumns()"
        >
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
        { name: 'amount', label: 'Quantidade', formatter: (value) => { return value.toFixed(4).replace('.', ',') } },
        { name: 'type', label: 'Entrada / Saída', formatter: (value) => (value == 'I' ? 'Entrada' : 'Saída') },
        {          
          name: 'actions',
          label: 'Ações',
          actions: [{ name: 'view', icon: 'bi bi-eye', to: '/transactions/:id' }],
        },
      ]
    }
  },
}
</script>
