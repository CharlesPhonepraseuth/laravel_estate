@extends('base')


@section('content')

    <div class="bg-light p-5 mb-5 text-center">
        <div class="container">
            <h1>L'agence - powered by Laravel</h1>
            <p>Découvrez nos biens propulsés par Laravel</p>
        </div>
    </div>

    <div class="container">
        <h2>Nos derniers biens</h2>
        <div class="row">

            @foreach($properties as $property)
                <div class="col">
                    @include('property.card')
                </div>
            @endforeach

        </div>
    </div>

@endsection