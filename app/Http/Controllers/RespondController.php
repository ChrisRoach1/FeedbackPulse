<?php

namespace App\Http\Controllers;

use App\Models\Questionnaire;
use App\Models\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Psy\Util\Str;

class RespondController extends Controller
{
    public function index(Request $request, string $slug)
    {
        $questionnaire = Questionnaire::query()->where('slug', $slug)->with('questions')->first();

        if($questionnaire) {
            return Inertia::render('Questionnaire',[
                'title' => $questionnaire->title,
                'questionnaire_id' => $questionnaire->id,
                'questions' => $questionnaire->questions->map(function ($question) {
                    return [
                        'id' => $question->id,
                        'title' => $question->title,
                        'type' => $question->type,
                        'possibleValues' => preg_split('/,/', $question->possibleValues, -1, PREG_SPLIT_NO_EMPTY),
                    ];
                })
            ]);
        }else{
            return Inertia::render('Questionnaire',[]);
        }
    }
    public function store(Request $request): RedirectResponse
    {
        $values = $request->validate([
            'name' => 'required',
            'responses.*' => 'array',
            'responses.*.response' => 'required',
            'responses.*.question_id' => 'required',
            'responses.*.questionnaire_id' => 'required',
        ]);

        $responseGroupId = \Illuminate\Support\Str::uuid();

        foreach($values['responses'] as $response) {
            Response::create([
                'userName' => $values['name'],
                'responseGroupId' => $responseGroupId,
                'questionnaire_id' => $response['questionnaire_id'],
                'question_id' => $response['question_id'],
                'response' => $response['response'],
            ]);
        }

        return Redirect::route('thankyou');
    }
}
