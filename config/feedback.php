<?php

return [

    /**
     * Feedback Dashboard
     *
     * The prefix and middleware for the feedback dashboard.
     */

    'prefix' => 'feedback',

    'middleware' => [
        'web',
    ],

    /**
     * Types
     *
     * The feedback types. Leave empty to remove.
     */

    'types' => [
        'idea' => 'Idea',
        'feedback' => 'Feedback',
        'bug' => 'Bug',
    ],

    /**
     * Screenshots
     *
     * Determine if screenshots should be allowed.
     */

    'screenshots' => true,

    /**
    * Exclude
    *
    * The routes excluded from displaying the feedback widget.
    */

   'exclude' => [
       '/feedback',
   ],

];
