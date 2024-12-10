<template>
  <li class="nav-item">
    <router-link :to="link" class="nav-link" :class="{ active: isActive() }">
      <i class="nav-icon" :class="icon" v-if="icon"></i>
      <p>
        <slot></slot>
      </p>
    </router-link>
  </li>
</template>

<script>
export default {
  name: 'NavItem',
  props: {
    link: {
      type: [String, Object],
      default: '',
    },
    icon: {
      type: String,
      default: '',
    },
  },
  methods: {
    isActive() {
      if (typeof this.link === 'object') {
        return this.$route.name === this.link.name
      }

      return this.$route.path === this.link
    },
  },
}
</script>
