<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TMDBService
{
    protected string $baseUrl;
    protected string $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('services.tmdb.base_url');
        $this->apiKey = config('services.tmdb.key');
    }

    public function searchMovies(string $query, int $page = 1)
    {
        return Http::withOptions([
            'verify' => false,
        ])->get("{$this->baseUrl}/search/movie", [
            'api_key' => $this->apiKey,
            'query' => $query,
            'language' => 'pt-BR',
            'page' => $page
        ])->json();
    }

    public function getMovie(int $id)
    {
        return Http::withOptions([
            'verify' => false,
        ])->get("{$this->baseUrl}/movie/{$id}", [
            'api_key' => $this->apiKey,
            'language' => 'pt-BR',
            'append_to_response' => 'credits',
        ])->json();
    }
}
