<x-app-layout>

    <!-- En caso contrario, mostramos el formulario, es llamada inicial -->
    <div class="container mt-5 w-4/5 mx-auto">
        <form action="{{ route('spaces.update', ['space' => $space->id]) }}" method="post">
            @csrf
            @method('PUT') <!-- Cambio de method a 'PUT', en caso contrario llamaría al show -->

            <!-- Gestión de errores -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-3">
                <label for="name" class="form-label block font-semibold">Nombre del Espacio</label>
                <input type="text" class="form-control block w-1/2" style="@error('name') border-color:RED; @enderror"
                    value="{{ old('name', $space->name) }}" name="name">
            </div>

            <div class="mb-3">
                <label for="regNumber" class="form-label block font-semibold">Número de Registro</label>
                <input type="text" class="form-control block w-1/2"
                    style="@error('regNumber') border-color:RED; @enderror"
                    value="{{old('regNumber', $space->regNumber)}}" name="regNumber">
            </div>

            <div class="mb-3">
                <label for="observation_CA" class="form-label block font-semibold">Observación (Catalán)</label>
                <textarea class="form-control block w-1/2 text-left"
                    style="@error('observation_CA') border-color:RED; @enderror" name="observation_CA" rows="3">{{old('observation_CA', $space->observation_CA)}}
                </textarea>
            </div>

            <div class="mb-3">
                <label for="observation_ES" class="form-label block font-semibold">Observación (Español)</label>
                <textarea class="form-control block w-1/2" style="@error('observation_ES') border-color:RED; @enderror"
                    name="observation_ES" rows="3">{{old('observation_ES', $space->observation_ES) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="observation_EN" class="form-label block font-semibold">Observación (Inglés)</label>
                <textarea class="form-control block w-1/2" style="@error('observation_EN') border-color:RED; @enderror"
                    name="observation_EN" rows="3">{{old('observation_EN', $space->observation_EN) }}
                </textarea>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label block font-semibold">Email</label>
                <input type="email" class="form-control block w-1/2" style="@error('email') border-color:RED; @enderror"
                    value="{{old('email', $space->email) }}" name="email">
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label block font-semibold">Teléfono</label>
                <input type="text" class="form-control block w-1/2" style="@error('phone') border-color:RED; @enderror"
                    value="{{old('phone', $space->phone) }}" name="phone">
            </div>

            <div class="mb-3">
                <label for="website" class="form-label block font-semibold">Sitio Web</label>
                <input type="url" class="form-control block w-1/2" style="@error('website') border-color:RED; @enderror"
                    value="{{old('website', $space->website) }}" name="website">
            </div>

            <div class="mb-3">
                <label for="access_types" class="form-label block font-semibold">Tipo de acceso</label>
                <select name="access_types" class="form-control"
                    style="@error('accesType') border-color:RED; @enderror">
                    <option value="y" {{ old('access_types', $space->access_types) == 'y' ? 'selected' : '' }}>Sí</option>
                    <option value="n" {{ old('access_types', $space->access_types) == 'n' ? 'selected' : '' }}>No</option>
                    <option value="p" {{ old('access_types', $space->access_types) == 'p' ? 'selected' : '' }}>Parcial
                    </option>
                </select>
            </div>

            <!-- Tipo de Espacio -->
            <div class="mb-3">
                <label for="space_type_id" class="form-label block font-semibold">Tipo de Espacio:</label>
                <select name="space_type_id" class="form-control">
                    <option value="">Seleccione un tipo de espacio</option>
                    @foreach ($spaceTypes as $type)
                        <option value="{{ $type->id }}" {{ $space->space_type_id == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Selección de Servicios -->
            <section class="flex gap-x-10">
                <div class="mb-3">
                    <label for="services" class="form-label block font-semibold">Servicios:</label>
                    <select name="services[]" id="services" class="form-control h-52" multiple>
                        @foreach ($services as $service)
                            <option value="{{ $service->id }}" {{ in_array($service->id, $space->services->pluck('id')->toArray()) ? 'selected' : '' }}>
                                {{ $service->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Selección de Modalidades -->
                <div class="mb-3">
                    <label for="modalities" class="form-label block font-semibold">Modalidades:</label>
                    <select name="modalities[]" id="modalities" class="form-control h-52" multiple>
                        @foreach ($modalities as $modality)
                            <option value="{{ $modality->id }}" {{ in_array($modality->id, $space->modalities->pluck('id')->toArray()) ? 'selected' : '' }}>
                                {{ $modality->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </section>

            <!-- Datos de la Dirección -->
            <h4 class="text-2xl font-bold my-5">Dirección</h4>

            <div class="mb-3">
                <label for="address_name" class="form-label block font-semibold">Nombre de la calle</label>
                <input type="text" class="form-control" value="{{$space->address->name}}" name="address_name">
            </div>

            <input type="submit"
                class="my-6 ml-48 text-white border border-blue-800 bg-blue-600 hover:bg-blue-800 hover:text-white font-semibold p-3 rounded-xl cursor-pointer"
                value="Update">
        </form>
    </div>

</x-app-layout>