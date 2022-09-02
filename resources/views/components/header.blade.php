<div>
    
    <nav class=" border-bottom header-vl navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
          <a class="navbar-brand" href="/">Bdoctor</a>
          <div class="p-0 flex-grow-1" id="navbarSupportedContent">
            <ul class="mb-0 d-flex justify-content-end">
              @if (!$user)
              <li class="list-unstyled me-4">
                  <a class="nav-link btn btn-primary text-light px-2" aria-current="page" href="/login">Login</a>
                </li>
                <li class="list-unstyled me-4">
                  <a class="nav-link btn btn-primary text-light px-2" href="/register">Register</a>
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
              
              <li class="list-unstyled me-4">
                <div class="row ">
                  <div class="col-auto text-light">
                    <a class="nav-link btn btn-primary px-2" href="/admin">{{ $user->name }}</a>
                  </div>
                  <div class="col-auto arrow btn btn-primary px-2 h-25 text-light ">
                    <i class="fa-solid fa-angle-down"></i>
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
  header{
    position: relative;
  }
  .logout{
    position: absolute;
    bottom: -30px;
    right: 40px;
  }

</style>

<script>
  let arrow = document.querySelector('.arrow');
  let logout = document.querySelector('.logout'); 
  
  arrow.addEventListener('click', function(){
    logout.classList.toggle('d-none')
  })
  
</script>