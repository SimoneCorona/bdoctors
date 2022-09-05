<template>
  <div class="adv-search container-fluid back">
    <div class="container pt-4">
      <h1 class="adv-search-title text-light pt-5">Ricerca avanzata</h1>
      <div class="input-group mb-5">
        <select v-model="specialtySearched" class="form-select me-4" aria-label="Selezione Specializzazione">
          <option selected>Seleziona la Specializzazione</option>
          <option v-for="(specialty, index) in specialties" :key="index" :value="specialty.specialty_slug">
            {{ specialty.specialty_name }}</option>
        </select>
        <select v-model="minAvgRating" class="form-select me-4" name="min-avg-rating"
          aria-label="Selezione voto medio minimo">
          <option value="0" selected>Media voti recensioni</option>
          <option value="1">1+</option>
          <option value="2">2+</option>
          <option value="3">3+</option>
          <option value="4">4+</option>
          <option value="5">5</option>
        </select>
        <select v-model="minReviewCount" class="form-select me-4" name="min-avg-rating"
          aria-label="Selezione numero minimo recensioni">
          <option value="0" selected>Numero minimo recensioni</option>
          <option value="1">1+</option>
          <option value="5">5+</option>
          <option value="10">10+</option>
        </select>
        <button class="search-btn btn btn-primary text-white" @click="search(specialtySearched)">Cerca</button>
      </div>
      <Doctors :doctorsToShow="resultDoctors" />
    </div>

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
  data() {
    return {
      specialtySearched: this.$route.params.specialty,
      minAvgRating: 0,
      minReviewCount: 0,
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
      axios.get('/api/search/' + selectedSpecialty, {
        params: {
          avg_rating: this.minAvgRating,
          min_reviews: this.minReviewCount,
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
  
  <style lang="scss" scoped>

  .back {
    background-image: url('/images/bg-blue.png'),
    linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5));
    background-blend-mode: overlay;;
    background-repeat: no-repeat;
    background-size: cover;
  }

  .adv-search-title {
    text-transform: uppercase;
    letter-spacing: 1rem;
    font-size: 1.8rem;
  }

  .search-btn {
    text-transform: uppercase;
    letter-spacing: .5rem;
    padding-left: 1rem;
    background-color: black;
    border: 1px solid white;
  }
  </style>