
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

                            <div id="map-canvas" style="height:400px;">

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
                                        <input type="text" class="form-control pull-right" name="name" id="name" placeholder="{{ $placeholder }}">
                                        <span class="error alert alert-danger hidden"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"></div>
                                        <textarea name="description" class="form-control pull-right" name="description" id="description">Description</textarea>
                                        <span class="error alert alert-danger hidden"></span>
                                    </div>
                                </div>

                                @if(count($parent) != 0)

                                        <div class="form-group">
                                            <label for="parent">{{ $appart }}  d'appartenence</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"></div>
                                                <select name="parent" id="parent" class="form-control pull-left">
                                                    @foreach($parent as $p)
                                                        <option value="{{ $p->id }}">{{ $p->nom }}</option>
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
                                        <input type="text" class="form-control pull-right" id="longitude" name="longitude" placeholder="Longitude">
                                        <span class="error alert alert-danger hidden"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="latitude">Latitude</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"></div>
                                        <input type="text" class="form-control pull-right" name="latitude" id="latitude" placeholder="Latitude">
                                        <span class="error alert alert-danger hidden"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <button class="btn btn-sm btn-info btn-flat pull-right">Ajouter à la liste</button>
                        </div>

                    </form>


                </div>
            </div>

            <div class="box-footer text-center">
                Administration EveryCycle
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"> {{ $title }} ajouter Récemment </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove">
                                <i class="fa fa-times"></i>
                            </button>
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

                                            <a href="{{ route('territory.read'.ucfirst($uri) , $last->id."-".ucfirst(str_replace('','-',$last->nom))) }}" class="product-title">
                                                {{ $last->nom }}
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
                    <div class="box-footer text-center">
                        Administration EveryCycle
                    </div>
                </div>
            </div>
            <div class="col-md-4">

            </div>
        </div>
    </section>

    <script src="{{ asset('admin/js/load-map.js') }}"></script>

    <script>
        app.map.initMap(document.getElementById('map-canvas'));
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

                var error = $('.input-group span.error');
                for(var i = 0 ; i < error.length ; i++) {
                    if(!$(error[i]).hasClass('hidden'))
                        $(error[i]).addClass('hidden')
                }

                $.ajax({
                    data : $(this).serialize(),
                    method : method,
                    action: action
                }).done(function(){
                    name.val('');
                    description.val('')
                    longitude.val('')
                    latitude.val('')
                }).fail(function(data) {

                   var error = data.responseJSON;

                    for(var e in error) {

                        $("#"+e).next('span.error').removeClass('hidden').text(error[e][0]);

                    }

                })
            })

        })

    </script>