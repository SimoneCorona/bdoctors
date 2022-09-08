<template>
  <div class="adv-search container-fluid back">
    <div class="container pt-4">
      <h1 class="adv-search-title text-light pt-5 mb-4">Ricerca avanzata</h1>
      <div class="container input-group mb-5">
        <div class="row w-100">
          <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-2">
            <select
              v-model="specialtySearched"
              class="form-select"
              aria-label="Selezione Specializzazione"
            >
              <option selected>Seleziona la Specializzazione</option>
              <option
                v-for="(specialty, index) in specialties"
                :key="index"
                :value="specialty.specialty_slug"
              >
                {{ specialty.specialty_name }}
              </option>
            </select>
          </div>

          <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-2">
            <select
              v-model="minAvgRating"
              class="form-select col-12"
              name="min-avg-rating"
              aria-label="Selezione voto medio minimo"
            >
              <option value="0" selected>Media voti recensioni</option>
              <option value="1">1+</option>
              <option value="2">2+</option>
              <option value="3">3+</option>
              <option value="4">4+</option>
              <option value="5">5</option>
            </select>
          </div>

          <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-2">
            <select
              v-model="minReviewCount"
              class="form-select me-4 col-12"
              name="min-avg-rating"
              aria-label="Selezione numero minimo recensioni"
            >
              <option value="0" selected>Numero minimo recensioni</option>
              <option value="1">1+</option>
              <option value="5">5+</option>
              <option value="10">10+</option>
            </select>
          </div>

          <div class="col-12 col-md-6 col-lg-4 col-xl-3">
            <button
              class="search-btn btn btn-primary text-white mb-2"
              @click="search(specialtySearched)"
            >
              Cerca
            </button>
          </div>
        </div>
      </div>
      <div v-if="totalDoctor > 0" class="text-light text-end">
        {{ totalDoctor }} Dottori
      </div>
      <Doctors :doctorsToShow="resultDoctors" />
      <div v-if="lastPage > 1">
        <nav>
          <div class="pagination justify-content-center">

            <ul
              role="menubar"
              class="pagination"
            >
              
              <li
                role="presentation"
                class="page-item"
              >
                <span
                  role="menuitem"
                  class="page-link text-dark"
                  :class="{ disabled: currentPage === 1 }"
                  @click="search(specialtySearched, currentPage === 1)"
                  >Prima pagina</span
                >
              </li>
              <li
                role="presentation"
                class="page-item "
              >
                <span
                  role="menuitem"
                  class="page-link mx-3 text-dark"
                  :class="{ disabled: currentPage === 1 }"
                  @click="search(specialtySearched, currentPage - 1)"
                  >‹</span
                >
              </li>
              
              <li role="presentation" class="page-item" v-if="currentPage - 2 > 0">
                <button
                  role="menuitemradio"
                  type="button"
                  
                  class="page-link mx-3 text-dark"
                >
                  {{currentPage - 2}}
                </button>
              </li>
              <li role="presentation" class="page-item" v-if="currentPage - 1 > 0">
                <button
                  role="menuitemradio"
                  type="button"
                  class="page-link mx-3 text-dark"
                >
                  {{currentPage - 1}}
                </button>
              </li>
              <li role="presentation" class="page-item">
                <button
                  role="menuitemradio"
                  type="button"
                  class="page-link myActive mx-3 text-dark"
                >
                  {{currentPage}}
                </button>
              </li>
              <li role="presentation" class="page-item bv-d-xs-down-none" v-if="currentPage + 1 <= lastPage">
                <button
                  role="menuitemradio"
                  type="button"
                  class="page-link mx-3 text-dark"
                >
                  {{currentPage + 1}}
                </button>
              </li>
              <li role="presentation" class="page-item bv-d-xs-down-none" v-if="currentPage + 2 <= lastPage">
                <button
                  role="menuitemradio"
                  type="button"
                  class="page-link mx-3 text-dark"
                >
                  {{currentPage + 2}}
                </button>
              </li>
              
              <li role="presentation" class="page-item">
                <button
                  role="menuitem"
                  type="button"
                  class="page-link mx-3 text-dark"
                  :class="{ disabled: currentPage === lastPage }"
                  @click="search(specialtySearched, currentPage + 1)"
                >
                  ›
                </button>
              </li>
              <li role="presentation" class="page-item">
                <button
                  role="menuitem"
                  type="button"
                  class="page-link text-dark"
                  :class="{ disabled: currentPage === lastPage }"
                  @click="search(specialtySearched, currentPage = lastPage)"
                >
                  Ultima pagina
                </button>
              </li>
            </ul>
          </div> 
        </nav>
      </div>

      <div
        v-if="resultDoctors.length === 0"
        class="text-center text-light doctorNull p-3"
      >
        Nessun medico trovato
      </div>
    </div>
  </div>
</template>
  
  <script>
import Doctors from "../components/Doctors.vue";
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
      currentPage: 1,
      lastPage: 0,
      totalDoctor: 0
    };
  },
  created() {
    this.getSpecialties();
  },
  mounted() {
    this.search(
      this.$route.params.specialty,
      this.currentPage
    );
  },
  methods: {
    search(selectedSpecialty, numberPage) {
      history.pushState({}, null, `/search/${selectedSpecialty}`);
      axios
        .get("/api/search/" + selectedSpecialty, {
          params: {
            avg_rating: this.minAvgRating,
            min_reviews: this.minReviewCount,
            page: numberPage,
          },
        })
        .then((resp) => {
          this.resultDoctors = resp.data.results.data;
          this.currentPage = resp.data.results.current_page;
          this.lastPage = resp.data.results.last_page;
          this.totalDoctor = resp.data.results.total;
        });
    },
    getSpecialties() {
      axios.get("/api/specialties").then((resp) => {
        this.specialties = resp.data.results;
      });
    },
  },
};
</script>
  
  <style lang="scss" scoped>
select {
  border-radius: 0;
}

.myActive {
  border: 5px solid black;
}

.back {
  background-image: url("/images/bg-blue.png"),
    linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5));
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
  letter-spacing: 0.5rem;
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

.doctorNull {
  background-color: rgba($color: #000000, $alpha: 0.5);
}
</style>