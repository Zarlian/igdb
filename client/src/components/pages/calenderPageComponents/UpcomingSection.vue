<template>
  <section v-for="(monthData, monthKey) in newReleases" :key="monthKey">
    <h2>{{ monthKey }} (2024)</h2>
    <div class="upcoming-container">
      <div v-for="game in monthData" :key="game.id" class="upcoming-content">
        <div class="image-text-container">
          <img :src="game.imageUrl" :alt="game.title">
          <div class="text-container">
            <h3>{{ game.title }} (2024)</h3>
            <p>Action Rpg</p>
            <p>Game company name</p>
          </div>
        </div>
        <Icon icon="bi:bookmark-plus" style="color: grey" width="2.5rem" height="2.5rem"/>
      </div>
    </div>
  </section>
</template>

<script>
import {Icon} from "@iconify/vue";

export default {
  name: "UpcomingSection",
  components: {Icon},
  props: {
    newReleases: {type: Object, required: true}
  }
}
</script>

<style scoped>

h2 {
  font-size: 1.5rem;
  margin-bottom: 1rem;
  font-weight: bold;
}

h3 {
  font-weight: bold;
  margin-bottom: 0.25rem;
}

p {
  color: #757575;
  font-size: 0.95rem;
  margin-bottom: 0.25rem;
}

section {
  margin-bottom: 2rem;
}

.upcoming-container {
  border: solid 1px #c9c9c9;
  border-radius: 4px;
  padding: 0.75rem;
}

.image-text-container{
  display: flex;
  justify-content: flex-start;
  align-items: center;
  gap: 0.5rem;
}

.upcoming-content {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 0.5rem;
  border-bottom: solid 1px #c9c9c9;
  padding: 0.2rem 0rem;
}

.upcoming-content:last-of-type {
  border-bottom: none;
}

img {
  width: 3rem;
  height: 4.5rem;
  object-fit: cover;
}
</style>