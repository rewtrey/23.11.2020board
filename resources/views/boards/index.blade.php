@extends('boards.layout')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/boards/create') }}">Створити оголошення</a></li>
                </ul>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Заголовок</th>
                                <th>Опис</th>
                                <th>Ціна ₴</th>
                                <th>Зображення</th>
                                    @if ($userEmail)
                                <th>Добавлено</th>
                                <th width="200px">Більше</th>
                                    @endif
                            </tr>
                        </thead>

                        @foreach ($boards as $board)
                            <tr>
                                <td>{{ $board['id']}}</td>
                                <td>{{ $board['title']}}</td>
                                <td>{{ $board['description']}}</td>
                                <td>{{ $board['price']}} ₴</td>
                                <td><img src="{{$board['image']}}" width="100" alt="image"/></td>
                                <td>{{ $board['created_at']}}</td>
                                <td>
                                    @if ($userEmail)
                                        <form action="{{ route('boards.destroy',$board['id']) }}" method="POST">
                                            <a class="btn btn-success" href="{{ route('boards.show',$board['id']) }}">
                                                <i class="fa fa-eye"></i>
                                            </a>

                                    @if ($board->user_id == Auth::user()->id)
                                            <a class="btn btn-primary" href="{{ route('boards.edit',$board['id']) }}">
                                                <i class="fa fa-pencil" ></i>
                                            </a>

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    @endif
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            {{ $boards->links() }}
        </div>
                @endsection

