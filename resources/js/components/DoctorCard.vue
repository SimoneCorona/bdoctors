<template>
    <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-5 pb-5">
        <div class="card ms_card p-3 mb-4 pt-0 h-100">
            <div class="card-top">
                <img class="doctor-image rounded-circle mx-auto d-block mb-4"
                    :src="user.photo ? `/storage/${user.photo}` : '/img/img-not-found.png'" style="width: 65%" />
                <p class="stars text-center"><i class="fas fa-star" :class="n <= starsInReviews ? 'text-warning' : 'text-muted'" v-for="n in 5" :key="n"></i></p>
                <h3 class="text-center">{{ user.name }} {{ user.surname }}</h3>
                <div class="mb-3 text-center" v-for="specialty in user.specialties" :key="specialty.specialty_id">
                    <div class="px-3 py-1 me-2 text-light">{{ specialty.specialty_name }}</div>
                </div>
                <div class="details p-1">
                    <p><strong>Indirizzo: </strong>{{ user.address }}</p>
                    <p v-if="user.phone_number"><strong>Numero di tel.: </strong>{{ user.phone_number }}</p>
                    <p v-else><strong>Numero di tel.: </strong>Nessun recapito telefonico</p>
                    <p><strong>Email: </strong>{{ user.email }}</p>
                </div>
            </div>
            <div class="card-bottom">
                <router-link class="text-light text-uppercase" :to="{ name: 'single-user', params: { slug: user.slug } }">Vedi info dottore</router-link>
            </div>
        </div>
        
    </div>
</template>

<script>
export default {
    name: 'DoctorCard',
    props: {
        user: Object,
    },
    computed: {
        starsInReviews() {
        return Math.round(this.user.reviews_avg_rating);
    },
  },
}
</script>

<style lang="scss" scoped>

.ms_card {
    background-color: rgba($color: #000000, $alpha: 0.5);
    border-radius: 0;

    .card-top {
        height: calc(100% - 2rem);

        img {
            outline: 1px solid white;
            outline-offset: 10px;
            margin-top: 2rem;
        }

        .stars {
            font-size: 1.5rem;
        }

        h3 {
            color: white;
            text-transform: uppercase;
            letter-spacing: .4rem;
        }

        p {
            color: white;
        }

        div {
            padding: .3rem;

            div {
                background-color: black;
                border: 1px solid white;
                letter-spacing: .2rem;
                display: inline-block;
            }
        }

        .details {

            p {
                margin-bottom: 0.3rem;
            }
        }
    }
        
    .card-bottom {
        height: 2rem;
        line-height: 2rem;
        text-align: end;
    }
}

</style>