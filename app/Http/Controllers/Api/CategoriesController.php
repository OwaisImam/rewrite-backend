<?php

namespace App\Http\Controllers\Api;

use App\Helper\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\CategoryRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    private Request $request;
    private User $user;
    private CategoryRepository $categoryRepository;

    public function __construct(Request $request, CategoryRepository $categoryRepository)
    {
        $this->request = $request;
        $this->categoryRepository = $categoryRepository;
        $this->user = Auth::guard('api')->user();
    }

    public function index()
    {
        $categories = $this->categoryRepository->where('status', 1)->get();

        return JsonResponse::success($categories, 'Categories fetched succssfully.');
    }
}