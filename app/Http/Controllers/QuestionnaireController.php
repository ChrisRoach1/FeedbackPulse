<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Question;
use App\Models\Questionnaire;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Inertia\Inertia;

class QuestionnaireController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $values = $request->validate([
            'title' => 'required',
            'questions' => 'required|array',
            'questions.*.title' => 'required',
            'questions.*.type' => 'required',
            'questions.*.possibleValues' => 'array',
        ]);

        $createdQuestionnaire = Questionnaire::create([
            'title' => $values['title'],
            'user_id' => auth()->id(),
            'slug' => Str::slug($values['title'], '-') . '-' . auth()->id(),
        ]);


        foreach($values['questions'] as $question) {
            Question::create([
                'title' => $question['title'],
                'questionnaire_id' => $createdQuestionnaire->id,
                'type' => $question['type'],
                'possibleValues' => key_exists("possibleValues", $question) ? \Arr::join($question['possibleValues'], ',') : null,
            ]);
        }

        return Redirect::route('dashboard');
    }

    public function index(Request $request)
    {
        $questionnaires = auth()->user()->questionnaires()->with('questions')->when($request['searchString'], function ($query) use ($request) {
            return $query->where('title', 'like', '%' . $request->get('searchString') . '%');
        })->get();

        $formattedQuestionnaire = $questionnaires->map(function ($questionnaire) {
           return [
               'id' => $questionnaire->id,
               'title' => $questionnaire->title,
               'slug' => $questionnaire->slug,
               'questions' => $questionnaire->questions->map(function ($question) {
                   return [
                       'id' => $question->id,
                       'title' => $question->title,
                       'type' => $question->type,
                       'possibleValues' => preg_split('/,/', $question->possibleValues, -1, PREG_SPLIT_NO_EMPTY),
                   ];
               })
           ];
        });

        return Inertia::render('AllQuestionnaires',[
            'questionnaires' => $formattedQuestionnaire,
            'searchString' => $request['searchString']
        ]);
    }
}
