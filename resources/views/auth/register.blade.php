@extends('boards.layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Реєстрація</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Імя</label>

                                <div class="col-md-6">
                                    <input type="text" placeholder = "Імя" class="form-control" name="name" value="{{ old('name') }}">

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('lastName') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Прізвище</label>

                                <div class="col-md-6">
                                    <input type="text" placeholder = "Прізвище" class="form-control" name="lastName" value="{{ old('lastName') }}">

                                    @if ($errors->has('lastName'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('lastName') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Номер телефону</label>

                                <div class="col-md-6">
                                    <input type="number" placeholder = "Номер телефону" class="form-control" name="phone" value="{{ old('phone') }}">

                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Email-адрес</label>

                                <div class="col-md-6">
                                    <input type="email" placeholder = "Email-адрес" class="form-control" name="email" value="{{ old('email') }}">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Пароль</label>

                                <div class="col-md-6">
                                    <input type="password" placeholder = "Пароль" class="form-control" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i>Зареєструватись
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection
