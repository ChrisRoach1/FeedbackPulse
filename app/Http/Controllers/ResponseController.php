<?php

namespace App\Http\Controllers;

use App\Models\Questionnaire;
use App\Models\Response;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ResponseController extends Controller
{
    public function index(Request $request, int $questionnaireId)
    {
        $responses = collect(Response::query()->where('questionnaire_id', $questionnaireId)->with('question')->get());
        return Inertia::render('AllResponses',[
            'responses' => $responses,
        ]);
    }
}
