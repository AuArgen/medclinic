<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Биз жөнүндө') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <h1 class="text-4xl font-extrabold text-gray-900 mb-6 text-center">Биздин клиника жөнүндө</h1>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center mb-12">
                    <div>
                        <img src="https://via.placeholder.com/600x400" alt="Our Clinic" class="rounded-lg shadow-lg animate-fade-in-left">
                    </div>
                    <div>
                        <h2 class="text-3xl font-semibold text-gray-800 mb-4 animate-slide-in-right">Биздин миссия</h2>
                        <p class="text-lg text-gray-700 leading-relaxed animate-fade-in-right">Биздин миссия - ар бир пациентке жогорку сапаттагы, жеткиликтүү жана гумандуу медициналык жардам көрсөтүү. Биз ден соолукту сактоо жана жакшыртуу аркылуу коомдун жыргалчылыгына салым кошууну көздөйбүз.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center mb-12">
                    <div>
                        <h2 class="text-3xl font-semibold text-gray-800 mb-4 animate-slide-in-left">Биздин баалуулуктар</h2>
                        <ul class="list-disc list-inside text-lg text-gray-700 leading-relaxed space-y-2 animate-fade-in-left">
                            <li><i class="fas fa-heartbeat text-indigo-600 mr-2"></i>Пациентке багытталган мамиле</li>
                            <li><i class="fas fa-handshake text-indigo-600 mr-2"></i>Ишеним жана ачыктык</li>
                            <li><i class="fas fa-lightbulb text-indigo-600 mr-2"></i>Инновация жана өнүгүү</li>
                            <li><i class="fas fa-users text-indigo-600 mr-2"></i>Командалык иш</li>
                        </ul>
                    </div>
                    <div>
                        <img src="https://via.placeholder.com/600x400" alt="Our Values" class="rounded-lg shadow-lg animate-fade-in-right">
                    </div>
                </div>

                <div class="text-center mt-12">
                    <h2 class="text-3xl font-semibold text-gray-800 mb-4 animate-fade-in-up">Эмне үчүн бизди тандоо керек?</h2>
                    <p class="text-lg text-gray-700 leading-relaxed max-w-3xl mx-auto animate-fade-in-up">Биздин клиника заманбап жабдуулар менен жабдылган, тажрыйбалуу жана квалификациялуу адистер иштейт. Биз ар дайым акыркы медициналык жетишкендиктерди колдонуп, сизге мыкты дарылоону сунуштайбыз.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
