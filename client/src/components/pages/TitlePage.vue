<template>
  <header>
    <IGDbHeader @languageSelected="handleLanguageSelected"/>
  </header>
  <main v-if="gameData" :style="{ background: `#1f1f1f url(${gameData.cover}) no-repeat   center` }">
    <div class="background-cover">
      <div class="content-container">
        <div class="title-container">
          <div>
            <h1>{{ this.gameData.title }}</h1>
            <p>{{ this.gameData.release_date }} - {{ this.gameData.esrb_rating }} </p>
          </div>

          <Rating :game="gameData" text="Rate" backGroundColor="#1a1a1a"/>
        </div>
        <div class="image-container">
          <img :src="this.gameData.cover" alt="" class="cover-image">
          <div v-if="this.gameData.trailers.length > 0" class="trailer-container">
            <iframe id="trailer" :src="this.gameData.trailers[0]" title="trailer"></iframe>
          </div>

          <div v-else class="trailer-container">
            <p>No trailers available</p>
          </div>


          <router-link :to="'/screenshots-gallery/' + gameData.id" id="images">
            <div >
              <div>
                <Icon icon="material-symbols-light:photo-library" style="color: white" width="2rem"/>
                <p>{{ this.gameData.screenshots.length }} PHOTOS</p>
              </div>
            </div>
          </router-link>

          <router-link :to="'/trailer-gallery/' + gameData.id" id="trailers">
            <div >
              <div>
                <Icon icon="material-symbols:video-library" style="color: white" width="2rem"/>
                <p>{{ this.gameData.trailers.length }} TRAILERS</p>
              </div>

            </div>
          </router-link>
        </div>

        <div class="game-details" v-if="titlePageText">

          <div>
            <div class="button-container">
              <Button v-for="genre in this.gameData.genres" :key="genre" :text="genre" background-color="none"
                      color="white" border-radius="0"/>
            </div>


            <div class="text-container">
              <p>{{ this.gameData.long_description }}</p>
              <p>{{ this.titlePageText.developer }}: {{ this.gameData.developer }}</p>
            </div>
          </div>
          <section>
            <h2>{{ this.titlePageText.platform }}</h2>
            <div class="icon-container">
              <Icon v-if="gameData.platforms.includes(ConsoleTypes.PC)" class="game-station-icon"
                    icon="iconoir:pc-check" width="2rem"/>
              <Icon v-if="gameData.platforms.includes(ConsoleTypes.PlayStation)" class="game-station-icon"
                    icon="ion:logo-playstation" width="2rem"/>
              <Icon v-if="gameData.platforms.includes(ConsoleTypes.Xbox)" class="game-station-icon" icon="ion:logo-xbox"
                    width="2rem"/>
            </div>

            <div class="add-to-gamelist">
              <div>
                <Icon icon="ic:baseline-plus" style="color: black"/>
                <p>{{ titlePageText.add_to_gamelist }}</p>
              </div>

              <Icon icon="mingcute:down-fill" style="color: black"/>
            </div>

          </section>
        </div>
      </div>
    </div>
    <TitlePageInformationPanel :game-data="gameData"/>
  </main>
  <IGDbFooter/>
</template>

<script>
import IGDbHeader from "@/components/header/IGDbHeader.vue";
import Rating from "@/components/utility/Rating.vue";
import {Icon} from "@iconify/vue";
import Button from "@/components/utility/Button.vue";
import titlePageText from "@/assets/data/titlePage.json";
import {ConsoleTypes} from "@/scripts/util/enums.js";
import TrailerCarousel from "@/components/utility/TrailerCarousel.vue";
import IGDbFooter from "@/components/utility/IGDbFooter.vue";
import TitlePageInformationPanel from "@/components/pages/titlePageComponents/TitlePageInformationPanel.vue";
import GameService from "@/scripts/services/gameService.js";


export default {
  name: "TitlePage",
  components: {TitlePageInformationPanel, IGDbFooter, TrailerCarousel, Button, Icon, Rating, IGDbHeader},
  data() {
    return {
      gameData: null,
      titlePageText: {},
      gameService : new GameService()
    };
  },
  computed: {
    ConsoleTypes() {
      return ConsoleTypes
    },
    gameId() {
      return this.$route.params.id;
    }
  },
  async mounted() {
    const languageFromStorage = localStorage.getItem("selectedLanguage") || 'en';
    this.titlePageText = titlePageText[languageFromStorage];

    this.gameData = await this.gameService.getGame(this.gameId, languageFromStorage)

  },
  methods: {
    async handleLanguageSelected(selectedLanguage) {
      this.titlePageText = titlePageText[selectedLanguage];

      this.gameData = await this.gameService.getGame(this.gameId, selectedLanguage);

    },

  },
}
</script>

<style scoped>
header {
  background-color: #121212;
  margin-bottom: 3rem;
}

main {
}

.background-cover {
  background-color: rgba(18, 18, 18, 0.95);
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
}


.content-container {
  padding-top: 2rem;
  width: 50%;
  margin: auto;
  display: flex;
  flex-direction: column;
}

.title-container {
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 1rem;
}

h1 {
  font-size: 2.75rem;
  margin-bottom: 1rem;
}

p {
  margin-bottom: 0.5rem;
}

img {
  object-fit: cover;
  grid-area: one;
  height: 100%;
  width: 100%;
}

.trailer-container {
  grid-area: two;
  height: 100%;
  width: 100%;
}

iframe {
  height: 100%;
  width: 100%;
}

#images {
  grid-area: three;
}

#trailers {
  grid-area: four;
}

.image-container {
  height: 27rem;
  display: grid;
  gap: 0.5rem;
  width: 100%;
  grid-template-columns: repeat(5, 1fr);
  grid-template-rows: auto;
  grid-template-areas:
  'one two two two four'
  'one two two two three';
  margin-bottom: 1rem;
}

#images, #trailers {
  background-color: #595959;
  height: 100%;
  width: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  cursor: pointer;
  color: white;
  text-decoration: none;

}
#images:hover, #trailers:hover {
  background-color: #737373;
  transition: background-color 0.5s;
}

#images div, #trailers div {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
  align-items: center;
}

.button-container {
  display: flex;
  gap: 0.5rem;
  margin-bottom: 1rem;
}


.game-details {
  display: flex;
  justify-content: space-between;
  margin-bottom: 1.5rem;
}

.game-details div {
  width: 85%;
}

.game-details .text-container {
  width: 100%;
}

.game-details p {
  border-bottom: 1px solid #595959;
  padding: 0.5rem;
  line-height: 1.2rem;
}

.game-details section {
  width: 30%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

.game-details section h2 {
  margin-bottom: 1rem;
  text-align: center;
}

.game-details section .icon-container {
  display: flex;
  gap: 0.75rem;
  justify-content: center;
  margin-bottom: 1rem;
}


.game-details section svg {
  margin: 0.5rem;
}

.add-to-gamelist {
  width: 15rem;
  background-color: #f5c518;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 0.5rem;
  margin-top: 1rem;
  cursor: pointer;
  color: #1a1a1a;
  padding: 0;
  border-radius: 4px;
}

.add-to-gamelist div:first-of-type {
  display: flex;
  gap: 0.5rem;
  align-items: center;
  border-right: #1a1a1a 1px solid;
}

.add-to-gamelist p {
  border: none;
  margin: 0;
}
</style>
