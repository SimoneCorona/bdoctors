<template>
    <div>
        <h1>{{ user.name }} {{ user.surname }}</h1>
        <img class="doctor-image" :src="user.photo ? `/storage/${user.photo}`: '/img/img-not-found.png'" />
        <p>{{ user.address }}</p>
        <p>{{ user.phone_number }}</p>
        <p>{{ user.email }}</p>
        <p>{{ user.cv ? user.cv : 'nessun cv'  }}</p>
        <div v-for="specialty in user.specialties" :key="specialty.specialty_id">
            <p>{{ specialty.specialty_name }}</p>
        </div>
        <div v-for="review in user.reviews" :key="review.id">
            <p>{{ review.author }}: {{ review.rating }} stelle</p>
            <p>{{ review.text_review }}</p>
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