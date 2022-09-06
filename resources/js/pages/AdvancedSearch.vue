<template>
  <div class="adv-search container-fluid back">
    <div class="container pt-4">
      <h1 class="adv-search-title text-light pt-5 mb-4">Ricerca avanzata</h1>
      <div class="container input-group mb-5">
        <div class="row w-100">
          <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-2">
            <select v-model="specialtySearched" class="form-select" aria-label="Selezione Specializzazione">
              <option selected>Seleziona la Specializzazione</option>
              <option v-for="(specialty, index) in specialties" :key="index" :value="specialty.specialty_slug">
                {{ specialty.specialty_name }}</option>
            </select>
          </div>

          <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-2">
            <select v-model="minAvgRating" class="form-select col-12" name="min-avg-rating"
              aria-label="Selezione voto medio minimo">
              <option value="0" selected>Media voti recensioni</option>
              <option value="1">1+</option>
              <option value="2">2+</option>
              <option value="3">3+</option>
              <option value="4">4+</option>
              <option value="5">5</option>
            </select>
          </div>

          <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-2">
            <select v-model="minReviewCount" class="form-select me-4 col-12" name="min-avg-rating"
              aria-label="Selezione numero minimo recensioni">
              <option value="0" selected>Numero minimo recensioni</option>
              <option value="1">1+</option>
              <option value="5">5+</option>
              <option value="10">10+</option>
            </select>
          </div>

          <div class="col-12 col-md-6 col-lg-4 col-xl-3">
            <button class="search-btn btn btn-primary text-white mb-2" @click="search(specialtySearched)">Cerca</button>
          </div>
        </div>

        </div>
      <Doctors :doctorsToShow="resultDoctors" />
    </div>

  <nav aria-label="Page navigation example d-flex">
  <ul class="pagination justify-content-center">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
    
    <li class="page-item">
      <a @click="search(currentPage + 1)" class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li>
  </ul>
</nav>
  </div>

</template>
  
  <script>
import Doctors from '../components/Doctors.vue';
import axios from "axios";

export default {
  name: "AdvancedSearch",
  components: {
    Doctors,
  },
  data() {
    return {
      specialtySearched: this.$route.params.specialty,
      minAvgRating: 0,
      minReviewCount: 0,
      specialties: [],
      resultDoctors: [],
      currentPage: 1
    }
  },
  created() {
    this.getSpecialties();
  },
  mounted() {
    this.search(this.$route.params.specialty, this.currentPage);
  },
  methods: {
    search(selectedSpecialty, doctorPage) {
      history.pushState(
        {},
        null,
        `/search/${selectedSpecialty}`
      );
      axios.get('/api/search/' + selectedSpecialty, {
        params: {
          avg_rating: this.minAvgRating,
          min_reviews: this.minReviewCount,
          page: doctorPage
        }
      })
        .then((resp) => {
          this.resultDoctors = resp.data.results;
          this.currentPage = resp.data.results.current_page;
          console.log(resp);
          
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

  select {
    border-radius: 0;
  }

  .back {
    background-image: url('/images/bg-blue.png'),
    linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5));
    background-blend-mode: overlay;
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
    border-radius: 0;
    width: 100%;
  }

  .container {
    margin: 0;
    padding: 0;
    margin: auto;
  }

    .row {
    margin: 0;
    padding: 0;
    margin: auto;
  }
  </style>