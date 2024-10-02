<template>
  <header>
    <IGDbHeader/>
  </header>
  <main>
    <h2>IGDb Charts</h2>
    <h1>{{ chartTitle }}</h1>
    <p>As rated by regular IMDb voters.</p>
    <div class="page">
      <div class="content">
        <div class="info-container">
          <p>{{ gameData.length }} Games</p>
          <div class="icon-container">
            <Icon icon="ic:round-list" width="2rem" height="2rem" color="grey"/>
            <Icon icon="ri:grid-fill" width="1.5rem" height="1.5rem" color="grey"/>
            <Icon icon="ph:list" width="1.5rem" height="1.5rem" color="grey"/>
          </div>
        </div>
        <Button text="" background-color="#0e63be"  :icon="filterIcon" icon-position="after"
                icon-color="white" icon-size="1.5rem" borderRadius="50px"/>
        <div class="ordering-container">
          <p>Sort by</p>
          <Button text="Popularity" background-color="white" color="#0e63be" :icon="sortIcon" icon-position="after"
                  icon-color="#0e63be"/>
          <Button text="" background-color="white" :icon="switchIcon" icon-position="after"
                  icon-color="#000000" border-radius="100px"/>
        </div>

        <ul>
          <li v-for="(game, index) in gameData" :key="game.id">
            <GameListCard
                :counter="index + 1"
                :game="game"
            />
          </li>
        </ul>
      </div>
      <ChartAside/>
    </div>

  </main>
</template>

<script>
import IGDbHeader from "@/components/header/IGDbHeader.vue";
import data from "../../assets/data/data.json";
import GameListCard from "@/components/utility/gameCards/GameListCard.vue";
import {Icon} from "@iconify/vue";
import Button from "@/components/utility/Button.vue";
import ChartAside from "@/components/pages/chartPageComponents/ChartAside.vue";

export default {
  name: "ChartPage",
  components: {ChartAside, Icon, GameListCard, IGDbHeader, Button},
  computed: {
    chartTitle() {
      const paramsName = this.$route.params.name;
      const queryParamsType = this.$route.query.type;

      const formattedParamsName = paramsName.charAt(0).toUpperCase() + paramsName.slice(1).replace(/-/g, ' ');
      const formattedQueryParamsType = queryParamsType.charAt(0).toUpperCase() + queryParamsType.slice(1).replace(/-/g, ' ');
      return `${formattedParamsName}: ${formattedQueryParamsType} games`;
    },

  },
  data() {
    return {
      gameData: [],
      sortIcon: "gravity-ui:caret-down",
      filterIcon: "fluent:filter-12-regular",
      switchIcon: "heroicons-outline:switch-vertical"
    };

  },
  mounted() {
    this.gameData = data.games
  },

}
</script>

<style scoped>
main {
  width: 50%;
  margin: auto;
  background-color: white;
  color: black;
  padding: 1rem;
}

header{
  background-color: #121212;
  margin-bottom: 3rem;
}

h1 {
  border-left: solid 3px #f5c518;
  font-size: 2rem;
  margin-bottom: 0.75rem;
  padding-left: 0.75rem;
}

h1 + p{
  color: #757575;
  margin-bottom: 2rem;
}

h2 {
  font-size: 1.5rem;
  margin-bottom: 1rem;
  font-weight: bold;
}

.content {
  width: 60%;
}

ul {
  padding: 0.5rem;
  border-radius: 4px;
  border: solid 1px #afafaf;
}

li {
  padding: 0.25rem 0.5rem;
  border-bottom: solid 1px #afafaf;
}

.info-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
}

.icon-container {
  display: flex;
  gap: 1rem;
  align-items: center;
}

.ordering-container {
  display: flex;
  justify-content: flex-end;
  align-items: center;
  margin-bottom: 1rem;
}
.page {
  display: flex;
  gap: 3rem;
}
</style>