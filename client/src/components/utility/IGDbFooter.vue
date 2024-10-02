<template>
  <footer>
    <div class="footer-content">

      <router-link to="/registration"><Button :text="'Sign in for more acces'" :backgroundColor="'var(--color-accent-yellow)'" :color="'var(--color-text-black)'"/></router-link>

      <div class="icon-container">
        <router-link to=""><Icon icon="akar-icons:tiktok-fill" color="white" width="30" height="30"/></router-link>
        <router-link to=""><Icon icon="akar-icons:instagram-fill" color="white" width="30" height="30"/></router-link>
        <router-link to=""><Icon icon="akar-icons:twitter-fill" color="white" width="30" height="30"/></router-link>
        <router-link to=""><Icon icon="akar-icons:youtube-fill" color="white" width="30" height="30"/></router-link>
        <router-link to=""><Icon icon="akar-icons:facebook-fill" color="white" width="30" height="30"/></router-link>

      </div>

      <nav>
        <router-link to="">Get the IGDb <app></app></router-link>
        <router-link to="">Help</router-link>
        <router-link to="">Site Index</router-link>
        <router-link to="">IGDbPro</router-link>
        <router-link to="">Box Office Mojo</router-link>
        <router-link to="">IGDb Developer</router-link>
      </nav>
      <nav>
        <router-link to="">Press Room</router-link>
        <router-link to="">Advertising</router-link>
        <router-link to="">Jobs</router-link>
        <router-link to="">Conditions of Use</router-link>
        <router-link to="">Privacy Policy</router-link>
        <router-link to="">Your Ads Privacy Choices</router-link>
      </nav>
      <p>a Zar's company</p>
      <p>&copy; 2024-2024 by IGDb.com, Inc.</p>
    </div>
  </footer>
</template>

<script>
import {Icon} from "@iconify/vue";
import Button from "@/components/utility/Button.vue";

export default {
  name: "IGDbFooter",
  components: {Button, Icon}
}
</script>

<style scoped>
footer {
  background-color: var(--color-black-background);
  color: var(--color-text-white);
  padding: 2rem;
  text-align: center;
}

.footer-content{
  display: flex;
  align-items: center;
  flex-direction: column;
  gap: 1rem;
}

.footer-content a{
  color: var(--color-text-white);
  text-decoration: none;
}

.footer-content nav a:hover{
  text-decoration: underline;
}

.footer-content svg{
  padding: 0.75rem;
  border-radius: 50px;
}

.footer-content svg:hover{
  background-color: #1f1f1f;
}

.footer-content nav{
  display: flex;
  justify-content: center;
  gap: 0.85rem;
}

.footer-content button{
  width: 13rem ;
}

.footer-content p:last-child{
  color:grey;
  font-size: 0.75rem;
}

</style>