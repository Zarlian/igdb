<template>
  <header>


    <nav>
      <LogoButton></LogoButton>
      <Menu @click="toggleMenu" :text="headerText.menu"></Menu>
      <SearchBar :filterText="headerText.filters"></SearchBar>
      <IGDbPro></IGDbPro>
      <router-link :to="user === null ? '/registration' : '/profile/gamelist'">
        <Button :text="headerText.gameList" background-color="#121212" :icon="buttonIcon" icon-position="before"
                iconSize="1em"></Button>
      </router-link>
      <router-link to="/registration" v-if="user === null">
        <Button :text="headerText.login" backgroundColor="#121212"/>
      </router-link>
      <Profile v-else :user="user"/>
      <router-link to="/admin" v-if="user && user.role === 'admin'">
        <Button text="Admin"/>
      </router-link>
      <LanguageSelector @languageSelected="handleLanguageSelected"></LanguageSelector>

    </nav>

    <div :class="{ 'is-menu-open': !isMenuOpen }" class="dropdown-content">
      <MenuDropdown @close-menu="closeMenu" :menuText="menuText"></MenuDropdown>
    </div>
  </header>
</template>

<script>


import LogoButton from "@/components/header/headerComponents/LogoButton.vue";
import Menu from "@/components/header/headerComponents/Menu.vue";
import SearchBar from "@/components/header/headerComponents/SearchBar.vue";
import LanguageSelector from "@/components/header/headerComponents/LanguageSelector.vue";
import MenuDropdown from "@/components/header/headerComponents/MenuDropdown.vue";
import IGDbPro from "@/components/header/headerComponents/IGDbPro.vue";
import headerText from "@/assets/data/header.json";
import menuText from "@/assets/data/menuDropDown.json";
import {useLoggedInUserStore} from "@/scripts/stores/loggedInUser.js";
import Button from "@/components/utility/Button.vue";
import Profile from "@/components/header/headerComponents/Profile.vue";

export default {
  name: "IGDbHeader",
  components: {Profile, Button, IGDbPro, MenuDropdown, LanguageSelector, SearchBar, Menu, LogoButton},
  data() {
    return {
      isMenuOpen: false,
      headerText: {},
      menuText: {},
      user: useLoggedInUserStore().user,
      buttonIcon: "bi:bookmark-plus-fill",
    };
  },
  mounted() {
    const languageFromStorage = localStorage.getItem("selectedLanguage") || 'en';
    this.headerText = headerText[languageFromStorage];
    this.menuText = menuText[languageFromStorage];

  },
  methods: {
    toggleMenu() {
      this.isMenuOpen = !this.isMenuOpen;
    },
    closeMenu() {
      this.isMenuOpen = false;
    },
    handleLanguageSelected(selectedLanguage) {
      this.$emit("languageSelected", selectedLanguage);
      this.headerText = headerText[selectedLanguage];
      this.menuText = menuText[selectedLanguage];
    },
  },
}
</script>

<style scoped>
nav {
  display: flex;
  align-items: center;
  justify-content: space-between;
  min-height: 3rem;
  padding: 0.25rem 0;
  position: relative;
  width: 55%;
  margin: auto;
}

header {
  background-color: #121212;
}

.dropdown-content {
  z-index: 1000;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100vh;
  background-color: var(--color-dark-grey-background);
  color: white;
}

.is-menu-open {
  visibility: hidden;
}

a {
  text-decoration: none;
}


</style>