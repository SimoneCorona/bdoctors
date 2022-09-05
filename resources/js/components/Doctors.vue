<template>
    <div>
        <h2 class="results-title mt-5 pt-4 mb-4 text-light">Risultati della ricerca</h2>
        
        <div class="row row-cols-3">
            <DoctorCard v-for="user in doctorsToShow" :key='user.id' :user="user"/>
        </div>
    </div>
</template>

<script>
import DoctorCard from './DoctorCard.vue';
export default {
    name: 'Doctors',
    components: {
        DoctorCard,
    },
    props: {
        doctorsToShow: Array,
    },
    data() {
        return {
            users: [],
        }    
    },
    created() {
        //this.getDoctors();
    },
    // methods: {
    //     getDoctors() {
    //          axios.get('/api/users')
    //          .then((resp) => {
    //             this.users = resp.data.results;
    //         })
    //     }
    // }
}
</script>

<style>
    .results-title {
        font-size: 1.3rem;
        text-transform: uppercase;
        letter-spacing: .8rem;
    }
</style>