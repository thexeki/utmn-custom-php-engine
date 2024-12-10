<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MasterClass;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Отображение мастер-классов в категории.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        // Получаем текущую категорию
        $category = Category::findOrFail($id);

        // Получаем мастер-классы этой категории
        $masterClasses = $category->masterClasses()->with('user')->get();

        // Получаем другие категории для меню
        $otherCategories = Category::where('id', '!=', $id)->get();

        return view('category', compact('category', 'masterClasses', 'otherCategories'));
    }
}
