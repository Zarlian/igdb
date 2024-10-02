<template>
  <div class="trailer-card">
    <iframe id="trailer" :src="trailerUrl" title="trailer"></iframe>
    <router-link :to="'/trailer/' + id + '/' + index">Watch the trailer</router-link>
  </div>
</template>

<script>
export default {
  name: "TrailerCard",
  props: {
    trailerUrl: {
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
iframe{
  width: 100%;
  height: 15rem;
  background-color: var(--color-accent-yellow);
  color: #fff;

}
</style>