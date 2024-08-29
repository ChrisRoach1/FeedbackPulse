<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Question;
use App\Models\Questionnaire;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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
            'user_id' => auth()->id()
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
}
