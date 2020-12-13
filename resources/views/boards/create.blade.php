@extends('boards.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Створити оголошення</h3></div>
                </div>
            </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Warning!</strong> Please check your input code<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('boards.store') }}" method="POST" class="form-group" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="form-group">
                    <strong>Заголовок: </strong>
                    <input type="text" name="title" class="form-control" placeholder="Заголовок">
                </div>
            </div>
            <div class="col-md-10 col-md-offset-1">
                <div class="form-group">
                    <strong>Опис: </strong>
                    <textarea class="form-control" style="height:150px"  type="text" name="description" class="form-control" placeholder="Опис"></textarea>
                </div>
            </div>
            <div class="col-md-10 col-md-offset-1">
                <div class="form-group">
                    <strong>Ціна: </strong>
                    <input type="number" name="price" class="form-control" placeholder="Ціна ₴">
                </div>
            </div>
                <div class="col-md-10 col-md-offset-1">
                    <div class="form-group">
                        <strong>Зображення: </strong>
                            <input type="file" class="form-control" name="file"><br>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <input type="submit" value="Створити" class="btn btn-success">
                                </div>
                    </div>
                </div>
@endsection
