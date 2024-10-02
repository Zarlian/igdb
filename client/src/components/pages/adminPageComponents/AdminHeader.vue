<template>
  <div class="content-buttons">
    <h2>{{ name }}</h2>
    <input id="search-bar" type="text" :placeholder="`Search ${name.toLowerCase()}`" v-on:input="handleSearchItems($event.target.value)">
    <div class="button">
      <Button :text="'Add New'" color="white" icon="ic:baseline-add" icon-position="after" icon-color="white"
              icon-size="1.5rem" border-radius="10px" @click="handleAddItem"/>
    </div>

  </div>
</template>

<script>
import Button from "@/components/utility/Button.vue";
export default {
  emits : ['addItem', 'searchItems'],
  name: "AdminHeader",
  components: {Button},
  props: {
    name : {type: String, required: true}
  },
  methods: {
    handleAddItem() {
      this.$emit('addItem');
    },
    handleSearchItems(searchParam){
      this.$emit('searchItems', searchParam);
    },
  }
}
</script>

<style scoped>

.content-buttons h2 {
  font-weight: bold;
  font-size: 1.5rem;
  width: 20%;
}

.button{
  width: 20%;
  display: flex;
  justify-content: flex-end;
}
#search-bar{
  width: 40%;
}
.content-buttons {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
}

.content-buttons input {
  width: 15rem;
  padding: 0.5rem;
  border-radius: 4px;
  border: 1px solid #adadad;
  color: #6d6d6d;
}
</style>