<template>
<div class="banner">
    <select  @change="sendSearchDoctor" v-model="selectedSpecialty" class="form-select" aria-label="Default select example">
      <option selected>Open this select menu</option>
      <option v-for="(specialty, index) in specialties" :key="index" :value="specialty.id">{{specialty.specialty_name}}</option>
    </select>
    <form action="">
      <button @click="$emit('search', selectedSpecialty)">Avvia ricerca per specializzazione</button>
    </form>
</div>
</template>

<script>
export default {
  name: 'Banner',
  data() {
    return {
        specialties: [],
        selectedSpecialty: '',
    }
  },
  created() {
        this.getSpecialties();
    },
    methods: {
        getSpecialties() {
             axios.get('/api/specialties')
             .then((resp) => {
                this.specialties = resp.data.results;
            })
        },
         sendSearchDoctor(){
           this.$emit('search', this.selectedSpecialty)
         }
    }
};
</script>

<style>
</style>