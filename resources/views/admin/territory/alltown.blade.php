@extends('template.admin')

@section('head')
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables/jquery.dataTables.min.css') }}">
@endsection

@section('content')

    <div class="content-wrapper">

        @include('admin.content-header' ,
            [
            'title'=>'Commune',
            'link'=>[
                ['name'=>'Acceuil','url'=>route('admin.index')],
                ['name'=>'Commune','url'=>route('territory.town')],
                ['name'=>'Listes Communes de la base de donnée']
            ]])

        @include('admin.all',['latest'=>$latest,'title'=>"Town"])

    </div>
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
