<template>
  <div class="dropdown-container">
    <header>
      <LogoButton></LogoButton>
      <Button text="Close" @click="closeMenu"/>
    </header>
    <main>
      <ul class="all-games">
        <li><Icon class="game-station-icon" icon="ic:round-all-out"/><h3>All Games</h3></li>
        <li><router-link to="/calender">{{menuText.calendar}}</router-link></li>
        <li><router-link :to="{ path: '/chart/all-games', query: { type: 'top-50' } }">{{menuText.top}}</router-link></li>
        <li><router-link :to="{ path: '/chart/all-games', query: { type: 'most-popular' } }">{{menuText.popular}}</router-link></li>
        <li><router-link to="/chart/all-games">{{menuText.browse}}</router-link></li>
      </ul>

      <ul class="pc-games">
        <li><Icon class="game-station-icon" icon="iconoir:pc-check"/><h3>PC Games</h3></li>
        <li></li>
        <li><router-link :to="{ path: '/chart/pc-games', query: { type: 'top-50' } }">{{menuText.top}}</router-link></li>
        <li><router-link :to="{ path: '/chart/pc-games', query: { type: 'most-popular' } }">{{menuText.popular}}</router-link></li>
        <li><a href="">{{menuText.browse}}</a></li>
      </ul>

      <ul class="playstation">
        <li><Icon class="game-station-icon" icon="ion:logo-playstation" /><h3>Playstation</h3></li>
        <li></li>
        <li><a href="">{{menuText.top}}</a></li>
        <li><a href="">{{menuText.popular}}</a></li>
        <li><a href="">{{menuText.browse}}</a></li>
      </ul>

      <ul class="xbox">
        <li><Icon class="game-station-icon" icon="ion:logo-xbox" /><h3>XBox</h3></li>
        <li></li>
        <li><a href="">{{menuText.top}}</a></li>
        <li><a href="">{{menuText.popular}}</a></li>
        <li><a href="">{{menuText.browse}}</a></li>
      </ul>
    </main>
  </div>
</template>

<script>
import LogoButton from "@/components/header/headerComponents/LogoButton.vue";
import {Icon} from "@iconify/vue";
import Button from "@/components/utility/Button.vue";

export default {
  name: "MenuDropdown",
  components: {Button, Icon, LogoButton},
  props: {
    menuText: {
      type: Object,
    }
  },
  methods: {
    closeMenu() {
      this.$emit('close-menu');
    },
  },
}
</script>

<style scoped>
.dropdown-container{
  width: 50%;
  margin: auto;
}

.dropdown-container header {
  margin: 2rem 0 ;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0.5rem 1rem;
}

.dropdown-container main {
  display: flex;
  gap: 2.5rem;
  padding: 0.5rem 1rem;
}

.dropdown-container main a{
  color: white;
  text-decoration: none;
}

.dropdown-container main h3{
  color: white;
  font-size: 1.5rem;
}

.dropdown-container main li{
  margin-bottom: 1rem;
  height: 1.2rem;
}

.dropdown-container main li:first-of-type{
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.dropdown-container .game-station-icon{
  color: var(--color-text-yellow);
  width: 1.5rem;
  height: 1.5rem;
}

.dropdown-container main li:not(:first-of-type){
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding-left: 2rem;
}

.dropdown-container main a:hover{
  text-decoration: underline;
}
</style>