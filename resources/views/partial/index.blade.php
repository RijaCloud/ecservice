@extends('template.template')

@section('title')
    WheelsMada | Site de géo-localisation
@endsection

@section('head')
    <meta name="description" content="Trouver les lieux spécialiser dans la maintenance, l'entretient et la personnalisation de votre moto à Antananarivo" >

@endsection

@section('content')
<div class="community col-lg-12" >
    @include('absolute.nav')
    <div class="middle-index">
        <h1>WheelsMada</h1>
        <h3><span class="typed" style="white-space:pre;">Trouver les lieux specialiser dans la maintenance, l'entretient, la personnalisation de votre moto , <br> quelque soit votre position à Antananarivo</span></h3>
    </div>
    <div class="middle-research">
        <form id="indexInput" action="{{ url('fokontany') }}" method="GET" autocomplete="off">
            <div class="toggle-input">
                <div style="position:relative;float:left;    width: 46%;">
                    <input type="text" placeholder="Je recherche" name="sv" id="mys" class="aria-search">
                </div>

                <div class="dropdown left">
                </div>

                <div style="position:relative;float:right;    width: 46%;">
                    <input type="text" placeholder="Fokontany" name="sf" id="mysf" class="aria-search">
                </div>
                <div class="dropdown right">
                    <ul class="hidden">

                    </ul>
                </div>

                <button type="submit" class="btn btn-primary"></button>
            </div>

            <div class="clearfix"></div>

        </form>
    </div>
</div>
<div class="bg">
    <div class="bg-bgContent commu-bg bg-1 ">
        <div class="bg-full"></div>
    </div>
</div>
@endsection
@section('footer')
<script src="{{ asset('bower_components/jquery/dist/jquery.js') }}"></script>
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('js/home-search.js') }}"></script>

@endsection
