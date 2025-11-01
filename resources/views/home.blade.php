<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Башкы бет') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Hero Section -->
                    <div class="text-center mb-12 py-16 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg shadow-xl animate-fade-in">
                        <h1 class="text-5xl font-extrabold text-white mb-4 animate-slide-down">Медициналык кызматтарды брондоо системасы</h1>
                        <p class="text-xl text-indigo-100 mb-8 animate-slide-up">Сиздин ден соолугуңуз биздин артыкчылык. Ыңгайлуу жана тез брондоо.</p>
                        <a href="{{ route('medics.index') }}" class="inline-flex items-center px-8 py-4 border border-transparent text-lg font-medium rounded-full shadow-lg text-indigo-600 bg-white hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white transition duration-300 ease-in-out transform hover:scale-105 animate-bounce-once">
                            Врачты тандоо
                        </a>
                    </div>

                    <!-- About Us Snippet -->
                    <div class="mb-12 p-8 bg-gray-50 rounded-lg shadow-md animate-fade-in-up">
                        <h3 class="text-3xl font-semibold text-gray-900 mb-4">Биз жөнүндө</h3>
                        <p class="text-gray-700 leading-relaxed">Биздин клиника 20 жылдан ашык убакыттан бери жогорку сапаттагы медициналык кызматтарды көрсөтүп келет. Биздин максат - ар бир пациентке жекече мамиле кылуу жана алардын ден соолугун чыңдоо үчүн мыкты шарттарды түзүү. Биздин тажрыйбалуу адистер командасы ар дайым сизге жардам берүүгө даяр.</p>
                        <a href="{{ route('about') }}" class="mt-4 inline-block text-indigo-600 hover:text-indigo-800 font-medium">Көбүрөөк билүү &rarr;</a>
                    </div>

                    <!-- Departments Section -->
                    <h3 class="text-3xl font-semibold text-gray-900 mb-6 animate-fade-in">Биздин одделдер</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                        @forelse ($departments as $department)
                            <div class="bg-gray-100 p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1 animate-fade-in-up">
                                <h4 class="text-xl font-semibold text-gray-800 flex items-center mb-2">
                                    @if ($department->icon)
                                        <i class="{{ $department->icon }} text-2xl text-indigo-600 mr-3"></i>
                                    @endif
                                    {{ $department->name }}
                                </h4>
                                <p class="text-gray-600">{{ Str::limit($department->short_description, 150) ?? 'Маалымат жок.' }}</p>
                                <div class="mt-4">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-800 font-medium">Көбүрөөк маалымат &rarr;</a>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500">Одделдер табылган жок.</p>
                        @endforelse
                    </div>

                    <!-- Medics Section -->
                    <h3 class="text-3xl font-semibold text-gray-900 mb-6 animate-fade-in">Биздин мыкты врачтар</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                        @forelse ($medics as $medic)
                            <div class="bg-gray-100 p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300 ease-in-out transform hover:scale-105 animate-fade-in-up">
                                <img src="https://via.placeholder.com/100" alt="{{ $medic->name }}" class="w-24 h-24 rounded-full mx-auto mb-4 object-cover border-4 border-indigo-300">
                                <h4 class="text-xl font-semibold text-gray-800">{{ $medic->name }}</h4>
                                <p class="text-indigo-600 text-sm mb-2">{{ $medic->department->name ?? 'Одделсиз' }}</p>
                                <p class="text-gray-600 text-sm">{{ Str::limit($medic->bio, 80) ?? 'Маалымат жок.' }}</p>
                                <div class="mt-4">
                                    <a href="{{ route('medics.show', $medic->id) }}" class="text-indigo-600 hover:text-indigo-800 font-medium">Профилин көрүү &rarr;</a>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500">Врачтар табылган жок.</p>
                        @endforelse
                    </div>

                    <!-- Services Section -->
                    <div class="mb-12 p-8 bg-indigo-50 rounded-lg shadow-md animate-fade-in-up">
                        <h3 class="text-3xl font-semibold text-gray-900 mb-4">Биздин кызматтар</h3>
                        <ul class="list-disc list-inside text-gray-700 leading-relaxed space-y-2">
                            <li><i class="fas fa-check-circle text-green-500 mr-2"></i>Терапия</li>
                            <li><i class="fas fa-check-circle text-green-500 mr-2"></i>Хирургия</li>
                            <li><i class="fas fa-check-circle text-green-500 mr-2"></i>Педиатрия</li>
                            <li><i class="fas fa-check-circle text-green-500 mr-2"></i>Кардиология</li>
                            <li><i class="fas fa-check-circle text-green-500 mr-2"></i>Стоматология</li>
                        </ul>
                    </div>

                    <!-- Testimonials Section -->
                    <div class="mb-12 p-8 bg-white rounded-lg shadow-md animate-fade-in-up">
                        <h3 class="text-3xl font-semibold text-gray-900 mb-4">Пациенттердин пикирлери</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-gray-100 p-6 rounded-lg shadow-sm">
                                <p class="text-gray-700 italic">"Мыкты клиника! Кызмат көрсөтүүсү жогорку деңгээлде, врачтары абдан кунт коюп мамиле кылышат."</p>
                                <p class="mt-4 font-semibold text-gray-800">- Айдана К.</p>
                            </div>
                            <div class="bg-gray-100 p-6 rounded-lg shadow-sm">
                                <p class="text-gray-700 italic">"Брондоо системасы абдан ыңгайлуу, убакытты үнөмдөйт. Рахмат!"</p>
                                <p class="mt-4 font-semibold text-gray-800">- Бектур А.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Info Snippet -->
                    <div class="p-8 bg-gray-50 rounded-lg shadow-md animate-fade-in-up">
                        <h3 class="text-3xl font-semibold text-gray-900 mb-4">Байланыш маалыматтары</h3>
                        <p class="text-gray-700 mb-2"><i class="fas fa-map-marker-alt text-indigo-600 mr-2"></i>Дарегибиз: Бишкек ш., Чүй пр. 123</p>
                        <p class="text-gray-700 mb-2"><i class="fas fa-phone-alt text-indigo-600 mr-2"></i>Телефон: +996 777 123456</p>
                        <p class="text-gray-700 mb-2"><i class="fas fa-envelope text-indigo-600 mr-2"></i>Email: info@medclinic.kg</p>
                        <a href="{{ route('contact') }}" class="mt-4 inline-block text-indigo-600 hover:text-indigo-800 font-medium">Биз менен байланышуу &rarr;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
