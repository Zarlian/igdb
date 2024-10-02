<script>
import HomePage from "@/components/pages/HomePage.vue";
import WhatToPlayPage from "@/components/pages/WhatToPlayPage.vue";
import AdminPage from "@/components/pages/AdminPage.vue";

export default{
  components: {
    HomePage,
    WhatToPlayPage,
    AdminPage
  },
  data() {
    return {
      homePage: HomePage
    }
  }
}
</script>

<template>
<router-view></router-view>
</template>

<style scoped>
</style>
