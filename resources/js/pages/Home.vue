<template>
  <div class="container">
    <h1>Pagina Home</h1>
    <div class="form-control">
      <select v-model="selectedSpecialty" class="form-select" aria-label="Cerca per specializzazione">
        <option selected>Open this select menu</option>
        <option v-for="(specialty, index) in specialties" :key="index" :value="specialty.specialty_slug">{{specialty.specialty_name}}</option>
      </select>
      <router-link class="btn btn-primary" :to="{name: 'advanced-search', params: {specialty: selectedSpecialty }}">Cerca</router-link> 
    </div>
  </div>
</template>

<script>
// import Doctors from '../components/Doctors.vue';
// import Banner from '../components/Banner.vue';
import axios from "axios";

export default {
    name: "Home",
    components: { 
        // Doctors, 
        // Banner,
    },
    data(){
      return {
        specialties : '',
        selectedSpecialty: '',
      }
    },
    created() {
        this.getSpecialties();
    },
    methods: {
      getSpecialties() {
             axios.get('/api/specialties')
             .then((resp) => {
                this.specialties = resp.data.results;
            })
        },
    }
}
</script>

<style>
</style>