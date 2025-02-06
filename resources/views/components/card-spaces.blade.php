<div class="block rounded-lg bg-white shadow-secondary-1">
    <div class="p-6 text-surface">
        <h5 class="mb-2 mt-5 mx-auto text-center text-2xl font-bold leading-tight">{{ $space->name }}</h5>
        <h3 class="mb-4 text-xl font-bold leading-tight"> Número de registro: {{ $space->regNumber }}</h3>


        <p class="mb-4 text-sm"> <span class="font-bold text-lg">observació: </span> {{$space->observation_CA}}</p>
        <p class="mb-4 text-sm"> <span class="font-bold text-lg">observación: </span> {{$space->observation_ES}}</p>
        <p class="mb-4 text-sm"> <span class="font-bold text-lg">observation: </span> {{$space->observation_EN}}</p>
        <p class="mb-4 text-sm"> <span class="font-bold text-lg">email: </span> {{ $space->email }}</p>
        <p class="mb-4 text-sm"> <span class="font-bold text-lg">phone: </span> {{ $space->phone }}</p>
        <p class="mb-4 text-sm"> <span class="font-bold text-lg">website: </span> {{ $space->website }}</p>
        <p class="mb-4 text-sm"> <span class="font-bold text-lg">acces type: </span> {{ $space->accessType }}</p>
        <p class="mb-4 text-sm"> <span class="font-bold text-lg">total score: </span> {{ $space->totalScore }}</p>
        <p class="mb-4 text-sm"> <span class="font-bold text-lg">count score: </span> {{ $space->countScore }}</p>
        <p class="mb-4 text-sm"> <span class="font-bold text-lg">address: </span> {{ $space->address->name  }}</p>
        <p class="mb-4 text-sm"> <span class="font-bold text-lg">space type: </span> {{ $space->spaceType->name }}</p>
        <p class="mb-4 text-sm"> <span class="font-bold text-lg">user: </span> {{ $space->user->name  }}</p>
        <p class="mb-4 text-sm"> <span class="font-bold text-lg">created at: </span> {{ $space->created_at }}</p>
        <p class="mb-4 text-sm"> <span class="font-bold text-lg">updated at: </span> {{ $space->updated_at }}</p>
        <a href="{{route('spaces.show', ['space' => $space->id])}}"
            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Show</a>
        <a href="{{route('spaces.edit', ['space' => $space->id])}}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>
        <form action="{{route('spaces.destroy', ['space' => $space->id])}}" method="POST" class="float-right">
            @method('DELETE')
            @csrf
            <button type="submit"
                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
        </form>
    </div>
</div>