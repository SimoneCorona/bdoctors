<template>
   <div class="page-not-found text-dark d-flex justify-content-center align-items-center">
        <div class="container text-center bg-transp">
            <h1 class="text-center py-5">Errore 404: Pagina non trovata!</h1>
        </div>
   </div>
</template>

<script>


export default {
    name: 'NotFound',
}
</script>

<style>


    .page-not-found {
        background-image: url("/images/bg-blue.png"),
            linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5));
        background-blend-mode: overlay;
        background-repeat: no-repeat;
        background-size: cover;
        min-height: 40vw;
    }

    .bg-transp {
        background-color: rgba(255,255,255,0.6);
    }
</style>
