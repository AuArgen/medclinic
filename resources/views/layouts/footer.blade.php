<footer class="bg-gray-800 text-white mt-12">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- About Section -->
            <div>
                <h3 class="text-lg font-semibold mb-4">MedClinic</h3>
                <p class="text-gray-400">Сиздин ден соолугуңузга кам көрүү - биздин негизги максатыбыз. Заманбап технологиялар жана тажрыйбалуу адистер.</p>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Ыкчам шилтемелер</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white">Башкы бет</a></li>
                    <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-white">Биз жөнүндө</a></li>
                    <li><a href="{{ route('medics.index') }}" class="text-gray-400 hover:text-white">Врачтар</a></li>
                    <li><a href="{{ route('departments.index') }}" class="text-gray-400 hover:text-white">Одделдер</a></li>
                    <li><a href="{{ route('documentation') }}" class="text-gray-400 hover:text-white">Документация</a></li>
                    <li><a href="{{ route('contact') }}" class="text-gray-400 hover:text-white">Байланыш</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Байланыш</h3>
                <ul class="space-y-2 text-gray-400">
                    <li class="flex items-start">
                        <i class="fas fa-map-marker-alt mt-1 mr-3"></i>
                        <span>Бишкек ш., Чүй пр. 123</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-phone-alt mr-3"></i>
                        <span>+996 777 123456</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-envelope mr-3"></i>
                        <span>info@medclinic.kg</span>
                    </li>
                </ul>
            </div>

            <!-- Social Media -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Биздин баракчалар</h3>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f text-xl"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram text-xl"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-telegram-plane text-xl"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-whatsapp text-xl"></i></a>
                </div>
            </div>
        </div>

        <div class="mt-8 border-t border-gray-700 pt-8 text-center text-gray-400">
            <p>&copy; {{ date('Y') }} MedClinic. Бардык укуктар корголгон.</p>
        </div>
    </div>
</footer>
