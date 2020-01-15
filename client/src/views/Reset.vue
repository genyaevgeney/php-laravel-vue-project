<template>
  <div class="div">
    <AppHeader :pageName="pageName"/>
    <div class="container register">
      <form class="form-horizontal register__form" action='' method="POST">
        <fieldset>
          <div class="control-group">
            <!-- E-mail -->
            <label class="control-label" for="email">E-mail</label>
            <div class="controls">
              <input type="text" id="email" name="email" placeholder="" class="input-xlarge">
              <p class="help-block">Please provide your E-mail</p>
            </div>
          </div>

          <div class="control-group">
            <!-- Button -->
            <div class="controls">
              <button class="btn btn-success">Send mail</button>
            </div>
          </div>
        </fieldset>
      </form>
    </div>
  </div>
</template>
<script>
  import AppHeader from "@/layout/AppHeader";

  export default {
    data() {
      return {
        pageName:"Reset Page"
      };
    },
    components: {
      AppHeader,
    },
    created() {
    },
    methods: {
    }
  };
</script>
<style lang="scss" scoped>
@import "@/assets/scss/views/_Reset.scss";
</style>
