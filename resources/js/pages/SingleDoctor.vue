<template>
  <div class="singleDoctor text-white">
    <div class="container pt-5">
        <div class="row p-4 info-base">
            <!-- Contenitore: foto info di base -->
            <div class="col-sm-12 col-md-12">
                <div class="container-fluid">
                    <div class="avatar-c row d-flex">
                        <!-- Avatar -->
                        <div class="avatar col-xs-12 col-sm-6 col-md-12 col-lg-6 mt-4 align-self-start">
                            <img class="doctor-image rounded-circle mb-5 w-100" :src="user.photo ? `${user.photo}`: '/img/img-not-found.png'" />
                        </div>
                        <!-- Info di base -->
                        <div class="info-c col-sm-12 col-md-12 offset-lg-2 col-lg-4 mt-3">
                            <h1>{{ user.name }} {{ user.surname }}</h1>
                            <p><i class="fas fa-star" :class="n <= starsInReviews ? 'text-warning' : 'text-light'" v-for="n in 5" :key="n"></i></p>
                            <div v-for="specialty in user.specialties" :key="specialty.specialty_id">
                                <router-link :to="{name: 'advanced-search', params: {specialty: specialty.specialty_slug }}"><p class="badge specialty-tag px-2 mx-1 text-light">{{ specialty.specialty_name }}</p></router-link>
                                <!-- :to="{ name: 'single-user', params: { slug: sponsored_users[counter].slug } } -->
                            </div>
                            <p><strong class="text-uppercase">Email</strong><br>{{ user.email }}</p>
                            <p v-if="user.phone_number"><strong class="text-uppercase">Numero di telefono</strong><br>{{ user.phone_number }}</p>
                            <p><strong class="text-uppercase">Indirizzo</strong><br>{{ user.address }}</p>
                            <!-- Prestazioni -->
                            <div>
                                <h4 class="bd-word mt-5"><span>P</span>restazioni</h4>
                                <p v-if="user.services">{{user.services}}</p>
                                <p v-else>Nessuna prestazione segnala dal dottore</p>
                            </div>
                            <!-- / Prestazioni -->
                        </div>
                        <!-- / Info di base -->
                    </div>
                </div>
            </div>
            <!-- CV utente (con scroll) -->
            <div class="col-sm-12col-md-12 mt-3 ps-4">
                <h4 class="bd-word"><span>C</span>urriculum Vitae</h4>
                <p class="me-5 mb-5" style="max-height: 40vh; overflow-y: auto">{{ user.cv ? user.cv : 'nessun cv' }}</p>
            </div>
        </div>

        <!-- Invia messaggio e recensione -->
        <div class="row msg-rev mt-5 py-5 align-items-end">
            <!-- Invia messaggio -->
            <div class="col-sm-12 col-lg-6">
                <h4 class="bd-word"><span>C</span>ontattami</h4>
                <div class="my-3 flex-nowrap">
                  <input
                    type="text"
                    class="form-control rounded-0 rounded-top"
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
                    class="form-control rounded-0"
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
                    class="form-control rounded-0 rounded-bottom"
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
                  <button  class="btn mybtn text-light" @click="postMessage()"> <!-- :disabled="message_sent" -->
                    Invia
                  </button>
                </div>
            </div>
            <!-- Invia recensione -->
            <div class="col-sm-12 col-lg-6">
                <h4 class="mb-3">Come ti è sembrato il servizio?</h4>
                <h4 class="bd-word"><span>S</span>crivi una recensione!</h4>
                <div
                  class="mb-1"
                  :class="{
                    'border border-1 border-danger rounded-3':
                      errors.review.includes('rating'),
                  }"
                >
                  <i
                    v-for="n in 5"
                    :key="n"
                    class="fa-solid fa-star"
                    :class="rating >= n ? 'text-warning' : 'text-light'"
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
                    class="form-control rounded-0 rounded-top"
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
                    class="form-control rounded-0 rounded-bottom"
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
                  <button class="btn mybtn text-light" @click="postReview()">
                    Invia
                  </button>
                </div>
            </div>
        </div>

        <!-- Tutte le recensioni -->
        <div class="all-revs row my-5 pt-5 px-3">
          <div  v-if="user.reviews.length > 0">
            <h4 class="bd-word pt-4 pb-3 mb-5"><span>T</span>utte le recensioni</h4>
            <SingleDoctorReviews />
          </div>

          <div v-else>
            <h4 class="bd-word pt-4 pb-3 mb-5"><span>S</span>crivi per primo una recensione</h4>
          </div>

        </div>
      </div>
  </div>
</template>

<style scoped lang="scss">
    @media only screen and (max-width: 576px) {
      .avatar-c {
        display: flex;
        justify-content: center;
  
        .avatar {
          padding: 0;
          width: 250px;
          height: 250px;
          margin-bottom: 3rem;

          img {
            width: 100%;
            height: 100%;
            object-fit: cover;
          }
        }
      }

      .info-c {
        text-align: center;
        margin-bottom: 3rem;
      }
  }

  @media only screen and (max-width: 991px) {
    .avatar-c {
      
      display: flex;
      justify-content: center;

      .avatar {
        margin: auto;
        padding: 0;
        width: 300px;
        height: 300px;
        margin-bottom: 3rem;

        img {
          width: 100%;
          height: 100%;
          object-fit: cover;
        }
      }

      .info-c {
        text-align: center;
        margin-bottom: 3rem;
      }
    }
  }

  @media only screen and (max-width: 1200px) {

    .avatar-c {
      display: flex;
      justify-content: space-between;
  
        .avatar {
          padding: 0;
          width: 350px;
          height: 350px;
          margin-bottom: 3rem;

          img {
            width: 100%;
            height: 100%;
            object-fit: cover;
          }
        }
      }
            .info-c {
        margin-bottom: 3rem;
      }
  }

  @media only screen and (min-width: 1201px) {
            .avatar {
          padding: 0;
          width: 300px;
          height: 300px;
          margin-bottom: 3rem;
          margin-right: 7rem;

          img {
            width: 100%;
            height: 100%;
            object-fit: cover;
          }
            }
  }


  

  .input {
    border-radius: 0;
  }

  .bd-word {
    text-transform: uppercase;
    letter-spacing: .5rem;

    span {
      color: white;
      background-color: black;
      padding-left: .5rem;
      margin-right: .3rem;
    }
  }

  .singleDoctor {
    background-image: url('/images/bg-SingleDoctor.jpg'),
    linear-gradient(rgba(255,255,255,0.1),rgba(255,255,255,0.1));
    background-size: 100%;
    background-blend-mode: overlay;

    .container {
      .info-base {
        background-color: rgba(0,0,0,0.4);

        // .avatar {
        //   width: 20vw;
        //   height: 100%;
        //   padding: 20px;

          // .avatar img {
          //   aspect-ratio: 1 / 1;
          //   width: 100%;
          // }
          

        // .avatar img {
        //   width: 100%;
        //   height: 100%;
        //   object-fit: cover;
        //   }
        // }

        .info-c {
          overflow: auto;
        }

        .specialty-tag {
          background-color: rgba(0,0,0,0.5);
          border-radius: 0;
          font-size: .8rem;
          border: 1px solid white;
          margin-right: .5rem;
          transition: .6s;

          &:hover {
            background-color: black;
            transition: .6s;
          }
        }
      }

      .msg-rev {
        background-color: rgba(0,0,0,0.4);

        .fa-star {
          font-size: 1.7rem;
        }

        .mybtn {
          margin-top: 1rem;
          border: 1px solid white;
          padding-left: 1rem;
          border-radius: 0;
        }

        .mybtn:hover {
          background-color: rgba($color: #000000, $alpha: 1.0);
        }
      }

      .all-revs {
        background-color: rgba(0,0,0,0.4);
        
        .review {
          border: none;
        }
      }
    }

    .doctor-image {
      outline: 1px solid white;
      outline-offset: 10px;
    }
  }
</style>

<script>
import { computed } from "vue";
import SingleDoctorReviews from "../components/SingleDoctorReviews.vue";
export default {
    name: "SingleDoctor",
    components: { 
      SingleDoctorReviews 
    },
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
                }
                else {
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
                this.rating = 0;
                this.review_text = "";
                this.review_author = "";
                if (resp.data.success) {
                    this.review_sent = true;
                    this.getSingleDoctor();
                }
                else {
                    for (const key in resp.data.response) {
                        this.errors.review.push(key);
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
                this.message_author = "";
                this.message_email = "";
                this.message_text = "";
                if (resp.data.success) {
                    this.message_sent = true;
                    this.getSingleDoctor();
                }
                else {
                    for (const key in resp.data.response) {
                        this.errors.message.push(key);
                    }
                }
            });
        },
        validEmail: function (email) {
            const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        },
    },
    computed: {
        starsInReviews() {
            return Math.round(this.user.avg_rating);
        },
    },
    
};
</script>
