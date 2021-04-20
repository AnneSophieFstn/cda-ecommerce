@extends('layouts.master')

@section('content')

@foreach ($fiches as $fiche)
    <div class="w3-row">
        <div class="w3-half w3-blue-grey w3-container">
            <div class="w3-padding-64 w3-center">
                <h1>{{ $fiche->title }}</h1>
                <img src="{{ asset('storage/' . $fiche->image) }}" alt="">
                <div class="w3-left-align w3-padding-large">
                    <h3>Description:</h3>
                    <p>{{ $fiche->description }}</p>
                    <h3>Adresse:</h3>
                    <p>{{ $fiche->adresse }}</p>
                </div>
            </div>
        </div>
    </div>
@endforeach

@endsection