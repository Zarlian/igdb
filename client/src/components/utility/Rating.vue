<template>
  <div class="rating-container">
    <div class="rated">
      <Icon icon="ph:star-fill" color="#f5c518"/>
      <p>{{ game.average_rating }}</p>
    </div>
    <Button @click="openModal" :text="text" color="#0e63be" :background-color="backGroundColor" :icon="buttonIcon" icon-position="before" icon-color="#5799ef"/>

    <RateModal ref="rateModalComponent" :game="game" />

  </div>
</template>

<script>
import Button from "@/components/utility/Button.vue";
import {Icon} from "@iconify/vue";
import RateModal from "@/components/utility/modals/RateModal.vue";
import {useLoggedInUserStore} from "@/scripts/stores/loggedInUser.js";

export default {
  name: "Rating",
  components: {RateModal, Icon, Button},
  props: {
    text: {
      type: String
    },
    backGroundColor: {
      type: String,
      default: "#1a1a1a"
    },
    game: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      buttonIcon: "ph:star"
    };
  },
  methods: {
    openModal() {
      if(useLoggedInUserStore().user === null) {
        this.$router.push("/registration");
      }
        else{
          this.$refs.rateModalComponent.openModal();
        }
    }
  }
}
</script>

<style scoped>
.rating-container {
  display: flex;
  align-items: center;
  justify-content: flex-start;
  gap: 0.5rem;
}
.rated{
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

</style>