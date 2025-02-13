<div class="block rounded-lg bg-white shadow-secondary-1">
    <div class="flex p-6 text-surface">

        <div class="flex">
            <span>Nombre: </span>
            <span>Nombre: </span>
            <span>Nombre: </span>
            <span>Nombre: </span>

        </div>



        <div class="flex justify-end">
            @if (!request()->is('users/*'))
                <a href="{{route('users.show', ['user' => $user->id])}}"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 mr-2 rounded">Mostrar</a>
            @endif
            <a href="{{route('users.edit', ['user' => $user->id])}}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mr-2 rounded">Editar</a>
            <form action="{{route('users.destroy', ['user' => $user->id])}}" method="POST" class="float-right">
                @method('DELETE')
                @csrf
                <button type="submit"
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Eliminar</button>
            </form>
        </div>

    </div>
</div>