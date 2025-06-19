<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Services\TMDBService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    public function search(Request $request, TMDBService $tmdb)
    {
        $query = $request->input('query');
        $movies = [];
        if ($query) {
            $results = $tmdb->searchMovies($query);
            $movies = array_slice($results['results'] ?? [], 0, 12); 
        }

        return view('movie.search')->with(['movies'=>$movies]);
    }

    public function show($id, TMDBService $tmdb)
    {
        $movie = $tmdb->getMovie($id);
        $reviews = Review::where('tmdb_id', $movie['id'])->get();
        $directors = collect($movie['credits']['crew'])
            ->where('job', 'Director')
            ->pluck('name')
            ->unique()
            ->implode(', ');

        return view('movie.show')->with(['movie'=>$movie, 'directors'=>$directors, 'reviews'=>$reviews]);
    }
}
