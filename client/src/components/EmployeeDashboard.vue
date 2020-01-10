<template>
  <div>
    <div class="main-block">
      <p class="page-name">
        Dashboard
      </p>
      <div class="main-section">
        <button id="show-modal" @click="showModal = true" class="create-btn">
          Create new employee
        </button>
        <Modal v-if="showModal" @close="closeModal">
          <h3 slot="header">Employee</h3>
          <div slot="body" class="create-div">
            <label for="name" class="label">Name:</label>
            <input v-model="info.name" type="text" id="name" class="input" />
            <p v-if="errors.name" class="help-block">{{ errors.name }}</p>
            <label for="address" class="label">Address:</label>
            <input
              v-model="info.address"
              type="text"
              id="address"
              class="input"
            />
            <p v-if="errors.address" class="help-block">{{ errors.address }}</p>
            <label for="companyName" class="label">Company name:</label>
            <input v-model="info.companyName" type="text" id="companyName" class="input" />
            <p v-if="errors.companyName" class="help-block">{{ errors.companyName }}</p>
          </div>
          <div slot="footer" class="mdl-footer">
            <button @click="createEmployee" class="modal-create-btn">Create</button>
          </div>
        </Modal>
        <Modal v-if="showEditModal" @close="closeModal">
          <h3 slot="header">Employee Edit</h3>
          <div slot="body" class="create-div">
            <label for="name" class="label">Name:</label>
            <input v-model="info.name" type="text" id="name" class="input" />
            <p v-if="errors.name" class="help-block">{{ errors.name }}</p>
            <label for="address" class="label">Address:</label>
            <input
              v-model="info.address"
              type="text"
              id="address"
              class="input"
            />
            <p v-if="errors.address" class="help-block">{{ errors.address }}</p>
            <label for="companyName" class="label">Company name:</label>
            <input v-model="info.companyName" type="text" id="companyName" class="input" />
            <p v-if="errors.companyName" class="help-block">{{ errors.companyName }}</p>
          </div>
          <div slot="footer" class="mdl-footer">
            <button @click="editDataEmployee" class="modal-create-btn">Edit</button>
          </div>
        </Modal>
        <div class="wrap-table employee">
          <p class="table-name">Employees list</p>
          <div class="wrap-div">
            <div class="table-main">
              <div class="tr">
                <span class="th">Name</span>
                <span class="th">Address</span>
                <span class="th">Company name</span>
                <span class="th"></span>
              </div>
              <div
                class="tr"
                v-for="(item, index) in backendData.data"
                :key="index"
              >
                <span class="td">{{ item.name }}</span>
                <span class="td"
                  >{{
                    item.address
                  }}</span
                >
                <span class="td">{{ item.companyName }}</span>
                <span class="td column-btn">
                  <button class="edit-btn" @click="editEmployee(index)">Edit</button>
                  <button class="delete-btn" @click="deleteEmployee(index)">Delete</button>
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
        address: "",
        companyName: "",
        id: ""
      },
      errors: {
        name: "",
        address: "",
        companyName: "",
      },
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
  //
  methods: {
    editEmployee(index) {
      this.showEditModal = true;
      this.info.name=this.backendData.data[index].name;
      this.info.address=this.backendData.data[index].address;
      this.info.companyName=this.backendData.data[index].companyName;
      this.info.id=this.backendData.data[index].id;
    },
    deleteEmployee(index) {
      let id=this.backendData.data[index].id;
      axios.delete(
        `http://php-crm.com/api/employees/${id}`,
        {
          headers: { Authorization: this.$cookie.get("token") }
        }
      ).then(response => {
              console.log(response)
              axios
            .get(
              `http://php-crm.com/api/employees/{employee}?page=${this.$route.params.num}`,
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
    createEmployee() {
      for (let key in this.errors) {
        this.errors[key] = "";
      }
      let formData = new FormData();
      formData.append("name", this.info.name);
      formData.append("address", this.info.address);
      formData.append("companyName", this.info.companyName);
      axios
        .post("http://php-crm.com/api/employees", formData, {
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
              `http://php-crm.com/api/employees/{employee}?page=${this.$route.params.num}`,
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
            } else if (key === "address") {
              this.errors.address = errorsObj[key][0];
            } else if (key === "companyName") {
              this.errors.companyName = errorsObj[key][0];
            }
          }
        });
    },
    editDataEmployee() {
      for (let key in this.errors) {
        this.errors[key] = "";
      }
      let formData = new FormData();
      formData.append("name", this.info.name);
      formData.append("address", this.info.address);
      formData.append("companyName", this.info.companyName);
      formData.append("_method", "put");
      axios
        .post(`http://php-crm.com/api/employees/${this.info.id}`, formData, {
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
              `http://php-crm.com/api/employees/{employee}?page=${this.$route.params.num}`,
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
            } else if (key === "address") {
              this.errors.address = errorsObj[key][0];
            } else if (key === "companyName") {
              this.errors.companyName = errorsObj[key][0];
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
