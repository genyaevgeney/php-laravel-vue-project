<template>
  <div>
    <div class="main-block">
      <p class="page-name">
        {{ $t('DashboardWord') }}
      </p>
      <div class="main-section">
        <button id="show-modal" @click="showModal = true" class="create-btn">
          {{ $t('CreateCompanyBtn') }}
        </button>
        <Modal v-if="showModal" @close="closeModal">
          <h3 slot="header">{{ $t('CompanyTrl') }}</h3>
          <div slot="body" class="create-div">
            <label for="name" class="label">{{ $t('NameTrl') }}:</label>
            <input v-model="info.name" type="text" id="name" class="input" />
            <p v-if="errors.name" class="help-block">{{ errors.name }}</p>
            <label for="logo" class="label">{{ $t('LogoTrl') }}:</label>
            <input type="file" id="logo" class="input" />
            <p v-if="errors.logo" class="help-block">{{ errors.logo }}</p>
            <label for="website" class="label">{{ $t('WebsiteTrl') }}:</label>
            <input
              v-model="info.website"
              type="text"
              id="website"
              class="input"
            />
            <p v-if="errors.website" class="help-block">{{ errors.website }}</p>
            <label for="email" class="label">{{ $t('EmailTrl') }}:</label>
            <input v-model="info.email" type="text" id="email" class="input" />
            <p v-if="errors.email" class="help-block">{{ errors.email }}</p>
          </div>
          <div slot="footer" class="mdl-footer">
            <button @click="createCompany" class="modal-create-btn">{{ $t('CreateTrl') }}</button>
          </div>
        </Modal>
        <Modal v-if="showEditModal" @close="closeModal">
          <h3 slot="header">{{ $t('EditWindow') }}</h3>
          <div slot="body" class="create-div">
            <label for="name" class="label">{{ $t('NameTrl') }}:</label>
            <input v-model="info.name" type="text" id="name" class="input" />
            <p v-if="errors.name" class="help-block">{{ errors.name }}</p>
            <label for="logo" class="label">{{ $t('LogoTrl') }}:</label>
            <div class="image-wrap modal-logo">
              <img id="editImg" class="image" :src="pathImg + info.logo" alt="logo"
                />
            </div>
            <input type="file" id="editLogo" class="input" />
            <p v-if="errors.logo" class="help-block">{{ errors.logo }}</p>
            <label for="website" class="label">{{ $t('WebsiteTrl') }}:</label>
            <input
              v-model="info.website"
              type="text"
              id="website"
              class="input"
            />
            <p v-if="errors.website" class="help-block">{{ errors.website }}</p>
            <label for="email" class="label">{{ $t('EmailTrl') }}:</label>
            <input v-model="info.email" type="text" id="email" class="input" />
            <p v-if="errors.email" class="help-block">{{ errors.email }}</p>
          </div>
          <div slot="footer" class="mdl-footer">
            <button @click="editDataCompany" class="modal-create-btn">{{ $t('EditTrl') }}</button>
          </div>
        </Modal>
        <div class="wrap-table">
          <p class="table-name">{{ $t('CompaniesListTrl') }}</p>
          <div class="wrap-div">
            <div class="table-main">
              <div class="tr">
                <span class="th">{{ $t('NameTrl') }}</span>
                <span class="th">{{ $t('LogoTrl') }}</span>
                <span class="th">{{ $t('WebsiteTrl') }}</span>
                <span class="th">{{ $t('EmailTrl') }}</span>
                <span class="th"></span>
              </div>
              <div
                class="tr"
                v-for="(item, index) in backendData.data"
                :key="index"
              >
                <span class="td">{{ item.name }}</span>
                <span class="td"
                  >
                  <div class="image-wrap">
                    <img class="image" :src="pathImg + item.logo" alt="logo"
                />
                  </div>
                </span>
                <span class="td"
                  ><a :href="item.website" target="_blank">{{
                    item.name
                  }}</a></span
                >
                <span class="td">{{ item.email }}</span>
                <span class="td column-btn">
                  <button class="edit-btn" @click="editCompany(index)">{{ $t('EditTrl') }}</button>
                  <button class="delete-btn" @click="deleteCompany(index)">{{ $t('DeleteTrl') }}</button>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="Dashboard__pagination">
      {{ createIterator() }}
      <ul v-if="backendData.pages > 1" class="pagination text-center">
        <li v-if="backendData.current_page == 1" class="disabled">
          <span>First</span>
        </li>
        <li v-else><router-link to="page=1">First</router-link></li>
        <li v-if="iterator !== 1" class="disabled"><span>...</span></li>
        <template v-for="i in backendData.pages">
          <template
            v-if="
              iterator <= Number(backendData.current_page) + 4 &&
                iterator <= backendData.pages
            "
          >
            <li v-if="iterator == backendData.current_page" class="active">
              <span>{{ iterator }}</span>
            </li>
            <li v-else>
              <router-link :to="'page=' + iterator">{{ iterator }}</router-link>
            </li>
            <li
              v-if="
                iterator == Number(backendData.current_page) + 4 &&
                  iterator < backendData.pages
              "
              class="disabled"
            >
              <span>...</span>
            </li>
            {{ incrementIterator() }}
          </template>
        </template>
        <li
          v-if="backendData.current_page == backendData.pages"
          class="disabled"
        >
          <span>Last</span>
        </li>
        <li v-else>
          <router-link :to="'page=' + backendData.pages">Last</router-link>
        </li>
      </ul>
    </div>
  </div>
</template>
<script>
import Modal from "@/components/Modal";
import axios from "axios";

export default {
  data() {
    return {
      showModal: false,
      showEditModal: false,
      info: {
        name: "",
        email: "",
        logo: "",
        website: "",
        id: ""
      },
      editInfo: {},
      errors: {
        name: "",
        email: "",
        logo: "",
        website: ""
      },
      pathImg: "http://php-crm.com/storage/",
    };
  },
  props: {
    backendData: {
      type: Object
    }
  },
  computed: {
    data() {
      return this.backendData;
    }
  },
  components: {
    Modal
  },
  created() {
    console.log("backendData", this.backendData);
  },
  methods: {
    editCompany(index) {
      this.showEditModal = true;
      this.info.name=this.backendData.data[index].name;
      this.info.email=this.backendData.data[index].email;
      this.info.logo=this.backendData.data[index].logo;
      this.info.website=this.backendData.data[index].website;
      this.info.id=this.backendData.data[index].id;
    },
    deleteCompany(index) {
      let id=this.backendData.data[index].id;
      axios.delete(
        `http://php-crm.com/api/companies/${id}`,
        {
          headers: { Authorization: this.$cookie.get("token") }
        }
      ).then(response => {
              console.log(response)
              axios
            .get(
              `http://php-crm.com/api/companies/{company}?page=${this.$route.params.num}`,
              {
                headers: { Authorization: this.$cookie.get("token") }
              }
            )
            .then(response => {
              this.backendData = response.data;
              this.backendData.pages = Math.ceil(this.backendData.total / this.backendData.per_page);
            });
            });
    },
    incrementIterator() {
      this.iterator++;
    },
    createIterator() {
      this.iterator =
        Number(this.backendData.current_page) > 5
          ? Number(this.backendData.current_page) - 4
          : 1;
    },
    createCompany() {
      let logoFile = document.querySelector("#logo").files[0];
      for (let key in this.errors) {
        this.errors[key] = "";
      }
      let formData = new FormData();
      formData.append("logo", logoFile);
      formData.append("name", this.info.name);
      formData.append("email", this.info.email);
      formData.append("website", this.info.website);
      axios
        .post("http://php-crm.com/api/companies", formData, {
          headers: { Authorization: this.$cookie.get("token") }
        })
        .then(response => {
          console.log(response);
          this.showModal = false;
          for (let key in this.info) {
            this.info[key] = "";
          }
          axios
            .get(
              `http://php-crm.com/api/companies/{company}?page=${this.$route.params.num}`,
              {
                headers: { Authorization: this.$cookie.get("token") }
              }
            )
            .then(response => {
              this.backendData = response.data;
              this.backendData.pages = Math.ceil(this.backendData.total / this.backendData.per_page);
            });
        })
        .catch(error => {
          console.log(error.response.data.errors);
          const errorsObj = error.response.data.errors;
          for (let key in errorsObj) {
            if (key === "name") {
              this.errors.name = errorsObj[key][0];
            } else if (key === "email") {
              this.errors.email = errorsObj[key][0];
            } else if (key === "website") {
              this.errors.website = errorsObj[key][0];
            } else if (key === "logo") {
              this.errors.logo = errorsObj[key][0];
            }
          }
        });
    },
    editDataCompany() {
      for (let key in this.errors) {
        this.errors[key] = "";
      }
      let formData = new FormData();
      let logoFile = document.querySelector("#editLogo").files[0];
      console.log(logoFile)
      if(logoFile) formData.append("logo", logoFile);
      formData.append("name", this.info.name);
      formData.append("email", this.info.email);
      formData.append("website", this.info.website);
      formData.append("_method", "put");
      axios
        .post(`http://php-crm.com/api/companies/${this.info.id}`, formData, {
          headers: { Authorization: this.$cookie.get("token") }
        })
        .then(response => {
          console.log(response);
          this.showEditModal = false;
          for (let key in this.info) {
            this.info[key] = "";
          }
          axios
            .get(
              `http://php-crm.com/api/companies/{company}?page=${this.$route.params.num}`,
              {
                headers: { Authorization: this.$cookie.get("token") }
              }
            )
            .then(response => {
              this.backendData = response.data;
              this.backendData.pages = Math.ceil(this.backendData.total / this.backendData.per_page);
            });
        })
        .catch(error => {
          console.log(error.response.data.errors);
          const errorsObj = error.response.data.errors;
          for (let key in errorsObj) {
            if (key === "name") {
              this.errors.name = errorsObj[key][0];
            } else if (key === "email") {
              this.errors.email = errorsObj[key][0];
            } else if (key === "website") {
              this.errors.website = errorsObj[key][0];
            } else if (key === "logo") {
              this.errors.logo = errorsObj[key][0];
            }
          }
        });
    },
    closeModal() {
      this.showModal = false;
      this.showEditModal = false;
      for (let key in this.errors) {
        this.errors[key] = "";
      }
      for (let key in this.info) {
        this.info[key] = "";
      }
    }
  }
};
</script>
<style lang="scss" scoped>
@import "@/assets/scss/components/_Dashboard.scss";
</style>
