<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $reviews = Review::where('user_id', $user->id)->get();
        return view('review.index')->with(['reviews'=>$reviews]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'rating' => 'required|integer|min:1|max:5',
                'content' => 'nullable|string|max:255',
                'tmdb_id' => 'required|string'
            ]);

            $review = Review::create([
                'rating' => $request->rating,
                'tmdb_id' => $request->tmdb_id,
                'user_id' => Auth::user()->id
            ]);

            if ($request->content) {
                Comment::create([
                    'content' => $request->content,
                    'isReported' => false,
                    'isRemoved' => false,
                    'review_id' => $review->id
                ]);
            }

            return back()->with('success', 'Avaliação enviada com sucesso!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Erro: ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
