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
        <!-- <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blank Page</li>
                    </ol>
                </div> -->
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

    $('title').html(title)
  },
}
</script>
