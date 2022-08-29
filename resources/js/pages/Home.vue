<template>
  <div class="container">
    <h1>Pagina Home</h1>
    <p>questo codice è contenuto solo nella home page</p>
    <Doctors />
  </div>
</template>

<script>
import Doctors from '../components/Doctors.vue';
export default {
    name: "Home",
    components: { 
        Doctors, 
    }
}
</script>

<style>
</style>