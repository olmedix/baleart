<div class="block rounded-lg bg-white shadow-secondary-1">
    <div class="flex p-6 text-surface">

        <div class="w-2/3">
            <p class="font-semibold">Nombre: <span class="font-medium">{{ $user->name . " " . $user->lastName }}</span>
            </p>
            <p class="font-semibold">Email: <span class="font-medium">{{ $user->email}}</span> </p>
            <p class="font-semibold">Teléfono: <span class="font-medium">{{ $user->phone}}</span> </p>
            <p class="font-semibold">Rol: <span class="font-medium">{{ $user->role->name}}</span> </p>

        </div>



        <div class="flex items-center justify-end">
            @if (!request()->is('users/*'))
                <a href="{{route('users.show', ['user' => $user->id])}}"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 mr-2 h-10 rounded">Mostrar</a>
            @endif
            <a href="{{route('users.edit', ['user' => $user->id])}}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mr-2 h-10 rounded">Editar</a>

            @if($user->role->name != 'administrador' && $user->role->name != 'gestor')

                <form action="{{route('users.destroy', ['user' => $user->id])}}" method="POST" class="float-right">
                    @method('DELETE')
                    @csrf
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Eliminar</button>
                </form>
            @endif
        </div>

    </div>
</div>