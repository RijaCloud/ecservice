@extends('template.admin')

@section('content')

    <div class="content-wrapper">

        @include('admin.content-header', [

            'title'=>'Pays',
            'link'=>[

                ['name'=>'Acceuil','url'=>route('admin.index')],
                ['name'=>'Pays']
            ]

        ])
        <section class="content">
            <div class="box box-default">

                <div class="box-header with-border">
                    <h3 class="box-title">Pays</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                    </div>

                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="map-canvas" style="min-height:400px;">

                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-12">

                            <div class="col-md-6">
                                <form action="{{ action('Back\TerritoryController@create') }}" method="POST">
                                    <div class="form-group">
                                        <label for="state"></label>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6">

                            </div>

                        </div>

                    </div>
                </div>

                <div class="box-footer">
                    Administration EveryCycle
                </div>
            </div>
        </section>
        <script src="{{ asset('admin/js/load-map.js') }}"></script>

        <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjd71as-VYz99wgGgkT3l4FQ3pL14fEuc&callback=initMap"></script>

    </div>

    
@endsection

@section('script')
        <!-- jQuery 2.2.3 -->
    <script src="{{ asset('admin/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.6 -->
    <script src="{{ asset('admin/bootstrap/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('admin/js/load-map.js') }}"></script>

    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjd71as-VYz99wgGgkT3l4FQ3pL14fEuc&callback=initMap"></script>


@endsection