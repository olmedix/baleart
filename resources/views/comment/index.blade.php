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

                <div class="flex pt-10 pl-6 pb-8 text-gray-900 border-b-2 w-5/6 mx-auto">
                    <div class="flex w-full">
                        <form action="{{ route('comments.index') }}" method="GET">
                            <label class="font-bold text-xl mt-2 mr-2" for="user">Usuario</label>
                            <input type="text" name="user" id="user" placeholder="Nombre del usuario"
                                value="{{ request('user') }}">

                            <button class="border-2 bg-gray-500 py-2 px-4 rounded-xl" type="submit">Buscar</button>
                        </form>
                    </div>
                </div>

                <div class="px-6 pb-6 text-gray-900">

                    <!-- Se muestran los elementos en forma de Card -->
                    @each('components.card-comments', $comments, 'comment')
                    {{ $comments->links() }} <!-- Paginación -->

                </div>
            </div>
        </div>
    </div>
</x-app-layout>