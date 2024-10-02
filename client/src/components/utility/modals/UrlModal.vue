<template>
  <div class="modal-overlay" @click.self="close">
    <div class="modal-content">
      <h2>{{ title }}</h2>
      <input v-model="inputValue" type="text" placeholder="Enter URL" />
      <div class="button-group">
        <Button :text="'Save'" @click="save" />
        <Button :text="'Cancel'" @click="close" />
      </div>
    </div>
  </div>
</template>

<script>
import Button from "@/components/utility/Button.vue";

export default {
  name: "UrlModal",
  components: { Button },
  props: {
    title: String,
    isVisible: Boolean,
  },
  data() {
    return {
      inputValue: "",
    };
  },
  methods: {
    save() {
      this.$emit("save", this.inputValue);
      this.inputValue = "";
    },
    close() {
      this.$emit("close");
    },
  },
};
</script>

<style scoped>
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.modal-content {
  background: white;
  padding: 2rem;
  border-radius: 10px;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.button-group {
  display: flex;
  gap: 1rem;
  margin-top: 1rem;
}
</style>
