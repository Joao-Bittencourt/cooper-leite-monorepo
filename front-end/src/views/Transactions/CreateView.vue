<template>
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

      <form action="/transactions/create" method="post" @submit.prevent="transactionSubmit()">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-label">Cooperado</div>
              <select v-model="cooperative_id" class="form-select">
                <option v-for="cooperative in cooperatives" :value="cooperative.id">
                  {{ cooperative.value }}
                </option>
              </select>
            </div>
            <div class="col-md-6">
              <div class="form-label">Produto</div>
              <select v-model="product_id" class="form-select">
                <option v-for="product in products" :value="product.id">
                  {{ product.value }}
                </option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-label">Quantidade</div>
              <input type="text" class="form-control" v-model="amount" />
            </div>
            <div class="col-md-3">
              <div class="form-label">Entrada/Saida</div>
              <select v-model="type" class="form-select">
                <option v-for="type in types" :value="type.id">
                  {{ type.value }}
                </option>
              </select>
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
import { createTransaction } from '../../services/TransactionService.js'
import { getCooperators } from '@/services/CooperatorService.js'
import { getProducts } from '@/services/ProductService.js'

export default {
  data() {
    return {
      product_id: '',
      cooperative_id: '',
      types: [{ id: 'I', value: 'Entrada' }, { id: 'O', value: 'Saída' }], // ['entrada', 'saida'],
      amount: '',
      created_by: '',
      cooperatives: [],
      products: [],
      loading: false,
    }
  },
  methods: {
    transactionSubmit() {
      this.loading = true

      let transaction = {
        product_id: this.product_id,
        cooperative_id: this.cooperative_id,
        type: this.type,
        amount: this.amount,
        created_by: this.created_by,
        active: 1,
      }

      createTransaction(transaction)
        .then((response) => {
          console.log(response)
        })
        .finally(() => {
          this.loading = false;
        })
    },
    fetchCooperatives() {
      getCooperators({ query: '' })
        .then((data) => {
          this.cooperatives = data.data.map((cooperative) => ({
            id: cooperative.id,
            value: cooperative.name,
          }))
        })
        .catch((error) => console.error(error))
    },
    fetchProducts() {
      getProducts({ query: '' })
        .then((data) => {
          this.products = data.data.map((product) => ({
            id: product.id,
            value: product.name,
          }))
        })
        .catch((error) => console.error(error))
    },
  },
  mounted() {
    this.fetchCooperatives(),
      this.fetchProducts()
  },
}
</script>
