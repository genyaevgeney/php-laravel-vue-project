<template>
  <header class="header">
    <div class="left-col">
      <router-link to="/">Home</router-link>
    </div>
    <div class="middle-col">
      <span>{{pageName}}</span>
    </div>
    <div class="right-col">
      <router-link v-if="!user" to="/login">Login</router-link>
      <router-link v-if="!user" to="/register">Register</router-link>
      <span v-if="user">{{user.email}}</span>
      <router-link v-if="user" to="/company/page=1">Companies</router-link>
      <router-link v-if="user" to="/employee/page=1">Employees</router-link>
      <span v-if="user" class="logout-btn" @click.prevent="logout" >Logout</span>
    </div>
  </header>
</template>
<script>
import axios from "axios";

export default {
  data() {
    return {

    };
  },
  computed: {
    user() {
      return this.$store.state.user
    }
  },
  props: {
    pageName: {
      type: String,
      default: ""
    }
  },
  components: {

  },
  created() {},
  mounted() {},
  methods: {
    logout() {
      axios.get('http://php-crm.com/api/auth/logout', {
           'headers': { 'Authorization': this.$cookie.get('token') }
          })
          .then(res=>{
            this.$store.dispatch('DROP_USER');
            this.$cookie.delete('token');
            this.$cookie.delete('rememberMe');
        this.$router.push({path: '/'});
            console.log(res)
          })
          .catch(err=>{
            console.log(err);
          });
    }
  }
};
</script>
<style lang="scss" scoped>
@import "@/assets/scss/layout/_AppHeader.scss";
</style>
