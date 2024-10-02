<template>
  <main v-if="loginText">
    <div class="container">
      <LogoButton size="3.25rem" class="logo"/>
      <form @submit.prevent="login">
        <h1>{{loginText.title}}</h1>
        <label for="email">{{loginText.mail}}</label>
        <input type="email" id="email" name="email" v-model="email" required>
        <label for="password">{{loginText.password}}</label>
        <input type="password" id="password" name="password" v-model="password" required :placeholder="loginText.passwordPlaceHolder">
        <input type="submit" :value="loginText.submit">
        <p>{{loginText.new}}</p>
        <router-link to="signup">{{loginText.create}}</router-link>
      </form>
    </div>

  </main>
</template>

<script>
import LogoButton from "@/components/header/headerComponents/LogoButton.vue";
import loginText from "@/assets/data/loginPage.json";
import {useLoggedInUserStore} from "@/scripts/stores/loggedInUser.js";
import UserService from "@/scripts/services/userService.js";
export default {
  name: "LoginPage",
  components: {LogoButton},
  data() {
    return {
      email: '',
      password: '',
      loginText: {},
      userService : new UserService()
    };
  },
  mounted() {
    const languageFromStorage = localStorage.getItem("selectedLanguage") || 'en';
    this.loginText = loginText[languageFromStorage];
  },
  methods: {
    async login() {
      const user = {
        email: this.email,
        password: this.password
      }
      await this.userService.loginUser(user)
          .then(async response => {
            await this.userService.getProfile()
                .then(profileResponse => {
                  useLoggedInUserStore().setUser(profileResponse.data);
                  this.$router.push("/home");
                })
                .catch(error => {
                  console.error(error);
                });
          })
          .catch(error => {
            console.error(error);
          })
    }
  }
}
</script>

<style scoped>
main{
  color: var(--color-text-black);
  background-color: var(--color-white-background);
  padding-top: 1rem;

  font-size: 0.8rem;
  height: 100vh;
}

.container{
  margin: auto;
  width: 25%;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.logo{
  margin-bottom: 1rem;
}

h1{
  font-size: 1.75rem;
  margin-bottom: 1.5rem;
}

form{
  display: flex;
  flex-direction: column;
  margin: 0 auto 1.5rem auto;
  width: 50%;

  border: #b6b6b6 solid 1px;
  border-radius: 10px;

  padding: 1rem;
}

label{
  font-weight: bold;
  margin-bottom: 0.3rem;
}

input{
  margin-bottom: 1rem;
  padding: 0.4rem;
  border-radius: 5px;
  border: solid 1px #b6b6b6;
}

input[type="submit"]{
  background-color: var(--color-accent-yellow);
  border: none;
  border-radius: 5px;
  padding: 0.5rem;
  cursor: pointer;
  margin-bottom: 1.5rem;
  color: #b6b6b6;
}


</style>