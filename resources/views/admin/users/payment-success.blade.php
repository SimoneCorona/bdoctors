@extends('layouts.dashboard')

<x-header />

@section('content')

<div class="success text-dark d-flex justify-content-center align-items-center">
    <div class="container text-center bg-transp">
        <h1 class="text-uppercase pt-5">Pagamento andato a buon fine</h1>
        <h2 class="pb-5">La tua sponsorizzazione terminerà il {{$sponsorship_end_msg}}</h2>
    </div>
</div>

@endsection

<style>
    .success {
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
