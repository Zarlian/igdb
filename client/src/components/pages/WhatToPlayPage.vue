<template>
  <div class="what-to-play-page">
    <header>
      <IGDbHeader @languageSelected="handleLanguageSelected"/>
    </header>
    <main>
      <h2>{{ whatToPlayText.title }}</h2>
      <nav v-if="whatToPlayText.nav">
        <Button @click="handleClick('featured')" ref="featured" :text="whatToPlayText.nav.guide" background-color="black" border-radius="0"/>
        <Button @click="handleClick('favorites')" ref="favorites" :text="whatToPlayText.nav.favorites" background-color="black" border-radius="0"/>
        <Button @click="handleClick('top')" ref="top" :text="whatToPlayText.nav.top" background-color="black" border-radius="0" />
        <Button @click="handleClick('from-your-watchlist')" ref="from-your-watchlist" :text="whatToPlayText.nav.watchlist" background-color="black" border-radius="0"/>
        <Button @click="handleClick('popular')" ref="popular" :text="whatToPlayText.nav.popular" background-color="black" border-radius="0"/>
      </nav>

      <div class="grid-container">
        <WhatToPlayContainer
            :gameCards="gameCards"
            :userGameList="userGameList"
            @addToGameList="handleAddToGameList"
            @removeFromGameList="handleRemoveFromGameList"
        />
      </div>

      <div class="empty-container" v-if="gameCards.length === 0">
        <Icon class="bookmark" icon="circum:bookmark-plus" width="3rem" height="3rem"/>
        <p>Sign in to acces your Gamelist</p>
        <p>Save games to keep track of what you want to play</p>
        <router-link to="/registration"><Button text="Sign in to IGDb" background-color="#121212" color="#5799ef" /></router-link>
      </div>
    </main>
    <IGDbFooter/>
  </div>
</template>

<script>
import IGDbHeader from "@/components/header/IGDbHeader.vue";
import Button from "@/components/utility/Button.vue";
import WhatToPlayContainer from "@/components/pages/whatToPlayComponents/WhatToPlayContainer.vue";
import GameCard from "@/components/utility/gameCards/GameCard.vue";
import { useLoggedInUserStore } from "@/scripts/stores/loggedInUser.js";
import whatToPlayText from "@/assets/data/whatToPlay.json";
import IGDbFooter from "@/components/utility/IGDbFooter.vue";
import UserService from "@/scripts/services/userService.js";
import {Icon} from "@iconify/vue";
import GameService from "@/scripts/services/gameService.js";

export default {
  name: "WhatToPlayPage",
  components: {Icon, IGDbFooter, WhatToPlayContainer, Button, IGDbHeader, GameCard },
  data() {
    return {
      gameCards: [],
      whatToPlayText: {},
      user: useLoggedInUserStore().user,
      userGameList: [],
      currentSelected: '',
      selectedButton: null,
      userService : new UserService(),
      gameService : new GameService()
    }
  },
  async mounted() {
    if (this.user !== null) {
      await this.getUserGameList();
    }
    const languageFromStorage = localStorage.getItem("selectedLanguage") || 'en';
    this.whatToPlayText = whatToPlayText[languageFromStorage];

    const section = this.$route.query.section || 'featured';

    await this.fetchData(section);
  },
  watch: {
    '$route.query.section'(newSection) {
      this.handleClick(newSection);
    }
  },
  methods: {
    async getUserGameList() {
      this.userGameList = await this.userService.getUserGameList(this.user.id);
    },
    handleLanguageSelected(selectedLanguage) {
      this.whatToPlayText = whatToPlayText[selectedLanguage];
    },
    handleClick(tag) {
      this.currentSelected = tag;
      this.addBorderToSelectedButton(tag);
      this.fetchData(tag);
    },
    addBorderToSelectedButton(tag) {
      if (this.selectedButton) {
        this.selectedButton.$el.style.border = 'none';
      }
      const selectedButton = this.$refs[tag];
      if (selectedButton) {
        selectedButton.$el.style.borderBottom = 'solid 2px #f5c518';
        this.selectedButton = selectedButton;
      }
    },
    async handleAddToGameList(userId, gameId) {
      await this.userService.addToGameList(userId, gameId);
      await this.getUserGameList();
      await this.fetchData(this.currentSelected);
    },
    async handleRemoveFromGameList(userId, gameId) {
      await this.userService.removeFromGameList(userId, gameId);
      await this.getUserGameList();
      await this.fetchData(this.currentSelected);
    },
    async fetchData(tag) {
      switch (tag) {
        case 'favorites':
          this.gameCards = await this.gameService.getFavoriteGames();
          break;
        case 'top':
          this.gameCards = await this.gameService.getTopRatedGames();
          break;
        case 'featured':
          this.gameCards = await this.gameService.getFeaturedGames();
          break;
        case 'from-your-watchlist':
          this.gameCards = []
          this.gameCards = await this.userService.getUserGameList(this.user.id);
          break;
        case 'popular':
          this.gameCards = await this.gameService.getPopularGames();
          break;
      }
    }
  }
}
</script>

<style scoped>
.what-to-play-page {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}

header {
  background-color: #121212;
  margin-bottom: 3rem;
}

main {
  background-color: var(--color-black-background);
  color: var(--color-text-white);
  width: 50%;
  margin: auto;
  flex: 1;
}

h2 {
  font-size: 3rem;
  margin-bottom: 2.5rem;
}

nav {
  display: flex;
  margin-bottom: 1.5rem;
}

.grid-container {
  display: grid;
  grid-template-columns: repeat(6, 1fr);
  grid-gap: 1rem;
}

.empty-container {
  width: 100%;
  height: 100%;
  padding: 2rem;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
}

.empty-container p {
  margin-bottom: 1.5rem;
}

.empty-container svg {
  margin-bottom: 1.5rem;
}

a {
  text-decoration: none;
}
</style>
