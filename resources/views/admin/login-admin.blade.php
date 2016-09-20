@extends('template.admin')

@section('content')

<div class="login-box">
    <div class="login-logo">
        <a href="{{ url('/') }}"><b>EveryCycle</b>
            <br>
            <h2>Administration</h2></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">{{ trans('login.msg-box-alert') }} <br> {{ trans('login.msg-box-msg') }} </p>

        <form action="{{ action('Auth\LoginController@login') }}" method="post" autocomplete="off">
            {{ csrf_field() }}
            <div class="form-group has-feedback">
                <input type="text" class="form-control" name="username" id="username" placeholder="{{ trans('login.nameholder') }}">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                <span class="help-block hidden block">{{ trans('login.invalide') }}</span>
                <span class="help-block hidden error"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                <span class="help-block hidden block">{{ trans('login.invalide') }}</span>
                <span class="help-block hidden error"></span>
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In <img src="{{ asset('img/ajax-loader.gif') }}" class="hidden"> </button>
                </div>
                <!-- /.col -->
            </div>
        </form>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@endsection

@section('script')

<!-- jQuery 2.2.3 -->
<script src="{{ asset('admin/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('admin/bootstrap/js/bootstrap.min.js') }}"></script>

<script >
    $(function() {

        var btn = $('button[type="submit"]');
        var form = btn.parent('form');
        var name = $('#username');
        var name_help = name.nextAll('span.block');
        var name_error = name.nextAll('span.error');
        var password = $('#password');
        var pass_help = password.nextAll('span.block');
        var pass_error = password.nextAll('span.error');
        var regex_name = /([\w\d\s_-])+/i;
        var regex_password = /([\w\d])+/i;
        var name_has_error = false;
        var pass_has_error = false;

        btn.click(function(event) {

            event.preventDefault();

            hide_help_if_show();

            btn.prop('disabled','disabled');
            btn.find('img').toggleClass('hidden');

            if(!regex_name.test(name.val()) || name.val() == "" ) {
                name_has_error = true;
            }

            if(!regex_password.test(password.val())|| password.val() == "") {
                pass_has_error = true;
            }

            if(!name_has_error && !pass_has_error) {

                $.ajax({
                    url: form.attr('action'),
                    method: "POST",
                    data: "_token={{ csrf_token() }}&name="+name.val()+"&password_confirmation="+password.val(),
                    statusCode: {
                        422: function(data) {
                            handle_error(data);
                            reset_btn();
                        },
                        500: function(data) {
                            alert('Une erreur interne est survenue')
                        },
                        200: function(data) {
                            window.location.href = "{{ url('gstion/admin') }}"
                        }
                    }
                })

            } else {

                setTimeout(function() {

                    if(name_has_error) {

                        name.parent('div').addClass('has-error');
                        name_help.removeClass('hidden')
                    }

                    if(pass_has_error) {
                        password.parent('div.form-group').addClass('has-error')
                        pass_help.removeClass('hidden')
                    }

                    reset_btn();
                    reset_error();

                },1000);

            }
        })

        function reset_btn (){
            btn.prop('disabled','');
            btn.find('img').addClass('hidden');
        }

        function reset_error () {
            name_has_error = false;
            pass_has_error = false;
        }

        function hide_help_if_show() {

            if(name.parent('div').hasClass('has-error'))
                name.parent('div').removeClass('has-error');
            if(password.parent('div').hasClass('has-error'))
                password.parent('div').removeClass('has-error')
            if(!name_help.hasClass('hidden'))
                    name_help.addClass('hidden')
            if(!pass_help.hasClass('hidden'))
                    pass_help.addClass('hidden')
            if(!name_error.hasClass('hidden'))
                name_error.addClass('hidden')
            if(!pass_error.hasClass('hidden'))
                pass_error.addClass('hidden')

        }

        function handle_error(data) {
            var data = data.responseJSON;
            if(data.name) {
                name.parent('div').addClass('has-error');
                name_error.removeClass('hidden').html(data.name[0])
            }
            if(data.password_confirmation) {
                password.parent('div').addClass('has-error');
                pass_error.removeClass('hidden').html(data.password_confirmation[0])

            }
        }

    });
</script>
@endsection