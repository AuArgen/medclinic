<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Врачтын профили') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <div class="flex flex-col md:flex-row items-center md:items-start gap-8 mb-8">
                    <div class="flex-shrink-0">
                        <img src="{{ $medic->avatar }}" alt="{{ $medic->name }}" class="w-48 h-48 rounded-full object-cover shadow-lg border-4 border-indigo-400">
                    </div>
                    <div class="flex-grow text-center md:text-left">
                        <h1 class="text-4xl font-extrabold text-gray-900 mb-2">{{ $medic->name }}</h1>
                        <p class="text-xl text-indigo-600 mb-4">{{ $medic->department->name ?? 'Одделсиз' }}</p>
                        <p class="text-gray-700 leading-relaxed mb-4">{{ $medic->bio ?? 'Бул врач жөнүндө маалымат жок.' }}</p>
                        <div class="space-y-2 text-lg text-gray-700">
                            <p><i class="fas fa-envelope text-indigo-600 mr-2"></i>Email: {{ $medic->email }}</p>
                            <p><i class="fas fa-phone-alt text-indigo-600 mr-2"></i>Телефон: {{ $medic->phone_number ?? '--' }}</p>
                            <p><i class="fas fa-map-marker-alt text-indigo-600 mr-2"></i>Дарек: {{ $medic->address ?? '--' }}</p>
                        </div>
                        @auth
                            @if (Auth::user()->role === 'customer')
                                <div class="mt-6 flex space-x-4">
                                    <a href="{{ route('appointments.create', $medic->id) }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition ease-in-out duration-150">
                                        Жазылуу
                                    </a>
                                    <a href="{{ route('messages.show', $medic->id) }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition ease-in-out duration-150">
                                        Билдирүү жазуу
                                    </a>
                                </div>
                            @endif
                        @else
                            <p class="text-gray-600 mt-6">Жазылуу үчүн <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">кирүү</a> же <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">катталуу</a> керек.</p>
                        @endauth
                    </div>
                </div>

                <div class="mt-12 p-6 bg-gray-50 rounded-lg shadow-md">
                    <h4 class="text-2xl font-semibold text-gray-900 mb-4">Расписание:</h4>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Күн</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Башталышы</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Аягы</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($medic->schedules as $schedule)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ __($schedule->day_of_week) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">Расписание жок.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
