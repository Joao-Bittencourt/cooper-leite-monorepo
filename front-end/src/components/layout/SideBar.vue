<template>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">

    </a>

    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <navItem link="/" icon="nav-icon fas fa-tachometer-alt"> Dashboard </navItem>
          <navItem link="/about" icon="nav-icon fas fa-box"> About </navItem>
        </ul>
      </nav>
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
