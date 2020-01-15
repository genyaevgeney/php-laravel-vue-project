<template>
  <div class="div">
    <AppHeader :pageName="pageName"/>
    <div class="container register">
      <form class="form-horizontal register__form" action='' method="POST">
        <p v-if="errorMsg" class="help-block">{{errorMsg}}</p>
        <fieldset>
          <div class="control-group">
            <!-- E-mail -->
            <label class="control-label" for="email">{{ $t('EmailLabel') }}</label>
            <div class="controls">
              <input v-model="info.email" type="text" id="email" name="email" placeholder="" class="input-xlarge">
            </div>
          </div>
          
          <div class="control-group">
            <!-- Password-->
            <label class="control-label" for="password">{{ $t('PasswordLabel') }}</label>
            <div class="controls">
              <input v-model="info.password" type="password" id="password" name="password" placeholder="" class="input-xlarge">
            </div>
          </div>

          <div class="control-group">
            <!-- Button -->
            <div class="controls">
              <button @click.prevent="btnClick" class="btn btn-success">{{ $t('Login') }}</button>
              <div class="label-wrap">
                <label class="forgot label" for="checkbox">{{ $t('RememberMe') }}: </label>
                <input v-model="rememberFlag" id="checkbox" type="checkbox"/>
              </div>
            </div>
          </div>
        </fieldset>
      </form>
    </div>
  </div>
</template>
<script>
  import AppHeader from "@/layout/AppHeader";
  import axios from "axios";

  export default {
    data() {
      return {
        info: {
          name: "",
          email: "",
          password: ""
        },
        errorMsg:"",
        rememberFlag: false
      };
    },
    computed: {
      pageName() {
        return this.$t('LoginpageName')
      },
    },
    components: {
      AppHeader,
    },
    created() {
    },
    methods: {
      btnClick() {
        this.errorMsg = "";
        const dataObj = {
          email: this.info.email,
          password: this.info.password
        }
        axios.post('http://php-crm.com/api/auth/login', dataObj)
        .then((response) => {
          this.$store.dispatch('SET_USER', response.data.user);
          const token = `${response.data.token_type} ${response.data.access_token}`
          this.$cookie.set('token', token);
          if(this.rememberFlag) this.$cookie.set('rememberMe', this.rememberFlag);
          this.$router.push({path: `/${this.$i18n.locale}`});
        })
        .catch((error) => {
          this.errorMsg = error.response.data.message;
        });
      }
    }
  };
</script>
<style lang="scss" scoped>
@import "@/assets/scss/views/_Login.scss";
</style>
