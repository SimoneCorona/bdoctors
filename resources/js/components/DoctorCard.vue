<template>
  <div class="col">
      <div class="card p-3 mb-3">
            <h3>{{ user.name }} {{ user.surname }}</h3>
            <img class="doctor-image" :src="user.photo ? `/storage/${user.photo}`: '/img/img-not-found.png'" />
            <div v-for="specialty in user.specialties" :key="specialty.specialty_id">
                <span class="badge rounded-pill text-bg-primary">{{ specialty.specialty_name }}</span>
            </div>
            <p>{{ user.address }}</p>
            <p>{{ user.phone_number }}</p>
            <p>{{ user.email }}</p>
            <p>{{ user.cv }}</p>
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