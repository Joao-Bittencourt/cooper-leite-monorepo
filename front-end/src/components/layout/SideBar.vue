<template>
  <aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#sidebar-menu"
        aria-controls="sidebar-menu"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-brand navbar-brand-autodark">
        <a href="."> </a>
      </div>

      <div class="collapse navbar-collapse" id="sidebar-menu">
        <ul class="navbar-nav pt-lg-3">
          <NavItem link="/" title="Home" icon="true">
            <i class="bi bi-house"></i>
          </NavItem>
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle"
              href="#navbar-base"
              data-bs-toggle="dropdown"
              data-bs-auto-close="false"
              role="button"
              aria-expanded="false"
            >
              <span class="nav-link-icon d-md-none d-lg-inline-block">
                <i class="bi bi-box-seam"></i>
              </span>
              <span class="nav-link-title"> Produtos </span>
            </a>
            <div class="dropdown-menu">
              <div class="dropdown-menu-columns">
                <div class="dropdown-menu-column">
                  <RouterLink to="/products" class="dropdown-item"> Listar </RouterLink>
                  <RouterLink to="/products/create" class="dropdown-item"> Cadastrar </RouterLink>

                  <!-- <div class="dropend">
                    <a class="dropdown-item dropdown-toggle" href="#sidebar-authentication" data-bs-toggle="dropdown"
                      data-bs-auto-close="false" role="button" aria-expanded="false">
                      Authentication
                    </a>
                    <div class="dropdown-menu">
                      <a href="./sign-in.html" class="dropdown-item">
                        Sign in
                      </a>
                      <a href="./sign-in-link.html" class="dropdown-item">
                        Sign in link
                      </a>

                    </div>
                  </div> -->
                </div>
              </div>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle"
              href="#navbar-base"
              data-bs-toggle="dropdown"
              data-bs-auto-close="false"
              role="button"
              aria-expanded="false"
            >
              <span class="nav-link-icon d-md-none d-lg-inline-block">
                <i class="bi bi-people"></i>
              </span>
              <span class="nav-link-title"> Cooperados </span>
            </a>
            <div class="dropdown-menu">
              <div class="dropdown-menu-columns">
                <div class="dropdown-menu-column">
                  <RouterLink to="/cooperators" class="dropdown-item"> Listar </RouterLink>
                  <RouterLink to="/cooperators/create" class="dropdown-item">
                    Cadastrar
                  </RouterLink>
                </div>
              </div>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle"
              href="#navbar-base"
              data-bs-toggle="dropdown"
              data-bs-auto-close="false"
              role="button"
              aria-expanded="false"
            >
              <span class="nav-link-icon d-md-none d-lg-inline-block">
                <i class="bi bi-arrow-down-up"></i>
              </span>
              <span class="nav-link-title"> Transações </span>
            </a>
            <div class="dropdown-menu">
              <div class="dropdown-menu-columns">
                <div class="dropdown-menu-column">
                  <RouterLink to="/transactions" class="dropdown-item"> Listar </RouterLink>
                  <RouterLink to="/transactions/create" class="dropdown-item">
                    Cadastrar
                  </RouterLink>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </aside>
</template>

<script>
import NavItem from './NavItem.vue'

export default {
  components: {
    NavItem,
  },
}
</script>

<style scoped>
.router-link-active {
  background-color: #293d58;
}
</style>
