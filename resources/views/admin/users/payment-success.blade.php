@extends('layouts.dashboard')

<x-header />

@section('content')

<h1>Pagamento andato a buon fine</h1>
<p>La tua sponsorizzazione terminerà il {{$sponsorship_end_msg}}</p>
@endsection
