<template>
  <div class="div">
    <AppHeader :pageName="pageName" />
    <div class="container register">
      <form class="form-horizontal register__form">
        <fieldset>
          <div class="control-group">
            <!-- Username -->
            <label class="control-label" for="username">{{ $t('NameLabel') }}</label>
            <div class="controls">
              <input
              v-model="info.name"
              type="text"
              id="username"
              name="username"
              placeholder=""
              class="input-xlarge"
              />
              <p v-if="errors.name" class="help-block">
                {{ errors.name }}
              </p>
            </div>
          </div>

          <div class="control-group">
            <!-- E-mail -->
            <label class="control-label" for="email">{{ $t('EmailLabel') }}</label>
            <div class="controls">
              <input
              v-model="info.email"
              type="text"
              id="email"
              name="email"
              placeholder=""
              class="input-xlarge"
              />
              <p v-if="errors.email" class="help-block">{{ errors.email }}</p>
            </div>
          </div>

          <div class="control-group">
            <!-- Password-->
            <label class="control-label" for="password">{{ $t('PasswordLabel') }}</label>
            <div class="controls">
              <input
              v-model="info.password"
              type="password"
              id="password"
              name="password"
              placeholder=""
              class="input-xlarge"
              />
              <p v-if="errors.password" class="help-block">{{ errors.password }}</p>
            </div>
          </div>

          <div class="control-group">
            <!-- Password -->
            <label class="control-label" for="password_confirm"
            >{{ $t('PasswordConfirmLabel') }}</label
            >
            <div class="controls">
              <input
              v-model="passwordConfirm"
              type="password"
              id="password_confirm"
              name="password_confirm"
              placeholder=""
              class="input-xlarge"
              />
              <p v-if="errors.passwordConfirm" class="help-block">
                {{ errors.passwordConfirm }}
              </p>
            </div>
          </div>

          <div class="control-group">
            <!-- Button -->
            <div class="controls">
              <button @click.prevent="btnClick" class="btn btn-success">
                {{ $t('Register') }}
              </button>
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
        errors: {
          name: "",
          email: "",
          password: "",
          passwordConfirm: ""
        },
        passwordConfirm: ""
      };
    },
    computed: {
      pageName() {
        return this.$t('RegisterpageName')
      },
    },
    components: {
      AppHeader
    },
    created() {
      console.log(this.$cookie.get('token'))
    },
    methods: {
      btnClick() {
        for (let key in this.errors) {
          this.errors[key] = "";
        }
        if (this.passwordConfirm !== this.info.password) {
          this.errors.passwordConfirm = "Passwords do not match";
        } else {
          const dataObj = {
            name: this.info.name,
            email: this.info.email,
            password: this.info.password
          }
          axios.post('http://php-crm.com/api/auth/register', dataObj)
          .then((response) => {
            this.$store.dispatch('SET_USER', response.data.user);
            const token = `${response.data.token_type} ${response.data.access_token}`
            this.$cookie.set('token', token);
            this.$cookie.set('rememberMe', true);
            this.$router.push({path: `/${this.$i18n.locale}`});
          })
          .catch((error) => {
            console.log(error.response.data.errors);
            const errorsObj = error.response.data.errors;
            for (let key in errorsObj) {
              if(key==="name") {
                this.errors.name = errorsObj[key][0]
              } else if (key==="email") {
                this.errors.email = errorsObj[key][0]
              } else if (key==="password") {
                this.errors.password = errorsObj[key][0]
              }
            }
          });
        }
      }
    }
  };
</script>
<style lang="scss" scoped>
@import "@/assets/scss/views/_Register.scss";
</style>
