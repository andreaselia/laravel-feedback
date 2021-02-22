# Laravel Feedback

[![Latest Stable Version](https://poser.pugx.org/andreaselia/feedback/v)](//packagist.org/packages/andreaselia/feedback)

Easily collect page view feedback with a beautifully simple to use dashboard.

![Laravel Feedback Dashboard](/screenshot.png?raw=true "Laravel Feedback Dashboard")

## Installation

Install the package:

```bash
composer require andreaselia/feedback
```

Publish the config file and assets:

```bash
php artisan vendor:publish --provider="AndreasElia\Feedback\FeedbackServiceProvider"
```

Don't forget to run the migrations:

```bash
php artisan migrate
```

You can add the page view middleware to a specific route group, e.g. `web.php` like so:

```php
Route::middleware('feedback')->group(function () {
    // ...
});
```

Or add the page view to all middlewares/on an application level like so:

```php
// app/Http/Kernel.php

protected $middleware = [
    // ...
    \AndreasElia\Feedback\Http\Middleware\Feedback::class,
];
```

## Contributing

You're more than welcome to submit a pull request, or if you're not feeling up to it - create an issue so someone else can pick it up.
