@extends('template.admin')

@section('content')

    <div class="content-wrapper">

        @include('admin.content-header' ,
            [
            'title'=>'Places',
            'link'=>[
                ['name'=>'Acceuil','url'=>route('admin.index')],
                ['name'=>'Places','url'=>route('territory.indexPlace')],
                ['name'=>'Tableau de bord']
            ]])

        <section class="content">
            <div class="row">
                <div class="col-md-8">
                    <div class="box box-default">
                        <div class="box-header box-with-border">
                            <h3 class="box-title">EveryCycle</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                            </div>

                        </div>
                        <div class="box-body">
                            <div class="row" style="margin-bottom:5px;">
                                <div class="col-md-12">
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
                    <div class="box box-default">
                        <div class="box-header box-with-border">
                            <h3 class="box-title">EveryCycle ajouté récemment</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                            </div>

                        </div>
                        <div class="box-body">
                            <ul class="products-list product-list-in-box">
                                @if(!empty($latest))
                                    @foreach($latest as $last)
                                        <li class="item">
                                            <div class="product-img">

                                            </div>
                                            <div class="product-info">
                                                <?php $uri = last( explode('/',Request::url()) ); ?>

                                                <a href="{{ route('territory.read'.ucfirst($uri) , $last->id."-".ucfirst(str_replace(' ','',$last->string_lieu))) }}" class="product-title">
                                                    {{ $last->string_lieu }}
                                                </a>
                                                <span class="product-description">
                                                    {{ $last->description }}
                                                </span>
                                            </div>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="item">
                                        Aucune donner à afficher
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <div class="box-footer text-centet">
                            Administration EveryCycle
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box box-default">
                        <div class="box-header box-with-border">
                            <h3 class="box-title">EveryCycle</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                            </div>

                        </div>
                        <div class="box-body">

                            <form id="place"  action="{{ route('territory.createPlace') }}" method="POST">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">Me localisé :</label>
                                    <button id="localisation" class="btn btn-sm btn-info btn-flat pull-right">Localisation</button>
                                </div>
                                <div class="form-group">
                                    <label for="name">Nom de la place</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Ex:Yaccoo">
                                    <span class="error alert alert-danger hidden"></span>

                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" placeholder="Ex:Magasin..."></textarea>
                                    <span class="error alert alert-danger hidden"></span>

                                </div>
                                <div class="form-group">
                                    <label for="longitude">Longitude</label>
                                    <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Longitude">
                                    <span class="error alert alert-danger hidden"></span>

                                </div>
                                <div class="form-group">
                                    <label for="latitude">Latitude</label>
                                    <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Latitude">
                                    <span class="error alert alert-danger hidden"></span>

                                </div>
                                <div class="form-group">
                                    <label for="fokontany">Fokontany de : </label>
                                    <select class="form-control select2" name="fokontany" id="fokontany">
                                        @foreach($fokontany as $f)
                                            <option value="{{ $f->id }}">{{ $f->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label style="display:block;">Caracteristique : </label>
                                    <label style="display:block;">
                                        <input type="checkbox" name="garage" class="flat-red">
                                        Garage
                                    </label>
                                    <label style="display:block;">
                                        <input type="checkbox" name="pieces" class="flat-red">
                                        Vendeur pieces
                                    </label>
                                    <label style="display:block;">
                                        <input type="checkbox" name="huiles" class="flat-red">
                                        Vendeur Huiles
                                    </label>
                                    <label style="display:block;">
                                        <input type="checkbox" name="personnalisation" class="flat-red">
                                        Personnalisateur
                                    </label>
                                    <label style="display:block;">
                                        <input type="checkbox" name="accessoroires" class="flat-red">
                                        Fournisseur d'accessoire
                                    </label>
                                    <label style="display:block;">
                                        <input type="checkbox" name="vente_moto" class="flat-red">
                                        Vendeur moto
                                    </label>

                                </div>
                                <button class="btn btn-sm btn-info btn-flat pull-right">Enregistrer</button>
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

                $.ajax({data:$(this).serialize(),url:$(this).attr('action'),method:$(this).attr('method')}).done(function() {
                    name.val('')
                    description.val('')
                    longitude.val('')
                    latitude.val('')
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