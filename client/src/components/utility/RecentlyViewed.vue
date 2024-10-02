<template>
  <div class="recently-viewed-container">
    <div class="recently-viewed-title">
    <h1>Recently Viewed</h1>
    <p @click="clearResentActivity">Clear your history</p>
    </div>
    <div class="image-container" v-if="recentlyViewed">
      <img
          v-for="game in recentlyViewed"
          :src="game.cover"
          :title="game.title"
          :alt="game.title"
          :key="game.id"
      />
    </div>
  </div>
</template>

<script>
import {useRecentActivityStore} from "@/scripts/stores/recentActivity.js";

export default {
  name: "RecentlyViewed",
  data() {
    return {
      recentlyViewed: [],
    };
  },
  mounted() {
    this.recentlyViewed = useRecentActivityStore().games;
  },
  methods: {
    clearResentActivity() {
      useRecentActivityStore().clearActivity();
      this.recentlyViewed = [];
    }
  }
};
</script>

<style scoped>
.recently-viewed-container {
  display: flex;
  flex-direction: column;
  box-sizing: border-box;
  background-color: #ededec;
  padding: 1rem 1rem 1.5rem 1rem;
  height: 10.5rem;
  width: 50%;
  margin: auto;

}

h1 {
  font-size: 1.25rem;
  color: #666666;
  font-weight: bold;
}

.image-container {
  display: flex;
  justify-content: flex-start;
  align-items: center;
  gap: 1rem;

  flex-grow: 1;
}

.recently-viewed-title {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 0.5rem;
}

.recently-viewed-title p {
  color: var(--color-text-blue);
  font-size: 0.75rem;
  cursor: pointer;
}

img {
  height: 100%;
  width: 4.25rem;
  object-fit: cover;
  box-shadow: 0 0 29px -9px rgba(120,120,120,0.75);
}
</style>
