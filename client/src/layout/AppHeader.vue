<template>
  <header class="header">
    <div class="left-col">
      <router-link :to="'/' + $i18n.locale">{{ $t('HomeLink') }}</router-link>
    </div>
    <div class="middle-col">
      <span>{{pageName}}</span>
    </div>
    <div class="right-col">
    <select v-model="$i18n.locale">
      <option
        v-for="(lang, i) in langs"
        :key="`Lang${i}`"
        :value="lang"
        >{{ lang }}</option
      >
    </select>
      <router-link v-if="!user" :to="'/' + $i18n.locale + '/login'">{{ $t('Login') }}</router-link>
      <router-link v-if="!user" :to="'/' + $i18n.locale + '/register'">{{ $t('Register') }}</router-link>
      <span v-if="user">{{user.email}}</span>
      <router-link v-if="user" :to="'/' + $i18n.locale + '/company/page=1'">{{ $t('CompaniesLink') }}</router-link>
      <router-link v-if="user" :to="'/' + $i18n.locale + '/employee/page=1'">{{ $t('EmployeesLink') }}</router-link>
      <span v-if="user" class="logout-btn" @click.prevent="logout" >{{ $t('LogoutLink') }}</span>
    </div>
  </header>
</template>
<script>
import axios from "axios";

export default {
  data() {
    return {
    langs: ['ru', 'en']
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
            this.$router.push({path: `/${this.$i18n.locale}`});
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
