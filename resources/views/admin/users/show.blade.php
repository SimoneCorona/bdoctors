@extends('layouts.dashboard')

@section('content')

<div class="d-flex justify-content-center">
    <ul class="m-0 p-0">
        @if($user->photo)
        <li class="list-unstyled rounded-circle">
            <img src="{{ asset('storage/' . $user->photo) }}"  alt="{{ $user->name }}" class="rounded-circle">
        </li>
        @else
        <li class="list-unstyled rounded-circle">
            <img src="{{ asset('img/img-not-found.png') }}" alt="img-not-found" class="rounded-circle">
        </li>
        @endif
        <li class="list-unstyled text-center"> <h2>{{ $user->name}} {{ $user->surname}}</h2></li>
        <li class="list-unstyled text-center rounded-pill bg-primary m-auto text-light" style="width: 20%">
        @foreach($user->specialties as $specialty)
            {{ $specialty->specialty_name }}{{ $loop->last ? '' : ', ' }}
        @endforeach
        </li>
        <li class="list-unstyled text-center">{{ $user->address }}</li>
        <li class="list-unstyled text-center">{{ $user->phone_number }}</li>
        <li class="list-unstyled text-center">{{ $user->email }}</li>
        <li class="list-unstyled text-center">{{ $user->cv }}</li>
        <li class="list-unstyled text-center my-3">
            <h3>Le tue recensioni</h3>
            <ul class="m-0 p-0">
                @foreach($user->reviews as $review)
                    <li class="list-unstyled">
                        {{ $review->text_review }}
                    </li>
                @endforeach
            </ul>
        </li>
        <li class="list-unstyled text-center my-3">
            <h3>I tuoi messaggi</h3>
            <ul class="m-0 p-0">
                @foreach($user->messages as $message)
                    <li class="list-unstyled" >
                        {{ $message->text_message }}
                    </li>
                @endforeach
            </ul>
        </li>
    </ul>
</div>
@endsection
