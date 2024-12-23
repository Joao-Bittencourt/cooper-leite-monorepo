<template>
  <content>
    <div class="card">
      <div class="card-header">
        <div>
          <h3 class="card-title">Produto</h3>
        </div>
      </div>

      <form action="/products/store" method="post" @submit.prevent="productSubmit()">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-label">Nome</div>
              <input type="text" class="form-control" v-model="name" />
            </div>
            <div class="col-md-3">
              <div class="form-label">Unidade</div>
              <input type="text" class="form-control" v-model="unit" />
            </div>
            <div class="col-md-3">
              <div class="form-label">Preço</div>
              <input type="text" v-model="price" class="form-control" />
            </div>
            <div class="mb-3">
              <label class="form-label">Descrição</label>
              <textarea class="form-control" v-model="description" rows="3"
                placeholder="Descrição do produto"></textarea>
            </div>
          </div>
        </div>
        <div class="card-footer bg-transparent mt-auto">
          <div class="btn-list justify-content-end">
            <button type="submit" class="btn btn-primary" :class="loading ? 'disabled' : ''">
              <div class="spinner-border text-white me-2" role="status" v-if="loading">
              </div>
              Salvar
            </button>
          </div>
        </div>
      </form>
    </div>
  </content>
</template>

<script>
import { createProduct } from '../../services/ProductService.js'

export default {
  data() {
    return {
      name: '',
      description: '',
      unit: '',
      price: '',
      loading: false,
    }
  },
  methods: {
    productSubmit() {
      this.loading = true
      
      let product = {
        name: this.name,
        description: this.description,
        unit: this.unit,
        price: this.price,
      }

      createProduct(product).then((response) => {
        console.log(response)
      }).finally(() => {
        this.loading = false
      })
    },
  },
}
</script>
