<template>
  <div class="test container-fluid">
    <!-- <h1 class="text-center">BDoctors</h1> -->
    <div class="jumbotron row row-cols-2 justify-content-center">
      <div class="col align-self-center mt-5 pt-5">
        <div class="input-group">
          <select v-model="selectedSpecialty" class="form-select" aria-label="Cerca per specializzazione">
            <option selected disabled></option>
            <option v-for="(specialty, index) in specialties" :key="index" :value="specialty.specialty_slug">{{specialty.specialty_name}}</option>
          </select>
          <router-link class="mybtn btn btn-light text-light" :to="{name: 'advanced-search', params: {specialty: selectedSpecialty }}"><b>cerca</b></router-link> 
        </div>
      </div>
    </div>

    <div class="sponsorship container mt-5">
      <h2 class="mb-5"><span class="first-letter">M</span>edici in evidenza</h2>
      <div class="row">
        <div class="card" v-for="user in sponsorships.user_sponsorships" :key="user.id">
          <div class="mydiv">
            span
          </div>
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
        sponsorships: [],
      }
    },
    created() {
        this.getSpecialties();
        this.getSponsorships();
    },
    methods: {
      getSpecialties() {
             axios.get('/api/specialties')
             .then((resp) => {
                this.specialties = resp.data.results;
            })
        },
            getSponsorships() {
             axios.get('/api/sponsorships')
             .then((resp) => {
                this.sponsorships.sponsorship_user = resp.data.results;
            })
        },
    }
}
</script>

<style lang="scss" scoped>
    .jumbotron {
      height: 60vh;
      background: linear-gradient(to top, #ffffff88, #00000088),  url('/images/jumbo.webp');
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
    }

    .sponsorship {
      h2 {
        text-transform: uppercase;
        letter-spacing: .5rem;

        .first-letter {
          display: inline-block;
          background-color: black;
          color: white;
          padding-left: .5rem;
          margin-right: .3rem;
          margin-left: .5rem;
        }
      }

      .row {
        width: 100%;
        height: 300px;
        background-color: darkcyan;
      }
    }

    .mybtn {
      background-color: #000000;
    }
</style>