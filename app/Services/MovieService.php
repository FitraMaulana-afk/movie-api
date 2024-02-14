<?php

namespace App\Services;

use App\Models\Movie;
use Exception;
use Illuminate\Http\Request;

/**
 * Class MovieService
 * @package App\Services
 */
class MovieService
{
    public Movie $movie;
    public ?string $oldImage = null;
    public ?string $newImage = null;

    public function __construct()
    {
        $this->movie = new Movie();
    }

    public function index(Request $request)
    {
        try {
            $movies = $this->movie->query()->with(['user', 'category']);

            return $movies;
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}