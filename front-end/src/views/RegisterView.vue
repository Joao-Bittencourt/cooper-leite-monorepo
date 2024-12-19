<template>
  <div class="page page-center">
    <div class="container container-tight py-4">
      <div class="text-center mb-4">
        <a href="." class="navbar-brand navbar-brand-autodark"> logo </a>
      </div>
      <form
        class="card card-md"
        action="/register"
        method="get"
        novalidate=""
        @submit.prevent="registerSubmit()"
      >
        <div class="card-body">
          <h2 class="card-title text-center mb-4">Create new account</h2>
          <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" v-model="name" class="form-control" placeholder="Enter name" />
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" v-model="email" class="form-control" placeholder="Enter email" />
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <div class="input-group input-group-flat">
              <input
                type="password"
                v-model="password"
                class="form-control"
                placeholder="Password"
                autocomplete="off"
              />
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <div class="input-group input-group-flat">
              <input
                type="password"
                v-model="c_password"
                class="form-control"
                placeholder="Password"
                autocomplete="off"
              />
            </div>
          </div>
          <div class="mb-3">
            <label class="form-check">
              <input type="checkbox" class="form-check-input" />
              <span class="form-check-label"
                >Agree the
                <a href="./terms-of-service.html" tabindex="-1">terms and policy</a>.</span
              >
            </label>
          </div>
          <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100">Create new account</button>
          </div>
        </div>
      </form>
    </div>
    <div class="text-center text-secondary mt-3">
      Already have account? <a href="/login" tabindex="-1">Sign in</a>
    </div>
  </div>
</template>

<script>
import { register } from '../services/AuthService.js'
export default {
  beforeMount() {
    document.title = 'Register | Cooper Leite'
  },
  data() {
    return {
      name: '',
      email: '',
      password: '',
      c_password: '',
    }
  },
  methods: {
    registerSubmit() {
      register(this.name, this.email, this.password, this.c_password)
        .then((response) => {
          console.log(response)
          this.$router.push('/')
        })
        .catch((error) => {
          console.log(error)
        })
    },
  },
}
</script>
