@extends('template.template')

@section('head')
    <link rel="stylesheet" href="{{ asset('js/select2/dist/css/select2.css') }}">
@endsection

@section('content')
<div class="community col-lg-12" >
    @include('absolute.nav')
    <div class="middle-index">
        <h1>EveryCycle</h1>
        <h3><span class="typed" style="white-space:pre;">Trouver les lieux specialiser dans la maintenance de votre moto , <br> quelque soit votre position à Antananarivo</span></h3>
    </div>
    <div class="middle-research">
        <form id="indexInput" action="{{ url('fokontany') }}" method="GET">
            <div class="toggle-input">
                <div style="position:relative">
                    <input type="text" placeholder="Je recherche" id="mys" class="aria-search">
                </div>
                <div class="dropdown"></div>
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
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Quartier",
            allowClear: false
        })
        $('#multiple').select2({
        })
    });
</script>
<script>
    $(function() {

        $('#indexInput').on('submit', function(e) {
            e.preventDefault();
            var select = $('#single_select').select();
            console.log(select)
            var url = $(this).attr('action') + '/';
        })

    });
</script>
@endsection
