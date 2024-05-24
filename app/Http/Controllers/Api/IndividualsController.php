<?php

namespace App\Http\Controllers\Api;

use App\Helper\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\IndividualRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndividualsController extends Controller
{
    private Request $request;
    private User $user;
    private IndividualRepository $individualRepository;

    public function __construct(Request $request, IndividualRepository $individualRepository)
    {
        $this->request = $request;
        $this->individualRepository = $individualRepository;
        $this->user = Auth::guard('api')->user();
    }

    public function index()
    {
        $individuals = $this->individualRepository->getTodaysRecords($this->request->day, $this->request->category_id);

        return JsonResponse::success($individuals, 'Individuals fetched succssfully.');
    }

    public function show($id)
    {
        $individual = $this->individualRepository->getSingleRecord($id);

        return JsonResponse::success($individual, 'Individual details fetched succssfully.');
    }
}