<template>
  <div class="container-fluid">
    <h1 class="text-center">BDoctors</h1>
    <div class="jumbotron row row-cols-2 justify-content-center">
      <div class="col align-self-center">
        <div class="input-group">
          <select v-model="selectedSpecialty" class="form-select" aria-label="Cerca per specializzazione">
            <option selected disabled></option>
            <option v-for="(specialty, index) in specialties" :key="index" :value="specialty.specialty_slug">{{specialty.specialty_name}}</option>
          </select>
          <router-link class="btn btn-primary text-light" :to="{name: 'advanced-search', params: {specialty: selectedSpecialty }}">Cerca</router-link> 
        </div>
      </div>
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

<style lang="scss" scoped>
    .jumbotron {
      height: 60vh;
      background: linear-gradient(to top, #00000088, #00000088),  url('/img/jumbotron.png');
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
    }
</style>