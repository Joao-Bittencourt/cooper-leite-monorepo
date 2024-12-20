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
  <div v-else>
    <slot name="content" :data="data"></slot>

    <!-- Pagination -->
    <nav v-if="meta && meta.last_page > 1">
      <ul class="pagination justify-content-center">
        <li
          class="page-item"
          :class="{ disabled: currentPage === 1 }"
          @click="fetchData(currentPage - 1)"
        >
          <span class="page-link">Previous</span>
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
          <span class="page-link">Next</span>
        </li>
      </ul>
    </nav>
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
