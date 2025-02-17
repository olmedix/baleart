<div class="block rounded-lg bg-white shadow-secondary-1">
    <div class="p-6 text-surface">
        <h5 class="mb-2 mt-5 mx-auto text-center text-2xl font-bold leading-tight">{{ $comment->space->name }}</h5>
        <h3 class="mb-4 text-xl font-bold leading-tight"> Comentario: </h3>
        <p class="mt-4 text-sm"> <span class=" text-lg">{!! $comment->comment !!}</p>

        <p class="mt-4 text-sm"> <span class="font-bold text-lg">Puntuación: </span> {{ $comment->score }}</p>
        <p class="mt-4 text-sm"> <span class="font-bold text-lg">Estado: </span> {!! $comment->status  !!}</p>
        <p class="my-4 text-sm"> <span class="font-bold text-lg">Usuario: </span> {{ $comment->user->name}}</p>
        <p class="mb-4 text-sm"> <span class="font-bold text-lg">Creado: </span> {{ $comment->created_at }}</p>
        <p class="mb-4 text-sm"> <span class="font-bold text-lg">Actualizado: </span> {{ $comment->updated_at }}</p>

        <!-- Lista si hay imagenes asociadas al comentario -->
        @if ($comment->images->count() > 0)
            <h3 class="my-6 text-xl font-bold leading-tight">Listado de imágenes </h3>

            <ul class="mb-4">
                @foreach ($comment->images as $image)
                    <div class="w-28 h-28 mr-2 inline-block rounded-2xl shadow-lg shadow-black">
                        <img class="w-28 h-28 rounded-2xl" src="{{ $image->url }}"
                            onerror="this.onerror=null;this.src='{{ asset('images/baluard.jpg') }}';" alt="Sin foto">
                    </div>

                @endforeach
            </ul>


        @endif


        @if (!request()->is('comments/*'))
            <a href="{{route('comments.show', ['comment' => $comment->id])}}"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Mostrar</a>
        @endif
        <a href="{{route('comments.edit', ['comment' => $comment->id])}}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</a>
        <form action="{{route('comments.destroy', ['comment' => $comment->id])}}" method="POST" class="float-right">
            @method('DELETE')
            @csrf
            <button type="submit"
                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Eliminar</button>
        </form>
    </div>
</div>