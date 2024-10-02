<template>
  <div class="logo-button">

      <router-link to="/home">
        <img :style="{ height: size }" src="@/assets/images/IGDb-logo.png" alt="IGDb logo" />
      </router-link>

  </div>
</template>

<script>
export default {
  name: "LogoButton",
  props: {
    size: {
      type: String,
      default: "2rem"
    }
  }
}
</script>

<style scoped>
</style>