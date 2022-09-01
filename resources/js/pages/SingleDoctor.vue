<template>
    <div class="container">
        <div class="container">
                <div class="row w-60 bg-danger">
                    <!-- container img -->
                    <div class="col p-0">
                        <img class="doctor-image rounded-circle w-50 h-60" :src="user.photo ? `${user.photo}`: '/img/img-not-found.png'" />
                    </div>

                    <!-- Wrapper info dottore -->
                    <div class="col p-0">
                        <h1>{{ user.name }} {{ user.surname }}</h1>
                        <div v-for="specialty in user.specialties" :key="specialty.specialty_id">
                            <p class="rounded-pill bg-primary px-2 mx-1 text-light">{{ specialty.specialty_name }}</p>
                        </div>
                        <p><strong>Indirizzo: </strong>{{ user.address }}</p>
                        <p><strong>Numero di tel.: </strong>{{ user.phone_number }}</p>
                        <p><strong>Email: </strong>{{ user.email }}</p>
                        <h4>Curriculum Vitae:</h4>
                        <p>{{ user.cv ? user.cv : 'nessun cv' }}</p>
                    </div>

                    <!-- Wrapper invio messaggi e recensioni -->
                    <div class="col">
                        <div class="row flex-column bg-success">
                            <div class="col">
                                Invia messaggio
                            </div>
                            <div class="col">
                                Invia recensione
                            </div> 
                        </div>
                    </div>    
                </div>

            <!-- Wrapper recensioni -->
                <div class="row w-35 flex-column bg-warning">
                    <div v-for="review in user.reviews" :key="review.id">
                        <p>{{ review.author }}: {{ review.rating }} stelle</p>
                        <p>{{ review.text_review }}</p>
                    </div>
                </div>
            </div>
    </div>
</template>

<script>
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
    }
};
</script>

<style>

</style>