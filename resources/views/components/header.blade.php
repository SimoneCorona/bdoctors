<div>
  <header class="position-fixed fixed-top">
    <nav class=" border-bottom header-vl navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        
        <a class="navbar-brand " href="/">
          <img class="d-inline-block d-sm-none" src="{{ asset('images/small-logo.png')}}" alt="">
          <img class="d-none d-sm-inline-block" src="{{ asset('images/logo.png')}}" alt="">
        </a>
          <div class="p-0 flex-grow-1" id="navbarSupportedContent">
            <ul class="mb-0 p-0 d-flex justify-content-end">
              @if (!$user)
              <li class="list-unstyled">
                <a class="mybtn border-0 nav-link me-3 px-2" aria-current="page" href="/login"><b>Accedi</b></a>
              </li>
              <li class="list-unstyled">
                <b><a class="mybtn border-0 nav-link pe-1" href="/register">Registrati</a></b>
              </li>
              @else
              
              <li class="position-relative list-unstyled me-4">
                <div class="row g-0">
                  <div class="col-auto">
                    <a class="nav-link px-2 mybtn" href="/admin">
                      <span class="d-none d-sm-inline-block">{{ $user->name }}</span>
                      <span class="d-inline-block d-sm-none"><i class="fa-regular fa-user"></i></span>
                    </a>
                  </div>
                  <div class="col-auto arrow ">
                    <span class="nav-link px-2 mybtn"></span>
                  </div>
                </div>
                <div class="logout d-none">
                  <a class="nav-link mybtn bg-light" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                
                      Logout
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST">
                      @csrf
                  </form>
                </div>
              </li>
              
              @endif
               
            </ul>
          </div>
        </div>
    </nav>
  </header>    
</div>

{{-- css --}}
<style scoped>
  
  nav {
    position: relative;
    height: 80px;
  }
  .arrow span {
    font-family: "Font Awesome 6 Free";
    font-weight: 900;
  }
  .arrow span::before {
    content: "\F107";
  }

  .logout{
    position: absolute;
    padding-left: 3.5rem; 
    /* top: 28px; */
    right: 0;
    border-top: 3px solid black;
  }

  .navbar-brand img {
    height: 40px;
  }


 .mybtn{
   text-transform: uppercase;
   letter-spacing: 0.4em;
   margin: 0;
   font-size: .8rem;
 }


</style>

{{-- js --}}
<script>
  let arrow = document.querySelector('.arrow');
  let logout = document.querySelector('.logout'); 
  
  if(arrow) {
    arrow.addEventListener('click', function(){
      logout.classList.toggle('d-none')
    })
  }
  
</script>