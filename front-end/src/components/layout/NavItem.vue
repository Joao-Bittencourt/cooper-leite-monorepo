<template>
  <li class="nav-item">
    <router-link :to="link" class="nav-link" :class="{ active: isActive() }">
      <span class="nav-link-icon d-md-none d-lg-inline-block" v-if="icon">
        <slot></slot>
      </span>
      <span class="nav-link-title" v-if="title">
        {{ title }}
      </span>
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
    title: {
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
