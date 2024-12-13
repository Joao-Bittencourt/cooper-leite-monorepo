<template>
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <RouterLink to="/profile" class="dropdown-item">
            <i class="fas fa-user mr-2"></i>
            Profile
          </RouterLink>
          <div class="dropdown-divider"></div>
          <a href="#" @click="logout()" class="dropdown-item"> <i class="fas fa-sign-out-alt mr-2"></i> Logout </a>
        </div>
      </li>
    </ul>
  </nav>
</template>

<script>
import { logout } from '@/services/AuthService';

export default {
  methods: {
    logout() {
      logout();
    },
  },
};
</script>