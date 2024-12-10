<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\MasterClass;

class HomeController extends Controller
{
    /**
     * Отображение главной страницы.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Получаем все категории
        $categories = Category::all();

        // Передаем их в шаблон
        return view('home', compact('categories'));
    }
}
