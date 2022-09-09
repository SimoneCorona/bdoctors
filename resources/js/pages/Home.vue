<template>
  <div class="test container-fluid pb-5">
    <!-- <h1 class="text-center">BDoctors</h1> -->
    <div class="jumbotron row row-cols-2 justify-content-center">
      <div class="col align-self-center mt-5 pt-5">
        <div class="input-group">
          <select v-model="selectedSpecialty" class="form-select" aria-label="Cerca per specializzazione">
            <option disabled selected value="0"></option>
            <option v-for="(specialty, index) in specialties" :key="index" :value="specialty.specialty_slug">{{ specialty.specialty_name }}</option>
          </select>
          <router-link class="style-btn btn text-uppercase bg-dark text-light text-center px-3 pe"
          :to="{name: 'advanced-search', params: {specialty: selectedSpecialty }}"
          :class="{disabled: selectedSpecialty === ''}"><b>Cerca</b></router-link> 
        </div>
      </div>
    </div>

    <!-- <p>{{ sponsored_users }}</p> -->

    <SponsoredSlider />



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
import axios from 'axios';
// import Doctors from '../components/Doctors.vue';
// import Banner from '../components/Banner.vue';
import SponsoredSlider from '../components/SponsoredSlider.vue';

export default {
    name: "Home",
    components: { 
        // Doctors, 
        // Banner,
        SponsoredSlider,
    },
    data(){
      return {
        specialties : '',
        selectedSpecialty: '',
      }
    },
    created() {
        this.getSpecialties();

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
    }
}
</script>

<style lang="scss" scoped>
    .test {
        background-image: url("/images/bg-blue.png"),
          linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.3));
        background-blend-mode: overlay;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .jumbotron {
      height: 60vh;
      background: linear-gradient(to top, #ffffff88, #00000088),  url('/images/jumbo.webp');
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
      border-bottom:5px solid black;
    }

    .style-btn {
      letter-spacing: .3rem;
    }

    select {
      border-radius: 0;
    }
</style>