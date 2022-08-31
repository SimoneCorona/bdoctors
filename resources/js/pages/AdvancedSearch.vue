<template>
    <div class="container">
      <h1>Ricerca Avanzata</h1>
      <Banner @search="search($event)"/>
      <Doctors :specialtySearched="specialtySearched"/>
    </div>
  </template>
  
  <script>
  import Doctors from '../components/Doctors.vue';
  import Banner from '../components/Banner.vue';
  import axios from "axios";
  
  export default {
      name: "AdvancedSearch",
      components: { 
          Doctors, 
          Banner,
      },
      data(){
        return {
            specialtySearched : this.$route.params.specialty,
        }
      },
      methods: {
        search(searchedSpecialty) {
              console.log(searchedSpecialty);
              //  axios.get('/api/users')
              //  .then((resp) => {
              //     this.specialtySearched = resp.data.results;
              //     console.log(resp.data.results)
              // })
          },
      }
  }
  </script>
  
  <style>
  </style>