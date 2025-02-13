<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <h1 class="text-2xl text-center font-bold">USUARIOS</h1>

                <div class="px-6 pb-6 text-gray-900">

                    <!-- Se muestran los elementos en forma de Card -->
                    @each('components.card-users', $users, 'user')
                    {{ $users->links() }}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>