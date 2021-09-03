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

Publish the public assets:

```bash
php artisan vendor:publish --tag=feedback-assets
```

Add the following blade directives to the `<head>` section of the template you'd like the feedback widget to show up on:

```php
@feedbackStyles
@feedbackScripts
```

## Contributing

You're more than welcome to submit a pull request, or if you're not feeling up to it - create an issue so someone else can pick it up.
