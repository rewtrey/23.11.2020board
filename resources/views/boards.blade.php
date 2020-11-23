Hello,
@if($userEmail)
    {{$userEmail}} <a href="logout">Logout</a>
@else
    Guest <a href="/login">Login</a> - <a href="/register">Register</a>
@endif

<br>
    @if ($userEmail)
        <form action="/boards" method="POST">
            <input type="text" name="title" placeholder="Title">
            <input type="text" name="description" placeholder="description">
            <input type="text" name="price" placeholder="price">
            <input type="submit" value="create">
        </form>
    @endif

<table border="1">
    <thead>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>description</th>
        <th>price</th>
        <th>User ID</th>

    </tr>
    </thead>
    <tbody>
        @foreach($boards as $board)
            <tr>
                <td>{{$board['id']}}</td>
                <td>{{$board['title']}}</td>
                <td>{{$board['description']}}</td>
                <td>{{$board['price']}}</td>
                <td>{{$board['user_id']}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
