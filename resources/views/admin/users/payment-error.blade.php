@extends('layouts.dashboard')

<x-header />

@section('content')

<h1>Errore nel pagamento</h1>
<p>{{$error}}</p>
@endsection
