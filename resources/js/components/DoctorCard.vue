<template>
    <div class="col-12 col-sm-6 col-md-4 col-lg-3 container">
        <div class="card ms_card p-3 mb-4">
            <h3 class="mb-2 text-center">{{ user.name }} {{ user.surname }}</h3>
            <img class="doctor-image rounded-circle mx-auto d-block mb-4"
                :src="user.photo ? `/storage/${user.photo}` : '/img/img-not-found.png'" style="width: 230px" />
            <div class="mb-3" v-for="specialty in user.specialties" :key="specialty.specialty_id">
                <span class="rounded-pill bg-primary px-3 py-1 me-2 text-light">{{ specialty.specialty_name }}</span>
            </div>
            <div class="details p-1">
                <p><strong>Indirizzo: </strong>{{ user.address }}</p>
                <p v-if="user.phone_number"><strong>Numero di tel.: </strong>{{ user.phone_number }}</p>
                <p v-else><strong>Numero di tel.: </strong>Nessun recapito telefonico</p>
                <p><strong>Email: </strong>{{ user.email }}</p>
            </div>
            <router-link :to="{ name: 'single-user', params: { slug: user.slug } }">Vedi info dottore</router-link>
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
    height: 550px;
    opacity: 85%;
    ;
}

p {
    margin-bottom: 0.3rem;
}
</style>