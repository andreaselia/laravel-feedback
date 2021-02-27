<?php

namespace AndreasElia\Feedback\Http\Controllers;

use Illuminate\Routing\Controller;
use AndreasElia\Feedback\Models\Feedback;
use AndreasElia\Feedback\Http\Requests\FeedbackRequest;

class StoreFeedbackSubmission extends Controller
{
    public function __invoke(FeedbackRequest $request)
    {
        Feedback::create($request->validated());

        return response('Success!', 200);
    }
}
