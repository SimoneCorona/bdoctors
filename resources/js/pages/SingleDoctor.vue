<template>
    <div class="container mt-5">
        <div class="row">
            <!-- Contenitore: foto info di base -->
            <div class="col-6">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Avatar -->
                        <div class="col-6">
                            <img class="doctor-image rounded-circle mb-5 w-100" :src="user.photo ? `${user.photo}`: '/img/img-not-found.png'" />
                        </div>
                        <!-- Info di base -->
                        <div class="col-6">
                            <h1>{{ user.name }} {{ user.surname }}</h1>
                            <p><i class="fa-star" :class="n <= starsInReviews ? 'fas' : 'far'" v-for="n in 5" :key="n"></i></p>
                            <div v-for="specialty in user.specialties" :key="specialty.specialty_id">
                                <p class="badge rounded-pill text-bg-primary px-2 mx-1 text-light">{{ specialty.specialty_name }}</p>
                            </div>
                            <p><strong>Email: </strong>{{ user.email }}</p>
                            <p v-if="user.phone_number"><strong>Numero di tel.: </strong>{{ user.phone_number }}</p>
                            <p><strong>Indirizzo: </strong>{{ user.address }}</p>
                            <!-- Prestazioni -->
                            <div>
                                <h4>Prestazioni:</h4>
                                <p v-if="user.services">{{user.services}}</p>
                                <p v-else>Nessuna prestazione segnala dal dottore</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- CV utente (con scroll) -->
            <div class="col-6">
                <h4 class="">Curriculum Vitae:</h4>
                <p class="me-5 mb-5" style="max-height: 40vh; overflow-y: auto">{{ user.cv ? user.cv : 'nessun cv' }}</p>
            </div>
        </div>

        <!-- Invia messaggio e recensione -->
        <div class="row">
            <!-- Invia messaggio -->
            <div class="col-6">
                <h4>Contattami:</h4>
                    <form class="d- flex flex-column" action="">
                    <div class="input-group my-3 flex-nowrap">
                        <input type="text" class="form-control" placeholder="Nome" aria-label="name" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group mb-3 flex-nowrap">
                        <input type="text" class="form-control" placeholder="Cognome" aria-label="surname" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group mb-3 flex-nowrap">
                    <input type="text" class="form-control" placeholder="Email" aria-label="surname" aria-describedby="addon-wrapping">
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Scrivi qui il tuo messaggio" id="floatingTextarea2" style="height: 150px"></textarea>
                        <label for="floatingTextarea2">Scrivi qui il tuo messaggio</label>
                    </div>
                </form>
            </div>
            <!-- Invia recensione -->
            <div class="col-6">
                <h4>Come ti è sembrato il servizio?</h4>
                <h5>Scrivi una recensione!</h5>
                <div class="d-flex justify-content-center p-2 mb-1" :class="{'border border-1 border-danger rounded-3': errors.review.includes('rating')}" >
                    <i v-for="n in 5"
                    :key="n"
                    class="fa-star fs-3 rating-star"
                    :class="rating >= n ? 'fas' : 'far' "
                    @mouseover="colorStarOnHover(n)"
                    @mouseout="showClickedStar()"
                    @click="clickRating(n)"></i>
                </div>
                <div v-show="errors.review.includes('rating')" class="text-danger">Inserisci un voto da 1 a 5</div>
                    <div class="my-3 flex-nowrap">
                        <input type="text" class="form-control"
                        v-model="review_author" placeholder="Nome e cognome"
                        :class="{'is-invalid': errors.review.includes('author')}"
                        aria-label="name" aria-describedby="addon-wrapping">
                    <div v-show="errors.review.includes('author')" class="text-danger">Inserisci il nome</div>
                </div>
                <div class="form-floating mb-3">
                    <textarea class="form-control" v-model="review_text" placeholder="Scrivi qui il tuo messaggio" id="floatingTextarea2" style="height: 178px"></textarea>
                    <label for="floatingTextarea2">Scrivi qui la tua recensione</label>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary text-light" @click="postReview()">Invia</button>
                    </div>
            </div>
        </div>

        <!-- Tutte le recensioni -->
        <div class="row my-5">
            <h4>Tutte le recensioni:</h4>
            <div v-if="user.reviews && user.reviews.length > 0">
                <div class="mb-3 py-3 px-3 border border-info border-4 rounded-3" v-for="review in user.reviews" :key="review.id">
                    <h4>Autore:</h4>
                    <p>{{ review.author }}</p>
                        <i class="fa-star" :class="n <= review.rating  ? 'fas' : 'far'" v-for="n in 5" :key="n"></i>
                    <p>{{ review.text_review }}</p>
                </div>
            </div>
            <p v-else>Nessuna recensione!</p>
        </div>
    </div>
</template>

<script>
import { computed } from 'vue';
export default {
    name: 'SingleDoctor',
    data() {
        return {
            user: [],
            rating: 0,
            clicked_rating: 0,
            review_author:'',
            review_text:'',
            errors: {
                review: [],
                message: []
            }
        }    
    },
    created() {
        this.getSingleDoctor();
    },
    methods: {
        getSingleDoctor() {
            const slug = this.$route.params.slug;
             axios.get(`/api/users/${slug}`)
             .then((resp) => {
            if (resp.data.success) {
                this.user = resp.data.results;
            } else {
                this.$router.push({name: 'not-found'});
            }  
            })
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
            if (this.review_author === '') {
                this.errors.review.push('author');
            } 
            if (this.clicked_rating === 0) {
                this.errors.review.push('rating');
            }
            if (this.errors.review.length > 0) {
                return
            }
            axios.post('/api/review',{
                user_id: this.user.id,
                author: this.review_author,
                rating: this.clicked_rating,
                text_review: this.review_text,
            })
             .then((resp) => {
            if (resp.data.success) {
                this.getSingleDoctor();
            } else {
                // this.$router.push({name: ''});
                // console.log(typeof(resp.data))
                // console.log(resp.data.response);
                for (const key in resp.data.response) {
                    this.errors.review.push(key);
                    // console.log(key);
                }
            }  
            })
        },
        
    },
    computed: {
        starsInReviews () {
            return Math.round(this.user.avg_rating)
            console.log(this.starsInReviews())
        }
    }
};
</script>

<style scoped lang="scss">
.fas{
    color: rgb(255, 242, 0);
}
</style>