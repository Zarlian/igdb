<template>
  <section class="feature-container">
    <h2><router-link :to="{ path: '/what-to-play', query: { section: sectionName } }">Your GameList<Icon icon="mingcute:right-fill" color="white" width="2.25rem" height="2rem"/></router-link></h2>
    <div class="empty-container">
      <Icon class="bookmark" icon="circum:bookmark-plus" width="3rem" height="3rem"/>
      <p>Sign in to acces your Gamelist</p>
      <p>Save games to keep track of what you want to play</p>
      <router-link to="/registration"><Button text="Sign in to IGDb" background-color="#121212" color="#5799ef" /></router-link>
    </div>
  </section>
</template>

<script>
import GameCard from "@/components/utility/gameCards/GameCard.vue";
import Carousel from "@/components/utility/Carousel.vue";
import {Icon} from "@iconify/vue";
import Button from "@/components/utility/Button.vue";
export default {
  name: "EmptySection",
  components: {Button, Icon, GameCard, Carousel},
  props: {
    title: { type: String, required: true },
    sectionName : "from-your-watchlist"
  },
  data(){
    return {
      sectionName : "from-your-watchlist"
    }
  }
}
</script>

<style scoped>
section{
  color: white;
}

h2{
  border-left: solid 3px #f5c518;
  line-height: 2rem;
  font-size: 1.75rem;
  padding-left: 0.5rem;
  margin: 1rem 0;
  cursor: pointer;


}

a{
  color: white;
  text-decoration: none;
  display: flex;
  align-items: center;
}

.empty-container p {
  margin-bottom: 1.5rem;
}

.empty-container svg {
  margin-bottom: 1.5rem;
}

.empty-container {
  width: 100%;

  padding: 2rem;

  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

</style>