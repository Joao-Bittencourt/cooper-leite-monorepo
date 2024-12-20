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
        <!-- @ToDo: revisar para passar dinamicamente a url -->
        <list-ajax apiUrl="http://localhost:8000/api/products" title="Items List">
          <template v-slot:content="{ data }">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nome</th>
                  <th>Descrição</th>
                  <th>Unidade</th>
                  <th>Preço</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="item in data" :key="item.id">
                  <td>{{ item.id }}</td>
                  <td>{{ item.name }}</td>
                  <td>{{ item.description }}</td>
                  <td>{{ item.unit }}</td>
                  <td>{{ item.price }}</td>
                  <td>
                    <button class="btn btn-sm btn-secondary" @click="viewItem(item.id)">
                      View
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </template>
        </list-ajax>
      </div>
    </div>
  </content>
</template>

<script>
import ListAjax from '@/components/ListAjax.vue'

export default {
  components: { ListAjax },
}
</script>
