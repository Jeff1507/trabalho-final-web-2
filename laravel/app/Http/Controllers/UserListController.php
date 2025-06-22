<?php

namespace App\Http\Controllers;

use App\Models\UserList;
use App\Models\UserListMovie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $path = "images/movies-list";

    public function index()
    {
        $user = Auth::user();
        $userLists = UserList::where('user_id', $user->id)->get();
        return view('movies-list.index')->with(['user_lists'=>$userLists]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('movies-list.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3',
            'img' => 'nullable|image|max:2048',
            'description' => 'nullable|string|max:255'
        ]);

        $user = Auth::user();

        $user_list = new UserList();
        $user_list->name = mb_strtoupper($request->name, 'UTF-8');
        $user_list->description = $request->description;
        $user_list->user()->associate($user);
        
        if ($request->hasFile('img') && $request->file('img')->isValid()) {
            $arq = $request->file('img');
            $nome_arq = Str::uuid() . '_' . time() . '.' . $arq->getClientOriginalExtension();

            $arq->storeAs("public/$this->path", $nome_arq);

            $user_list->img = $this->path . "/" . $nome_arq;
        }

        $user_list->save();

        return redirect()->route('movies-list.index')->with('success', 'Lista criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user_list = UserList::findOrFail($id);

        $user = Auth::user();
        if ($user_list->user_id !== $user->id) {
            return redirect()->back()->with('error', 'Você não tem permissão para realizar essa ação!');
        }

        $movies = $user_list->movies;
        //$movies = UserListMovie::with(['movie'])->where('user_list_id', $user_list->id)->get();
        return view('movies-list.show')->with(['user_list'=>$user_list, 'movies'=>$movies]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {   
        $user_list = UserList::findOrFail($id);
        $user = Auth::user();
        if ($user_list->user_id !== $user->id) {
            return redirect()->back()->with('error', 'Você não tem permissão para realizar essa ação!');
        }
        return view('movies-list.edit')->with(['user_list'=>$user_list]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        $user_list = UserList::findOrFail($id);

        if ($user_list->user_id !== $user->id) {
            return redirect()->back()->with('error', 'Você não tem permissão para realizar essa ação!');
        }

        $request->validate([
            'name' => 'required|string|min:3',
            'img' => 'nullable|image|max:2048',
            'description' => 'nullable|string|max:255'
        ]);
        

        $user_list->name = mb_strtoupper($request->name, 'UTF-8');
        $user_list->description = $request->description;
        $user_list->user()->associate($user);

        if ($request->hasFile('img') && $request->file('img')->isValid()) {
            if ($user_list->img && Storage::exists("public/{$user_list->img}")) {
                Storage::delete("public/{$user_list->img}");
            }
            $arq = $request->file('img');
            $nome_arq = Str::uuid() . '_' . time() . '.' . $arq->getClientOriginalExtension();

            $arq->storeAs("public/$this->path", $nome_arq);

            $user_list->img = $this->path . "/" . $nome_arq;
        }

        $user_list->save();

        return redirect()->route('movies-list.show', $id)->with('success', 'Lista atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();
        $user_list = UserList::findOrFail($id);
        if ($user_list->user_id !== $user->id) {
            return redirect()->back()->with('error', 'Você não tem permissão para realizar essa ação!');
        }

        if ($user_list->img && Storage::exists("public/{$user_list->img}")) {
            Storage::delete("public/{$user_list->img}");
        }

        $user_list->delete();

        return redirect()->route('movies-list.index')->with('success', 'Lista excluida com sucesso!');
    }
}
