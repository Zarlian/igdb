<template>
  <header>
    <IGDbHeader @languageSelected="handleLanguageSelected" />
  </header>

  <main v-if="homepageText.titles">

    <HeadLiners :gameData="headlinerData" class="headliner"/>
    <HomePageGameSection
        :title="homepageText.titles.top"
        :gameData="topTenData"
        :userGameList="gamelistData"
        sectionName="top"
        @addToGameList="handleAddToGameList"
        @removeFromGameList="handleRemoveFromGameList"
    />
    <HomePageGameSection
        :title="homepageText.titles.favorite"
        :gameData="favoriteData"
        :userGameList="gamelistData"
        sectionName="favorites"
        @addToGameList="handleAddToGameList"
        @removeFromGameList="handleRemoveFromGameList"
    />

    <EmptySection v-if="user === null"
          title="From your Gamelist"
    />

    <HomePageGameSection
          title="From your Gamelist"
          section-name="gamelist"
          :userGameList="gamelistData"
          :game-data="gamelistData" v-else
          @addToGameList="handleAddToGameList"
          @removeFromGameList="handleRemoveFromGameList"
    />

    <HomePageGameSection
        :title="homepageText.titles.featured"
        :gameData="featuredData"
        :userGameList="gamelistData"
        sectionName="featured"
        @addToGameList="handleAddToGameList"
        @removeFromGameList="handleRemoveFromGameList"
    />

    <HomePageGameSection
        title="Recently Viewed"
        section-name="recently-viewed"
        :game-data="recentActivity"
        :userGameList="gamelistData"
        @addToGameList="handleAddToGameList"
        @removeFromGameList="handleRemoveFromGameList"
    />
  </main>
  <IGDbFooter />
</template>

<script>
import HeadLiners from "@/components/pages/homePageComponents/HeadLiners.vue";
import HomePageGameSection from "@/components/pages/homePageComponents/HomePageGameSection.vue";
import GameCard from "@/components/utility/gameCards/GameCard.vue";
import IGDbHeader from "@/components/header/IGDbHeader.vue";
import data from "@/assets/data/data.json"
import homepageText from "@/assets/data/homePage.json";
import {useLoggedInUserStore} from "@/scripts/stores/loggedInUser.js";
import EmptySection from "@/components/pages/homePageComponents/EmptySection.vue";
import IGDbFooter from "@/components/utility/IGDbFooter.vue";
import {useRecentActivityStore} from "@/scripts/stores/recentActivity.js";
import UserService from "@/scripts/services/userService.js";
import GameService from "@/scripts/services/gameService.js";
export default {
  name: "HomePage",
  components: {IGDbFooter, EmptySection, IGDbHeader, GameCard, HomePageGameSection, HeadLiners},
  data() {
    return {
      headlinerData: [],
      topTenData: [],
      favoriteData: [],
      featuredData: [],
      homepageText: {},
      gamelistData: [],

      user: useLoggedInUserStore().user,
      recentActivity : useRecentActivityStore().games,
      userService : new UserService(),
      gameService : new GameService()
    }
  },
  async mounted() {
    const languageFromStorage = localStorage.getItem("selectedLanguage") || 'en';
    this.homepageText = homepageText[languageFromStorage];

    this.headlinerData = [...data.games];
    this.headlinerData.sort(() => Math.random() - 0.5);

    await this.updateGameLists();
  },
  methods: {
    async updateGameLists() {
      this.topTenData = await this.gameService.getTopRatedGames();
      this.favoriteData = await this.gameService.getFavoriteGames();
      this.featuredData = await this.gameService.getFeaturedGames();

      if (this.user !== null) {
        this.gamelistData = await this.userService.getUserGameList(this.user.id);
      }
    },
    useLoggedInUserStore,
    handleLanguageSelected(selectedLanguage) {
      this.homepageText = homepageText[selectedLanguage];
    },
    async handleAddToGameList(userId, gameId){
        await this.userService.addToGameList(userId,gameId);
        await this.updateGameLists();

    },
    async handleRemoveFromGameList(userId, gameId) {
        await this.userService.removeFromGameList(userId,gameId);
        await this.updateGameLists();

    }
  },
}


</script>

<style scoped>
header{
  background-color: #121212;
  margin-bottom: 3rem;
}

main{
  background-color:var(--color-black-background);
  min-height: 100vh;
  width: 50%;
  margin: auto;
}

section, .headliner {
  height: 100%;
  margin-bottom: 3.5rem;
}
</style>