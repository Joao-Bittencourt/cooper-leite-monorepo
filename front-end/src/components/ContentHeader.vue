<template>
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 v-if="title">
            <i :class="icon" v-if="icon"></i>
            {{ title }}
          </h1>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  props: {
    title: {
      type: String,
      default: '',
    },
    icon: {
      type: String,
      default: '',
    },
  },
  beforeMount() {
    let title = this.$route.title
    title = this.title ? `${this.title} | Cooper Leite` : title

    document.title = title
  },
}
</script>
