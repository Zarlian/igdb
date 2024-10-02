<template>
  <IGDbHeader/>
  <main>
    <h3>not implemented yet</h3>
  </main>
  <IGDbFooter/>
</template>


<script>
import IGDbFooter from "@/components/utility/IGDbFooter.vue";
import IGDbHeader from "@/components/header/IGDbHeader.vue";

export default {
  name: "TrailerGalleryPage",
  components: {IGDbHeader, IGDbFooter}
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