<template>
    <div class="container">
      <h1>Ricerca Avanzata</h1>
      <Banner/>
      <!-- <Banner @search="search($event)"/> -->
      <Doctors :doctorsToShow="resultDoctors"/>
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
            resultDoctors: [],
        }
      },
      mounted() {
        this.search(this.$route.params.specialty);
    },
      methods: {
        search(selectedSpecialty) {
              //console.log(searchedSpecialty);
               axios.get('/api/search/'+ selectedSpecialty)
               .then((resp) => {
                  this.resultDoctors = resp.data.results;
              })
              
              }

               
          },
        // getDoctors() {
        //     axios.get('/api/users').then((resp) => {
                
        //         this.doctor = resp.data.results;
        //     })
        // }
    }
  </script>
  
  <style>
  </style>