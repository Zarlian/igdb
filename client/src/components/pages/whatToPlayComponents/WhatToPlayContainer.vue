<template>

    <GameCard
        v-for="game in gameCards"
        :game="game"
        :userGameList="userGameList"
        @addToGameList="handleAddToGameList"
        @removeFromGameList="handleRemoveFromGameList"
    />
</template>

<script>
import GameCard from "@/components/utility/gameCards/GameCard.vue";
import EmptySection from "@/components/pages/homePageComponents/EmptySection.vue";
import {Icon} from "@iconify/vue";
import Button  from "@/components/utility/Button.vue";

export default {
  name: "WhatToPlayContainer",
  components: {Button, Icon, EmptySection, GameCard},
  props: {
    userGameList: {
      type: Array, default: () => []
    },
    gameCards: {
      type: Array,
      default: () => [],
    },
  },
  methods: {
    handleAddToGameList(userId, gameId){

      this.$emit('addToGameList', userId,gameId);
    },
    handleRemoveFromGameList(userId, gameId){
      this.$emit('removeFromGameList', userId, gameId);
    }
  }
}
</script>

