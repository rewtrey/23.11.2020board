@extends('boards.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Check all advertisement</h2>
            </div>

            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('boards.create') }}"> Create new advertisement</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Title</th>
            <th>Description</th>
            <th>Price $</th>
            <th>Created at</th>
            @if ($userEmail)
            <th width="250px">Action</th>
            @endif

        </tr>
        @foreach ($boards as $board)
            <tr>
                <td>{{ $board['id']}}</td>
                <td>{{ $board['title']}}</td>
                <td>{{ $board['description']}}</td>
                <td>{{ $board['price']}}</td>
                <td>{{ $board['created_at']}}</td>
                <td>
                    @if ($userEmail)
                        <form action="{{ route('boards.destroy',$board['id']) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('boards.show',$board['id']) }}">Show</a>

                        <a class="btn btn-primary" href="{{ route('boards.edit',$board['id']) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                    @endif
                    </form>
                </td>
            </tr>

        @endforeach

    </table>



@endsection
