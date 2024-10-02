<template>
  <IGDbHeader></IGDbHeader>
  <main v-if="userGameList">
    <div class="content">
      <header class="gamelist-header">
          <h1>Your Gamelist</h1>
          <div class="icon-container">
            <div class="icons">
              <Icon icon="ic:baseline-edit" width="1.5rem" height="1.5rem"  style="color: #6d6d6d" />
              <p>EDIT</p>
            </div>
            <div class="icons">
              <Icon icon="ic:baseline-share" width="1.5rem" height="1.5rem"  style="color: #6d6d6d" />
              <p>SHARE</p>
            </div>
          </div>

      </header>
      <div class="list-controls">
        <p>{{userGameList.length}} Games</p>
        <div class="sort-container">
          <div>
            <label for="sort">Sort by: </label>
            <select name="sort" id="sort">
              <option value="date">Date</option>
              <option value="title">Title</option>
              <option value="rating">Rating</option>
            </select>
          </div>

          <div class="arrow-container">
            <Icon icon="cil:arrow-bottom" width="1rem" height="1.2rem"  style="color: #6d6d6d" />
            <Icon icon="cil:arrow-top" width="1rem" height="1.2rem"  style="color: #6d6d6d" />
          </div>

          <div @click="toggleGrid">
            <Icon v-if="isGrid" icon="ic:round-list" width="1.5rem" height="1.5rem" style="color: #6d6d6d"/>
            <Icon v-else icon="ri:grid-fill" width="1.5rem" height="1.5rem" style="color: #6d6d6d"/>
          </div>

        </div>
      </div>
      <ul>
        <li v-for="(game, index) in userGameList" :key="game.id">
          <GameListCard
              :game="game"
              @delete-from-list="deleteFromList"
          />
        </li>
      </ul>
      <RecentlyViewed/>
    </div>
  </main>
</template>

<script>
import IGDbHeader from "@/components/header/IGDbHeader.vue";
import {Icon} from "@iconify/vue";
import {useLoggedInUserStore} from "@/scripts/stores/loggedInUser.js";
import GameListCard from "@/components/utility/gameCards/GameListCard.vue";
import RecentlyViewed from "@/components/utility/RecentlyViewed.vue";
import UserService from "@/scripts/services/userService.js";

export default {
  name: "GameListPage",
  components: {RecentlyViewed, GameListCard, Icon, IGDbHeader},
  data() {
    return {
      isGrid: false,
      userGameList: null,
      user: null,
      userService : new UserService()
    }
  },
  methods: {
    toggleGrid(){
      this.isGrid = !this.isGrid;
    },
    async deleteFromList(gameId){
      await this.userService.removeFromGameList(this.user.id, gameId);
      this.userGameList = await this.userService.getUserGameList(this.user.id);
    }
  },
  async mounted() {
    this.user = useLoggedInUserStore().user;
    this.userGameList = await this.userService.getUserGameList(this.user.id);
  }

}
</script>

<style scoped>
main {
  background: rgb(176, 176, 172);
  background: linear-gradient(180deg, rgba(176, 176, 172, 1) 0%, rgba(226, 225, 220, 1) 100%);
  color: var(--color-text-black);
  min-height: 80vh;
}

.content {
  width: 50%;
  margin: auto;
  background-color: #eeeeee;

}

.gamelist-header{
  display: flex;
  justify-content: space-between;
  border-bottom: 1px solid #adadad;
  padding: 1.25rem 0.75rem 1.5rem 0.75rem;
}

.icon-container{
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 1rem;
}

.icons{
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.5rem;
}

h1{
  font-size: 1.75rem;
}

.content ul {
  background-color: var(--color-white-background);
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

.gamelist-header p{
  font-size: 0.75rem;
  margin: 0;
  color: #6d6d6d;
}

.arrow-container svg{
  width: 1rem;
}

.list-controls{
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0.75rem 0.75rem 0.75rem 1.25rem;
  border-bottom: 1px solid #adadad;
  color: #6d6d6d;
  font-size: 0.8rem;
}

.sort-container{
  display: flex;
  align-items: center;
  gap: 1.5rem;
}

svg{
  cursor: pointer;
}

select{
  padding: 0.25rem;
  border-radius: 4px;
  border: 1px solid #adadad;
  color: #6d6d6d;
}
</style>