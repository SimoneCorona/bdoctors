<template>
  <div class="container">
    <h1>Pagina Home</h1>
    <Banner @startSearchDoctors="search($event)"/>
    <Doctors />
  </div>
</template>

<script>
import Doctors from '../components/Doctors.vue';
import Banner from '../components/Banner.vue';
// import axios from "axios";

export default {
    name: "Home",
    components: { 
        Doctors, 
        Banner,
    },
    // data(){
    // return {
    //   specialtyArraySeached : [],
    //   }
    // },
    // methods: {
    //   search() {
    //          axios.get('/api/specialties')
    //          .then((resp) => {
    //             this.specialtyArraySeached = resp.data.results;
    //             console.log(resp.data.results)
    //         })
    //     },
    // }
}
</script>

<style>
</style>