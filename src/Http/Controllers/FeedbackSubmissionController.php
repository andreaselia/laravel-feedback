<?php

namespace AndreasElia\Feedback\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use AndreasElia\Feedback\Models\Feedback;

class FeedbackSubmissionController extends Controller
{
    public function __invoke(Request $request)
    {
        $rules = [
            'text' => ['required', 'string', 'max:255'],
            'screenshot' => ['nullable', 'string'],
        ];

        if ($types = array_keys(config('feedback.types'))) {
            $rules['type'] = ['required', 'string', 'in:'.implode(',', $types)];
        }

        Feedback::create($request->validate($rules));

        return response('Success!', 200);
    }
}
