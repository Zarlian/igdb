<template>
  <div class="carousel-button-container">
    <div :class="[sectionName, 'carousel-container']" :style="{ gridTemplateColumns: gridColumns }">
      <div v-for="game in gameData" class="carousel-item">
        <GameCard
            :game="game"
            @addToGameList="handleAddToGameList"
            @removeFromGameList="handleRemoveFromGameList"
            :userGameList="userGameList"
        />
      </div>
    </div>
    <div v-if="gameData.length > itemsPerSlide" class="carousel-button" id="moveLeftBtn" @click="moveGrid('left')">
      <Icon class="iconify-icon" icon="mingcute:left-fill" color="white" width="2.25rem" height="2.25rem"/>
    </div>
    <div v-if="gameData.length > itemsPerSlide" class="carousel-button" id="moveRightBtn" @click="moveGrid('right')">
      <Icon class="iconify-icon" icon="mingcute:right-fill" color="white" width="2.25rem" height="2.25rem"/>
    </div>
  </div>
</template>

<script>
import GameCard from "@/components/utility/gameCards/GameCard.vue";
import { Icon } from "@iconify/vue";

export default {
  emits: ['addToGameList', 'removeFromGameList'],
  name: "Carousel",
  props: {
    gameData: { type: Array, required: true },
    sectionName: { type: String, required: true },
    itemsPerSlide: { type: Number, default: 6 },
    userGameList: {type : Array, default: () => []}
  },
  components: { Icon, GameCard },
  computed: {
    gridColumns() {
      return `repeat(${this.itemsPerSlide}, 1fr)`;
    }
  },

  methods: {
    moveGrid(direction) {
      if (direction === "left") {
        // Move items left
        const poppedItem = this.gameData.pop();
        this.gameData.unshift(poppedItem);
      } else if (direction === "right") {
        // Move items right
        const shiftedItem = this.gameData.shift();
        this.gameData.push(shiftedItem);
      }
    },
    handleAddToGameList(userId, gameId){
      this.$emit('addToGameList', userId,gameId);
    },
    handleRemoveFromGameList(userId, gameId){
      this.$emit('removeFromGameList', userId, gameId);
    }
  }
};
</script>

<style scoped>
.carousel-button-container {
  position: relative;
  height: 28rem;
  width: 100%;
}

.carousel-container {
  display: grid;
  gap: 2rem;
  height: 100%;
  width: 100%;
  overflow: hidden;
}

.carousel-button {
  display: flex;
  justify-content: center;
  align-items: center;
  border: solid 1px white;
  border-radius: 4px;
  height: 4rem;
  width: 3rem;
  position: absolute;
  top: 35%;
  transform: translateY(-50%);
  cursor: pointer;
}

.carousel-button:hover .iconify-icon {
  color: yellow;
}

#moveLeftBtn {
  left: -1.5rem;
}

#moveRightBtn {
  right: -1.5rem;
}
</style>
