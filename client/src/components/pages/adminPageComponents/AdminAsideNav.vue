<template>
  <aside class="sidebar">
    <LogoButton class="logo-button"/>
    <ul>
      <li @click="handleClick('games')">Games</li>
      <li @click="handleClick('users')">Users</li>
      <li @click="handleClick('developers')">Developers</li>
      <li @click="handleClick('genres')">Genres</li>
      <li @click="handleClick('platforms')">Platforms</li>
      <li @click="handleClick('reviews')">Reviews</li>
    </ul>
  </aside>
</template>

<script>
import LogoButton from "@/components/header/headerComponents/LogoButton.vue";

export default {
  name: "AdminAsideNav",
  components: {LogoButton},
  methods: {
    handleClick(subtype) {
      this.$emit('handleClick', subtype);
    }
  }
}
</script>

<style scoped>
.sidebar {
  width: 15%;
  background-color: #333;
  color: var(--color-text-white);
  font-size: 1.25rem;
  padding: 1.5rem;

  display: flex;
  flex-direction: column;
  align-items: center;
}

.logo-button {
  margin-bottom: 2rem;
}

.sidebar ul {
  list-style: none;
  width: 100%;
}

.sidebar li {
  padding: 10px;
  cursor: pointer;
  background-color: grey;
  border-radius: 10px ;
  margin: 0.35rem auto;

}

.sidebar li:hover {
  background-color: #555;
}
</style>