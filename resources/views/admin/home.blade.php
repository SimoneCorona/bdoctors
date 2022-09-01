
@extends('layouts.dashboard')

<x-header link1="Logout" href1="/login" link2="Visita il sito" href2="{{ route('guest.home') }}" link3="Il mio profilo" href3="{{ route('admin.users.edit') }}" />



@section('content')

    HOMEPAGE
    
@endsection