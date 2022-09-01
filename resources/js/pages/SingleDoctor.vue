<template>
    <div class="container my-5">
        <div class="container">
                <div class="row w-60">
                    <!-- container img -->
                    <div class="col p-0">
                        <img class="doctor-image rounded-circle w-50 h-60 mb-5" :src="user.photo ? `${user.photo}`: '/img/img-not-found.png'" />
                        <div>
                            <h4>Prestazioni:</h4>
                            <p v-if="user.services">{{user.services}}</p>
                            <p v-else>Nessuna prestazione segnala dal dottore</p>
                        </div>
                        <!-- Wrapper recensioni -->
                        <div class="reviews-wrapper row mt-5 flex-column" style="width: 95%">
                            <h4>Tutte le recensioni:</h4>
                            <div class="mb-3 py-3 border border-info border-4 rounded-3" v-for="review in user.reviews" :key="review.id">
                                <h4>Autore:</h4>
                                <p>{{ review.author }}: {{ review.rating }} stelle</p>
                                <!-- <i class="fa-star" :class="n <= starsInReviews ? 'fas' : 'far'" v-for="n in 5" :key="n"></i>  -->
                                <p>{{ review.text_review }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Wrapper info dottore -->
                    <div class="col p-0">
                        <h1>{{ user.name }} {{ user.surname }}</h1>
                        <div v-for="specialty in user.specialties" :key="specialty.specialty_id">
                            <p class="rounded-pill px-2 mx-1 text-light">{{ specialty.specialty_name }}</p>
                        </div>
                        <p><strong>Indirizzo: </strong>{{ user.address }}</p>
                        <p v-if="user.phone_number"><strong>Numero di tel.: </strong>{{ user.phone_number }}</p>
                        <p><strong>Email: </strong>{{ user.email }}</p>
                        <p><strong>Voto medio: </strong>{{ user.avg_rating }}</p>
                        <h4 class="my-3">Curriculum Vitae:</h4>
                        <p>{{ user.cv ? user.cv : 'nessun cv' }}</p>
                    </div>

                    <!-- Wrapper invio messaggi e recensioni -->
                    <div class="col">
                        <div class="row flex-column">
                            <div class="col mb-3 py-3 border border-info border-4 rounded-3">
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
                            <div class="col py-3 border border-info border-4 rounded-3">
                                <h4>Come ti è sembrato il servizio?</h4>
                                <!-- <i class="fa-star" :class="n <= starsInReviews ? 'fas' : 'far'" v-for="n in 5" :key="n"></i> -->
                                <h5>Scrivigli/le una recensione!</h5>
                                <div class="input-group my-3 flex-nowrap">
                                    <input type="text" class="form-control" placeholder="Nome" aria-label="name" aria-describedby="addon-wrapping">
                                </div>
                                <div class="input-group mb-3 flex-nowrap">
                                    <input type="text" class="form-control" placeholder="Cognome" aria-label="surname" aria-describedby="addon-wrapping">
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" placeholder="Scrivi qui il tuo messaggio" id="floatingTextarea2" style="height: 150px"></textarea>
                                    <label for="floatingTextarea2">Scrivi qui la tua recensione</label>
                                </div>
                            </div> 
                        </div>
                    </div>    
                </div>

            
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
        }
    },
    // computed: {
    //     starsInReviews () {
    //         return Math.ceil(this.user.review[rating])
    //     }
    // }
};
</script>

<style scoped lang="scss">
// .reviews-wrapper{
//     div {
//         p{
//         .fas{
//             color: rgba(255, 255, 0, 0.762);
//         }
//         }
//     }
// }

</style>