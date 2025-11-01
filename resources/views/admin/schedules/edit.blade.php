<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Расписаниени өзгөртүү') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <h3 class="text-2xl font-semibold text-gray-900 mb-6">Расписаниени өзгөртүү</h3>

                <form method="POST" action="{{ route('admin.schedules.update', $schedule->id) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Medic -->
                    <div>
                        <x-input-label for="user_id" :value="__('Врач')" />
                        <select id="user_id" name="user_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="">-- Врач тандоо --</option>
                            @foreach ($medics as $medic)
                                <option value="{{ $medic->id }}" {{ old('user_id', $schedule->user_id) == $medic->id ? 'selected' : '' }}>{{ $medic->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                    </div>

                    <!-- Day of Week -->
                    <div>
                        <x-input-label for="day_of_week" :value="__('Күн')" />
                        <select id="day_of_week" name="day_of_week" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="">-- Күн тандоо --</option>
                            <option value="Monday" {{ old('day_of_week', $schedule->day_of_week) === 'Monday' ? 'selected' : '' }}>Дүйшөмбү</option>
                            <option value="Tuesday" {{ old('day_of_week', $schedule->day_of_week) === 'Tuesday' ? 'selected' : '' }}>Шейшемби</option>
                            <option value="Wednesday" {{ old('day_of_week', $schedule->day_of_week) === 'Wednesday' ? 'selected' : '' }}>Шаршемби</option>
                            <option value="Thursday" {{ old('day_of_week', $schedule->day_of_week) === 'Thursday' ? 'selected' : '' }}>Бейшемби</option>
                            <option value="Friday" {{ old('day_of_week', $schedule->day_of_week) === 'Friday' ? 'selected' : '' }}>Жума</option>
                            <option value="Saturday" {{ old('day_of_week', $schedule->day_of_week) === 'Saturday' ? 'selected' : '' }}>Ишемби</option>
                            <option value="Sunday" {{ old('day_of_week', $schedule->day_of_week) === 'Sunday' ? 'selected' : '' }}>Жекшемби</option>
                        </select>
                        <x-input-error :messages="$errors->get('day_of_week')" class="mt-2" />
                    </div>

                    <!-- Start Time -->
                    <div>
                        <x-input-label for="start_time" :value="__('Башталыш убактысы')" />
                        <x-text-input id="start_time" class="block mt-1 w-full" type="time" name="start_time" :value="old('start_time', \Carbon\Carbon::parse($schedule->start_time)->format('H:i'))" required />
                        <x-input-error :messages="$errors->get('start_time')" class="mt-2" />
                    </div>

                    <!-- End Time -->
                    <div>
                        <x-input-label for="end_time" :value="__('Аяктоо убактысы')" />
                        <x-text-input id="end_time" class="block mt-1 w-full" type="time" name="end_time" :value="old('end_time', \Carbon\Carbon::parse($schedule->end_time)->format('H:i'))" required />
                        <x-input-error :messages="$errors->get('end_time')" class="mt-2" />
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
