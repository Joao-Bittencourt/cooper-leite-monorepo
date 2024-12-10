<template>
  <div class="wrapper">
    <navBar />

    <sideBar />

    <div class="content-wrapper">
      <RouterView />
    </div>

    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">v0.0.0</div>
    </footer>
  </div>
</template>

<script>
import NavBar from './NavBar.vue'
import SideBar from './SideBar.vue'

export default {
  components: {
    NavBar,
    SideBar,
  },
}
</script>
