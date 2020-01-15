import Vue from "vue";
import Router from "vue-router";

import Error from "../views/Error";
import Homepage from "../views/Homepage";
import Company from "../views/Company";
import Employee from "../views/Employee";
import Login from "../views/Login";
import Reset from "../views/Reset";
import Register from "../views/Register";
import RouterView from "../views/RouterView.vue";

import { i18n } from "../main.js";

Vue.use(Router);

export default new Router({
  mode: "history",
  routes: [
    {
      path: "/:lang",
      component: RouterView,
      beforeEnter(to, from, next) {
        const lang = to.params.lang;
        if (!["en", "ru"].includes(lang)) return next("ru");
        if (i18n.locale !== lang) {
          i18n.locale = lang;
        }
        return next();
      },
      children: [
        {
          path: "company/page=:num",
          name: "Company",
          component: Company,
          props: true
        },
        {
          path: "employee/page=:num",
          name: "Employee",
          component: Employee,
          props: true
        },
        {
          path: "/",
          name: "Homepage",
          component: Homepage,
          props: true
        },
        {
          path: "register",
          name: "Register",
          component: Register,
          props: true
        },
        {
          path: "login",
          name: "Login",
          component: Login,
          props: true
        },
        {
          path: "reset",
          name: "Reset",
          component: Reset,
          props: true
        }
      ]
    },
    {
      path: "*",
      name: "ErrorPage",
      component: Error
    }
  ]
});
