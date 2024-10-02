<template>
  <AutoCarousel :gameData="gameData"/>
</template>

<script>
import AutoCarousel from "@/components/utility/AutoCarousel.vue";

export default {
  name: "HeadLiners",
  components: {AutoCarousel},
  props: {
    gameData: {
      type: Array,required: true
    },
  },
}
</script>

<style scoped>

</style>