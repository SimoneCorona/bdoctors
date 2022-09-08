<template>
    <div v-if="reviews.success = true">
        <div class="review mb-5 px-4 pt-3 border border-1" v-for="review in reviews.data" :key="review">
            <p>{{ review.text_review}}</p>
            <i class="fas fa-star" :class="n <= review.rating  ? 'text-warning' : 'text-light'" v-for="n in 5" :key="n"></i>
            <p class="mt-3 mb-0">Pubblicato il: {{ review.created_at.slice(0, 10) }} alle ore {{ review.created_at.slice(11, 16) }}</p>
            <p><small>Scritto da: </small>{{ review.author}}</p>
        </div>
       <nav v-if="lastPage > 1"  aria-label="Page navigation example">
        <ul class="pagination d-flex justify-content-center">
          <li class="page-item">
            <button @click="(this.currentPage - 1)" :class="{ disabled: currentPage === 1 }" class="page-link bg-dark text-light m-2" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
              <span class="sr-only">Previous</span>
            </button>
          </li>
          <li v-for="(page,index) in lastPage" :key="index" class="page-item"><input class="btn-check" type="radio" id="numPage"> <a id="numPage" class="page-link text-dark m-2" href="#" @click="search(reviews ,page)">{{ page  }}</a></li> 
          <li class="page-item">
            <button @click="(this.currentPage + 1)" class="page-link text-dark m-2" :class="{ disabled: currentPage === lastPage }"    aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
              <span class="sr-only">Next</span>
            </button>
          </li>
        </ul>
      </nav>
    </div>    
    <p v-else>Nessuna recensione!</p> 
</template>

<script>
export default {
    name: "SingleDoctorReviews",
    data() {
        return {
            currentPage: 1,
            lastPage: 0,
            reviews: [],
    }
},
created() {
        this.getReviews();
},

methods: {
    getReviews() {
      const slug = this.$route.params.slug;
      axios.get(`/api/users/${slug}/reviews`).then((resp) => {
        if (resp.data.success) {
          this.reviews = resp.data.results;
        } else {
          this.$router.push({ name: "not-found" });
        }
      });
    }
}
}

</script>

<style>
.review {
          border: none;
        }
</style>