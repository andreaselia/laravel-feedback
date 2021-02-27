<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Feedback Dashboard
    |--------------------------------------------------------------------------
    |
    | The prefix and middleware for the feedback dashboard.
    |
    */

    'prefix' => 'feedback',

    'middleware' => [
        'web',
    ],

    /*
    |--------------------------------------------------------------------------
    | Exclude
    |--------------------------------------------------------------------------
    |
    | The routes excluded from displaying the feedback widget.
    |
    */

   'exclude' => [
       '/feedback',
   ],

];
