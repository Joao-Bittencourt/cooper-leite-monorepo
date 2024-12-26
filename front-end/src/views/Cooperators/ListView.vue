<template>
  <content>
    <div class="card">
      <div class="card-header">
        <div>
          <h3 class="card-title">Cooperados</h3>
        </div>
        <div class="card-actions">
          <router-link to="/Cooperators/create" class="btn btn-primary"> Cadastrar </router-link>
        </div>
      </div>
      <div class="card-body">
        <list-ajax :apiUrl="getUrl('cooperators')" title="Items List" :columns="getConfigColumns()">
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
        { name: 'email', label: 'Email' },
        {
          name: 'actions',
          label: 'Ações',
          actions: [{ name: 'view', icon: 'bi bi-eye', to: '/cooperators/:id' }],
        },
      ]
    },
    viewItem(id) {
      alert(id)
    },
  },
}
</script>
