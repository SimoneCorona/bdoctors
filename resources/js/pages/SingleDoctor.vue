<template>
  <div class="container my-5">
    <div class="container">
      <div class="row w-60">
        <!-- container img -->
        <div class="col p-0">
          <img
            class="doctor-image rounded-circle w-50 h-60 mb-5"
            :src="user.photo ? `${user.photo}` : '/img/img-not-found.png'"
          />
          <div>
            <h4>Prestazioni:</h4>
            <p v-if="user.services">{{ user.services }}</p>
            <p v-else>Nessuna prestazione segnala dal dottore</p>
          </div>
          <!-- Wrapper recensioni -->
          <div class="reviews-wrapper row mt-5 flex-column" style="width: 90%">
            <h4>Tutte le recensioni:</h4>
            <div v-if="user.reviews && user.reviews.length > 0">
              <div
                class="mb-3 py-3 px-3 border border-info border-4 rounded-3"
                v-for="review in user.reviews"
                :key="review.id"
              >
                <h4>Autore:</h4>
                <p>{{ review.author }}</p>
                <i
                  class="fa-star"
                  :class="n <= review.rating ? 'fas' : 'far'"
                  v-for="n in 5"
                  :key="n"
                ></i>
                <p>{{ review.text_review }}</p>
              </div>
            </div>
            <p v-else>Nessuna recensione!</p>
          </div>
        </div>
        <!-- Wrapper info dottore -->
        <div class="col p-0">
          <h1>{{ user.name }} {{ user.surname }}</h1>
          <div
            v-for="specialty in user.specialties"
            :key="specialty.specialty_id"
          >
            <p class="badge rounded-pill text-bg-primary px-2 mx-1 text-light">
              {{ specialty.specialty_name }}
            </p>
          </div>
          <p><strong>Indirizzo: </strong>{{ user.address }}</p>
          <p v-if="user.phone_number">
            <strong>Numero di tel.: </strong>{{ user.phone_number }}
          </p>
          <p><strong>Email: </strong>{{ user.email }}</p>
          <p>
            <strong>Voto medio: </strong
            ><i
              class="fa-star"
              :class="n <= starsInReviews ? 'fas' : 'far'"
              v-for="n in 5"
              :key="n"
            ></i>
          </p>
          <h4 class="my-3">Curriculum Vitae:</h4>
          <p class="me-5" style="height: 65vh; overflow-y: auto">
            {{ user.cv ? user.cv : "nessun cv" }}
          </p>
        </div>

        <!-- Wrapper invio messaggi e recensioni -->
        <div class="col">
          <div class="row flex-column">
            <div class="col mb-3 py-3 border border-info border-4 rounded-3">
              <h4>Contattami:</h4>

              <div class="my-3 flex-nowrap">
                <input
                  type="text"
                  class="form-control"
                  v-model="message_author"
                  placeholder="Nome e cognome"
                  :class="{ 'is-invalid': errors.message.includes('author') }"
                  aria-label="name"
                  aria-describedby="addon-wrapping"
                />
                <div
                  v-show="errors.message.includes('author')"
                  class="text-danger"
                >
                  Inserisci il nome
                </div>
              </div>
              <div class="mb-3 flex-nowrap">
                <input
                  type="email"
                  class="form-control"
                  v-model="message_email"
                  placeholder="Email"
                  :class="{ 'is-invalid': errors.message.includes('email') }"
                  aria-label="email"
                  aria-describedby="addon-wrapping"
                />
                <div
                  v-show="errors.message.includes('email')"
                  class="text-danger"
                >
                  Inserisci un indirizzo email valido
                </div>
              </div>
              <div class="form-floating mb-3">
                <textarea
                  class="form-control"
                  v-model="message_text"
                  placeholder="Scrivi qui il tuo messaggio"
                  id="message-text"
                  style="height: 150px"
                  :class="{
                    'is-invalid': errors.message.includes('text_message'),
                  }"
                ></textarea>
                <label for="message-text">Scrivi qui il tuo messaggio</label>
                <div
                  v-show="errors.message.includes('text_message')"
                  class="text-danger"
                >
                  Inserisci un messaggio di almeno 10 caratteri
                </div>
              </div>
              <div class="d-flex align-items-center justify-content-end">
                <span v-show="message_sent" class="text-success me-2">Messaggio inviato! &#10004;</span>
                <button class="btn btn-primary" @click="postMessage()">
                  Invia
                </button>
              </div>
            </div>
            <div class="col py-3 border border-info border-4 rounded-3">
              <h4>Come ti è sembrato il servizio?</h4>
              <h5>Scrivi una recensione!</h5>
              <div
                class="d-flex justify-content-center p-2 mb-1"
                :class="{
                  'border border-1 border-danger rounded-3':
                    errors.review.includes('rating'),
                }"
              >
                <i
                  v-for="n in 5"
                  :key="n"
                  class="fa-star fs-3 rating-star"
                  :class="rating >= n ? 'fas' : 'far'"
                  @mouseover="colorStarOnHover(n)"
                  @mouseout="showClickedStar()"
                  @click="clickRating(n)"
                ></i>
              </div>
              <div
                v-show="errors.review.includes('rating')"
                class="text-danger"
              >
                Inserisci un voto da 1 a 5
              </div>
              <div class="my-3 flex-nowrap">
                <input
                  type="text"
                  class="form-control"
                  v-model="review_author"
                  placeholder="Nome e cognome"
                  :class="{ 'is-invalid': errors.review.includes('author') }"
                  aria-label="name"
                  aria-describedby="addon-wrapping"
                />
                <div
                  v-show="errors.review.includes('author')"
                  class="text-danger"
                >
                  Inserisci il nome
                </div>
              </div>
              <div class="form-floating mb-3">
                <textarea
                  class="form-control"
                  v-model="review_text"
                  placeholder="Scrivi qui il tuo messaggio"
                  id="floatingTextarea2"
                  style="height: 150px"
                ></textarea>
                <label for="floatingTextarea2"
                  >Scrivi qui la tua recensione</label
                >
              </div>
              <div class="d-flex align-items-center justify-content-end">
                <span v-show="review_sent" class="text-success me-2">Recensione inviata! &#10004;</span>
                <button class="btn btn-primary" @click="postReview()">
                  Invia
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { computed } from "vue";
export default {
  name: "SingleDoctor",
  data() {
    return {
      user: [],
      rating: 0,
      clicked_rating: 0,
      review_author: "",
      review_text: "",
      review_sent: false,
      message_author: "",
      message_email: "",
      message_text: "",
      message_sent: false,
      errors: {
        review: [],
        message: [],
      },
    };
  },
  created() {
    this.getSingleDoctor();
  },
  methods: {
    getSingleDoctor() {
      const slug = this.$route.params.slug;
      axios.get(`/api/users/${slug}`).then((resp) => {
        if (resp.data.success) {
          this.user = resp.data.results;
        } else {
          this.$router.push({ name: "not-found" });
        }
      });
    },
    colorStarOnHover(rating) {
      this.rating = rating;
    },
    showClickedStar() {
      this.rating = this.clicked_rating;
    },
    clickRating() {
      this.clicked_rating = this.rating;
    },
    postReview() {
      this.errors.review = [];
      if (this.review_author === "") {
        this.errors.review.push("author");
      }
      if (this.clicked_rating === 0) {
        this.errors.review.push("rating");
      }
      if (this.errors.review.length > 0) {
        return;
      }
      axios
        .post("/api/review", {
          user_id: this.user.id,
          author: this.review_author,
          rating: this.clicked_rating,
          text_review: this.review_text,
        })
        .then((resp) => {
          if (resp.data.success) {
            this.review_sent = true;
            this.getSingleDoctor();
          } else {
            // console.log(typeof(resp.data))
            // console.log(resp.data.response);
            for (const key in resp.data.response) {
              this.errors.review.push(key);
              // console.log(key);
            }
          }
        });
    },
    postMessage() {
      this.errors.message = [];
      if (this.message_author === "") {
        this.errors.message.push("author");
      }
      if (!this.validEmail(this.message_email)) {
        this.errors.message.push("email");
      }
      if (this.message_text.length < 10) {
        this.errors.message.push("text_message");
      }
      if (this.errors.message.length > 0) {
        return;
      }
      axios
        .post("/api/message", {
          user_id: this.user.id,
          author: this.message_author,
          email: this.message_email,
          text_message: this.message_text,
        })
        .then((resp) => {
          if (resp.data.success) {
            this.message_sent = true;
            this.getSingleDoctor();
          } else {
            for (const key in resp.data.response) {
              this.errors.message.push(key);
            }
          }
        });
    },
    validEmail: function (email) {
      var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    }
  },
  computed: {
    starsInReviews() {
      return Math.round(this.user.avg_rating);
      console.log(this.starsInReviews());
    },
  },
};
</script>

<style scoped lang="scss">
.fas {
  color: rgb(255, 242, 0);
}
</style>