@extends('layouts.dashboard')

<x-header />

@section('content')

<div class="error text-dark d-flex justify-content-center align-items-center">
    <div class="container text-center bg-transp py-5">
        <h1 class="text-uppercase">Errore nel pagamento</h1>
        <h2>{{$error}}</h2>
    </div>
</div>
@endsection

<style>
    .error {
        background-image: url('/images/bg-admin.png'),
        linear-gradient(rgba(255, 255, 255, 0.1),rgba(255, 255, 255, 0.1));
        background-size: 100%;
        background-blend-mode: overlay;
        min-height: 40vh;
    }

    .bg-transp {
        background-color: rgba(255,255,255,0.6);
    }
</style>