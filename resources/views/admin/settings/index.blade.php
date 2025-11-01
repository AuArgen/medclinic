<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Сайттын жөндөөлөрү') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Сайттын жөндөөлөрүн башкаруу</h3>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Site Name -->
                        <div>
                            <x-input-label for="site_name" :value="__('Сайттын аталышы')" />
                            <x-text-input id="site_name" class="block mt-1 w-full" type="text" name="site_name" :value="old('site_name', $settings['site_name'])" required autofocus />
                            <x-input-error :messages="$errors->get('site_name')" class="mt-2" />
                        </div>

                        <!-- Site Logo -->
                        <div class="mt-4">
                            <x-input-label for="site_logo" :value="__('Сайттын логотиби')" />
                            @if ($settings['site_logo'])
                                <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="Сайттын логотиби" class="h-20 w-auto object-contain mb-2">
                            @endif
                            <input id="site_logo" type="file" name="site_logo" class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100" />
                            <x-input-error :messages="$errors->get('site_logo')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Жаңыртуу') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
