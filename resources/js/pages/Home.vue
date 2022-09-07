<template>
  <div class="test container-fluid">
    <!-- <h1 class="text-center">BDoctors</h1> -->
    <div class="jumbotron row row-cols-2 justify-content-center">
      <div class="col align-self-center mt-5 pt-5">
        <div class="input-group">
          <select v-model="selectedSpecialty" class="form-select" aria-label="Cerca per specializzazione">
            <option selected value="0"></option>
            <option v-for="(specialty, index) in specialties" :key="index" :value="specialty.specialty_slug">{{ specialty.specialty_name }}</option>
          </select>
          <router-link class="mybtn text-light ps-3 pe-2" :to="{name: 'advanced-search', params: {specialty: selectedSpecialty }}"><b>cerca</b></router-link> 
        </div>
      </div>
    </div>

    <!-- <SponsoredSlider /> -->

    <!-- MEDICI IN EVIDENZA -->
    <!-- <div class="medici-prove container">
      <ul>
        <li v-for="(doc, index) in sponsored_users" :key="index">
          {{ doc.name }} {{ doc.surname }}
        </li>
      </ul>
    </div> -->
    <!-- / MEDICI IN EVIDENZA -->
  </div>
</template>

<script>
// import Doctors from '../components/Doctors.vue';
// import Banner from '../components/Banner.vue';
// import DoctorCard from '../components/SponsoredSlider.vue';
import axios from "axios";

export default {
    name: "Home",
    components: { 
        // Doctors, 
        // Banner,
        // SponsoredSlider,
    },
    data(){
      return {
        specialties : '',
        selectedSpecialty: '',
        sponsorships: [],
        sponsored_users: [],
        counter: '',
        prev: '',
        next: '',
      }
    },
    created() {
        this.getSpecialties();
        this.getSponsorships();
        this.counter = 0;
        this.prev = -1;
        this.next = 1;
        // setInterval(()=> {
        //   if (this.counter >= this.sponsored_users.length - 1) {
        //     this.counter = 0;
        //   } else {
        //     this.counter++;
        //   }
        // }, 5000)
    },
    methods: {
      getSpecialties() {
        axios.get('/api/specialties')
        .then((resp) => {
          this.specialties = resp.data.results;
        })
      },

      getSponsorships() {
        axios.get('/api/sponsored-users')
        .then((resp) => {
          this.sponsored_users = resp.data.results.data;
        })
      },


    }
}
</script>

<style lang="scss" scoped>
    .test {
      background-color: cadetblue;
    }
    .jumbotron {
      height: 60vh;
      background: linear-gradient(to top, #ffffff88, #00000088),  url('/images/jumbo.webp');
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
    }
    .sponsorship {
      padding-top: 50px;
      padding-bottom: 70px;
      border-right: 3px solid black;
      border-left: 3px solid black;
      h2 {
        text-transform: uppercase;
        letter-spacing: .5rem;
        text-align: center;
        .first-letter {
          display: inline-block;
          color: white;
          background-color: black;
          padding-left: .5rem;
          margin-right: .3rem;
          margin-left: .5rem;
        }
      }
    }
    .mybtn {
      background-color: #000000;
      text-decoration: none;
      display: flex;
      align-items: center;
    }
    select {
      border-radius: 0;
    }
</style>