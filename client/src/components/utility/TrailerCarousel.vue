<template>
  <div class="carousel-button-container">
    <div :class="[sectionName, 'carousel-container']" :style="{ gridTemplateColumns: gridColumns }">


      <div v-if="isScreenShot" v-for="(screenshotUrl, index) in screenshots" class="carousel-item">
        <ScreenShotCard
            :screenshotUrl="screenshotUrl"
            :id="gameData.id"
            :index="index"
        />
      </div>

      <div v-else v-for="(trailerUrl, index) in trailers" class="carousel-item">
        <TrailerCard
            :trailerUrl="trailerUrl"
            :id="gameData.id"
            :index="index"
        />
      </div>
    </div>
    <div v-if="gameData.trailers.length > itemsPerSlide" class="carousel-button" id="moveLeftBtn" @click="moveGrid('left')">
      <Icon class="iconify-icon" icon="mingcute:left-fill" color="white" width="2.25rem" height="2.25rem"/>
    </div>
    <div v-if="gameData.trailers.length > itemsPerSlide" class="carousel-button" id="moveRightBtn" @click="moveGrid('right')">
      <Icon class="iconify-icon" icon="mingcute:right-fill" color="white" width="2.25rem" height="2.25rem"/>
    </div>
  </div>
</template>

<script>
import { Icon } from "@iconify/vue";
import TrailerCard from "@/components/utility/gameCards/TrailerCard.vue";
import ScreenShotCard from "@/components/utility/gameCards/ScreenShotCard.vue";

export default {
  name: "TrailerCarousel",
  props: {
    isScreenShot: {type: Boolean, default: false},
    gameData: { type: Array, required: true },
    sectionName: { type: String, required: true },
    itemsPerSlide: { type: Number, default: 2 },
  },
  components: {ScreenShotCard, TrailerCard, Icon },
  computed: {
    gridColumns() {
      return `repeat(${this.itemsPerSlide}, 1fr)`;
    }
  },
  data() {
    return {
      trailers: [],
      screenshots: []
      }
  },
  mounted() {
    this.trailers = this.gameData.trailers.slice();
    this.screenshots = this.gameData.screenshots.slice();
  },
  methods: {
    moveGrid(direction) {
      if (direction === "left") {
        // Move items left
        const poppedItem = this.trailers.pop();
        this.trailers.unshift(poppedItem);
      } else if (direction === "right") {
        // Move items right
        const shiftedItem = this.trailers.shift();
        this.trailers.push(shiftedItem);
      }
    }
  }
};
</script>

<style scoped>
.carousel-button-container {
  position: relative;
  height: 17rem;
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
  border: solid 1px var(--color-white-background);
  border-radius: 4px;
  height: 4rem;
  width: 3rem;
  position: absolute;
  top: 35%;
  transform: translateY(-50%);
  cursor: pointer;

  background-color: rgba(45, 52, 52, 0.26);
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
