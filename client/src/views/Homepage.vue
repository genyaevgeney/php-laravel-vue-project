<template>
  <div class="div">
    <AppHeader :pageName="pageName"/>
    <div class="container">

    </div>
  </div>
</template>
<script>
import AppHeader from "@/layout/AppHeader";


export default {
  data() {
    return {
      pageName:"Homepage",
    };
  },
  computed: {
    user() {
      return this.$store.state.user
    }
  },
  components: {
    AppHeader
  },
  created() {
        console.log(this.$cookie.get('token'))
  },
  methods: {
  }
};
</script>
<style lang="scss" scoped>
@import "@/assets/scss/views/_Homepage.scss";
</style>
