<template>
  <div>
    <Header />
    <h1>Pagina iniziale appena apri il sito (questo elemento apparirà su ogni pagina del front office)</h1>
    <div class="jumbotron">
      <img :src="require('/public/img/jumbotron.jpg')" alt="">
    </div>  
    <router-view></router-view>
  </div>
</template>

<script>
import Header from "../components/Header.vue";
export default {
    name: 'App',
    components:{
      Header
    }
}
</script>

<style>
.jumbotron img{
  width: 100%;
}
</style>