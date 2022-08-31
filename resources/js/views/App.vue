<template>
  <div>
    <Header />
    <router-view></router-view>
    <Footer />
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