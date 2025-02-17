<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if (session('status'))
                    <div class="p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300"
                        role="alert">
                        <span class="font-medium">{{ session('status') }}</span>
                    </div>
                @endif

                <div class="flex mx-auto justify-center">
                    <a href="{{ route('spaces.create') }}"
                        class="bg-blue-600 hover:bg-blue-800 hover:scale-110 text-white font-bold py-2 px-4 rounded">Agregar
                        Espacio</a>
                </div>
                <div class="p-6 text-gray-900">

                    <!-- Se muestran los elementos en forma de Card -->
                    @each('components.card-spaces', $spaces, 'space')
                    {{ $spaces->links() }} <!-- Paginación -->

                </div>
            </div>
        </div>
    </div>
</x-app-layout>