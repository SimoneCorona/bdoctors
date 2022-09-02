<template>
  <div class="col">
      <div class="card p-3 mb-4">
            <h3 class="mb-0 text-center">{{ user.name }}</h3>
            <h3 class="text-center mb-3">{{ user.surname }}</h3>
            <img class="doctor-image rounded-circle mx-auto d-block mb-2" :src="user.photo ? `/storage/${user.photo}`: '/img/img-not-found.png'" style="height: 80%; width: 80%" />
            <div class="mb-3" v-for="specialty in user.specialties" :key="specialty.specialty_id">
                <span class="rounded-pill bg-primary px-3 py-1 me-2 text-light">{{ specialty.specialty_name }}</span>
            </div>
            <p><strong>Indirizzo: </strong>{{ user.address }}</p>
            <p v-if="user.phone_number"><strong>Numero di tel.: </strong>{{ user.phone_number }}</p>
            <p v-else><strong>Numero di tel.: </strong>Nessun recapito telefonico</p>
            <p><strong>Email: </strong>{{ user.email }}</p>
            <router-link :to="{name: 'single-user', params: {slug: user.slug }}">Vedi info dottore</router-link> 
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

<style lang="scss">
    p {
        margin-bottom: 0.3rem;
    }
</style>