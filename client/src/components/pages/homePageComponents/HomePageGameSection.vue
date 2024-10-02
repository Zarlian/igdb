<template>
  <section class="feature-container">
    <h2>
      <router-link
          @mouseover="changeIconColor"
          @mouseleave="resetIconColor"
          :to="{ path: '/what-to-play', query: { section: sectionName } }">
        {{ title }}
        <Icon icon="mingcute:right-fill" :color="iconColor" width="2.25rem" height="2rem"/>
      </router-link>

    </h2>
    <p v-if="description" class="description">{{ description }}</p>
    <Carousel
        :gameData="gameData"
        :section-name="sectionName"
        :userGameList="userGameList"
        @addToGameList="handleAddToGameList"
        @removeFromGameList="handleRemoveFromGameList"
    />
  </section>
</template>

<script>
import GameCard from "@/components/utility/gameCards/GameCard.vue";
import Carousel from "@/components/utility/Carousel.vue";
import {Icon} from "@iconify/vue";
export default {
  emits: ['addToGameList', 'removeFromGameList'],
  name: "HomePageGameSection",
  components: {Icon, GameCard, Carousel},
  props: {
    title: { type: String, required: true },
    gameData: { type: Array, required: true },
    description: { type: String },
    sectionName: { type: String, required: true },
    userGameList: { type: Array , default: () => []}
  },
  data() {
    return {
      icon: "",
      iconColor: "white",
    };
  },
  methods: {
    changeIconColor() {
      this.iconColor = '#f5c518';
    },
    resetIconColor() {
      this.iconColor = 'white';
    },
    handleAddToGameList(userId, gameId){

      this.$emit('addToGameList', userId,gameId);
    },
    handleRemoveFromGameList(userId, gameId){
      this.$emit('removeFromGameList', userId, gameId);
    }
  }
}
</script>

<style scoped>
section {
  color: white;
}

h2 {
  border-left: solid 3px #f5c518;
  line-height: 2rem;
  font-size: 1.75rem;
  padding-left: 0.5rem;
  margin: 1rem 0;
  cursor: pointer;
}

a {
  color: white;
  text-decoration: none;
  display: flex;
  align-items: center;
}
p {
  margin-bottom: 1.5rem;
}
</style>
