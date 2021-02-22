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
     * Enable Types
     *
     * Whether or not types are enabled.
     */

    'enable_types' => true,

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
