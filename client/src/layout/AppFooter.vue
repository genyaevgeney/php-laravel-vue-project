<template>
  <footer class="footer-global">
    <div class="footer-global__top">
      <div class="container">
        <div class="row footer-global__top-row">
          <div class="col-lg-3 col-md-6 col-12 footer-global__top-col">
            <router-link to="/" class="col-3 footer-global__logo-wrap">
              <img
                src="images/header-logo.png"
                alt="logo-img"
                class="footer-global__logo-img"
              />
              <span class="footer-global__logo-text">SCHOLAR</span>
            </router-link>
            <p class="footer-global__top-text">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas
              enim orci, pharetra vitae sem ac, luctus imperdiet dolor. Nam vel
              sollicitudin est. Vestibulum ac risus ipsum. Maecenas lacus urna,
              tincidunt auctor enim non, pulvinar sollicitudin elit.
            </p>
          </div>
          <div
            class="col-xl-5 col-lg-4 col-md-6 col-12 footer-global__top-col footer-global__nav-cols"
          >
            <div class="footer-global__navigation-col">
              <span class="footer-global__navigation">NAVIGATION</span>
              <div class="footer-global__navigation-links">
                <router-link
                  to="/homepage"
                  class="footer-global__navigation-link"
                  >About Us</router-link
                >
                <router-link
                  to="/homepage"
                  class="footer-global__navigation-link"
                  >Online Course</router-link
                >
                <router-link
                  to="/homepage"
                  class="footer-global__navigation-link"
                  >Lectures</router-link
                >
                <router-link
                  to="/homepage"
                  class="footer-global__navigation-link"
                  >Partners</router-link
                >
                <router-link
                  to="/contactUs"
                  class="footer-global__navigation-link"
                  >Contact Us</router-link
                >
              </div>
            </div>
            <div class="footer-global__support-col">
              <span class="footer-global__support">SUPPORT</span>
              <div class="footer-global__support-links">
                <router-link to="/terms" class="footer-global__support-link"
                  >Terms of Use</router-link
                >
                <router-link
                  to="/privacyPolicy"
                  class="footer-global__support-link"
                  >Privacy Policy</router-link
                >
                <router-link to="/homepage" class="footer-global__support-link"
                  >Support</router-link
                >
                <router-link to="/homepage" class="footer-global__support-link"
                  >Licensing</router-link
                >
                <router-link to="/homepage" class="footer-global__support-link"
                  >Advertise</router-link
                >
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-lg-5 col-md-7 col-12 footer-global__top-col">
            <span class="footer-global__join-title">JOIN THE NEWSLETTER</span>
            <div class="footer-global__join-text">
              Get the freshest reviews, news, and more delivered right to your
              inbox!
            </div>
            <form class="footer-global__join-form">
              <BaseInput
                type="email"
                placeholder="Email"
                class="footer-global__join-input-email"
              />
              <base-button>SUBSCRIBE</base-button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-global__bottom">
      <div class="container">
        <div class="row footer-global__bottom-row">
          <span
            class="col-md-4 col-12 footer-global__bottom-col footer-global__copyright"
            >Copyright © 2019 Scholar. All Rights Are Reserved</span
          >
          <div
            class="col-md-4 col-sm-6 col-12 footer-global__bottom-col footer-global__social-links"
          >
            <router-link class="footer-global__social-link" to="/foo">
              <img
                src="images/twitter-icon.png"
                alt="twitter icon"
                class="footer-global__social-img"
              />
            </router-link>
            <router-link class="footer-global__social-link" to="/foo">
              <img
                src="images/facebook-icon.png"
                alt="facebook icon"
                class="footer-global__social-img"
              />
            </router-link>
            <router-link class="footer-global__social-link" to="/foo">
              <img
                src="images/youtube-icon.png"
                alt="youtube icon"
                class="footer-global__social-img"
              />
            </router-link>
          </div>
          <div
            class="col-md-4 col-sm-6 col-12 footer-global__bottom-col footer-global__payment-cards"
          >
            <router-link class="footer-global__payment" to="/foo">
              <img src="images/visa-icon.png" alt="youtube icon" />
            </router-link>
            <router-link class="footer-global__payment" to="/foo">
              <img src="images/amex-icon.png" alt="youtube icon" />
            </router-link>
            <router-link class="footer-global__payment" to="/foo">
              <img src="images/card-icon.png" alt="youtube icon" />
            </router-link>
            <router-link class="footer-global__payment" to="/foo">
              <img src="images/paypal-icon.png" alt="youtube icon" />
            </router-link>
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>
<script>
import BaseButton from "@/components/BaseButton";
import BaseInput from "@/components/BaseInput";

export default {
  components: {
    BaseButton,
    BaseInput
  }
};
</script>
<style lang="scss" scoped>
@import "@/assets/scss/layout/_AppFooter.scss";
</style>
