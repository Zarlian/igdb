<template>
  <div class="content">

    <AdminHeader
        :name="'Games'"
        @addItem="handleAddGame"
        @searchItems="handleSearchGames"
        />

    <ul>
      <li v-for="(game, index) in games" :key="game.id">
        <GameListAdminCard

            :game="game"
            @editGame="handleEditGame"
            @toggleFeatured="handleToggleFeatured"
            @deleteGame="handleDeleteGame"
        />
      </li>
    </ul>
    <Pagination
        :data="data"
        @goToPage="handleGoToPage"
      />
  </div>
</template>

<script>
import GameListAdminCard from "@/components/utility/gameCards/GameListAdminCard.vue";
import Button from "@/components/utility/Button.vue";
import Pagination from "@/components/pages/adminPageComponents/Pagination.vue";
import AdminHeader from "@/components/pages/adminPageComponents/AdminHeader.vue";
export default {
  emits: ['editGame','addGame', 'goToPage','searchGames','toggleFeatured', 'deleteGame'],
  name: "GameContent",
  components: {AdminHeader, GameListAdminCard, Button, Pagination},
  props: {
    data: {type: Object, required: true}
  },
  data(){
    return{
      games : this.data.data,
    }
  },
  watch: {
    data(newData) {
      this.updateState(newData);
    }
  },
  methods: {
    updateState(newData) {
      this.games = newData.data;
    },
    handleEditGame(gameId) {
      this.$emit('editGame', gameId);
    },
    handleAddGame() {
      this.$emit('addGame');
    },
    handleGoToPage(url){
      this.$emit('goToPage',url);
    },
    handleSearchGames(searchParam){
      this.$emit('searchGames', searchParam);
    },
    handleToggleFeatured(game){
      this.$emit('toggleFeatured', game);
    },
    handleDeleteGame(gameId){
      this.$emit('deleteGame', gameId);
    }
  }
}
</script>

<style scoped>
.content {
  flex: 1;
  padding: 20px;
  width: 100%;
}

.content ul {
  background-color: var(--color-white-background);
  border: solid 1px #adadad;
  border-radius: 10px;
  padding: 1.5rem;
}

.content li {
  padding: 1rem 0;
  border-bottom: solid 1px #adadad;
}

.content li:last-of-type {
  border-bottom: none;
  padding-bottom: 0;
}

.content li:first-of-type {
  padding-top: 0;
}

</style>