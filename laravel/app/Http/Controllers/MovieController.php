<?php

namespace App\Http\Controllers;

use App\Services\TMDBService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    public function search(Request $request, TMDBService $tmdb)
    {
        $query = $request->input('query');
        $movies = $tmdb->searchMovies($query);

        return response()->json($movies);
    }

    public function show($id, TMDBService $tmdb)
    {
        $movie = $tmdb->getMovie($id);
        $directors = collect($movie['credits']['crew'])
            ->where('job', 'Director')
            ->pluck('name')
            ->unique()
            ->implode(', ');

        return view('movie.show')->with(['movie'=>$movie, 'directors'=>$directors]);
    }
}
