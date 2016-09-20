@extends('template.template')

@section('title') Pieces Moto | EveryCycle @endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('js/iCheck/skins/all.css') }}">
    <script src="{{ asset('js/iCheck/icheck.js') }}"></script>
@endsection

@section('content')

    @include('absolute.permanent-navbar')

    <div class="body-container" id="body">

        <div class="row">
            <div class="col-md-6">
                <div class="canvas-container">
                    <div id="canvas" style="position:relative;max-width:100%;max-height:100%">

                    </div>
                </div>
            </div>
            <div class="col-md-6" id="section-right">
                <div class="content-fixed-top animated" id="topRight" data-moved="true">
                    <span class="top-content">
                        Recherche avancée :
                    </span>
                    <form action="/" method="get" id="territorySpecification" class="territory-display">
                        <label for="display">Par:</label>
                        <ul id="display" class="display-t">
                            <li><input type="radio" id="input-1"  name="fokontany" value="fokontany">Fokontany</li>
                            <li><input type="radio" id="input-2"  name="departement" value="departement">D&eacute;partement</li>
                            <li><input type="radio" id="input-3" name="region" value="region">R&eacute;gion</li>
                        </ul>
                    </form>
                </div>
                <section class="content-fixed" id="fixedRight">
                    @include('absolute.loop-array',[$thatPlace])
                </section>
            </div>

        </div>

    </div>
@endsection

@section('script')
    <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjd71as-VYz99wgGgkT3l4FQ3pL14fEuc"></script>

    <script src="{{ asset('js/load-map.js') }}"></script>
    <script>
        $(function() {
            var height = $(window).height() - $("header-fixed").height();
            $('#group').css('max-height',height);
            $('#group').css('min-height',height);
            $('.canvas-container').css('height',height);
            $('#canvas').css('height',height-30);
        })
    </script>
    <script>
        $(function() {
            $('input[type="radio"]').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_square',
                increaseArea: '20%', // optional
            })
            $('input[type="radio"]').on('ifChanged', function(event) {

                var input = $('input[type=radio]')

                for(var i in input) {
                    if($(i).is(':checked')) {
                        $(i).iCheck('uncheck')
                    }
                }

            })
        })
    </script>
    <script>
        $(window).load(function() {
            app.map.getDataMarkerAndLoadMap(document.querySelectorAll('.marked'))
        })
    </script>
@endsection

@section('footer')

@endsection