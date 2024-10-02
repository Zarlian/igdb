<template>
  <aside>
    <div class="your-rating-container">
      <h4>You have rated</h4>
      <p><span>0</span>/50 (0%)</p>

      <input type="checkbox">
      <p>Hide titles you've rated</p>
    </div>



    <h3>More to explore</h3>

    <h4>Charts</h4>
    <ul>
      <li><a href="">Top Box Office (US)<Icon icon="mingcute:right-fill" color="#000000" width="1.5rem" height="1.5rem"/></a></li>
      <li>From the past weekend</li>
      <li><a href="">IMDb Top 250 Movies<Icon icon="mingcute:right-fill" color="#000000" width="1.5rem" height="1.5rem"/></a></li>
      <li>As rated by regular IMDb voters.</li>
      <li><a href="">Top Rated English Movies<Icon icon="mingcute:right-fill" color="#000000" width="1.5rem" height="1.5rem"/></a></li>
      <li>English-language movies as rated by IMDb users</li>
      <li><a href="">Most Popular TV Shows<Icon icon="mingcute:right-fill" color="#000000" width="1.5rem" height="1.5rem"/></a></li>
      <li>As determined by IMDb users</li>
      <li><a href="">Top 250 TV Shows<Icon icon="mingcute:right-fill" color="#000000" width="1.5rem" height="1.5rem"/></a></li>
      <li>Top 250 as rated by IMDb Users</li>
      <li><a href="">Lowest Rated Movies<Icon icon="mingcute:right-fill" color="#000000" width="1.5rem" height="1.5rem"/></a></li>
      <li>Bottom 100 as voted by IMDb users</li>
      <li><a href="">Most Popular Celebs<Icon icon="mingcute:right-fill" color="#000000" width="1.5rem" height="1.5rem"/></a></li>
      <li>As determined by IMDb users</li>
    </ul>
  </aside>
</template>

<script>
import {Icon} from "@iconify/vue";

export default {
  name: "ChartAside",
  components: {Icon},
}
</script>

<style scoped>
h3 {
  border-left: solid 3px #f5c518;
  font-size: 2rem;
  font-weight: bold;
  margin-bottom: 2rem;
  padding-left: 0.75rem;
}

p{
  margin-bottom: 0.75rem;
}

a {
  color: black;
  text-decoration: none;
  font-size: 1.25rem;
  font-weight: bold;
  display: flex;
  align-items: center;
}
li{
  margin-bottom: 0.75rem;
}

h4{
  font-size: 1.75rem;
  font-weight: bold;
  margin-bottom: 1.5rem;
}

.your-rating-container h4 + p{
  color: #737373;
}

.your-rating-container p span{
  font-size: 1.25rem;
  color: #008a00;
}

input{
  display: inline-block;
}

input + p{
  display: inline-block;
  margin-bottom: 1.5rem;
}

li:nth-of-type(even){
  color: #808080;
  margin-bottom: 1rem;
}
</style>