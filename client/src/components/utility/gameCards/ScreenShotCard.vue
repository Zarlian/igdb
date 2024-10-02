<template>
  <div class="trailer-card">
    <img id="screenshot" :src="screenshotUrl" :alt="screenshotUrl" title="trailer">
    <router-link :to="'/trailer/' + id + '/' + index">Watch the trailer</router-link>
  </div>
</template>

<script>
export default {
  name: "ScreenShotCard",
  props: {
    screenshotUrl: {
      type: String, required: true},
    id: {
      type: Number, required: true
    },
    index: {
      type: Number, required: true
    }
  }

}
</script>

<style scoped>
#screenshot{
  width: 100%;
  height: 15rem;
  background-color: var(--color-accent-yellow);
  color: #fff;
  object-fit: cover;
}
</style>