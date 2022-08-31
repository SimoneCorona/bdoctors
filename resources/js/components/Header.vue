<template>
<div>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="/">BDOCTOR</a>
    <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button> -->
    <div class="p-0 flex-grow-1" id="navbarSupportedContent">
      <ul class="mb-0 d-flex justify-content-end">
        <li class="list-unstyled me-4">
          <a class="nav-link btn btn-primary text-light px-2" aria-current="page" href="/login">Login</a>
        </li>
        <li class="list-unstyled me-4">
          <a class="nav-link btn btn-primary text-light px-2" href="/register">Register</a>
        </li>
        <!-- <li class="list-unstyled me-4 border border-dark">
          <a class="nav-link" href="/logout">Logout</a>
        </li> -->
        <!-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Sign-in
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="/login">Login</a></li>
            <li><a class="dropdown-item" href="/register">Register</a></li>
            <li><a class="dropdown-item" href="/logout">Logout</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>--> 
      </ul>
    </div>
  </div>
</nav>
</div>
</template>

<script>

export default {
    name: 'Header',
}
</script>

<style>

</style>