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
          v-for="page in paginationRange"
          :key="page"
          :class="{ active: page === currentPage, disabled: page === '...' }"
          @click="fetchData(page)"
          :disabled="page === '...'"
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
            <div v-if="column.actions">
              <div v-for="action in column.actions" :key="action.name">
                <RouterLink :to="generateRoute(action.to, item)" class="btn btn-sm btn-primary">
                  <i :class="action.icon"></i>
                  {{ action.name }}
                </RouterLink>
              </div>
            </div>
            <div v-else>
              {{ item[column.name] }}
            </div>
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

        <!-- < 1 2 3 ... n-2 n-1 n > -->
        <li
          class="page-item"
          v-for="page in paginationRange"
          :key="page"
          :class="{ active: page === currentPage, disabled: page === '...' }"
          @click="fetchData(page)"
          :disabled="page === '...'"
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
    generateRoute(to, item) {
      return to.replace(':id', item?.id)
    },
  },
  computed: {
    paginationRange() {
      const total = Math.ceil(this.meta.total / this.meta.per_page)
      const current = this.currentPage
      const delta = 2
      const range = []
      let left = Math.max(2, current - delta)
      let right = Math.min(total - 1, current + delta)

      if (current - delta > 2) {
        range.push(1, '...')
      } else {
        range.push(1)
      }

      for (let i = left; i <= right; i++) {
        range.push(i)
      }

      if (current + delta < total - 1) {
        range.push('...', total)
      } else if (total > 1) {
        range.push(total)
      }

      return range
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
