<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Review;
use App\Models\UserList;
use App\Models\UserListMovie;
use App\Services\TMDBService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class MovieController extends Controller
{
    public function search(Request $request, TMDBService $tmdb)
    {
        $query = $request->input('query');
        $page = $request->input('page', 1);
        $movies = [];
        $total_pages = 0;
        
        if ($query) {
            $results = $tmdb->searchMovies($query, $page);
            $movies = $results['results'] ?? []; 
            $total_pages = $results['total_pages'] ?? 1;
        }

        return view('movie.search')->with(['movies'=>$movies, 'query'=>$query, 'page'=>$page, 'total_pages'=>$total_pages]);
    }

    public function show($id, TMDBService $tmdb)
    {
        $movie = $tmdb->getMovie($id);

        $reviews = Review::where('tmdb_id', $movie['id'])->get();

        $user_lists = UserList::where('user_id', Auth::user()->id)->get();

        $directors = collect($movie['credits']['crew'])
            ->where('job', 'Director')
            ->pluck('name')
            ->unique()
            ->implode(', ');

        return view('movie.show')->with(['movie'=>$movie, 'directors'=>$directors, 'reviews'=>$reviews, 'user_lists'=>$user_lists]);
    }

    public function addToList(Request $request)  {
        try {
            $request->validate([
                'user_list_id' => 'required|exists:user_lists,id',
                'tmdb_id' => 'required|string',
                'title' => 'required|string',
                'poster_url' => 'nullable|string',
                'release_year' => 'required|string',
                'runtime' => 'required|string',
                'overview' => 'nullable|string'
            ]);

            $posterPath = null;

            if ($request->poster_url) {
                $tmdbPosterUrl = 'https://image.tmdb.org/t/p/original' . $request->poster_url;
                $posterContents = Http::withOptions([
                    'verify'=>false
                ])->get($tmdbPosterUrl)->body();

                $posterName = Str::uuid() . '.jpg';
                Storage::disk('public')->put("images/posters/{$posterName}", $posterContents);

                $posterPath = "images/posters/{$posterName}";
            }

            $movie = Movie::firstOrCreate(
                ['tmdb_id' => $request->tmdb_id],
                [
                    'title' => $request->title,
                    'poster_url' => $posterPath,
                    'release_year' => substr($request->release_year, 0, 4),
                    'runtime' => $request->runtime,
                    'overview' => $request->overview,
                ]
            );

            $user_list = UserList::findOrFail($request->user_list_id);

            UserListMovie::create([
                'user_list_id' => $user_list->id,
                'movie_id' => $movie->id
            ]);

            return back()->with('success', 'Filme adicionado à lista com sucesso!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Filme já adicionado!');
        }
    }
}
