@extends('layouts.app')

@section('content')
    <div class="messages-c">
        <div class="container d-flex flex-column">
            <h3 class="bd-word mb-3 pb-5"><span class="bd-letter">I</span> miei messaggi</h3>
            @forelse ($messages->sortByDesc('created_at') as $message)
                <div class="message mb-4">
                    <div class="mb-1">
                        <div class="p-0 my-2">
                            {{ $message->text_message }}
                        </div>
                        <div class="p-0">
                            <strong>Email: </strong><a href="{{'mailto:'.$message->email}}">{{ $message->email }}</a>
                        </div>
                        <small>Inviato da <strong>{{ $message->author }}</strong></small><br>
                        <small>Scritto il {{ $message->created_at->format('d-m-Y') }} alle ore
                            {{ $message->created_at->format('g:i') }} </small>
                    </div>
                </div>
            @empty
            <div class="messageNull">Nessun messaggio</div>
            @endforelse

            @if ($messages->hasPages())
            <nav aria-label="Page navigation example">
                <ul class="pagination d-flex justify-content-center">
                  <li class="page-item {{$messages->onFirstPage() ? 'disabled' : '' }}" >
                    <a class="btn mybtn text-light m-2 {{$messages->onFirstPage() ? 'disabled' : '' }}" 
                        href="{{ route('admin.messages.index', ['page' => $messages->currentPage() - 1]) }}"
                        aria-label="Previous">
                      <i class="fa-solid fa-chevron-left"></i>
                    </a>
                  </li>
                  <li class="page-item"> <button id="numPage" class="btn mybtn text-light m-2" >Pagina {{ $messages->currentPage() }}</button></li> 
                  <li class="page-item {{ !$messages->hasMorePages() ? 'disabled' : '' }}"  >
                    <a class="btn mybtn text-light m-2 {{ !$messages->hasMorePages() ? 'disabled' : '' }}"
                        href="{{ route('admin.messages.index', ['page' => $messages->currentPage() + 1]) }}"
                        aria-label="Next">
                      <i class="fa-solid fa-chevron-right"></i>
                    </a>
                  </li>
                </ul>
              </nav>
              @endif
          </div>
    </div>
    <x-footer />
@endsection




<style>

.pagination .mybtn {
          /* margin-top: 1rem;
          height: 2.5rem;
          line-height: 2.5rem; */
          border: 1px solid white;
          padding-left: 1rem;
          border-radius: 0;
        }
.bd-word {
        text-transform: uppercase;
        letter-spacing: .4rem;
        font-size: 1.7rem;
    }

.bd-letter {
        color: white;
        background-color: rgba(0, 0, 0, 0.4);
        padding-left: .4rem;
        margin-right: .2rem;
        border: 1px solid black;
    }

    .messages-c {
        background-image: url('/images/bg-admin.png'),
        linear-gradient(rgba(255, 255, 255, 0.1),rgba(255, 255, 255, 0.1));
        background-size: 100%;
        background-blend-mode: overlay;
        padding-top: 3.6rem;
        margin-top: -1.7rem;
    }

    .message {
        background-color: rgba(255, 255, 255, 0.5);
        padding: 2rem 3rem;
    }

    .messageNull{
        min-height: 50vh;
    }
</style>
