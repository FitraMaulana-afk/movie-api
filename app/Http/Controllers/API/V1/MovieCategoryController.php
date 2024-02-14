<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\MovieCategory\StoreMovieCategoryRequest;
use App\Http\Requests\MovieCategory\UpdateMovieCategoryRequest;
use App\Models\MovieCategory;
use App\Services\MovieCategoryService;
use Exception;
use Illuminate\Http\Request;

class MovieCategoryController extends Controller
{
    public MovieCategoryService $movieCategoryService;

    public function __construct()
    {
        $this->movieCategoryService = new MovieCategoryService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $response = $this->movieCategoryService->index($request)->paginate(10);

            return \responder()
                ->success($response);
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMovieCategoryRequest $request)
    {
        try {
            $response = $this->movieCategoryService->store($request);

            return \responder()
                ->success($response);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MovieCategory $movieCategory)
    {
        try {
            $response = $movieCategory;

            return \responder()
                ->success($response);
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMovieCategoryRequest $request, MovieCategory $movieCategory)
    {
        try {
            $response = $this->movieCategoryService->update($request, $movieCategory);

            return \responder()
                ->success($response);
        } catch (Exception $e) {
            return \responder()
                ->error($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MovieCategory $movieCategory)
    {
        try {
            $this->movieCategoryService->delete($movieCategory);

            return \responder()
                ->success();
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}
