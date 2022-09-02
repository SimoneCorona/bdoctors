<div>
    
    <nav class=" border-bottom header-vl navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
          <a class="navbar-brand" href="/">Bdoctor</a>
          <div class="p-0 flex-grow-1" id="navbarSupportedContent">
            <ul class="mb-0 d-flex justify-content-end">
              <li class="list-unstyled me-4">
                <a class="nav-link btn btn-primary text-light px-2" aria-current="page" href="{{ $href1 }}">{{ $link1 }}</a>
              </li>
              <li class="list-unstyled me-4">
                <a class="nav-link btn btn-primary text-light px-2" href="{{ $href2 }}">{{ $link2 }}</a>
              </li>
               {{-- <li class="list-unstyled me-4">
                <a class="nav-link btn btn-primary text-light px-2" href="{{ $href3 }}">{{ $link3 }}</a>
              </li>  --}}
              @if ($user)
              <li class="nav-item">
                <a class="nav-link" href="{{ $href3 }}"
                    onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ $link3 }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                </li> 
              @else
              <li class="list-unstyled me-4">
                <a class="nav-link btn btn-primary text-light px-2" href="{{ $href3 }}">{{ $link3 }}</a>
              </li>
              
                  
              @endif
            </ul>
          </div>
        </div>
      </nav>
     
</div>