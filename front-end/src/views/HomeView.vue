<template>
  <content-header title="Home" />
  <content>
    <div class="row">
      <div class="col-sm-6 col-lg-3">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-auto">
                <span class="bg-primary text-white avatar">
                  <i class="bi bi-box-seam"></i>
                </span>
              </div>
              <div class="col">
                <div class="font-weight-medium">{{ countProducts }} Produtos</div>
              </div>

            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-auto">
                <span class="bg-primary text-white avatar">
                  <i class="bi bi-people"></i>
                </span>
              </div>
              <div class="col">
                <div class="font-weight-medium">{{ countCooperatives }} Cooperados</div>
              </div>

            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-auto">
                <span class="bg-primary text-white avatar">
                  <i class="bi bi-arrow-down-up"></i>
                </span>
              </div>
              <div class="col">
                <div class="font-weight-medium">{{ countTransactions }} Transações</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </content>
</template>


<script>
import { countProducts } from '@/services/ProductService';

export default {
  data() {
    return {
      countProducts: 0,
      countCooperatives: 0,
      countTransactions: 0
    }
  },
  mounted() {
    countProducts().then((response) => {
      this.countProducts = response.count
    })
  }
}
</script>