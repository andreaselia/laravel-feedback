<?php

namespace AndreasElia\Feedback\Tests\Unit;

use AndreasElia\Feedback\Tests\TestCase;
use AndreasElia\Feedback\Models\Feedback;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FeedbackTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function feedback_can_be_submitted()
    {
        $testData = [
            'type' => 'feedback',
            'text' => 'This is a feedback test',
        ];

        $this->post('/feedback', $testData)
            ->assertSuccessful();

        $this->assertCount(1, Feedback::all());
        $this->assertDatabaseHas('feedback', [
            'text' => $testData['text'],
        ]);
    }
}
