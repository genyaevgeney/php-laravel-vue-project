<template>
  <transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">

          <div class="modal-header">
            <slot name="header">
              default header
            </slot>
          </div>

          <div class="modal-body">
            <slot name="body">
              default body
            </slot>
          </div>

          <div>
            <slot name="footer">
              default footer
            </slot>
          </div>

          <div class="modal-close">
              <button class="modal-default-button" @click="$emit('close')">
                Close
              </button>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>
<script>
export default {
  data() {
    return {
      showModal: false
    };
  },
  components: {},
  created() {},
  methods: {}
};
</script>
<style lang="scss" scoped>
@import "@/assets/scss/components/_Modal.scss";
</style>

