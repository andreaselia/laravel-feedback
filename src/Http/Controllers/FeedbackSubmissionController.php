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
        ];

        if (config('feedback.enable_types')) {
            $rules['type'] = ['required', 'string', 'in:idea,feedback,bug'];
        }

        if (config('feedback.screenshots')) {
            $rules['screenshot'] = ['nullable', 'string'];
        }

        Feedback::create($request->validate($rules));

        return response('Success!', 200);
    }
}
