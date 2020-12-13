<?php


namespace App\Http\Controllers;

use App\Http\Requests\Board\CreateBoardRequest;
use App\Http\Requests\Board\UpdateBoardRequest;
use App\Models\Board;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;


class BoardController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        $boards = Board::with('user')
            ->orderBy ('updated_at', 'DESC')
           ->paginate(5);

        return view('boards.index', [
            'boards' => $boards,
            'userEmail' => $user->email ?? null]);
    }

    public function create()
    {
        return view('boards/create');
    }

    public function show($boardId)
    {
        $board = Board::query()
            ->where('id', '=', $boardId)
            ->first();

        return view('boards.show',compact('board'));
    }

    public function edit(Board $board)
    {
        return view('boards.edit',compact('board'));
    }


    public function store(CreateBoardRequest $request): RedirectResponse
    {
        /** @var UploadedFile $file */
        /** @var User|null $user */


            $file = $request->file('file');
            $validated = $request->validated();

            $board = new Board();
            $board->user_id = $request->user()->id;
            $board->title = $validated['title'];
            $board->description = $validated['description'];
            $board->price = $validated['price'];
            $board->image = '';
            $board->save();
            $ext = last(explode('.', $file->getClientOriginalName()));

            $fileName = md5(time()) . '.' . $ext;
            $file->storeAs('', $fileName, 'public');

            $board->image = $fileName;

            $board->save();
            $board->load('user');
            return redirect('/boards');
        }



    public function update(UpdateBoardRequest $request, $boardId)
    {
        $board = Board::query()
            ->where('id', '=', $boardId)
            ->first();

        if ($board->user_id == Auth::user()->id)

        if (!$board) {
            return response()->json(['error' => 'Оголошення не знайдене з ID: ' . $boardId], Response::HTTP_NOT_FOUND);
        }

        $validated = $request->validated();

        $board->title = $validated['title'] ?? $board->title;
        $board->description = $validated['description'] ?? $board->description;
        $board->price = $validated['price'] ?? $board->price;

        $board->save();

        return redirect()->route('boards.index')
            ->with('success', 'Оголошення оновлено');
    }

    public function destroy($boardId)
    {
        $board = Board::query()
            ->where('id', '=', $boardId)
            ->first();

        if (!$board) {
            return response()->json(['error' => 'голошення не знайдене з ID: ' . $boardId], Response::HTTP_NOT_FOUND);
        }

        $board->delete();

        return redirect('/boards')
            ->with('success', 'Оголошення видалено!');
    }

}
