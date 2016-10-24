
<section class="content">
    <div class="row">
        <div class="col-md-8">
            <div class="box box-default">
                <div class="box-header box-with-border">
                    <h3 class="box-title">WheelsMada</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                    </div>

                </div>
                <div class="box-body">
                    <table id="datatable_e" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            @if(Route::current()->getName() == 'territory.allPlace')
                                <td>No.</td>
                                <td>Name</td>
                                <td>Description</td>
                                <td>Fokontany</td>
                            @else
                                <td>No.</td>
                                <td>Name</td>
                                <td>Description</td>
                                <td>Lieux affilié</td>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($latest))

                            @foreach($latest as $last)

                                <?php
                                $link = Route::current()->getName() == 'territory.allPlace' ? route('territory.readPlace',['id'=>$last->id.'-'. str_replace(' ','-',$last->string_lieu) ]) : route('territory.read'.ucfirst($title) , ['id'=>$last->id.'-'.$last->nom])
                                ?>

                                <tr style="cursor:pointer;" data-link="{{ $link }}" data-delete="{{ route('territory.deletePlace',['id'=>$last->id]) }}" class="to-map">
                                        @if(Route::current()->getName() == 'territory.allPlace')
                                    <td>{{ $last->id }}</td>
                                    <td>{{ $last->string_lieu }}</td>
                                    <td>{{ $last->description }}</td>
                                    <td>{{ $last->fokontany->nom }}</td>
                                            @else
                                        <td>{{ $last->id }}</td>
                                        <td>{{ $last->nom }}</td>
                                        <td>{{ $last->description }}</td>
                                        <td></td>

                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <li class="item">
                                Aucune donner à afficher
                            </li>
                        @endif
                        </tbody>

                    </table>

                </div>
                <div class="box-footer text-center">
                    Administration WheelsMada
                </div>
            </div>
            <div class="box box-default">
                <div class="box-header box-with-border">
                    <h3 class="box-title">Details</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                    </div>

                </div>
                <div class="box-body">
                    <div class="row" id="info" style="display:none;">
                        <div class="col-md-12">
                            <a style="display:inline-block;" class="btn btn-primary" id="edit">Editer</a>
                            <form style="display:inline-block;" action="" id="delete" method="POST">
                                {{ csrf_field() }}
                                <button class="btn btn-warning" id="delete">Supprimer</button>
                            </form>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="map-latitude">Nom</label>
                                <input type="text" class="form-control" value="" id="map-name" disabled>
                            </div>
                            <div class="form-group">
                                <label for="map-description">Description</label>
                                <textarea id="map-description" class="form-control" disabled></textarea>
                            </div>
                            <div class="form-group">
                                <label for="map-latitude">Latitude</label>
                                <input type="text" class="form-control" value="" id="map-latitude" disabled>
                            </div>
                            <div class="form-group">
                                <label for="map-longitude">Longitude</label>
                                <input type="text" class="form-control" value="" id="map-longitude" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer text-center">
                    Administration WheelsMada
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-default">
                <div class="box-header box-with-border">
                    <h3 class="box-title">WheelsMada</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                    </div>

                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="canvas" style="height:400px;"></div>
                        </div>
                    </div>
                </div>
                <div class="box-footer text-center">
                    Administration WheelsMada
                </div>
            </div>

        </div>
    </div>
</section>

<script src="{{ asset('admin/js/load-map.js') }}"></script>

<script>
    app.map.initMap(document.getElementById('canvas'));

    var tomap = document.querySelectorAll('.to-map');
    var load = document.querySelector('.img-loader');
    for(var i = 0 ; i < tomap.length ; i++) {
        tomap[i].addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            load.classList.remove('hidden')
            app.map.findMapAndReloadMarkers(this.getAttribute('data-link'),this.getAttribute('data-delete'));
        })
    }
</script>