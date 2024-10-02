<template>
  <figure>
    <router-link :to="'/title/' + game.id"  @click="addToActivity"><img :src="game.cover" :alt="game.title" /></router-link>
    <figcaption>
      <Rating  :game="game"/>
      <h3 @click="addToActivity"><router-link :to="'/title/' + game.id">{{ game.title }}</router-link></h3>
      <router-link :to="user === null ? '/registration' : '/profile/gamelist'" class="gamelist"><Button class="gamelist" text="Gamelist" background-color="#2c2c2c" color="#5799ef" /></router-link>

      <div class="trailer-container">
        <router-link :to="'/trailer/' + game.id"><Button
            text="Trailer"
            background-color="#1a1a1a"
            icon="bi:play-fill"
            icon-position="before"
            icon-size="1.3rem"
        /></router-link>
      </div>
      <Icon :icon="isGameInUserList ? 'mdi:bookmark' : 'circum:bookmark-plus'" class="bookmark" @click="handleBookmarkClick(game.id)" />
    </figcaption>
  </figure>
</template>

<script>
import Button from "@/components/utility/Button.vue";
import Rating from "@/components/utility/Rating.vue";
import {Icon} from "@iconify/vue";
import {useLoggedInUserStore} from "@/scripts/stores/loggedInUser.js";
import {useRecentActivityStore} from "@/scripts/stores/recentActivity.js";
import TrailerModal from "@/components/utility/modals/TrailerModal.vue";

export default {
  emits : ['addToGameList', 'removeFromGameList'],
  name: "GameCard",
  components: {TrailerModal, Icon, Rating, Button },
  props: {
    game: {
      type: Object,
      required: true
    },
    userGameList: { type : Array, default: () => []}
  },

  computed: {
    isGameInUserList() {
      return this.userGameList.some(g => g.id === this.game.id);
    }
  },
  data() {
    return {
      user: useLoggedInUserStore().user
    }
  },
  methods: {
    openInfoModal() {
      this.$refs.infoModalComponent.openModal();
    },
    handleBookmarkClick(gameId) {
      if (this.user != null) {
        if(this.isGameInUserList){
          this.handleRemoveFromGameList(gameId);
        }else{
          this.handleAddToGameList(gameId);
        }
      } else {
        this.$router.push('/registration');
      }
    },

    addToActivity() {
      useRecentActivityStore().addActivity(this.game);
    },
    handleAddToGameList(gameId) {
      this.$emit('addToGameList', this.user.id, gameId);
    },
    handleRemoveFromGameList(gameId){
      this.$emit('removeFromGameList', this.user.id, gameId)
    }
  },
};
</script>

<style scoped>
img {
  width: 100%;
  height: 60%;
  border-radius: 0 0 7px 7px;
  object-fit: cover;
  margin-bottom: 0.75rem;
}

a{
  text-decoration: none;
  color: white;
}

h3 a:hover{
  text-decoration: underline;
}

img:hover {
  cursor: pointer;
  filter: brightness(0.8);
}

figure {
  position: relative;
  width: 100%;
  height: 28rem;
  color: var(--color-text-white);
  background-color: #1a1a1a;
  border-radius: 0 0 4px 4px;
}
Rating {
  margin-bottom: 1rem;
}
h3 {
  margin-bottom: 0.75rem;
  line-height: 1.2rem;
  height: 2.5rem;
}
Button {
  margin-bottom: 0.75rem;
}
.gamelist{
  width: 100%;
}
.trailer-container {
  width: 100%;
  display: flex;
  justify-content: center;
}
figcaption {
  display: flex;
  flex-direction: column;
  align-items: start;
  padding: 0 0.5rem 0.5rem 0.5rem;
}

.bookmark{
  position: absolute;
  top: -5px;
  left: -11px;
  color: var(--color-text-white);
  font-size: 3rem;
  cursor: pointer;
}

.bookmark:hover{
  color: #c4c4c4;
}
</style>
