<template>
  <div class="information">
    <div class="information-container">
      <div class="section-container">
        <section>
          <router-link :to="'/trailer-gallery/' + gameData.id">
            <h2>Trailers {{ this.gameData.trailers.length }}
              <Icon icon="mingcute:right-fill" color="black" width="2.25rem" height="2rem"/>
            </h2>
          </router-link>
          <TrailerCarousel :gameData="gameData" sectionName="trailers"/>
        </section>
        <section>
          <router-link :to="'/screenshots-gallery/' + gameData.id">
            <h2>Screenshots {{ this.gameData.screenshots.length }}
              <Icon icon="mingcute:right-fill" color="black" width="2.25rem" height="2rem"/>
            </h2>
          </router-link>
          <TrailerCarousel
              :is-screen-shot="true"
              :gameData="gameData" sectionName="trailers"/>
        </section>

      </div>
      <aside class="more-to-explore">

      </aside>
    </div>


  </div>
</template>

<script>
import {Icon} from "@iconify/vue";
import TrailerCarousel from "@/components/utility/TrailerCarousel.vue";

export default {
  name: "TitlePageInformationPanel",
  components: {TrailerCarousel, Icon},
  props: {
    gameData: {
      type: Object, required: true
    }
  }
}
</script>

<style scoped>
.information {
  background-color: var(--color-white-background);
  color: #1a1a1a;
}

.information-container {
  display: flex;

  width: 50%;
  margin: auto;
}

.section-container {
  width: 70%;
  margin: auto;
  padding-top: 2rem;
}

.section-container a{
  text-decoration: none;
}

.section-container section h2 {
  font-size: 2rem;
  color: #1a1a1a;
}

.more-to-explore {
  width: 30%;
}
</style>