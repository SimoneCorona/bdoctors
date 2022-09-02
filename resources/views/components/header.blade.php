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
              <li class="list-unstyled me-4">
                <a class="nav-link btn btn-primary text-light px-2" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
              </li>
                <li class="list-unstyled me-4">
                  <a class="nav-link btn btn-primary text-light px-2" href="/admin">{{ $user->name }}</a>
              </li>
              @endif
               
            </ul>
          </div>
        </div>
      </nav>
     
</div>