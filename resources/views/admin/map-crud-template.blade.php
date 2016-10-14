<section class="content">
    <div class="box box-default">

        <div class="box-header with-border">
            <h3 class="box-title">{{ $title }}</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>

        </div>

        <div class="box-body">
            <div class="row" style="margin-bottom:5px;">
                <div class="col-md-6">
                    <input type="text" id="searchbox" placeholder="Recherche" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div id="map-canvas" style="height:400px">

                    </div>

                </div>
            </div>
            <div class="row">

                <form id="territory" action="{{ $action }}" method="POST">
                    {{ csrf_field() }}
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <h2>Information G&eacute;n&eacute;rale</h2>
                            <div class="form-group">
                                <label for="name">Nom</label>
                                <div class="input-group">
                                    <div class="input-group-addon"></div>
                                    <input type="text" class="form-control pull-right" name="nom" value="{{ $value->nom }}" id="name" placeholder="{{ $placeholder }}">
                                    <span class="error alert alert-danger hidden"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <div class="input-group">
                                    <div class="input-group-addon"></div>
                                    <textarea name="description" class="form-control pull-right" name="description" id="description">{{$value->description}}</textarea>
                                    <span class="error alert alert-danger hidden"></span>
                                </div>
                            </div>

                            @if(count($parent) != 0)

                                <div class="form-group">
                                    <label for="parent">{{ $appart }}  d'appartenence</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"></div>
                                        <?php $name = strtolower($appart)  ?>

                                        <select name="{{ $name }}_id" id="parent" class="form-control pull-left">
                                            @foreach($parent as $p)

                                                <option value="{{ $p->id }}" @if($p->id == $pl) selected="selected" @endif>{{ $p->nom }}</option>

                                            @endforeach
                                        </select>
                                        <span class="error alert alert-danger hidden"></span>
                                    </div>
                                </div>

                            @endif
                        </div>
                        <div class="col-md-6">
                            <h2>Degr&eacute;s D&eacute;cimaux</h2>
                            <div class="form-group">
                                <label for="longitude">Longitude</label>
                                <div class="input-group">
                                    <div class="input-group-addon"></div>
                                    <input type="text" value="{{ $value->longitude }}"  class="form-control pull-right" id="longitude" name="longitude" placeholder="Longitude">
                                    <span class="error alert alert-danger hidden"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="latitude">Latitude</label>
                                <div class="input-group">
                                    <div class="input-group-addon"></div>
                                    <input type="text" value="{{ $value->latitude }}" class="form-control pull-right" name="latitude" id="latitude" placeholder="Latitude">
                                    <span class="error alert alert-danger hidden"></span>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="alert alert-success success hidden"> Action succés</div>

                        <button class="btn btn-sm btn-info btn-flat pull-right">Enregistrer</button>
                    </div>

                </form>


            </div>
        </div>

        <div class="box-footer text-center">
            Administration WheelsMada
        </div>

        <div id="coord" data-lat="{{ $value->latitude }}" data-lng="{{ $value->longitude }}"></div>

        <script src="{{ asset('admin/js/load-map.js') }}"></script>

        <script>
            var coord = document.getElementById('coord');
            app.map.initMap(document.getElementById('map-canvas'), {lat: parseFloat(coord.getAttribute('data-lat')) , lng: parseFloat(coord.getAttribute('data-lng')) });
        </script>

        <script>

            $(document).ready(function() {

                var form = $('#territory');

                form.submit(function(e) {

                    e.preventDefault();

                    var action = $(this).attr('action');
                    var method = $(this).attr('method');

                    var name = $('#name');
                    var description = $('#description');
                    var longitude = $('#longitude');
                    var latitude = $('#latitude');
                    var parent = $('#parent');
                    var loader = $('.img-loader');
                    var success = $('.success');
                    if(!success.hasClass('hidden'));
                        success.addClass('hidden');

                    var error = $('.input-group span.error');
                    for(var i = 0 ; i < error.length ; i++) {
                        if(!$(error[i]).hasClass('hidden'))
                            $(error[i]).addClass('hidden')
                    }
                    loader.removeClass('hidden')
                    $.ajax({
                        data : $(this).serialize(),
                        method : method,
                        url: action
                    }).done(function(){
                        loader.addClass('hidden')
                        success.removeClass('hidden')
                    }).fail(function(data) {

                        var error = data.responseJSON;

                        for(var e in error) {

                            $("#"+e).next('span.error').removeClass('hidden').text(error[e][0]);

                        }

                        loader.addClass('hidden')
                    })
                })

            })

        </script>
    </div>

</section>

