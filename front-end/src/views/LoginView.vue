<template>
  <div class="page page-center">
    <div class="container container-tight py-4">
      <div class="text-center mb-4">
        <a href="/" class="navbar-brand navbar-brand-autodark"> logo </a>
      </div>
      <div class="card card-md">
        <div class="card-body">
          <h2 class="h2 text-center mb-4">Login to your account</h2>
          <form
            action="./"
            method="get"
            autocomplete="off"
            novalidate
            @submit.prevent="loginSubmit()"
          >
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input
                type="email"
                class="form-control"
                placeholder="your@email.com"
                v-model="email"
                autocomplete="off"
              />
            </div>
            <div class="mb-2">
              <label class="form-label">
                Password
                <!-- <span class="form-label-description">
                                    <a href="./forgot-password.html">I forgot password</a>
                                </span> -->
              </label>
              <div class="input-group input-group-flat">
                <input
                  type="password"
                  class="form-control"
                  placeholder="Your password"
                  v-model="password"
                  autocomplete="off"
                />
              </div>
            </div>
            <div class="mb-2">
              <label class="form-check">
                <input type="checkbox" class="form-check-input" />
                <span class="form-check-label">Remember me</span>
              </label>
            </div>
            <div class="form-footer">
              <button type="submit" class="btn btn-primary w-100" :class="loading ? 'disabled' : ''">
                <div class="spinner-border text-white me-2" role="status" v-if="loading">
                </div>
                Sign in
              </button>
            </div>
          </form>
        </div>
      </div>
      <div class="text-center text-secondary mt-3">
        Don't have account yet? <a href="./register" tabindex="-1">Sign up</a>
      </div>
    </div>
  </div>
</template>

<script>
import { login } from '../services/AuthService.js'

export default {
  beforeMount() {
    document.title = 'Login | Cooper Leite'
  },
  data() {
    return {
      email: '',
      password: '',
      loading: false,
    }
  },
  methods: {
    loginSubmit() {
      this.loading = true;
      login(this.email, this.password)
        .then((response) => {
          console.log(response)
          this.$router.push('/')
        })
        .catch((error) => {
          console.log(error)
        })
        .finally(() => {
          this.loading = false
        })
    },
  },
}
</script>
