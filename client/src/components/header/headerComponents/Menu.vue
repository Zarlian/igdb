<template>
    <Button :text="text" :icon="buttonIcon" icon-position="before" iconSize="1.5em"></Button>

</template>

<script>
import Button from "@/components/utility/Button.vue";

export default {
  name: 'Menu',
  components: {
    Button,
  },
  props: {
    text: {
      type: String,
    }
  },
  data() {
    return {
      buttonIcon: "ci:hamburger-md"
    };
  }

};
</script>

<style scoped>

</style>
