<template>
  <IGDbHeader/>
  <main>
    <h3>not implemented yet</h3>
  </main>
  <IGDbFooter/>
</template>

<script>
import IGDbHeader from "@/components/header/IGDbHeader.vue";
import IGDbFooter from "@/components/utility/IGDbFooter.vue";

export default {
  name: "SettingsPage",
  components: {IGDbFooter, IGDbHeader}
}
</script>

<style scoped>
main{
  background-color: var(--color-white-background);
  width: 50%;
  color: var(--color-text-black);
  height: 100vh;
  margin: auto;
}
</style>