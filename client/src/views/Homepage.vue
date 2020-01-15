<template>
  <div class="div">
    <AppHeader :pageName="pageName"/>
    <div class="image-wrap">
      <img src="home.jpg" alt="image">
    </div>
  </div>
</template>
<script>
  import AppHeader from "@/layout/AppHeader";


  export default {
    data() {
      return {
      };
    },
    computed: {
      pageName() {
        return this.$t('HomepageName')
      },
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
