<template>
  <div class="div">
    <AppHeader :pageName="pageName" />
    <div class="container">
      <template v-if="user">
        <EmployeeDashboard :backendData="backendData" />
      </template>
    </div>
  </div>
</template>
<script>
  import AppHeader from "@/layout/AppHeader";
  import axios from "axios";
  import EmployeeDashboard from "@/components/EmployeeDashboard";

  export default {
    data() {
      return {
        backendData: {}
      };
    },
    computed: {
      pageName() {
        return this.$t("EmployeeDashboardPageName");
      },
      user() {
        return this.$store.state.user;
      }
    },
    components: {
      AppHeader,
      EmployeeDashboard
    },
    mounted() {
      this.getData();
    },
    watch: {
      $route: "getData",
      $store: "getData"
    },
    created() {
      console.log(this.$cookie.get("token"));
    },
    methods: {
      async getData() {
        axios
        .get(
          `http://php-crm.com/api/employees/{employee}?page=${this.$route.params.num}`,
          {
            headers: { Authorization: this.$cookie.get("token") }
          }
          )
        .then(response => {
          console.log("COMPANY", response.data.companyName);
          this.backendData = response.data;
          this.backendData.pages = Math.ceil(
            this.backendData.total / this.backendData.per_page
            );
          console.log(this.backendData.total);
          console.log("Data", this.backendData);
        });
      }
    }
  };
</script>
<style lang="scss" scoped>
@import "@/assets/scss/views/_Company.scss";
</style>
