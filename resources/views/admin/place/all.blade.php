@extends('template.admin')

@section('head')
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables/jquery.dataTables.min.css') }}">
@endsection

@section('content')

    <div class="content-wrapper">

        @include('admin.content-header' ,
            [
            'title'=>'Places',
            'link'=>[
                ['name'=>'Acceuil','url'=>route('admin.index')],
                ['name'=>'Places','url'=>route('territory.indexPlace')],
                ['name'=>'Listes des CycleServices existant']
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
                                <table id="datatable_e" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <td>No.</td>
                                            <td>Name</td>
                                            <td>Description</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($latest))
                                        @foreach($latest as $last)
                                            <tr style="cursor:pointer;" data-link="{{ route('territory.readPlace',['id'=>$last->id]) }}" data-delete="{{ route('territory.deletePlace',['id'=>$last->id]) }}" class="to-map">
                                                <td>{{ $last->id }}</td>
                                                <td>{{ $last->string_lieu }}</td>
                                                <td>{{ $last->description }}</td>
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
                            <h3 class="box-title">Details</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                            </div>

                        </div>
                        <div class="box-body">
                            <div class="row" id="info" style="display:none;">
                                <div class="col-md-12">
                                    <a class="btn btn-primary" id="edit">Editer</a>
                                    <form action="" id="delete" method="POST">
                                        {{ csrf_field() }}
                                        <button class="btn btn-warning" id="delete">Supprimer</button>
                                    </form>

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

        var tomap = document.querySelectorAll('.to-map');
        var load = document.querySelector('.img-loader');
        for(var i = 0 ; i < tomap.length ; i++) {
            tomap[i].addEventListener('click', function(e) {
                e.preventDefault();
                load.classList.remove('hidden')
                app.map.findMapAndReloadMarkers(this.getAttribute('data-link'),this.getAttribute('data-delete'));
            })
        }
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
                $.ajax({data:$(this).serialize(),url:$(this).attr('action'),method:$(this).attr('method')})
            });
        })
    </script>

    @endsection

    @section('script')

            <!-- jQuery 2.2.3 -->
    <script src="{{ asset('admin/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>

    <!-- DataTables -->
    <script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>

    <script>
        $(function () {
            $('#datatable_e').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false

            });
        });
    </script>
@endsection