@extends('template.admin')

@section('content')

    <div class="content-wrapper">

        @include('admin.content-header' ,
            [
            'title'=>$place->lieu->string_lieu,
            'link'=>[
                ['name'=>'Acceuil','url'=>route('admin.index')],
                ['name'=>'Places','url'=>route('territory.indexPlace')],
                ['name'=>$place->lieu->string_lieu]
            ]])

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header box-with-border">
                            <h3 class="box-title">WheelsMada</h3>

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
                                    <div id="canvas" style="height:400px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer text-center">
                            Administration EveryCycle
                        </div>
                    </div>

                </div>
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header box-with-border">
                            <h3 class="box-title">EveryCycle</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                            </div>

                        </div>
                        <div class="box-body">

                            <form id="place"  action="{{ route('territory.updatePlace',['id'=>$place->lieu_id]) }}" method="POST">
                                {{csrf_field()}}
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="name">Me localisé :</label>
                                        <button id="localisation" class="btn btn-sm btn-info btn-flat pull-right">Localisation</button>
                                        <span class="error alert alert-danger hidden"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Nom de la place</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Ex:Yaccoo" value="{{ $place->lieu->string_lieu }}">
                                        <span class="error alert alert-danger hidden"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" id="description" name="description" placeholder="Ex:Magasin...">{{ $place->lieu->description }}</textarea>
                                        <span class="error alert alert-danger hidden"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="longitude">Longitude</label>
                                        <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Longitude" value="{{ (string) $place->lieu->longitude }}">
                                        <span class="error alert alert-danger hidden"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="latitude">Latitude</label>
                                        <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Latitude" value="{{ (string) $place->lieu->latitude }}">
                                        <span class="error alert alert-danger hidden"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="latitude">Image</label>
                                    <input type="file" class="form-control" name="image" id="image">

                                </div>

                                    <div class="form-group">
                                        <label for="fokontany">Fokontany de : </label>
                                        <select class="form-control select2" name="fokontany" id="fokontany">
                                            @foreach($fokontany as $f)
                                                <option value="{{ $f->id }}" @if($f->id == $place->fonkontany_id) selected @endif>{{ $f->nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label style="display:block;">Caracteristique : </label>
                                        <label style="display:block;">
                                            <input type="checkbox" name="garage" @if($place->garage) checked @endif class="flat-red">
                                            Garage
                                        </label>
                                        <label style="display:block;">
                                            <input type="checkbox" name="pieces" @if($place->pieces) checked @endif class="flat-red">
                                            Vendeur pieces
                                        </label>
                                        <label style="display:block;">
                                            <input type="checkbox" name="huiles" @if($place->huiles) checked @endif class="flat-red">
                                            Vendeur Huiles
                                        </label>
                                        <label style="display:block;">
                                            <input type="checkbox" name="personnalisation" @if($place->personnalisation) checked @endif class="flat-red">
                                            Personnalisateur
                                        </label>
                                        <label style="display:block;">
                                            <input type="checkbox" name="accessoires" @if($place->accessoires) checked @endif class="flat-red">
                                            Fournisseur d'accessoire
                                        </label>
                                        <label style="display:block;">
                                            <input type="checkbox" name="vente_moto" @if($place->vente_moto) checked @endif class="flat-red">
                                            Vendeur moto
                                        </label>

                                    </div>
                                    <button class="btn btn-sm btn-info btn-flat pull-right">Enregistrer</button>

                                </div>
                            </form>
                        </div>
                        <div class="box-footer text-center">
                            Administration EveryCycle
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="{{ asset('admin/js/load-map.js') }}"></script>

    <script>
        app.map.initMap(document.getElementById('canvas'));

        document.getElementById('localisation').addEventListener('click', function(e) {

            e.preventDefault();

            var localize =  app.map.localize(document.getElementById('latitude'),document.getElementById('longitude'));

            if(localize)
                app.map.reloadMarkers([document.getElementById('latitude'),document.getElementById('longitude')])

        })

    </script>

    <script >
        $(document).ready(function() {
            //Flat red color scheme for iCheck
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });
        });
    </script>

    <script>
        $(function() {

            var file ;

            $('input[type=file]').on('change',function(e) {
                file = e.target.files;
            })

            $('#place').on('submit', function(e) {

                e.preventDefault();

                var name = $('#name');
                var description = $('#description');
                var longitude = $('#longitude');
                var latitude = $('#latitude');

                var error = $('.input-group span.error');
                for(var i = 0 ; i < error.length ; i++) {
                    if(!$(error[i]).hasClass('hidden'))
                        $(error[i]).addClass('hidden')

                }

                var data = new FormData();

                if(file) {
                       data.append("file",file[0]);
                }

                var box = $('input[type=checkbox]:checked');
                box.each(function() {
                    data.append($(this).attr('name'),$(this).attr('value'));
                })
                data.append('name',name.val())
                data.append('description',description.val())
                data.append('longitude',longitude.val())
                data.append('latitude',latitude.val())
                data.append('fokontany',$('#fokontany').val())
                data.append('_token',$('input[type=hidden]').val())


                $.ajax({
                    data:data,
                    url:$(this).attr('action'),
                    method:$(this).attr('method'),
                    cache: false,
                    processData: false,
                    contentType: false
                }).done(function() {
                    
                }).fail(function(data) {
                    var error = data.responseJSON;

                    for(var e in error) {

                        $("#"+e).next('span.error').removeClass('hidden').text(error[e][0]);

                    }
                })

            });

        })
    </script>

    @endsection

    @section('script')

            <!-- jQuery 2.2.3 -->
    <script src="{{ asset('admin/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>

@endsection