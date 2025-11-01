<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Билдирүү') }} - {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Сүйлөшүү: {{ $user->name }}</h3>

                    <div class="flex flex-col space-y-4 h-96 overflow-y-auto p-4 border border-gray-200 rounded-md mb-4">
                        @forelse ($messages as $message)
                            <div class="flex {{ $message->sender_id === Auth::id() ? 'justify-end' : 'justify-start' }}">
                                <div class="max-w-xs lg:max-w-md px-4 py-2 rounded-lg {{ $message->sender_id === Auth::id() ? 'bg-indigo-500 text-white' : 'bg-gray-200 text-gray-800' }}">
                                    @if ($message->message)
                                        <p>{{ $message->message }}</p>
                                    @endif
                                    @if ($message->image)
                                        <img src="{{ asset('storage/' . $message->image) }}" alt="Image" class="mt-2 rounded-md max-w-full h-auto">
                                    @endif
                                    <span class="block text-xs {{ $message->sender_id === Auth::id() ? 'text-indigo-200' : 'text-gray-600' }} text-right mt-1">{{ $message->created_at->format('H:i') }}</span>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-gray-500">Бул сүйлөшүүдө билдирүүлөр жок.</p>
                        @endforelse
                    </div>

                    <form method="POST" action="{{ route('messages.store', $user->id) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="flex items-center">
                            <input type="text" name="message" placeholder="Билдирүү жазыңыз..." class="flex-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mr-2" />
                            <input type="file" name="image" class="hidden" id="message-image-upload" />
                            <label for="message-image-upload" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 cursor-pointer mr-2">
                                Сүрөт кошуу
                            </label>
                            <x-primary-button type="submit">
                                Жөнөтүү
                            </x-primary-button>
                        </div>
                        <x-input-error :messages="$errors->get('message')" class="mt-2" />
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
