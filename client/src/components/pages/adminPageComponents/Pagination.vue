<template>
  <div class="pagination-container">
    <button @click="handleGoToPage(firstPageUrl)"><<</button>
    <button @click="handleGoToPage(previousPageUrl)"><</button>
    <button v-for="page in totalPages" :key="page" @click="createUrl(page)" :class="{ 'current-page': page === currentPage }">
      {{ page }}
    </button>

    <button @click="handleGoToPage(nextPageUrl)">></button>
    <button @click="handleGoToPage(lastPageUrl)">>></button>
  </div>
</template>

<script>
export default {
  name: "Pagination",
  props: {
    data: {type: Object, required: true}
  },
  data(){
    return{
      games : this.data.data,
      firstPageUrl : this.data.first_page_url,
      lastPageUrl : this.data.last_page_url,
      nextPageUrl : this.data.next_page_url,
      previousPageUrl : this.data.prev_page_url,
      maxPage : parseInt(this.data.last_page),
      currentPage : this.data.current_page
    }
  },
  computed: {
    totalPages() {
      return Array.from({ length: this.data.last_page }, (_, i) => i + 1);
    }
  },
  watch: {
    data(newData) {
      this.updateState(newData);
    }
  },
  methods: {
    updateState(newData) {
      this.games = newData.data;
      this.firstPageUrl = newData.first_page_url;
      this.lastPageUrl = newData.last_page_url;
      this.nextPageUrl = newData.next_page_url;
      this.previousPageUrl = newData.prev_page_url;
      this.maxPage = parseInt(newData.last_page);
      this.currentPage = this.data.current_page;
    },
    createUrl(pageNr) {
      const url = `${this.data.path}?page=${pageNr}`
      this.handleGoToPage(url)
    },
    handleGoToPage(url){
      this.$emit('goToPage',url);
    }
  },

}
</script>

<style scoped>
.pagination-container {
  display: flex;
  justify-content: center;
  margin-top: 20px;
}


.pagination-container button {
  background-color: var(--color-black-background);
  color: white;
  border: none;
  border-radius: 5px;
  padding: 8px 16px;
  margin: 0 5px;
  cursor: pointer;
}

.pagination-container button:hover {
  background-color: var(--color-black-background);
}

.pagination-container button.current-page {
  background-color: var(--color-text-yellow);
}
</style>