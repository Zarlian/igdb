<template>
  <header>
    <IGDbHeader/>
  </header>
  <main>
    <div class="container">
      <div class="sign-in-options">
      <h1>Sign in</h1>
        <router-link to="registration/login"><Button text="Sign in with IMDb" backgroundColor="#FFFFFF" color="black" :icon="igdbIcon" iconColor="#1877f2" iconPosition="before" iconSize="1.5rem"/></router-link>
        <router-link to=""><Button text="Sign in with Amazon" backgroundColor="#FFFFFF" color="black" :icon="amazonIcon" iconColor="#000000" iconPosition="before" iconSize="1.5rem"/></router-link>
        <router-link to=""><Button text="Sign in with Google" backgroundColor="#FFFFFF" color="black" :icon="googleIcon" iconColor="#000000" iconPosition="before" iconSize="1.5rem"/></router-link>
        <router-link to=""><Button text="Sign in with Apple" backgroundColor="#FFFFFF" color="black" :icon="appleIcon" iconColor="#000000" iconPosition="before" iconSize="1.5rem"/></router-link>
        <router-link to=""><Button text="Sign in with Facebook" backgroundColor="#FFFFFF" color="black" :icon="facebookIcon" iconColor="#1877f2" iconPosition="before" iconSize="1.5rem"/></router-link>
        <p class="divider">------------------- or -------------------</p>
        <router-link to="registration/signup"><Button text="Create a New Account" backgroundColor="#f5c518" color="black"/></router-link>

        <p>By signing in, you agree to IGDb's
          <span><router-link to="/conditions">Conditions of Use</router-link></span> and
          <span><router-link to="/privacy">Privacy Policy</router-link></span>.
        </p>
      </div>
      <div class="benefits">
        <h2>Benefits of your free IGDb account</h2>
        <ul>
          <li><h3>Personalized Recommendations</h3></li>
          <li>Discover games you'll love.</li>
          <li><h3>Your Gamelist</h3></li>
          <li>Track everything you want to watch and receive e-mail when movies open in theaters.</li>
          <li><h3>Your Ratings</h3></li>
          <li>Rate and remember everything you've played.</li>
          <li><h3>Contribute to IMDb</h3></li>
          <li>Add data that will be seen by millions of people and get cool badges.</li>
        </ul>
      </div>
    </div>
    <RecentlyViewed/>
  </main>
  <IGDbFooter/>

</template>

<script>
import IGDbHeader from "@/components/header/IGDbHeader.vue";
import Button from "@/components/utility/Button.vue";
import RecentlyViewed from "@/components/utility/RecentlyViewed.vue";
import IGDbFooter from "@/components/utility/IGDbFooter.vue";

export default {
  name: 'SignInPage',
  components: {IGDbFooter, RecentlyViewed, Button, IGDbHeader},
  data() {
    return {
      igdbIcon: "logos:igdb",
      amazonIcon: "ri:amazon-fill",
      googleIcon: "flat-color-icons:google",
      appleIcon: "ic:baseline-apple",
      facebookIcon: "ic:baseline-facebook",
    }
  }
};
</script>

<style scoped>
:root {
  --var-divider-text: "---------";
}
.container {
  box-sizing: border-box;
  display: flex;
  width: 50%;
  background-color: white;
  margin: auto;
  gap: 4.5rem;
  padding: 2.5rem;
  border-bottom: solid 1px #c0c0c0;
  color: #333333;
}

h1 {
  text-align: center;
  margin-bottom: 1.5rem;
}

ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.benefits{
  padding: 0.5rem 0.5rem 0.5rem 1.5rem;
  height: fit-content;
  border-left: solid 1px #9d9d9d;
}

li {
  margin-bottom: 0.25rem;
}

.sign-in-options {
  padding-top: 0.5rem;
  display: flex;
  flex-direction: column;
  align-items: center;

  width: 19rem;
}

.divider {
  margin: 1rem 0;
}

.sign-in-options a{
  width: 100%;
  text-decoration: none;
}

.sign-in-options button {
  border: 1px solid #ddd;
  border-radius: 5px;
  margin-bottom: 10px;
  cursor: pointer;
  font-weight: bold;
  width: 100%;
  font-size: 1em;
  display: flex;
  gap: 1.5rem;
  justify-content: flex-start;
  color:#555555;
}

.sign-in-options button:last-of-type{
  display: flex;
  justify-content: center;
}

.sign-in-options a{
  text-decoration: none;
}

.sign-in-options a:hover{
  text-decoration: underline #007bff;
  color: var(--color-text-blue);
}

header{
  background-color: #121212;
  /*add shadow*/
  box-shadow: 0px 10px 5px 0px rgba(0,0,0,0.72);
}

main {
  margin: auto;
  background-color: #cececa;
  color: black;
}


h1 , h2{
  font-size: 1.25rem;
  font-weight: bold;
  margin-bottom: 1rem;
}

h3{
  font-size: 1.1rem;
  font-weight: bold;
  margin-bottom: 0.25rem;
}

li:nth-child(even){
  font-size: 0.9rem;
  margin-bottom: 0.75rem;
}

.sign-in-options p:last-child{
  font-size: 0.75rem;
  text-align: center;
}
</style>
