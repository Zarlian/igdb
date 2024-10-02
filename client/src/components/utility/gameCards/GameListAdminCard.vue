<template>
  <div class="flex-container">
    <div class="poster-image">
      <img :src="game.cover" :alt="game.title" />
    </div>
    <div class="game-info">
      <div>
        <h3>{{ game.title }}</h3>
        <p class="release-info">Released on: {{game.release_date}}</p>
        <p>{{game.short_description}}</p>
        <p>Made by: {{game.developer}}</p>
      </div>

      <div class="icon-container">
        <div class="featured">
          <p>Featured:</p>
          <Icon v-if="game.featured" icon="ic:round-check" width="1.5rem" height="1.5rem"  style="color: #7fb035" @click="handleToggleFeatured"/>
          <Icon v-else icon="ic:round-close" width="1.5rem" height="1.5rem"  style="color: #c04c4c" @click="handleToggleFeatured"/>
        </div>

        <Icon icon="ic:baseline-edit" width="1.5rem" height="1.5rem"  style="color: #6d6d6d" @click="handleEditGame"/>
        <Icon icon="material-symbols:delete" width="1.5rem" height="1.5rem"  style="color: #6d6d6d" @click="handleDeleteGame"/>
      </div>

    </div>
  </div>
</template>

<script>
import Rating from "@/components/utility/Rating.vue";
import {Icon} from "@iconify/vue";
import Button from "@/components/utility/Button.vue";

export default {
  name: "GameListAdminCard",
  emist: ['editGame', 'toggleFeatured', 'deleteGame'],
  components: {Button, Icon, Rating},
  props: {
    // counter: { type: Number, required: true },
    game: { type: Object, required: true}
  },
  methods: {
    handleToggleFeatured(){
      this.$emit('toggleFeatured', this.game);
    },
    handleDeleteGame(){
      this.$emit('deleteGame', this.game.id);
    },
    handleEditGame() {
      this.$emit('editGame', this.game.id);
    }
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
  width: 95%;
}

.game-info p:first-of-type, .game-info h3{
  display: inline-block;
  font-weight: bold;
  padding-right: 0.5rem;
  margin-bottom: 0.5rem;
}

.game-info .icon-container{
  display: flex;
  align-items: center;
  gap: 1rem;
}

.featured{
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.2rem;
}

.game-info .featured p{
  padding: 0;
  margin: 0;
}

.release-info{
  color: #a3a3a3;
}

.game-info .icon-container svg{
  border-radius: 50px;
  padding: 0.5rem;
}

.game-info .icon-container svg:hover{
  background-color: #b4b4b4;
  cursor: pointer;
}
</style>