<?php


namespace App\Http\Controllers;

use App\Http\Requests\Board\CreateBoardRequest;
use App\Http\Requests\Board\UpdateBoardRequest;
use App\Models\Board;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class BoardController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        $boards = Board::query()
            ->orderBy('updated_at', 'DESC')
            ->get()
            ->toArray();

        return view('boards.index', [
            'boards' => $boards,
            'userEmail' => $user->email ?? null
        ])->with('i',(request()->input('page',1)-1)*5);


    }


    public function create()
    {
        return view('boards.create');
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

    public function store(CreateBoardRequest $request)
    {
        /** @var User|null $user */
        $user = $request->user();

        if (!$user) {
            return response()->json(['error' => 'You should be authorized to create board!'], Response::HTTP_UNAUTHORIZED);
        }

        $validated = $request->validated();

        $board = new Board();
        $board->user_id = $user->id;
        $board->title = $validated['title'];
        $board->description = $validated['description'];
        $board->price = $validated['price'];
        $board->created_at = $validated['created_at'];
        $board->save();

        return redirect('/boards');
    }

    public function update(UpdateBoardRequest $request, $blogId)
    {
        $board = Board::query()
            ->where('id', '=', $blogId)
            ->first();

        if (!$board) {
            return response()->json(['error' => 'Blog not found with ID: ' . $blogId], Response::HTTP_NOT_FOUND);
        }

        $validated = $request->validated();

        $board->title = $validated['title'] ?? $board->title;
        $board->description = $validated['description'] ?? $board->description;
        $board->price = $validated['price'] ?? $board->price;

        $board->save();

        return redirect()->route('boards.index')
            ->with('success', 'Board updated successfully');
    }

    public function destroy($boardId): JsonResponse
    {
        $board = Board::query()
            ->where('id', '=', $boardId)
            ->first();

        if (!$board) {
            return response()->json(['error' => 'Board not found with ID: ' . $boardId], Response::HTTP_NOT_FOUND);
        }

        $board->delete();

        return response()->json(['message' => 'Board [' . $boardId . '] has been removed!'], Response::HTTP_ACCEPTED);
    }
}
