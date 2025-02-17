<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300"
                    role="alert">
                    <span class="font-medium">{{ session('status') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <h1 class="text-2xl text-center font-bold">LISTA DE USUARIOS</h1>

                <h3 class="text-center font-bold text-2xl mt-6">Ordenar por:
                    {{ substr($orderBy, 0, strlen($orderBy) - 3) }}
                </h3>

                <div class="flex mb-6 justify-center">
                    <a href="{{ route('users.index', ['orderBy' => 'created_at']) }}"
                        class="border py-2 px-4 font-semibold text-xl mr-4 text-white bg-fuchsia-600">
                        Fecha creación
                    </a>

                    <a href="{{ route('users.index', ['orderBy' => 'updated_at']) }}"
                        class="border py-2 px-4 font-semibold text-xl text-white bg-amber-600">
                        Fecha actualización
                    </a>
                </div>

                <div class="px-6 pb-6 text-gray-900">

                    <!-- Se muestran los elementos en forma de Card -->
                    @each('components.card-users', $users, 'user')
                    {{ $users->links() }}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>