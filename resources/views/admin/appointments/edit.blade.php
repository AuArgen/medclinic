<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Брондоону өзгөртүү') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <h3 class="text-2xl font-semibold text-gray-900 mb-6">Брондоо: {{ $appointment->patient->name }} - {{ $appointment->medic->name }}</h3>

                <form method="POST" action="{{ route('admin.appointments.update', $appointment->id) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Patient Name -->
                    <div>
                        <x-input-label for="patient_name" :value="__('Пациент')" />
                        <x-text-input id="patient_name" class="block mt-1 w-full bg-gray-100" type="text" :value="$appointment->patient->name" disabled />
                    </div>

                    <!-- Medic Name -->
                    <div>
                        <x-input-label for="medic_name" :value="__('Врач')" />
                        <x-text-input id="medic_name" class="block mt-1 w-full bg-gray-100" type="text" :value="$appointment->medic->name" disabled />
                    </div>

                    <!-- Appointment Date -->
                    <div>
                        <x-input-label for="appointment_date" :value="__('Күнү')" />
                        <x-text-input id="appointment_date" class="block mt-1 w-full" type="date" name="appointment_date" :value="old('appointment_date', $appointment->appointment_date->format('Y-m-d'))" required />
                        <x-input-error :messages="$errors->get('appointment_date')" class="mt-2" />
                    </div>

                    <!-- Appointment Time -->
                    <div>
                        <x-input-label for="appointment_time" :value="__('Убактысы')" />
                        <x-text-input id="appointment_time" class="block mt-1 w-full" type="time" name="appointment_time" :value="old('appointment_time', $appointment->appointment_time->format('H:i'))" required />
                        <x-input-error :messages="$errors->get('appointment_time')" class="mt-2" />
                    </div>

                    <!-- Notes -->
                    <div>
                        <x-input-label for="notes" :value="__('Кошумча маалымат')" />
                        <textarea id="notes" name="notes" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm bg-gray-100" disabled>{{ old('notes', $appointment->notes) }}</textarea>
                    </div>

                    <!-- Room -->
                    <div>
                        <x-input-label for="room_id" :value="__('Палата')" />
                        <select id="room_id" name="room_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="">-- Палата тандоо --</option>
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}" {{ old('room_id', $appointment->room_id) == $room->id ? 'selected' : '' }}>{{ $room->floor->building->name }} - {{ $room->floor->name }} - {{ $room->room_number }} (Сыйымдуулугу: {{ $room->capacity }})</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('room_id')" class="mt-2" />
                    </div>

                    <!-- Status -->
                    <div>
                        <x-input-label for="status" :value="__('Статус')" />
                        <select id="status" name="status" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="pending" {{ old('status', $appointment->status) === 'pending' ? 'selected' : '' }}>Күтүүдө</option>
                            <option value="confirmed" {{ old('status', $appointment->status) === 'confirmed' ? 'selected' : '' }}>Тастыкталды</option>
                            <option value="cancelled" {{ old('status', $appointment->status) === 'cancelled' ? 'selected' : '' }}>Жокко чыгарылды</option>
                            <option value="completed" {{ old('status', $appointment->status) === 'completed' ? 'selected' : '' }}>Аткарылды</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
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
</x-app-layout>
