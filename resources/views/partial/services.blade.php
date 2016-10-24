
@extends('template.template')

@section('title') Moto | EveryCycle @endsection

@section('head')
    <meta name="robots" content="dofollow,doindex">
    <meta name="description" content="Trouver les lieux spécialiser dans la maintenance, l'entretient et la personnalisation de votre moto à Antananarivo" >
    <link rel="stylesheet" href="{{ asset('js/iCheck/skins/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/map.css') }}">
    <script src="{{ asset('js/iCheck/icheck.js') }}"></script>
@endsection

@section('content')

    @include('absolute.permanent-navbar')

    <div class="body-container" id="body">

        <div class="row">
            <div class="col-md-10">

                <section class="content-fixed" id="fixedRight">
                    <?php $place = $thatPlace['place'] ?>
                    @include('absolute.loop-array',[$place])
                </section>

            </div>
            <div class="col-md-6" id="section-right">

                <div class="canvas-container">
                    <div id="canvas" style="position:relative;max-width:100%;max-height:100%"></div>
                </div>
            </div>

        </div>

    </div>
@endsection

@section('script')
    <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjd71as-VYz99wgGgkT3l4FQ3pL14fEuc"></script>

    <script src="{{ asset('js/load-map.js') }}"></script>
    <script src="{{ asset('js/bar-search.js') }}"></script>
    <script>
        $(function() {
            var height = $(window).height() - $("header-fixed").height();
            $('#canvas').css('height',height-60).css('padding-bottom',20);
        })
    </script>
    <script>
        $(function() {
            $('input[type="radio"],input[type="checkbox"]').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_square',
                increaseArea: '20%', // optional
            })

            var r = ""

            $('input[type="radio"]').on('ifChecked', function(event) {

                    var value =  event.currentTarget.getAttribute('value');
                    r = value

                    if($('#hidden').hasClass('hidden'))
                        $('#hidden').removeClass('hidden');
                    $('#s').attr('name','sp='+value).attr('placeholder',value);

            })

            $('input[type="checkbox"]').on('ifChecked', function(event) {

                if($('#btn').hasClass('hidden'))
                        $('#btn').removeClass('hidden')

            })


            chosen = false;

            $('#s').on('keyup', function() {
                chosen = false;
                if( $( this ).val().length >= 3 ) {
                    $.ajax({
                        url: '{{ route('match') }}?s='+$(this).val()+'&'+$(this).attr('name')
                    }).done(function(data) {
                        if(!$('.result').hasClass('hidden'))
                                $('.result').addClass('hidden')

                        if($('span.list').length) {
                            $('span.list').each(function() {
                                $(this).remove()
                            })
                        }
                        if( data.length && !chosen ) {
                            var result = $('.result')
                            result.removeClass('hidden')
                            for(var d = 0 ; d < data.length ; d++) {
                                if( data[d].nom == $('#s').val() ) {
                                    chosen = true
                                    $('#actif').removeClass('hidden')
                                    return
                                }
                                var span = $(' <span> ').addClass('list').text(data[d].nom)
                                result.append(span)
                            }
                        }
                    })
                }
            })
            $('.result').on('click','span.list', function() {
                $('#s').val($(this).html())
                $(this).parent().addClass('hidden')
                $(this).remove()
                chosen = true
                $('#actif').removeClass('hidden')
            })
            $('#territorySpecification').on('submit', function(e) {
                e.preventDefault();

                var url = r+'/'+$('#s').val()
                var checked = $(this).serializeArray()
                var checkedList = ""

                for(var c = 0 ; c < checked.length ; c++) {
                    if(c >=2 ) {
                        checkedList += "&"+checked[c].name +"="+checked[c].value
                    }
                }
                window.location.href = '/'+url+'?'+checkedList;
                //app.map.reloadPageWithNewData();
            })
        })
    </script>
    <script>
        $(window).load(function() {
            app.map.getDataMarkerAndLoadMap(document.querySelectorAll('.marked'),
            {
                center: {
                    lat: "{{  isset($thatPlace['center']) ?  $thatPlace['center']['lat'] : -18.9149 }}",
                    lng: "{{  isset($thatPlace['center']) ? $thatPlace['center']['lng'] : 47.5316 }}"
                }
            })
                app.getMoreResult(document.getElementById('more'))
        })
    </script>
@endsection

@section('footer')

@endsection