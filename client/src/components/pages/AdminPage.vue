<template>
  <div class="admin-page">
    <AdminAsideNav @handleClick="handleClick" />
    <main>
      <header>
        <h1>Admin Page Title</h1>
        <div class="user-content" >
          <Icon icon="mynaui:user" width="4rem" height="4rem"  style="color: grey" />
          <p v-if="user">{{user.name}}</p>
        </div>
      </header>

      <div class="admin-page-content">
        <GameContent v-if="selectedSection === 'games'"
                     :data="data"
                     @editGame="handleClick('editGame', $event)"
                     @addGame="handleClick('addGame')"
                     @goToPage="handleGoToPage($event)"
                     @searchGames="handleSearchGames($event)"
                     @toggleFeatured="handleToggleFeatured($event)"
                     @deleteGame="handleDeleteGame($event)"
        />
        <EditGameContent v-else-if="selectedSection === 'addGame'"
                         @goToGames="handleClick('games')"
                         @saveGame="handleSaveGame"
                         :type="'add'"
        />
        <EditGameContent v-else-if="selectedSection === 'editGame'"
                         :game="data"
                         @goToGames="handleClick('games')"
                         @saveGame="handleSaveGame($event, $event)"
                         :type="'edit'"
        />

        <Content v-else-if="selectedSection === 'users'"
                 :data="data"
                 :name="'Users'"
                 @deleteContent="handleContentDelete($event)"
                 @editContent="handleContentEdit"
                 @goToPage="handleGoToPage($event)"
                 @searchContent="handleSearchContent"
        />
        <Content v-else-if="selectedSection === 'developers'"
                 :data="data"
                 :name="'Developers'"
                 @deleteContent="handleContentDelete($event)"
                 @editContent="handleContentEdit"
                 @goToPage="handleGoToPage($event)"
                 @searchContent="handleSearchContent"
        />
        <Content v-else-if="selectedSection === 'genres'"
                 :data="data"
                 :name="'Genres'"
                 @deleteContent="handleContentDelete($event)"
                 @editContent="handleContentEdit"
                 @goToPage="handleGoToPage($event)"
                 @searchContent="handleSearchContent"
        />
        <Content v-else-if="selectedSection === 'platforms'"
                 :data="data"
                 :name="'Platforms'"
                 @deleteContent="handleContentDelete($event)"
                 @editContent="handleContentEdit"
                 @goToPage="handleGoToPage($event)"
                 @searchContent="handleSearchContent"
        />
      </div>


    </main>
  </div>
</template>

<script>
import LogoButton from "@/components/header/headerComponents/LogoButton.vue";
import SearchBar from "@/components/header/headerComponents/SearchBar.vue";
import GameListAdminCard from "@/components/utility/gameCards/GameListAdminCard.vue";
import Button from "@/components/utility/Button.vue";
import GameContent from "@/components/pages/adminPageComponents/GameContent.vue";
import AddGameContent from "@/components/pages/adminPageComponents/AddGameContent.vue";
import EditGameContent from "@/components/pages/adminPageComponents/EditGameContent.vue";
import {useLoggedInUserStore} from "@/scripts/stores/loggedInUser.js";
import {Icon} from "@iconify/vue";
import AdminAsideNav from "@/components/pages/adminPageComponents/AdminAsideNav.vue";
import Content from "@/components/pages/adminPageComponents/Content.vue";
import AdminGameService from "@/scripts/services/adminService"
export default {
  components: {

    Content,
    AdminAsideNav,
    Icon,
    EditGameContent,
    AddGameContent, GameContent, Button, GameListAdminCard, SearchBar, LogoButton
  },
  data() {
    return {
      selectedSection: '',
      data: [],
      user: useLoggedInUserStore().user,
      service : new AdminGameService()
    };
  },
  methods: {
    async handleClick(subtype, gameId = null) {

      switch (subtype) {
        case 'games':
          this.data = await this.service.getGames();
          break;
        case 'users':
          this.data = await this.service.getContent('users');
          break;
        case 'developers':
          this.data = await this.service.getContent('developers');
          break;
        case 'genres':
          this.data = await this.service.getContent('genres');
          break;
        case 'platforms':
          this.data = await this.service.getContent('platforms');
          break;
        case 'reviews':
          //this.data = await getAdminReviews();
          break;
        case 'editGame':
          this.selectedSection = 'editGame';
          this.data = await this.service.getGame(gameId);
          break;
        case 'addGame':
          this.data = {}
          this.selectedSection = 'addGame';
          break;
      }

      this.selectedSection = subtype;
    },
    async handleGoToPage(url){
      this.data = await this.service.goToPage(url)
    },
    async handleSearchGames(searchParam){
      this.data = await this.service.searchGames(searchParam);
    },
    async handleSearchContent(name, searchParam){
      this.data = await this.service.searchContent(name, searchParam);
    },
    async handleSaveGame(body, type){
      console.log("type:" + type)
      console.log("body" + body)
      if(type === 'add'){
        await this.service.createGame(body);
        await this.handleClick('games')
      }else{
        await this.service.updateGame(body);
        await this.handleClick('games');
      }
    },
    async handleToggleFeatured(game){
      await this.service.toggleFeatured(game);
      await this.handleClick('games')
    },
    async handleDeleteGame(gameId){
      await this.service.deleteGame(gameId)
      await this.handleClick('games')
    },
    async handleContentDelete(name, itemId){
      await this.service.deleteContent(name, itemId);
      this.data = await this.service.getContent(name);
    },
    async handleContentEdit(name, itemId, content){
      await this.service.editContent(name, itemId, content);
      this.data = await this.service.getContent(name);
    }
  },
};
</script>

<style scoped>
.admin-page {
  display: flex;
}

.user-content {
  display: flex;
  align-items: center;
  gap: 1rem;
}

header{
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem;
  background-color: var(--color-light-background);
  border-bottom: 1px solid #adadad;
}

header h1 {
  font-size: 2rem;
}

.user-content p {
  font-size: 1.5rem;
}

.user-content svg {
  border-radius: 50%;
  background-color: #dcdcdc;
}

.admin-page-content {
  width: 60%;
  margin: auto;
}

main {
  background-color: var(--color-light-background);
  min-height: 100vh;
  width: 100%;
  color: var(--color-text-black);
}
</style>
