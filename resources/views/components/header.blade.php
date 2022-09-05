<div>
    
    <header class="position-fixed  fixed-top">
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
              
              <li class="list-unstyled me-4 w-25 my-container">
                <div class="d-flex justify-content-end ">
                  <div class=" text-light m-1">
                    <a class="nav-link btn btn-primary px-3 py-1" href="/admin">{{ $user->name }}</a>
                  </div>
                  {{-- <div class="arrow bg-primary  rounded text-light m-1 ">
                    <i class="fa-solid fa-angle-down"></i>
                  </div> --}}
                  <i class="fa-solid fa-angle-down arrow nav-link btn btn-primary px-3 py-2 m-1 text-light"></i>
                </div>
                
                <div class="logout text-light d-none  d-flex justify-content-end mx-1">
                  <a class="nav-link btn btn-primary px-3 py-1" href="{{ route('logout') }}"
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
.my-container{
  position: relative;
}

.logout{
  position: absolute;
  right: 0;
}



</style>

{{-- js --}}
<script>
  
  let logout = document.querySelector('.logout'); 
  let arrow = document.querySelector('.arrow');
  arrow.addEventListener('click', function(){
    logout.classList.toggle('d-none')
  })
  
</script>