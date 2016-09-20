@extends('template.admin')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Tableau de bord EveryCycle
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('gstion/admin') }}"><i class="fa fa-dashboard"></i> Acceuil </a></li>
            </ol>
        </section>
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

@endsection