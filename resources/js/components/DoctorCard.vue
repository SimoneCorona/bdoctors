<template>
  <div class="card mb-3">
        <h1>{{ user.name }} {{ user.surname }}</h1>
        
        <img class="doctor-image" :src="user.photo ? `/storage/${user.photo}`: '/img/img-not-found.png'" />
        <p>{{ user.address }}</p>
        <p>{{ user.phone_number }}</p>
        <p>{{ user.email }}</p>
        <p>{{ user.cv }}</p>
        <p>{{ user.specialties ? user.specialties.specialties_name : 'nessuna specializzazione'  }}</p>
        <router-link :to="{name: 'single-user', params: {slug: user.slug }}">Vedi info dottore</router-link> 
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

<style>

</style>