<div>
    <nav class="border-bottom header-vl navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
          <a class="navbar-brand" href="/">
            <img src="images/logo.png" alt="">
          </a>
          <div class="p-0 flex-grow-1" id="navbarSupportedContent">
            <ul class="mb-0 d-flex justify-content-end">
              @if (!$user)
              <li class="list-unstyled me-4">
                  <a class="mybtn nav-link text-black px-2" aria-current="page" href="/login"><b>L O G I N</b></a>
                </li>
                <li class="list-unstyled me-4">
                  <b><a class="mybtn nav-link text-black px-2" href="/register">R E G I S T E R</a></b>
                </li>
              @else
              {{-- <li class="list-unstyled me-4">
                <a class="nav-link btn btn-primary text-light px-2" href="/admin">{{ $user->name }}</a>
              </li>
              
              <li class="arrow btn btn-primary list-unstyled me-4 text-light px-2 h-25 ">
                <i class="fa-solid fa-angle-down"></i>
              </li>
              <li class="list-unstyled me-4 logout">
                <a class="nav-link btn btn-primary text-light px-2" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">

                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
              </li> --}}
              
              <li class="position-relative list-unstyled me-4">
                <div class="row ">
                  <div class="col-auto text-light">
                    <a class="nav-link btn btn-primary px-2" href="/admin">{{ $user->name }}</a>
                  </div>
                  <div class="col-auto arrow text-light ">
                    <span class="nav-link btn btn-primary px-2"></span>
                  </div>
                </div>
                <div class="logout text-light d-none">
                  <a class="nav-link btn btn-primary px-2" href="{{ route('logout') }}"
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
</div>

<style scoped>
  nav {
    position: relative;
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
    top: 32px;
    right: 0;
  }

  .navbar-brand img {
    height: 40px;
  }

</style>

<script>
  let arrow = document.querySelector('.arrow');
  let logout = document.querySelector('.logout'); 
  
  if(arrow) {
    arrow.addEventListener('click', function(){
      logout.classList.toggle('d-none')
    })
  }
  
</script>