<template>
  <SideBar />
  <NavBar />
  <div class="page-wrapper">
    <div class="page-body">
      <div class="container-xl">
        <router-view></router-view>
      </div>
    </div>
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
