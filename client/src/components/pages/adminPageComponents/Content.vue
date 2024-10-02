<template>
  <div class="content">

    <AdminHeader
        :name="name"
        @addItem="handleAddContent"
        @searchItems="handleSearchContent"
    />

    <ul>
      <li v-for="(item, index) in content" :key="data.id">
        <p>{{ item.name }}</p>

        <div class="icon-container">
          <Icon v-if="name!=='Users'" icon="ic:baseline-edit" width="1.5rem" height="1.5rem"  style="color: #6d6d6d" @click="handleEditContent(item.id)"/>
          <Icon icon="material-symbols:delete" width="1.5rem" height="1.5rem"  style="color: #6d6d6d" @click="handleDeleteContent(item.id)"/>
        </div>
      </li>
    </ul>

    <Pagination
      :data="data"
      @goToPage="handleGoToPage"
      />


  </div>
</template>

<script>
import {Icon} from "@iconify/vue";
import Pagination from "@/components/pages/adminPageComponents/Pagination.vue";
import AdminHeader from "@/components/pages/adminPageComponents/AdminHeader.vue";

export default {
  emits: ['editContent', 'deleteContent','goToPage', 'addContent','searchContent'],
  name: "Content",
  components: {AdminHeader, Icon,Pagination},
  props: {
    name: {type: String, required : true},
    data : {type : Object, required : true}
  },
  data(){
    return {
      content : this.data.data,
    }
  },
  watch: {
    data(newData) {
      this.updateState(newData);
    }
  },
  methods : {
    updateState(newData) {
      this.content = newData.data;
    },
    handleSearch(){
      console.log(this.content)
    },
    handleEditContent(itemId){
      const name = this.name.toLowerCase();
      //todo make modal and get the content
      //this.$emit('editContent', name, itemId, content)
    },
    handleDeleteContent(itemId){
      const name = this.name.toLowerCase();
      this.$emit('deleteContent', name, itemId)
    },
    handleGoToPage(url){
      this.$emit('goToPage',url);
    },
    handleAddContent() {
      this.$emit('addContent');
    },
    handleSearchContent(searchParam){
      this.$emit('searchContent', this.name.toLowerCase(),searchParam);
    },
  }
}
</script>

<style scoped>
.content {
  flex: 1;
  padding: 20px;
  width: 100%;
}

.content ul {
  background-color: var(--color-white-background);
  border: solid 1px #adadad;
  border-radius: 10px;
  padding: 1.5rem;
}


.content li {
  padding: 1rem 0;
  border-bottom: solid 1px #adadad;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.content li:last-of-type {
  border-bottom: none;
  padding-bottom: 0;
}

.content li:first-of-type {
  padding-top: 0;
}


.icon-container svg{
  border-radius: 50px;
  padding: 0.5rem;
  margin: 0.5rem;
}

.icon-container svg:hover{
  background-color: #b4b4b4;
  cursor: pointer;
}


</style>