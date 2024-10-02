<template>
  <main v-if="signUpText">
    <div class="container">
      <LogoButton size="3.25rem" class="logo"/>
      <form @submit.prevent="registrate">
        <h1>{{signUpText.title}}</h1>
        <label for="name">{{ signUpText.name }}</label>
        <input type="text" id="name" name="name" v-model="username" required :placeholder="signUpText.namePlaceHolder">
        <label for="email">{{signUpText.mail}}</label>
        <input type="email" id="email" name="email" v-model="email" required>
        <label for="password">{{signUpText.password}}</label>
        <input type="password" id="password" name="password" v-model="password" required :placeholder="signUpText.passwordPlaceHolder">
        <p>{{signUpText.passwordExtra}}</p>
        <label for="password">{{signUpText.confirmPassword}}</label>
        <input type="password" id="password" name="password" v-model="passwordConfirmation" required >
        <input type="submit" :value="signUpText.submit">
        <div class="break-line"></div>
        <p>Already have an account? <router-link to="login">Log in</router-link></p>
      </form>
    </div>

  </main>
</template>

<script>
import IGDbHeader from "@/components/header/IGDbHeader.vue";
import signUpText from "@/assets/data/signUpPage.json";
import LogoButton from "@/components/header/headerComponents/LogoButton.vue";
import UserService from "@/scripts/services/userService.js";
export default {
  name: "SignUpPage",
  components: {LogoButton, IGDbHeader},
  data() {
    return {
      name: '',
      email: '',
      password: '',
      passwordConfirmation: '',
      signUpText: {},
      userService : new UserService()
    };
  },
  methods: {
    async registrate() {
      const user = {
        name: this.username,
        email: this.email,
        password: this.password
      }

      await this.userService.registerUser(user)
          .then((response) => {
            this.$router.push('/registration/login');
          })
          .catch((error) => {
            console.error(error);
          });
    }
  },
  mounted() {
    const languageFromStorage = localStorage.getItem("selectedLanguage") || 'en';
    this.signUpText = signUpText[languageFromStorage];
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

  border: #b6b6b6 solid 0.5px;
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

input:nth-of-type(3){
  margin-bottom: 0.25rem;
}

input + p{
  margin-bottom: 1rem;
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

.break-line{
  border-top: 1px solid #b6b6b6;
  width: 75%;
  margin: auto auto 1.5rem auto;
}


</style>