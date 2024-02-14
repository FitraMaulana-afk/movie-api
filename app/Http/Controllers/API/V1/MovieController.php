<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Services\MovieService;
use Exception;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public MovieService $movieService;

    public function __construct()
    {
        $this->movieService = new MovieService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $response = $this->movieService->index($request)->paginate(10);
            // \dd($response);
            return \responder()
                ->success($response);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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