<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Биздин врачтар') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <h1 class="text-4xl font-extrabold text-gray-900 mb-8 text-center">Биздин квалификациялуу адистер</h1>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse ($medics as $medic)
                        <div class="bg-gray-100 p-6 rounded-lg shadow-md hover:shadow-xl transition duration-300 ease-in-out transform hover:-translate-y-1 animate-fade-in-up text-center">
                            <img src="https://via.placeholder.com/150" alt="{{ $medic->name }}" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover border-4 border-indigo-300">
                            <h4 class="text-2xl font-semibold text-gray-800 mb-1">{{ $medic->name }}</h4>
                            <p class="text-indigo-600 text-md mb-3">{{ $medic->department->name ?? 'Одделсиз' }}</p>
                            <p class="text-gray-700 leading-relaxed">{{ Str::limit($medic->bio, 120) ?? 'Маалымат жок.' }}</p>
                            <div class="mt-5">
                                <a href="{{ route('medics.show', $medic->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Профилин көрүү
                                </a>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center col-span-full">Врачтар табылган жок.</p>
                    @endforelse
                </div>

                <div class="mt-10">
                    {{ $medics->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
