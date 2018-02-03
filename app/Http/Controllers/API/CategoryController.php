<?php

namespace App\Http\Controllers\API;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getCategories()
    {
        return Category::all();
    }

    public function createCategory(Request $request)
    {
        if (Auth::user()->id !== 1) {
            return response()->json([
                'message' => 'Только пользователь с ID = 1 может создавать категории!'
            ], Response::HTTP_BAD_REQUEST);
        }

        $this->validateCategory($request);

        $category = new Category($request->all());
        $category->save();

        return $category;
    }

    public function showCategory($id)
    {
        $category = Category::findOrFail($id);

        return $category;
    }

    public function updateCategory($id, Request $request)
    {
        $this->validateCategory($request);

        $category = Category::findOrFail($id);
        $category->fill($request->all());
        $category->save();

        return $category;
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return ['message' => 'Category deleted'];
    }

    private function validateCategory(Request $request)
    {
        Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ])->validate();
    }
}