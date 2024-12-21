<template>
  <div v-if="loading" class="text-center my-4">
    <div class="spinner-border text-primary" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
  </div>
  <div v-if="error" class="alert alert-danger">
    {{ error }}
  </div>

  <!-- List Content -->
  <div class="table-responsive" v-else>
    <div class="mb-3 d-flex align-items-center" v-if="meta && meta.last_page > 1">
      <p class="mb-0">Exibindo {{ meta.from }} a {{ meta.to }} de {{ meta.total }} registros</p>
      <ul class="pagination m-0 ms-auto">
        <li
          class="page-item"
          :class="{ disabled: currentPage === 1 }"
          @click="fetchData(currentPage - 1)"
        >
          <span class="page-link"><i class="bi bi-caret-left-fill"></i></span>
        </li>
        <li
          class="page-item"
          v-for="page in meta.last_page"
          :key="page"
          :class="{ active: currentPage === page }"
          @click="fetchData(page)"
        >
          <span class="page-link">{{ page }}</span>
        </li>
        <li
          class="page-item"
          :class="{ disabled: currentPage === meta.last_page }"
          @click="fetchData(currentPage + 1)"
        >
          <span class="page-link"> <i class="bi bi-caret-right-fill"></i></span>
        </li>
      </ul>
    </div>

    <table class="table card-table table-vcenter text-nowrap datatable">
      <thead>
        <tr>
          <th v-for="column in columns" :key="column.name">
            {{ column.label ?? column.name }}
          </th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in data" :key="item.id">
          <td v-for="column in columns" :key="column.name">
            {{ item[column.name] }}
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-3 d-flex align-items-center" v-if="meta && meta.last_page > 1">
      <p class="mb-0"></p>
      <ul class="pagination m-0 ms-auto">
        <li
          class="page-item"
          :class="{ disabled: currentPage === 1 }"
          @click="fetchData(currentPage - 1)"
        >
          <span class="page-link"><i class="bi bi-caret-left-fill"></i></span>
        </li>
        <li
          class="page-item"
          v-for="page in meta.last_page"
          :key="page"
          :class="{ active: currentPage === page }"
          @click="fetchData(page)"
        >
          <span class="page-link">{{ page }}</span>
        </li>
        <li
          class="page-item"
          :class="{ disabled: currentPage === meta.last_page }"
          @click="fetchData(currentPage + 1)"
        >
          <span class="page-link"><i class="bi bi-caret-right-fill"></i></span>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ListAjax',
  props: {
    apiUrl: {
      type: String,
      required: true,
    },
    title: {
      type: String,
      default: 'List',
    },
    columns: {
      type: Array,
      default: [],
    },
  },
  data() {
    return {
      data: [],
      meta: null,
      currentPage: 1,
      loading: false,
      error: null,
    }
  },
  methods: {
    async fetchData(page = 1) {
      if (page < 1 || (this.meta && page > this.meta.last_page)) return

      this.loading = true
      this.error = null
      this.currentPage = page

      try {
        console.log(this.apiUrl)
        const response = await fetch(`${this.apiUrl}?page=${page}`, {
          method: 'GET',
          headers: {
            'Content-Type': 'application/json',
            Authorization: 'Bearer ' + localStorage.getItem('token'),
          },
        })
        if (!response.ok) {
          throw new Error(`HTTP error! Status: ${response.status}`)
        }
        const result = await response.json()
        this.data = result.data || []
        this.meta = result || null
      } catch (err) {
        this.error = err.message || 'Failed to fetch data.'
      } finally {
        this.loading = false
      }
    },
  },
  mounted() {
    this.fetchData() // Fetch data on component mount
  },
}
</script>

<style>
/* Optional styles */
.pagination .page-link {
  cursor: pointer;
}
</style>
