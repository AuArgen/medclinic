<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $department->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <div class="flex items-center mb-4">
                    @if ($department->icon)
                        <i class="{{ $department->icon }} text-4xl text-indigo-600 mr-4"></i>
                    @endif
                    <h1 class="text-4xl font-extrabold text-gray-900">{{ $department->name }}</h1>
                </div>

                @if ($department->image)
                    <img src="{{ asset('storage/' . $department->image) }}" alt="{{ $department->name }}" class="w-full h-64 object-cover rounded-lg mb-6 shadow-md">
                @endif

                <div class="prose max-w-none text-gray-700 leading-relaxed">
                    {!! $department->description !!}
                </div>

                @if ($department->children->isNotEmpty())
                    <div class="mt-12">
                        <h3 class="text-2xl font-semibold text-gray-900 mb-4">Под-одделдер</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach ($department->children as $child)
                                <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                                    <a href="{{ route('departments.show', $child->id) }}" class="font-semibold text-indigo-600 hover:text-indigo-800">{{ $child->name }}</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if ($department->medics->isNotEmpty())
                    <div class="mt-12">
                        <h3 class="text-2xl font-semibold text-gray-900 mb-4">Бул одделдин врачтары</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($department->medics as $medic)
                                <div class="bg-gray-100 p-4 rounded-lg shadow-sm text-center">
                                    <img src="{{ $medic->avatar }}" alt="{{ $medic->name }}" class="w-24 h-24 rounded-full mx-auto mb-2 object-cover">
                                    <h4 class="font-semibold text-lg">{{ $medic->name }}</h4>
                                    <a href="{{ route('medics.show', $medic->id) }}" class="text-sm text-indigo-600 hover:underline">Профилин көрүү</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
