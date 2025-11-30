<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Биздин врачтар') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-semibold text-gray-900 mb-6">Биздин адистер</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @forelse ($medics as $medic)
                            <div class="bg-gray-50 p-6 rounded-lg shadow-md hover:shadow-xl transition duration-300 ease-in-out transform hover:-translate-y-1">
                                <div class="flex flex-col items-center text-center">
                                    <img src="{{ $medic->avatar }}" alt="{{ $medic->name }}" class="w-32 h-32 rounded-full object-cover mb-4 border-4 border-white shadow-lg">
                                    <h4 class="text-xl font-semibold text-gray-800">{{ $medic->name }}</h4>
                                    <p class="text-indigo-600">{{ $medic->department->name ?? 'Одделсиз' }}</p>
                                    <p class="mt-2 text-gray-600 text-sm">{{ Str::limit($medic->bio, 100) ?? 'Маалымат жок.' }}</p>
                                    <a href="{{ route('medics.show', $medic->id) }}" class="mt-4 inline-block bg-indigo-500 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-indigo-600 transition">Профилин көрүү</a>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 col-span-full text-center">Врачтар табылган жок.</p>
                        @endforelse
                    </div>

                    <div class="mt-8">
                        {{ $medics->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
