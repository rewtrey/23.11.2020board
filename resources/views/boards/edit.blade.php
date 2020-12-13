@extends('boards.layout')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3><h2>Редагувати оголошення</h2></h3></div>
                    </div>
                </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Warning!</strong> Please check input field code<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('boards.update',$board->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="form-group">
                    <strong>Заголовок:</strong>
                    <input type="text" name="title" value="{{ $board->title }}" class="form-control" placeholder="Title">
                </div>
            </div>
            <div class="col-md-10 col-md-offset-1">
                <div class="form-group">
                    <strong>Опис:</strong>
                    <textarea class="form-control" style="height:150px" name="description" placeholder="Description">{{ $board->description }}</textarea>
                </div>
            </div>
            <div class="col-md-10 col-md-offset-1">
                <div class="form-group">
                    <strong>Ціна :</strong>
                    <input type="number" name="price" value="{{ $board->price }}₴" class="form-control" placeholder="Ціна ₴">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-success">Зберегти</button>
            </div>
        </div>




    </form>
@endsection
