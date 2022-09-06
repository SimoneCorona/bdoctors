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

    <!-- <div class="sponsorship container mt-5">
      <h2 class="mb-5"><span class="first-letter">M</span>edici in evidenza</h2>
      <div class="slider container-fluid">
        <div class="row d-flex align-items-center h-100">
          <div class="col-3">
            <div class="prev small-circle">
              <img src="img/img-not-found.png" alt="">
            </div>
          </div>
          <div class="col-6 d-flex justify-content-center">
            
          </div>
          <div class="col-3 d-flex justify-content-end">
            <div class="next small-circle">
              <img src="img/img-not-found.png" alt="">
            </div>
          </div>
        </div>
      </div>
    </div> -->

    <!-- INIZIO SLIDER CONTAINER -->
    <div class="sponsorship container overflow-hidden mt-5">
      <!-- TITOLO SLIDER -->
      <h2 class="mb-5 pb-5"><span class="first-letter">M</span>edici in evidenza</h2>
      <!-- INIZIO SLIDER -->
      <div class="container-fluid">
        <div class="row d-flex align-items-center">
          <!-- BOTTONE PREV -->
          <div class="col-3">
            <div class="small-circle prev">
              <img src="img/img-not-found.png" alt="">
            </div>
          </div>
          <!-- / BOTTONE PREV -->
          <div class="col-6 d-flex justify-content-center">
            <!-- CARD CHE SI GIRA -->
            <div class="mycard">
              <div class="mycard__inner">
                <!-- FRONTE -->
                <div class="mycard__front">
                  <img src="img/img-not-found.png" alt="">
                </div>
                <!-- RETRO -->
                <div class="mycard__back">
                  <h2>
                    Sono il retro
                  </h2>
                </div>
              </div>
            </div>
          </div>
          <!-- / CARD CHE SI GIRA -->

          <!-- BOTTONE NEXT -->
          <div class="col-3">
            <div class="small-circle next">
              <img src="img/img-not-found.png" alt="">
            </div>
          </div>
          <!-- / BOTTONE NEXT -->
        </div>
      </div>
    </div>
    <!-- FINE SLIDER CONTAINER -->


    <!-- <div class="mycard">
      <div class="mycard__inner">
        <div class="mycard__front">
          <img src="img/img-not-found.png" alt="">
        </div>
        <div class="mycard__back">
          <h2>
            Sono il retro
          </h2>
        </div>
      </div>
    </div> -->


    <!-- medici prove -->
    <div class="medici-prove container">
      <ul>
        <li v-for="(doc, index) in sponsored_users" :key="index">
          {{ doc.name }} {{ doc.surname }}
        </li>
      </ul>
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
        sponsored_users: [],
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
        axios.get('/api/sponsored-users')
        .then((resp) => {
          this.sponsored_users = resp.data.results.data;
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

      // .slider {
      //   width: 100%;
      //   height: 500px;
      //   border-right: 3px solid black;
      //   border-left: 3px solid black;
      //   margin-bottom: 4rem;

      //   .row {
      //     div {
      //       overflow: hidden;
      //       height: 100%;
      //       padding: 0;
      //       display:flex;
      //       align-items: center;

      //       .prev {
      //         translate: -50%;
      //       }

      //       .next {
      //         translate: 50%;
      //       }
      //     }
      //   }
      // }
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

    .small-circle {
      width: 20vw;
      max-width: 300px;
      height: 20vw;
      max-height: 300px;
      outline: 3px solid black;
      outline-offset: 10px;
      border-radius: 50%;
      overflow: hidden;
      cursor: pointer;

      img {
        width: 100%;
        object-fit: cover;
        transition: .4s;
      }

      img:hover {
        transform: scale(110%);
        transition: .4s;
      }
    }

    .next {
      translate: 55%;
    }
    
    .prev {
      translate: -55%;
    }

    .mycard {
      width: 30vw;
      max-width: 460px;
      height: 30vw;
      max-height: 450px;
      border-radius: 50%;
      outline: 5px solid black;
      outline-offset: 15px;
      perspective: 300px;
      
      &:hover .mycard__inner {
        transform: rotateY(180deg);
      }

      &__inner {
        width: 100%;
        height: 100%;
        position: relative;
        background-color: rgba($color: #000000, $alpha: .5);
        color: white;
        transform-style: preserve-3d;
        transition: transform 1s;
        border-radius: 50%;

        img {
          width: 100%;
          border-radius: 50%;
        }
      }

      &__front, &__back {
        width: 100%;
        height: 100%;
        position: absolute;
        backface-visibility: hidden;
        overflow: hidden;
        border-radius: 50%;
      }

      &__back {
        transform: rotateY(180deg);
        display: flex;
        justify-content: center;
        align-items: center;
      }
    }
</style>