<template>
<footer class="bg-primary">
  <div class="container d-flex justify-content-center">
    <div class="row">
      <div class="col-auto">
      <i class="fa-solid fa-bicycle"></i>
        <h4>Colonna 1</h4>
        <ul class="list-unstyled">
          <li><a>Home</a></li>
          <li><a>Privacy</a></li>
          <li><a>Contatti</a></li>
          <li><a>Lavoro</a></li>
          <li><a>Link</a></li>
          <li><a>Link</a></li>
          <li><a>Link</a></li>
        </ul>
      </div>

    <div class="col-auto">
      <h4>Colonna 2</h4>
      <ul class="list-unstyled">
        <li><a>Home</a></li>
        <li><a>Privacy</a></li>
        <li><a>Contatti</a></li>
        <li><a>Lavoro</a></li>
        <li><a>Link</a></li>
        <li><a>Link</a></li>
        <li><a>Link</a></li>
      </ul>
    </div>

    <div class="col-auto">
      <h4>Colonna 3</h4>
      <ul class="list-unstyled">
        <li><h2>DB</h2></li>
        <li><a>Home</a></li>
        <li><a>Privacy</a></li>
        <li><a>Contatti</a></li>
        <li><i class="fa-solid fa-house"></i></li>
      </ul>
    </div>
  </div>
</div>
  
</footer>
</template>

<script>

export default {
    name: 'Footer',
}
</script>

<style scoped lang="scss">

 footer{
  a {
    color: black;
    text-decoration: none;
    cursor: pointer;
  }

 }

</style>