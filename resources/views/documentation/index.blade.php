<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Документация') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <div class="text-center mb-10">
                    <h1 class="text-4xl font-bold text-gray-900">Сайтты колдонуу боюнча колдонмо</h1>
                    <p class="mt-2 text-lg text-gray-600">Бул жерден сайттын функцияларын кантип колдонуу керектиги жөнүндө маалымат таба аласыз.</p>
                </div>

                <!-- Search Form -->
                <form action="{{ route('documentation') }}" method="GET" class="mb-10 max-w-2xl mx-auto">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="fas fa-search text-gray-400"></i>
                        </span>
                        <input type="text" name="search" value="{{ $searchTerm ?? '' }}" placeholder="Мисалы: Врачка жазылуу..." class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </form>

                @if (empty($sections) && $searchTerm)
                    <div class="text-center py-12">
                        <p class="text-xl text-gray-600">"{{ $searchTerm }}" боюнча эч нерсе табылган жок.</p>
                        <a href="{{ route('documentation') }}" class="mt-4 inline-block text-indigo-600 hover:underline">Издөөнү тазалоо</a>
                    </div>
                @endif

                <div class="space-y-10">
                    @foreach ($sections as $section)
                        <div id="{{ Str::slug($section['title']) }}" class="p-8 bg-gray-50 rounded-xl shadow-md transition hover:shadow-lg">
                            <h2 class="text-3xl font-semibold text-gray-800 mb-6 border-b-2 border-indigo-200 pb-2">{{ $section['title'] }}</h2>
                            <ul class="space-y-6">
                                @foreach ($section['content'] as $key => $value)
                                    <li>
                                        <h4 class="font-bold text-xl text-gray-700 mb-1">{{ $key }}</h4>
                                        <p class="text-gray-600 leading-relaxed ml-4 border-l-4 border-gray-200 pl-4">{{ $value }}</p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
