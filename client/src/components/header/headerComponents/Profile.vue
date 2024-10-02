<template>

  <div class="profile-selector">
    <Button :text="user.name" @click="toggleProfilePane"/>

    <div v-if="showProfilePane" class="profile-pane">
      <router-link to="">Your activity</router-link>

      <router-link to="/profile/gamelist">Your gamelist</router-link>

      <router-link :to="name='ratings'">Your ratings</router-link>

      <router-link to="">Your lists</router-link>

      <router-link to="">Account settings</router-link>

      <p @click="logout">Logout</p>


    </div>
  </div>

</template>

<script>
import Button from "@/components/utility/Button.vue";
import {useLoggedInUserStore} from "@/scripts/stores/loggedInUser.js";
import UserService from "@/scripts/services/userService.js";
export default {
  name: "Profile",
  components: {Button},
  props: {
    user: {
      type: Object,
    }
  },
  data() {
    return {
      showProfilePane: false,
      userService : new UserService()
    };
  },
  methods: {
    toggleProfilePane() {
      this.showProfilePane = !this.showProfilePane;
    },
    async logout() {
      useLoggedInUserStore().clearUser();
      await this.userService.logoutUser();
      //refresh page
      window.location.reload();
    }
  },
}
</script>

<style scoped>

.profile-selector {
  position: relative;
}

.profile-pane {
  background-color: var(--color-dark-grey-background);
  position: absolute;
  left: 0;
  z-index: 1000;

  width: 7vw;
}

.profile-pane a{
  color: white;
  text-decoration: none;
}

.profile-pane p, .profile-pane a {
  margin: 0;
  padding: 1rem ;
  display: block;
}

.profile-pane p:hover, .profile-pane a:hover {
  background-color: #313131;
  color: var(--color-text-white);
  cursor: pointer;
  text-decoration: var(--color-text-white);
}
</style>