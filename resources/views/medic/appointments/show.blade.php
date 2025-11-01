<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Брондоонун деталдары') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Брондоо: {{ $appointment->patient->name }}</h3>

                    <form method="POST" action="{{ route('medic.appointments.update', $appointment->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Patient Name -->
                        <div class="mb-4">
                            <x-input-label for="patient_name" :value="__('Пациент')" />
                            <x-text-input id="patient_name" class="block mt-1 w-full bg-gray-100" type="text" :value="$appointment->patient->name" disabled />
                        </div>

                        <!-- Appointment Date -->
                        <div class="mb-4">
                            <x-input-label for="appointment_date" :value="__('Күнү')" />
                            <x-text-input id="appointment_date" class="block mt-1 w-full bg-gray-100" type="date" :value="$appointment->appointment_date->format('Y-m-d')" disabled />
                        </div>

                        <!-- Appointment Time -->
                        <div class="mb-4">
                            <x-input-label for="appointment_time" :value="__('Убактысы')" />
                            <x-text-input id="appointment_time" class="block mt-1 w-full bg-gray-100" type="time" :value="$appointment->appointment_time->format('H:i')" disabled />
                        </div>

                        <!-- Notes -->
                        <div class="mb-4">
                            <x-input-label for="notes" :value="__('Кошумча маалымат')" />
                            <textarea id="notes" name="notes" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm bg-gray-100" disabled>{{ $appointment->notes ?? '--' }}</textarea>
                        </div>

                        <!-- Status -->
                        <div class="mt-4">
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
                                {{ __('Статусту жаңыртуу') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
