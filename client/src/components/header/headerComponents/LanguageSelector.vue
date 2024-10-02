<template>
  <div class="language-selector">
    <Button :text="selectedLanguage.toUpperCase()" background-color="#121212" :icon="buttonIcon" icon-position="after"
            icon-size="1em"
            @click="toggleLanguagePane"/>
    <div v-if="showLanguagePane" class="language-pane">


      <div class="language-item">
        <input type="radio" id="english" value="en" v-model="selectedLanguage" @change="emitLanguage"/>
        <label for="english">English</label>
      </div>

      <div class="language-item">
        <input type="radio" id="dutch" value="nl" v-model="selectedLanguage" @change="emitLanguage"/>
        <label for="dutch">Dutch</label>
      </div>

      <div class="language-item">
        <input type="radio" id="french" value="fr" v-model="selectedLanguage" @change="emitLanguage"/>
        <label for="french">French</label>
      </div>


    </div>
  </div>
</template>

<script>
import Button from "@/components/utility/Button.vue";

export default {
  name: "LanguageSelector",
  components: {Button},
  data() {
    return {
      buttonIcon: "gravity-ui:caret-down",
      showLanguagePane: false,
      selectedLanguage: "",
    };
  },
  mounted() {
    this.selectedLanguage = localStorage.getItem("selectedLanguage") || "en";
  },
  methods: {
    toggleLanguagePane() {
      this.showLanguagePane = !this.showLanguagePane;
    },
    emitLanguage() {
      this.showLanguagePane = false;
      this.$emit('languageSelected', this.selectedLanguage);
      setLanguageInLocalStorage(this.selectedLanguage);
    },

  },
};

function setLanguageInLocalStorage(selectedLanguage) {
  localStorage.setItem("selectedLanguage", selectedLanguage);
}
</script>


<style scoped>
.language-selector {
  position: relative;
  display: inline-block; /* Ensure that the language pane stays below the button */
}

.language-pane {
  background-color: var(--color-dark-grey-background);
  position: absolute;
  top: 100%;
  right: 0;
  z-index: 1000;

  width: 7vw;
}

.language-item {
  padding: 1rem;
}

.language-item:hover {
  background-color: #313131;
  cursor: pointer;
}

.language-item input[type="radio"] {
  margin-right: 1rem;
}

.language-item label , .language-item input[type="radio"] {
  cursor: pointer;
}

</style>
