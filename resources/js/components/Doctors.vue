<template>
    <div>
        <h2>Tutti i dottori:</h2>
        <div class="container">
        <div v-for="user in doctorsToShow" :key='user.id' class="row row-cols-3">
            <DoctorCard :user="user"/>
        </div>
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

</style>