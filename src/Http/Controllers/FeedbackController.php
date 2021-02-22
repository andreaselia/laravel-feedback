<?php

namespace AndreasElia\Feedback\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use AndreasElia\Feedback\Models\Feedback;

class FeedbackController extends Controller
{
    /** @var string */
    protected $period;

    public function __invoke(Request $request): View
    {
        $this->period = $request->get('period', 'today');

        return view('feedback::dashboard', [
            'period' => $this->period,
            'periods' => $this->periods(),
            'items' => $this->items(),
        ]);
    }

    protected function periods(): array
    {
        return [
            'today' => 'Today',
            '1_week' => 'Last 7 days',
            '30_days' => 'Last 30 days',
            '6_months' => 'Last 6 months',
            '12_months' => 'Last 12 months',
        ];
    }

    protected function items(): Collection
    {
        return Feedback::query()
            ->scopes(['filter' => [$this->period]])
            ->get();
    }
}
