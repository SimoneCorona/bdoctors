<template>
    <div class="col-12 col-md-6 col-lg-4 col-xl-3 container mb-5 pb-5">
        <div class="card ms_card p-3 mb-4 pt-0 h-100">
            <div class="card-top">
                <img class="doctor-image rounded-circle mx-auto d-block mb-4"
                    :src="user.photo ? `/storage/${user.photo}` : '/img/img-not-found.png'" style="width: 65%" />
                <h3 class="mb-2 text-center">{{ user.name }} {{ user.surname }}</h3>
                <div class="mb-3" v-for="specialty in user.specialties" :key="specialty.specialty_id">
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
}
</script>

<style lang="scss" scoped>

.ms_card {
    overflow: scroll;
    background-color: rgba($color: #000000, $alpha: 0.5);
    border-radius: 0;

    .card-top {
        height: calc(100% - 2rem);

        img {
            outline: 1px solid white;
            outline-offset: 10px;
            margin-top: 2rem;
        }

        h3 {
            color: white;
            text-transform: uppercase;
            letter-spacing: .4rem;
            padding-bottom: 1rem;
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