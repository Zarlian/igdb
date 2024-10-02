<template>
  <div class="carousel-button-container">
    <div class="auto-carousel-container">

      <div v-for="(game, index) in gameData" :class="['auto-carousel-item', `item-${index}`]">
        <img :src="game.imageUrl" :alt="game.title">
      </div>

      <div class="carousel-button" id="moveLeftBtn" @click="moveGrid('left')">
        <Icon class="iconify-icon" icon="mingcute:left-fill" color="white" width="2.25rem" height="2.25rem"/>
      </div>
      <div class="carousel-button" id="moveRightBtn" @click="moveGrid('right')">
        <Icon class="iconify-icon" icon="mingcute:right-fill" color="white" width="2.25rem" height="2.25rem"/>
      </div>

    </div>
  </div>

</template>

<script>

import GameCard from "@/components/utility/gameCards/GameCard.vue";
import {Icon} from "@iconify/vue";

export default {
  name: "AutoCarousel",
  props: {
    gameData: {type: Array, required: true}
  },
  components: {Icon, GameCard},
  methods: {
    moveGrid(direction) {
      // Move items left
      if (direction === 'left') {
        const poppedItem = this.gameData.pop();
        this.gameData.unshift(poppedItem);
      } else if (direction === 'right') {
        // Move items right
        const shiftedItem = this.gameData.shift();
        this.gameData.push(shiftedItem);
      }
    },

    startAutoMove() {

      // Start automatic movement every 3 seconds
      this.intervalId = setInterval(() => {
        this.moveGrid("right"); // Change direction as needed
      }, 3000);
    },
    stopAutoMove() {
      // Stop automatic movement
      clearInterval(this.intervalId);
    }
  },
  mounted() {
    this.startAutoMove();
  },
  beforeDestroy() {
    this.stopAutoMove();
  }
};


</script>

<style scoped>
.item-0 {
  position: relative;
  grid-area: one;
}

.item-1 {
  grid-area: two;
}

.item-2 {
  grid-area: three;
}

.item-3 {
  grid-area: four;
}

.auto-carousel-container {
  height: 36rem;
  width: 100%;
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  grid-template-rows: auto;
  grid-template-areas:
  'one one one two'
  'one one one three'
  'one one one four';
  gap: 2rem;
  overflow: hidden;
}

img {
  width: 100%;
  height: 100%;
  object-fit: cover;
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

.carousel-button-container {
  position: relative;
  height: 28rem;
  width: 100%;
}

.carousel-button:hover .iconify-icon {
  color: yellow; /* does not work yet */
}

#moveLeftBtn {
  left: -1.5rem;
}

#moveRightBtn {
  right: -1.5rem;
}

</style>
