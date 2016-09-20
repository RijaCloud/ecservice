@extends('template.template')

@section('head')
    <link rel="stylesheet" href="{{ asset('js/select2/dist/css/select2.css') }}">
@endsection

@section('content')
<div class="community col-lg-10" >
    @include('absolute.nav')
    <div class="middle-index">
        <h1>EveryCycle</h1>
        <h3><span class="typed" style="white-space:pre;">Trouver les lieux specialiser dans la maintenance de votre moto , <br> quelque soit votre position à Antananarivo</span></h3>
    </div>
    <div class="middle-research">
        <form id="indexInput" action="{{ url('fokontany') }}" method="GET">
            <div class="toggle-input">
                <label for="multiple">
                    Je cherche :
                </label>
                <select name="sv" id="multiple">
                    <option value="part">Pieces </option>
                    <option value="accessory">Accessoires </option>
                    <option value="garage">Reparations </option>
                    <option value="personnalisation">Personnalisation </option>
                </select>
            </div>
            <div class="toggle-input-right">
                <select name="commune" class="select2" id="single_select" style="
                width:40%!important;outline:none!important;padding:20px!important;" tabindex="-1">
                    @foreach($fokontany as $f)
                        <option value="{{ $f->nom }}">{{ $f->nom }}</option>
                    @endforeach
                </select>
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
<script src="{{ asset('js/select2/dist/js/select2.js') }}"></script>
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
