<template>
  <header class="navbar navbar-expand-md d-none d-lg-flex d-print-none">
    <div class="container-xl">
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbar-menu"
        aria-controls="navbar-menu"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-nav flex-row order-md-last">
        <div class="nav-item dropdown">
          <a
            href="#"
            class="nav-link d-flex lh-1 text-reset p-0"
            data-bs-toggle="dropdown"
            aria-label="Open user menu"
          >
            <span class="avatar avatar-sm"></span>
            <div class="d-none d-xl-block ps-2">
              <div>{{ currentUser?.name ?? 'Usuário' }}</div>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <RouterLink to="/profile" class="dropdown-item">Profile</RouterLink>
            <div class="dropdown-divider"></div>
            <RouterLink to="/logout" class="dropdown-item" @click="logout">Logout</RouterLink>
          </div>
        </div>
      </div>
      <div class="collapse navbar-collapse" id="navbar-menu"></div>
    </div>
  </header>
</template>

<script>
import { logout } from '@/services/AuthService'

export default {
  data() {
    return {
      currentUser: JSON.parse(localStorage.getItem('user')),
    }
  },
  methods: {
    logout() {
      logout()
    },
  },
}
</script>
