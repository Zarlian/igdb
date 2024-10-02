<template>
  <div class="flex-container">
    <div class="poster-image">
      <img :src="game.cover" :alt="game.title" />
    </div>
    <div class="game-info">
      <div>
      <p>{{counter}}.</p>
      <h3>{{ game.title }}</h3>
      <p class="release-info">2024 1h 56m PG-13</p>
      <Rating :game="game"  rated="" text="Rate" backGroundColor="white"/>
      </div>
      <div class="icon-container">
        <router-link :to="'/title/' + game.id"><Icon  icon="material-symbols:info-outline"  width="1.5rem" icon-color="#0e63be" /></router-link>
        <Icon icon="material-symbols:delete" width="1.5rem" height="1.5rem"  style="color: #6d6d6d" @click="handleDeleteFromList"/>
      </div>

    </div>
  </div>
</template>

<script>
import Rating from "@/components/utility/Rating.vue";
import {Icon} from "@iconify/vue";
import Button from "@/components/utility/Button.vue";

export default {
  emits: ['deleteFromList'],
  name: "GameListCard",
  components: {Button, Icon, Rating},
  props: {
    counter: { type: Number },
    game: { type: Object, required: true}
  },
  methods: {
    handleDeleteFromList(){
      this.$emit('deleteFromList', this.game.id);
    },
  }
};
</script>

<style scoped>
.flex-container{
  display: flex;
  align-items: center;
  height: 6.5rem;
}

.poster-image{
  height: 100%;
  width: 4.5rem;
  margin-right: 1rem;
}
img{
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.game-info{
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: 83%;
}

.game-info p:first-of-type, .game-info h3{
  display: inline-block;
  font-weight: bold;
  padding-right: 0.5rem;
  margin-bottom: 0.5rem;
}

.game-info .icon-container svg{
  border-radius: 50px;
  padding: 0.5rem;
}

.game-info .icon-container svg:hover{
  background-color: #b4b4b4;
  cursor: pointer;
}

.game-info .icon-container{
  display: flex;
  align-items: center;
  gap: 1rem;
}

.release-info{
  color: #a3a3a3;
}
</style>