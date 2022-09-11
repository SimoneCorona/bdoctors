@extends('layouts.dashboard')

@section('content')

<div>
    <div class="user d-flex pt-2 py-4">
        <div class="user-avatar me-5">
            @if($user->photo)
            <div class="avatar">
                <img src="{{ asset('storage/' . $user->photo) }}"  alt="{{ $user->name }}">
            </div>
            @else
            <div class="avatar">
                <img src="{{ asset('img/img-not-found.png') }}" alt="img-not-found">
            </div>
            @endif
        </div>

        <div class="user-info">
            <span class="mb-3"> <h2>{{ $user->name }} {{ $user->surname }}</h2></span>
            <div>
                @foreach($user->specialties as $specialty)
                <span class="rounded-pill bg-primary px-3 py-1 mb-3 text-light">
                    {{ $specialty->specialty_name }}
                </span>
            @endforeach
            </div>
            <span class="mt-3">Indirizzo: {{ $user->address }}</span>
            <span class="">Numero di tel.: {{ $user->phone_number }}</span>
            <span class="mb-5">Email: {{ $user->email }}</span>
            <span class="">{{ $user->cv }}</span>
        </div>
    </div>

    <ul id="mex-rev" class="container-fluid d-flex">
        <li class="row col-6 reviews list-unstyled my-3 me-2">
            <h3>Le tue recensioni</h3>
            <ul class="m-0 p-0">
                @foreach($user->reviews as $review)
                    <li class="review list-unstyled mb-2">
                        <div>
                            <span>
                                {{ $review->text_review }}
                            </span>
                            <small>Inviato da {{ $review->author }}</small>
                        </div>
                    </li>
                @endforeach
            </ul>
        </li>
        <li class="messages row col-6 list-unstyled my-3 ms-2">
            <h3>I tuoi messaggi</h3>
            <ul class="m-0 p-0">
                @foreach($user->messages as $message)
                    <li class="message list-unstyled" >
                        <div>
                            <div class="ps-0">
                                {{ $message->text_message }}
                            </div>
                            <small>Inviato da {{ $message->author }}</small>
                            <a href="#">{{ $message->email }}</a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </li>
    </ul>
</div>
@endsection

<style>

    /* Reset */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .user {
        margin-left: -2rem;
    }

    #mex-rev {
        padding-left: 0;
    }


    .user {
        border-bottom: 1px solid black;
    }

    /* Foto tonda */
    .avatar {
        width: 200px;
        height: 200px;
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
    .reviews, .messages {
        padding-bottom: 1rem;
    }

    .message {
        border-radius: 15px 0 15px 15px;
        border: 1px solid black;
        margin-bottom: 3rem;
    }

    .message div, .review div {
        padding: .5rem 1.5rem;
        margin-bottom: 1rem;
    }

    .review {
        border-radius: 0 15px 15px 15px;
        border: 1px solid black;

    }
</style>
