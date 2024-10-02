<template>
  <div class="modal" v-if="showModal">
    <div class="modal-content" >
      <Icon @click="closeModal" class="close" icon="material-symbols:close" width="1.5rem" height="1.5rem"  style="color: white" />
      <div class="big-star-container">
        <Icon icon="ph:star-fill" width="6rem" height="6rem" style="color: #5799ef" class="star"/>
      </div>
      <p class="stars-selected" v-if="rateAmount === 0">?</p>
      <p class="stars-selected" v-else>{{ rateAmount }}</p>
      <div class="modal-inner-content">
        <h1>RATE THIS</h1>
        <p>{{game.title}}</p>
        <div class="star-container">
          <Icon v-for="(star, index) in stars" :key="index" :icon="star.icon" :width="star.width" :height="star.height" :color="star.color" @mouseover="fillStars(index)" @mouseout="resetStars" @click="setRating(index)" />
        </div>
        <button class="rate-button" disabled ref="rate-button" @click="rateGame">Rate</button>

      </div>
    </div>
  </div>
</template>

<script>
import {Icon} from "@iconify/vue";
import Button from "@/components/utility/Button.vue";
import {rateGame} from "@/scripts/util/apiWrapper.js";
import {useLoggedInUserStore} from "@/scripts/stores/loggedInUser.js";

export default {
  name: "RateModal",
  components: {Button, Icon},
  props: {
    game: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      showModal: false,
      stars: [
        { icon: "ph:star", width: "1.5rem", height: "1.5rem", color: "#aaaaaa", filled: false },
        { icon: "ph:star", width: "1.5rem", height: "1.5rem", color: "#aaaaaa", filled: false },
        { icon: "ph:star", width: "1.5rem", height: "1.5rem", color: "#aaaaaa", filled: false },
        { icon: "ph:star", width: "1.5rem", height: "1.5rem", color: "#aaaaaa", filled: false },
        { icon: "ph:star", width: "1.5rem", height: "1.5rem", color: "#aaaaaa", filled: false }
      ],
      rateAmount: 0,
      isButtonDisabled: true,
      user: useLoggedInUserStore().user
    };
  },
  methods: {
    openModal() {
      this.showModal = true;
    },
    closeModal() {
      this.showModal = false;
    },
    fillStars(index) {
      for (let i = 0; i <= index; i++) {
        this.stars[i].icon = "ph:star-fill";
        this.stars[i].color = "#5799ef";
        this.stars[i].filled = true;
      }
    },
    resetStars() {
      for (let i = this.rateAmount; i < this.stars.length; i++) {
        if (this.stars[i].filled) {
          this.stars[i].icon = "ph:star";
          this.stars[i].color = "#aaaaaa";
        }
      }
    },
    setRating(index) {
      for (let i = 0; i < this.stars.length; i++) {
        this.stars[i].filled = i <= index;
      }
      this.rateAmount = index + 1;
      this.enableButton();
    },
    enableButton(){
      this.$refs["rate-button"].disabled = false;
      this.$refs["rate-button"].style.backgroundColor = "var(--color-text-yellow)";
      this.$refs["rate-button"].style.color = "black";
      this.$refs["rate-button"].style.cursor = "pointer";
    },
    async rateGame() {
      await rateGame(this.user.id, this.game.id, this.rateAmount);
      this.closeModal();
    }
  }
};
</script>

<style>
/* Styles for the modal */
.modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5); /* semi-transparent black background */
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.modal-content {
  position: relative;
  width: 40rem;
  padding: 20px;
  border-radius: 5px;
}

.close{
  position: absolute;
  top: 0;
  right: 0;
  padding: 0.5rem;
  transform: translate(-50%, -50%);
  background-color: transparent;
  border: none;
  border-radius: 20px;
  cursor: pointer;
}

.close:hover{
  background-color: #9f9f9f;
}

.big-star-container {
  position: absolute;
  top: 10%;
  left: 50%;
  transform: translate(-50%, -50%);
}

.stars-selected{
  position: absolute;
  top: 10%;
  left: 50%;
  transform: translate(-50%, -50%);
}

.modal-inner-content{
  display: flex;
  flex-direction: column;
  align-items: center;
  background-color: #1f1f1f;
  padding-top: 4rem;
}

.modal-content h1{
  color: var(--color-text-yellow);
  margin-bottom: 1rem;
}
.modal-content p{
  margin-bottom: 1rem;
}

.star-container{
  display: flex;
  margin-bottom: 1rem;
}

.modal-content svg{
  cursor: pointer;
  padding: 0.5rem;
}

.rate-button{
  width: 12rem;
  padding: 0.5rem;
  border-radius: 4px;
  margin-bottom: 1rem;
  background-color: #313131;
  color: #969696;
  border: none;
}
</style>
