<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Se muestran los elementos en forma de Card -->
                    @each('components.card-spaces', $spaces, 'space')
                    {{ $spaces->links() }} <!-- Paginación -->

                </div>
            </div>
        </div>
    </div>
</x-app-layout>