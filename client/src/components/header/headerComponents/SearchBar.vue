<template>
    <div v-if="filterText" class="search-container">
      <div class="input-wrapper">
        <div class="button-wrapper">
          <Button
              :text="filterText.all"
              background-color="#FFFFFF"
              color="#252525"
              :icon="buttonIcon"
              icon-position="after"
              iconSize="1em"
              iconColor="#252525"
              borderRadius=" 4px 0 0 4px"
              @click="toggleFilterPane"
          />

        <div v-if="showFilterPane" class="filter-pane">

          <p><Icon icon="ic:baseline-search"/>{{filterText.all}}</p>

          <p>{{filterText.titles}}</p>

          <p>{{filterText.developers}}</p>

          <p>{{filterText.keyWords}}</p>

          <router-link to="">{{filterText.advanced}}</router-link>
        </div>
        </div>
        <div class="search-input-container">
          <input
              type="text"
              placeholder="Search IGDb"
          />
          <Icon class="search-icon" icon="ic:baseline-search"/>
        </div>
      </div>
    </div>
</template>

<script>
import {Icon} from "@iconify/vue";
import Button from "@/components/utility/Button.vue";

export default {
  name: "SearchBar",
  components: {Button, Icon},
  props: {
    filterText: {
      type: Object,
    }
  },
  data() {
    return {
      buttonIcon: "gravity-ui:caret-down",
      showFilterPane: false,
    };
  },
  methods: {
    toggleFilterPane() {
      this.showFilterPane = !this.showFilterPane;
    }
  }
};
</script>

<style scoped>
.search-container{
  flex-grow: 1;
}
.input-wrapper {
  display: flex;
  align-items: center;
}

.search-input-container {
  width: 25vw;
  position: relative;
  flex: 1;
  height: 2rem;
}

.search-input-container input {

  border: none;
  border-left: solid 1px #252525;
  border-radius: 0 4px 4px 0;
  box-sizing: border-box;
  height: 100%;
  width: 100%;
  padding-right: 30px;
}

.search-input-container input:focus {
  border-left: none;
}

.search-icon {
  position: absolute;
  top: 50%;
  right: 10px;
  transform: translateY(-50%);
}

.button-wrapper{
  position: relative;
  display: inline-block;
}

.filter-pane {
  background-color: var(--color-dark-grey-background);
  position: absolute;
  left: 0;
  z-index: 1000;

  width: 7vw;
}

.filter-pane a{
  color: white;
  text-decoration: none;
}

.filter-pane p, .filter-pane a {
  margin: 0;
  padding: 1rem ;
  display: block;
}

.filter-pane p:hover, .filter-pane a:hover {
  background-color: #313131;
  color: var(--color-text-white);
  cursor: pointer;
}

.filter-pane p:last-of-type{
  border-bottom: 1px solid #c4c4c4;
}

.filter-pane svg{
  margin-right: 0.5rem;
}

</style>