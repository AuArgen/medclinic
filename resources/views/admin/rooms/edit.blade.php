<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Палатаны өзгөртүү') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Палата: {{ $room->room_number }}</h3>

                    <form method="POST" action="{{ route('admin.rooms.update', $room->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Floor -->
                        <div>
                            <x-input-label for="floor_id" :value="__('Этаж')" />
                            <select id="floor_id" name="floor_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">-- Этаж тандоо --</option>
                                @foreach ($floors as $floor)
                                    <option value="{{ $floor->id }}" {{ old('floor_id', $room->floor_id) == $floor->id ? 'selected' : '' }}>{{ $floor->building->name }} - {{ $floor->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('floor_id')" class="mt-2" />
                        </div>

                        <!-- Room Number -->
                        <div class="mt-4">
                            <x-input-label for="room_number" :value="__('Палата номери')" />
                            <x-text-input id="room_number" class="block mt-1 w-full" type="text" name="room_number" :value="old('room_number', $room->room_number)" required autofocus />
                            <x-input-error :messages="$errors->get('room_number')" class="mt-2" />
                        </div>

                        <!-- Capacity -->
                        <div class="mt-4">
                            <x-input-label for="capacity" :value="__('Сыйымдуулугу')" />
                            <x-text-input id="capacity" class="block mt-1 w-full" type="number" name="capacity" :value="old('capacity', $room->capacity)" required min="1" />
                            <x-input-error :messages="$errors->get('capacity')" class="mt-2" />
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
