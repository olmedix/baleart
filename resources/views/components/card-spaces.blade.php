<div class="block rounded-lg bg-white shadow-secondary-1">
    <div class="p-6 text-surface">
        <h5 class="mb-2 mt-5 mx-auto text-center text-2xl font-bold leading-tight">{{ $space->name }}</h5>
        <h3 class="mb-4 text-xl font-bold leading-tight"> Número de registro: {{ $space->regNumber }}</h3>


        <p class="text-sm"> <span class="font-bold text-lg ">Observació: </span>
            {!! $space->observation_CA !!}</p>
        <p class="mt-4 text-sm"> <span class="font-bold text-lg">Observación: </span> {!! $space->observation_ES !!}</p>
        <p class="mt-4 text-sm"> <span class="font-bold text-lg">Observation: </span> {!! $space->observation_EN !!}</p>
        <p class="my-4 text-sm"> <span class="font-bold text-lg">Email: </span> {{ $space->email }}</p>
        <p class="mb-4 text-sm"> <span class="font-bold text-lg">Teléfono: </span> {{ $space->phone }}</p>
        <p class="mb-4 text-sm"> <span class="font-bold text-lg">Página web: </span> {{ $space->website }}</p>
        <p class="mb-4 text-sm"> <span class="font-bold text-lg">Modalidades:
                @foreach ($space->modalities as $modality)
                    <span class="font-normal text-sm"> {{ $modality->name }}, </span>
                @endforeach
        </p>
        <p class="mb-4 text-sm"> <span class="font-bold text-lg">Servicios:
                @foreach ($space->services as $service)
                    <span class="font-normal text-sm"> {{ $service->name }}, </span>
                @endforeach
        </p>
        <p class="mb-4 text-sm"> <span class="font-bold text-lg">Acceso: </span> {{ $space->access_types }}</p>
        <p class="mb-4 text-sm"> <span class="font-bold text-lg">Puntuación total: </span> {{ $space->totalScore }}</p>
        <p class="mb-4 text-sm"> <span class="font-bold text-lg">Número de comentarios: </span> {{ $space->countScore }}
        </p>
        <p class="mb-4 text-sm"> <span class="font-bold text-lg">Calle: </span> {{ $space->address->name  }}</p>
        <p class="mb-4 text-sm"> <span class="font-bold text-lg">Tipo de espacio: </span> {{ $space->spaceType->name }}
        </p>
        <p class="mb-4 text-sm"> <span class="font-bold text-lg">Usuario: </span> {{ $space->user->name  }}</p>
        <p class="mb-4 text-sm"> <span class="font-bold text-lg">Creado: </span> {{ $space->created_at }}</p>
        <p class="mb-4 text-sm"> <span class="font-bold text-lg">Actualizado: </span> {{ $space->updated_at }}</p>
        @if (!request()->is('spaces/*'))
            <a href="{{route('spaces.show', ['space' => $space->id])}}"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Mostrar</a>
        @endif
        <a href="{{route('spaces.edit', ['space' => $space->id])}}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</a>
        <form action="{{route('spaces.destroy', ['space' => $space->id])}}" method="POST" class="float-right">
            @method('DELETE')
            @csrf
            <button type="submit"
                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Eliminar</button>
        </form>
    </div>
</div>