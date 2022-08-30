<template>
  <div class="container">
    <h1>Pagina Home</h1>
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