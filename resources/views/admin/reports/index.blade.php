<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Отчеттор') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <h3 class="text-2xl font-semibold text-gray-900 mb-6">Врачтар боюнча отчеттор</h3>

                <form action="{{ route('admin.reports.index') }}" method="GET" class="mb-8 space-y-4 md:space-y-0 md:flex md:items-end md:space-x-4">
                    <div class="flex-1">
                        <x-input-label for="medic_id" :value="__('Врачты тандоо')" />
                        <select id="medic_id" name="medic_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="">-- Баардык врачтар --</option>
                            @foreach ($medics as $medic)
                                <option value="{{ $medic->id }}" {{ $selectedMedicId == $medic->id ? 'selected' : '' }}>{{ $medic->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex-1">
                        <x-input-label for="start_date" :value="__('Башталыш күнү')" />
                        <x-text-input id="start_date" class="block mt-1 w-full" type="date" name="start_date" :value="$startDate" />
                    </div>
                    <div class="flex-1">
                        <x-input-label for="end_date" :value="__('Аяктоо күнү')" />
                        <x-text-input id="end_date" class="block mt-1 w-full" type="date" name="end_date" :value="$endDate" />
                    </div>
                    <div>
                        <x-primary-button type="submit">
                            {{ __('Отчетту көрсөтүү') }}
                        </x-primary-button>
                    </div>
                </form>

                <div class="overflow-x-auto mb-12">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Врач</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Жалпы брондоолор</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Аткарылган</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Тастыкталган</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Жокко чыгарылган</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($medicReports as $report)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $report['medic']->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $report['total_appointments'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $report['completed_appointments'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $report['successful_appointments'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $report['cancelled_appointments'] }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">Отчеттор жок.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <h3 class="text-2xl font-semibold text-gray-900 mb-6">Палаталар боюнча отчет</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Корпус</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Этаж</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Палата номери</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Сыйымдуулугу</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Учурда бош эмес</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Бош орундар</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($rooms as $room)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $room->floor->building->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $room->floor->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $room->room_number }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $room->capacity }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $room->appointments_count }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $room->capacity - $room->appointments_count }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">Палаталар боюнча отчеттор жок.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
