<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Биздин одделдер') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-semibold text-gray-900 mb-6">Биздин одделдер</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @forelse ($departments as $department)
                            <div class="bg-gray-50 p-6 rounded-lg shadow-md hover:shadow-xl transition duration-300 ease-in-out transform hover:-translate-y-1">
                                <h4 class="text-xl font-semibold text-gray-800 flex items-center mb-2">
                                    @if ($department->icon)
                                        <i class="{{ $department->icon }} text-2xl text-indigo-600 mr-3"></i>
                                    @endif
                                    {{ $department->name }}
                                </h4>
                                <p class="text-gray-600">{{ Str::limit($department->short_description, 150) ?? 'Маалымат жок.' }}</p>
                                <div class="mt-4">
                                    <a href="{{ route('departments.show', $department->id) }}" class="text-indigo-600 hover:text-indigo-800 font-medium">Көбүрөөк маалымат &rarr;</a>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 col-span-full text-center">Одделдер табылган жок.</p>
                        @endforelse
                    </div>

                    <div class="mt-8">
                        {{ $departments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
