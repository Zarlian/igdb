<template>
  <div>
    <header>
      <IGDbHeader/>
    </header>
    <main>
      <div class="content-container">
        <div class="title-container">
          <h1>Upcoming Releases</h1>

          <select name="consoles" id="console-select">
            <option value="all">All Consoles</option>
            <option v-for="type in consoleTypeValues" :key="type" :value="type">
              {{ type }}
            </option>
          </select>
        </div>
        <UpcomingSection :newReleases="newReleases"/>

      </div>
    </main>
  </div>
</template>

<script>
import {ConsoleTypes} from "@/scripts/util/enums.js";
import IGDbHeader from "@/components/header/IGDbHeader.vue";
import data from "../../assets/data/data.json";
import UpcomingSection from "@/components/pages/calenderPageComponents/UpcomingSection.vue";
import {Icon} from "@iconify/vue";
export default {
  name: "CalendarPage",
  components: {UpcomingSection, Icon, IGDbHeader},
  data() {
    return {
      ConsoleTypes: ConsoleTypes,
      newReleases: data.newReleases,
    };
  },
  computed: {
    consoleTypeValues() {
      return Object.values(ConsoleTypes).map((type) => type.toString());
    },
  },
};
</script>

<style scoped>
main {
  color: var(--color-text-black);
  background-color: var(--color-light-background);
  min-height: 100vh;
  padding: 1.5rem 0;
}

header {
  background-color: #121212;
  margin-bottom: 2rem;
}

.content-container {
  width: 48%;
  margin: auto;
}

.title-container {
  display: flex;
  justify-content: flex-start;
  align-items: center;
  gap: 1rem;
  margin-bottom: 2rem;
}

h1 {
  font-size: 2.75rem;
}

select {
  font-size: 2.75rem;
  font-weight: bold;
  border: solid 1px #f5f5f5;
  background-color: var(--color-light-background);
  color: var(--color-text-blue);
  border-radius: 4px;
  width: 25rem;
}

select:hover {
  background-color: #edf3fa;
}

select:focus {
  border: dashed 1px #95c6f6;
  background-color: #edf3fa;
}

option {
  font-size: 1.25rem;
  font-weight: normal;
  color: var(--color-black-background);
}






</style>
