<template>
    <div class="container">
      <h1>Ricerca Avanzata</h1>
    <div class="input-group">
      <select v-model="specialtySearched" class="form-select" aria-label="Default select example">
        <option selected>Open this select menu</option>
        <option v-for="(specialty, index) in specialties" :key="index" :value="specialty.specialty_slug">{{specialty.specialty_name}}</option>
      </select>
      <button class="btn btn-primary text-white" @click="search(specialtySearched)">Avvia ricerca per specializzazione</button>
    </div>
      <Doctors :doctorsToShow="resultDoctors"/>
    </div>
  </template>
  
  <script>
  import Doctors from '../components/Doctors.vue';
  //import Banner from '../components/Banner.vue';
  import axios from "axios";
  
  export default {
      name: "AdvancedSearch",
      components: { 
          Doctors, 
          //Banner,
      },
      data(){
        return {
            specialtySearched : this.$route.params.specialty,
            specialties: [],
            resultDoctors: [],
        }
      },
      created() {
        this.getSpecialties();
      },
      mounted() {
        this.search(this.$route.params.specialty);
    },
      methods: {
        search(selectedSpecialty) {
              history.pushState(
                    {},
                    null,
                    `/search/${selectedSpecialty}`
                  );
               axios.get('/api/search/'+ selectedSpecialty, {
                params: {
                avg_rating: 0,
                review_count: 0,
              }
            })
               .then((resp) => {
                  this.resultDoctors = resp.data.results;
              })
              
              },
              getSpecialties() {
             axios.get('/api/specialties')
             .then((resp) => {
                this.specialties = resp.data.results;
            })
        },
          },
          
    }
  </script>
  
  <style>
  </style>