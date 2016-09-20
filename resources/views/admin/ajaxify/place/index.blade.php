
<div class="content-wrapper">

    @include('admin.content-header' ,
        [
        'title'=>'Places',
        'link'=>[
            ['name'=>'Acceuil','url'=>route('admin.index')],
            ['name'=>'Places','url'=>route('place.index')],
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

                        <form action="{{ action('Back\PlaceController@store') }}" method="POST">
                            <div class="form-group">
                                <label for="name">Nom de la place</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Ex:Yaccoo">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" placeholder="Ex:Magasin..."></textarea>
                            </div>
                            <div class="form-group">
                                <label for="longitude">Longitude</label>
                                <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Longitude">
                            </div>
                            <div class="form-group">
                                <label for="latitude">Latitude</label>
                                <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Latitude">
                            </div>
                            <div class="form-group">
                                <label for="fokontany">Fokontany de : </label>
                                <select name="fokontany" id="fokontany">
                                    @foreach($fokontany as $f)
                                        <option value="{{ $f->id }}">{{ $f->nom }}</option>
                                    @endforeach
                                </select>
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


<div id="coord" data-lat="{{ $place->latitude }}" data-lng="{{ $place->longitude }}"></div>

<script src="{{ asset('admin/js/load-map.js') }}"></script>

<script>
    var coord = document.getElementById('coord');
    app.map.initMap(document.getElementById('map-canvas'), {lat:coord.data('lat') , lng: coord.data('lng') });
</script>