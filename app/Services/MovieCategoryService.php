<?php

namespace App\Services;

use App\Http\Requests\MovieCategory\StoreMovieCategoryRequest;
use App\Http\Requests\MovieCategory\UpdateMovieCategoryRequest;
use App\Models\MovieCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * Class MovieCategoryService
 * @package App\Services
 */
class MovieCategoryService
{
    public MovieCategory $movieCategory;
    public ?string $oldImage = null;
    public ?string $newImage = null;

    public function __construct()
    {
        $this->movieCategory = new MovieCategory();
    }

    public function index(Request $request)
    {
        try {
            $movieCategories = $this->movieCategory->query()->with('user');

            return $movieCategories;
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function store(StoreMovieCategoryRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            if ($request->hasFile('image')) {
                $this->newImage = $request->file('image')->store('movie-category/image', 'public');
                $data['image'] = $this->newImage;
            }
            $data['user_id'] = auth()->id();
            $movieCategory = $this->movieCategory->create($data);
            DB::commit();

            return $movieCategory;
        } catch (\Exception $e) {
            DB::rollBack();

            $e->getMessage();
        }
    }

    public function update(UpdateMovieCategoryRequest $request, MovieCategory $movieCategory)
    {
        DB::beginTransaction();
        try {
            // dd($movieCategory);
            $data = $request->validated();
            if ($request->hasFile('image')) {
                $this->oldImage = $movieCategory->image;
                $this->newImage = $request->file('image')->store('movie-category/image', 'public');
                $data['image'] = $this->newImage;
            }
            $data['user_id'] = auth()->id();
            $movieCategory->update($data);
            DB::commit();
            DB::afterCommit(function () {
                if (!empty($this->oldImage) && (Storage::disk('public'))->exists($this->oldImage)) {
                    Storage::disk('public')->delete($this->oldImage);
                }
            });

            return $movieCategory;
        } catch (\Exception $e) {
            DB::rollBack();
            $e->getMessage();
        }
    }

    public function delete(MovieCategory $movieCategory)
    {
        DB::beginTransaction();
        try {
            $this->oldImage = $movieCategory->image;
            $movieCategory->delete();
            DB::commit();
            DB::afterCommit(function () {
                if (!empty($this->oldImage) && (Storage::disk('public'))->exists($this->oldImage)) {
                    Storage::disk('public')->delete($this->oldImage);
                }
            });

            return $movieCategory;
        } catch (Exception $e) {
            DB::rollBack();
            $e->getMessage();
        }
    }
}
