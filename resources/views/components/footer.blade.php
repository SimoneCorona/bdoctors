<div id="footer">
    <footer class="py-5">
        <div class="container">
          <div class="row">
            <div class="col-sm-6 col-md-4 col-lg-5">
              <h4><span class="d-inline-block bg-dark px-2 text-light">P</span> U B B L I C O</h4>
              <ul class="f-links list-unstyled">
                <li><a href="/">Home</a></li>
                <li><a href="/login">Login</a></li>
                <li><a href="/register">Registrati</a></li>
                <li><a href="#">Contatti</a></li>
                <li><a href="#">Privacy</a></li>
                <li><a href="#">FAQ</a></li>
              </ul>
            </div>
      
          <div class="col-sm-6 col-md-5 col-lg-5">
            <h4><span class="d-inline-block bg-dark px-2 text-light">D</span> A S H B O A R D</h4>
            <ul class="f-links list-unstyled">
              <li><a href="{{ route('admin.home') }}">Il tuo profilo</a></li>
              <li><a href="{{ route('admin.users.edit') }}">Modifica profilo</a></li>
              <li><a href="{{ route('admin.messages.index') }}">Messaggi</a></li>
              <li><a href="{{ route('admin.reviews.index') }}">Recensioni</a></li>
              <li><a href="{{ route('admin.users.sponsor') }}">Sponsorizza il tuo lavoro</a></li>
              <li><a href="{{ route('logout') }}">Logout</a></li>
            </ul>
          </div>
      
          <div class="col-sm-12 col-md-3 col-lg-2 social">
            <h4 class="px-2 ms-1"><span id="square" class="d-inline-block bg-dark px-2 text-light">S</span> O C I A L</h4>

            <div class="social container-fluid">
              <div class="row">
                <div class="col-4 col-md-12 d-flex mb-3">
                  <a href="https://www.instagram.com/">
                    <i class="fa-brands fa-instagram"></i>
                  </a>
                  <a href="https://www.facebook.com/">
                    <i class="fa-brands fa-facebook"></i>
                  </a>
                </div>
                <div class="col-4 col-md-12 d-flex mb-3">
                  <a href="https://www.linkedin.com/">
                    <i class="fa-brands fa-linkedin"></i>
                  </a>
                  <a href="https://twitter.com/?lang=it">
                    <i class="fa-brands fa-twitter"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
        
    </footer>
</div>

<style>



    #footer h4 {
      font-weight: 700;
      font-size: 1.2rem;
      margin-bottom: 2rem;
      padding-left: .5rem;
    }
    #footer li { 
      margin-top: .8rem; 
    }

    #footer a { 
      text-decoration: none; 
      cursor: pointer;
      text-transform: uppercase;
      color: black;
    }

    .f-links li {
      padding-left: .5rem;
      transition: .5s;
    }

    .f-links li:hover {
      border-left: 3px solid black;
      transition: .3s;
      padding-left: 1rem;
    }

  .social a {
    margin-right: 1rem;
    width: 3.5rem;
    height: 3.5rem;
    border: 1px solid black;
    text-align: center;
    cursor: pointer;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: .3s;
  }

  .social a i {
    color: black;
    font-size: 2rem;
    transition: .5s;
  }

  .social a:hover {
    background-color: black;
    transition: .5s;
  }

  .social a:hover i {
    color: white;
    font-size: 3rem;
    transition: .5s;
  }

</style>