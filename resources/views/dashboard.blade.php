<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Feedback</title>

    @feedbackStyles
    @feedbackScripts
</head>
<body>
    <div class="min-h-screen bg-gray-100 text-gray-500 py-6 flex flex-col sm:py-16">
        <div class="px-4 w-full lg:px-0 sm:max-w-5xl sm:mx-auto">
            <div class="flex justify-end">
                <div class="relative inline-block text-left">
                    <div>
                        <button type="button" class="inline-flex justify-center w-full rounded-md shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-200" id="filter-button">
                            {{ $periods[$period] }}
                            <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>

                    <div class="origin-top-right absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5" style="display: none;" id="filter-dropdown">
                        <div class="p-2" role="menu" aria-orientation="vertical" aria-labelledby="filter-button">
                            @foreach ($periods as $key => $value)
                                <a href="{{ url(config('feedback.prefix')) }}?period={{ $key }}" class="block px-4 py-2 rounded-lg text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">{{ $value }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4 shadow-sm bg-white rounded-lg overflow-hidden">
                <div class="px-4 sm:px-6 py-5">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Feedback</h3>
                </div>
                <div class="px-4 sm:px-6 py-3 bg-gray-50 border-t border-b border-gray-200 text-xs font-medium leading-4 tracking-wider text-gray-600 uppercase">
                    <div class="grid grid-cols-8 gap-8">
                        <div class="col-span-1">Type</div>
                        <div class="col-span-3">Text</div>
                        <div class="col-span-2">Screenshot</div>
                        <div class="col-span-2">When</div>
                    </div>
                </div>
                <div class="divide-y divide-gray-200 max-h-96 overflow-y-auto">
                    @foreach ($items as $item)
                        <div class="grid grid-cols-8 gap-8 px-4 sm:px-6 py-3 hover:bg-gray-50">
                            <div class="col-span-1 text-sm leading-5 text-gray-800">
                                @if ($item->type === 'idea')
                                    <span class="bg-yellow-50 rounded-md px-2 py-1 text-xs">
                                        {{ \Illuminate\Support\Str::ucfirst($item->type) }}
                                    </span>
                                @elseif ($item->type === 'feedback')
                                    <span class="bg-blue-50 rounded-md px-2 py-1 text-xs">
                                        {{ \Illuminate\Support\Str::ucfirst($item->type) }}
                                    </span>
                                @elseif ($item->type === 'bug')
                                    <span class="bg-red-50 rounded-md px-2 py-1 text-xs">
                                        {{ \Illuminate\Support\Str::ucfirst($item->type) }}
                                    </span>
                                @endif
                            </div>
                            <div class="col-span-3 text-sm leading-5 text-gray-600">{{ $item->text }}</div>
                            <div class="col-span-2">
                                @if ($item->screenshot)
                                    <a href="{{ $item->screenshot }}" download="screenshot-{{ $item->type }}.png">
                                        <img class="w-48 h-auto" src="{{ $item->screenshot }}" alt="Screenshot">
                                    </a>
                                @else
                                    -
                                @endif
                            </div>
                            <div class="col-span-2 text-sm leading-5 text-gray-800">{{ $item->created_at->diffForHumans() }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        const filterButton = document.getElementById('filter-button');
        const filterDropdown = document.getElementById('filter-dropdown');

        filterButton.addEventListener('click', function (e) {
            e.preventDefault();

            filterDropdown.style.display = 'block';
        });

        document.addEventListener('click', function (e) {
            if (!filterButton.contains(e.target) && !filterDropdown.contains(e.target)) {
                filterDropdown.style.display = 'none';
            }
        });
    </script>
</body>
</html>
