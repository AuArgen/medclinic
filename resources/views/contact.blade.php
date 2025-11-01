<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Байланыш') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <h1 class="text-4xl font-extrabold text-gray-900 mb-6 text-center">Биз менен байланышыңыз</h1>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 mb-12">
                    <div class="animate-fade-in-left">
                        <h2 class="text-3xl font-semibold text-gray-800 mb-4">Байланыш маалыматтары</h2>
                        <p class="text-lg text-gray-700 mb-4"><i class="fas fa-map-marker-alt text-indigo-600 mr-3"></i>Дарегибиз: Бишкек ш., Чүй пр. 123</p>
                        <p class="text-lg text-gray-700 mb-4"><i class="fas fa-phone-alt text-indigo-600 mr-3"></i>Телефон: +996 777 123456</p>
                        <p class="text-lg text-gray-700 mb-4"><i class="fas fa-envelope text-indigo-600 mr-3"></i>Email: info@medclinic.kg</p>
                        <p class="text-lg text-gray-700 mb-4"><i class="fas fa-clock text-indigo-600 mr-3"></i>Иштөө убактысы: Дүйшөмбү-Жума, 9:00 - 18:00</p>

                        <h2 class="text-3xl font-semibold text-gray-800 mt-8 mb-4">Бизди картадан табыңыз</h2>
                        <div class="bg-gray-200 rounded-lg overflow-hidden shadow-md" style="height: 300px;">
                            <!-- Google Maps Embed Code Here -->
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2923.664090549491!2d74.6036083153676!3d42.8746399791556!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x389eb7dc91b3c881%3A0x1a7f01f01c80651!2sChuy%20Ave%2C%20Bishkek!5e0!3m2!1sen!2skg!4v1678987654321!5m2!1sen!2skg" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>

                    <div class="animate-fade-in-right">
                        <h2 class="text-3xl font-semibold text-gray-800 mb-4">Бизге жазыңыз</h2>
                        <form action="#" method="POST" class="space-y-4">
                            <div>
                                <x-input-label for="name" :value="__('Атыңыз')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required />
                            </div>
                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" required />
                            </div>
                            <div>
                                <x-input-label for="subject" :value="__('Тема')" />
                                <x-text-input id="subject" class="block mt-1 w-full" type="text" name="subject" required />
                            </div>
                            <div>
                                <x-input-label for="message" :value="__('Билдирүүңүз')" />
                                <textarea id="message" name="message" rows="5" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required></textarea>
                            </div>
                            <x-primary-button>
                                {{ __('Жөнөтүү') }}
                            </x-primary-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
