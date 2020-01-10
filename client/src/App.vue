<template>
  <router-view />
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {};
  },
  computed: {
    user() {
      return this.$store.state.user;
    }
  },
  watch: {
    $route: "chekAuth"
  },
  created() {
    this.chekAuth();
  },
  methods: {
    async chekAuth() {
      if (this.$cookie.get("rememberMe")) {
        axios
          .get("http://php-crm.com/api/auth/me",
              {
                headers: { Authorization: this.$cookie.get("token") }
              })
          .then(response => {
            this.$store.dispatch("SET_USER", response.data);
          })
          .catch(error => {
            console.log(error)
          });
      }
    }
  }
};
</script>

<style lang="scss">
@import "@/assets/scss/index.scss";
</style>
