
@extends('layouts.dashboard')

<x-header {{-- link1="Il mio profilo" href1="{{ route('admin.home') }}" link2="Visita il sito" href2="{{ route('guest.home') }}" link3="Logout" href3="{{ route('logout') }}" --}} />

{{-- {{dd($user)}} --}}

@section('content')

<div>
    <div class="user d-flex my-4 pt-2 py-4">
        <div class="user-avatar me-5">
            @if($user->photo)
            <li class="avatar list-unstyled">
                <img src="{{ asset('storage/' . $user->photo) }}"  alt="{{ $user->name }}">
            </li>
            @else
            <li class="avatar list-unstyled">
                <img src="{{ asset('img/img-not-found.png') }}" alt="img-not-found">
            </li>
            @endif
            <div class="mt-4">
                <div class="p-0">
                    <li class="nav-item list-unstyled mb-2">
                        <a class="nav-link active" href="{{ route('admin.users.edit') }}"> 
                            <i class="fa-solid fa-pen me-2"></i>
                            <strong>Modifica profilo</strong> 
                        </a>
                    </li>
                    <li class="nav-item list-unstyled mb-2">
                        <a class="nav-link active" href="#messages"> 
                            <i class="fa-solid fa-comments me-2"></i>
                            <strong>Messaggi</strong> 
                        </a>
                    </li>
                    <li class="nav-item list-unstyled mb-2">
                        <a class="nav-link active" href="#reviews"> 
                            <i class="fa-solid fa-comments me-2"></i>
                            <strong>Recensioni</strong> 
                        </a>
                    </li>
                    <li class="nav-item list-unstyled mb-2">
                        <a class="nav-link active" href="#stats"> 
                            <i class="fa-solid fa-ranking-star me-2"></i>
                            <strong>Le mie statistiche</strong> 
                        </a>
                    </li>
                </div>
            </div>
        </div>

        <div class="user-info ms-5">
            <li class="list-unstyled mb-3"> <h2>{{ $user->name }} {{ $user->surname }}</h2></li>
            <li class="list-unstyled text-light">
                @foreach($user->specialties as $specialty)
                <span class="rounded-pill bg-primary px-3 py-1 me-2 text-light">
                    {{ $specialty->specialty_name }}
                </span>
            @endforeach
            </li>
            <li class="list-unstyled mt-3"><strong>Indirizzo: </strong>{{ $user->address }}</li>
            <li class="list-unstyled"><strong>Numero di tel.:</strong>{{ $user->phone_number }}</li>
            <li class="list-unstyled"><strong>Email: </strong>{{ $user->email }}</li>
            <li class="list-unstyled mt-4"><h3>Il mio Curriculum Vitae:</h3></li>
            <li class="list-unstyled">{{ $user->cv }}</li>
        </div>
    </div>

    {{-- Wrapper reviews --}}
    <div id="reviews" class="container-fluid d-flex mb-4">
        <div class="col-6 reviews my-3 pe-4 border-end border-dark">
            <h3 class="mb-3">Le tue recensioni:</h3>
            <div class="mb-3 p-0">
                @foreach($user->reviews as $review)
                    <div class="review mb-4">
                        <div>
                            <small>Inviato da: <strong>{{ $review->author }}</strong></small><br>
                            <span>
                                {{ $review->text_review }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        {{-- Wrapper messages --}}
        <div id="messages" class="messages d-flex row col-6 my-3 ps-5 ">
            <h3 class="mb-3">I tuoi messaggi:</h3>
            <div class="m-0 p-0">
                @foreach($user->messages as $message)
                    <div class="message mb-4" >
                        <div class="mb-1">
                            <small>Inviato da: <strong>{{ $message->author }}</strong></small>
                            <div class="p-0">
                                <strong>Email: </strong><a href="#">{{ $message->email }}</a>
                            </div>
                            <div class="p-0">
                                {{ $message->text_message }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Wrapper statistic --}}
    <div id="stats" class="border-top pt-2 border-dark">
        Le mie statistiche
    </div>
</div>
@endsection

<style scoped>

    .user {
        border-bottom: 1px solid black;
    }

    /* Foto tonda */
    .avatar {
        border: 1px solid black;
        border-radius: 50%;
        overflow: hidden;
    }

    .avatar img {
        width: 200px;
        height: 200px;
        object-fit: cover;
    }

    /* Sezione messaggi e recensioni ricevute */
    .message, .review  {
        border-radius: 15px 0 15px 15px;
        border: 1px solid black;
    }

    .message div, .review div {
        padding: .5rem 1.5rem;
    }
</style>

    
