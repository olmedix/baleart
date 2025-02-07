<x-app-layout>
    <h3>Edit Space</h3>

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


    <!-- En caso contrario, mostramos el formulario, es llamada inicial -->

    <form action="{{ route('spaces.update', ['space' => $space->id]) }}" method="post">
        @csrf
        @method('PUT') <!-- Cambio de method a 'PUT', en caso contrario llamaría al show -->

        <div class="mb-3">
            <label for="name" class="form-label">Nombre del Espacio</label>
            <input type="text" class="form-control" style="@error('name') border-color:RED; @enderror"
                value="{{ old('name', $space->name) }}" name="name">
        </div>

        <div class="mb-3">
            <label for="regNumber" class="form-label">Número de Registro</label>
            <input type="text" class="form-control" style="@error('regNumber') border-color:RED; @enderror"
                value="{{old('regNumber', $space->regNumber)}}" name="regNumber">
        </div>

        <div class="mb-3">
            <label for="observation_CA" class="form-label">Observación (Catalán)</label>
            <textarea class="form-control" style="@error('observation_CA') border-color:RED; @enderror"
                value="{{old('observation_CA', $space->observation_CA)}}" name="observation_CA" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label for="observation_ES" class="form-label">Observación (Español)</label>
            <textarea class="form-control" style="@error('observation_ES') border-color:RED; @enderror"
                value="{{old('observation_ES', $space->observation_ES) }}" name="observation_ES" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label for="observation_EN" class="form-label">Observación (Inglés)</label>
            <textarea class="form-control" style="@error('observation_EN') border-color:RED; @enderror"
                value="{{old('observation_EN', $space->observation_EN) }}" name="observation_EN" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" style="@error('email') border-color:RED; @enderror"
                value="{{old('email', $space->email) }}" name="email">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Teléfono</label>
            <input type="text" class="form-control" style="@error('phone') border-color:RED; @enderror"
                value="{{old('phone', $space->phone) }}" name="phone">
        </div>

        <div class="mb-3">
            <label for="website" class="form-label">Sitio Web</label>
            <input type="url" class="form-control" style="@error('website') border-color:RED; @enderror"
                value="{{old('website', $space->website) }}" name="website">
        </div>

        <div class="mb-3">
            <label for="accessType" class="form-label">Tipo de acceso</label>
            <select name="accessType" class="form-control" style="@error('website') border-color:RED; @enderror">
                <option value="{{$space->accessType}}" {{$space->accessType}}</option>
                <option value="y">Si</option>
                <option value="n">No</option>
                <option value="P">P</option>
            </select>
        </div>

        <!-- Tipo de Espacio -->
        <div class="mb-3">
            <label for="space_type_id" class="form-label">Tipo de Espacio:</label>
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
        <div class="mb-3">
            <label for="services" class="form-label">Servicios:</label>
            <select name="services[]" id="services" class="form-control" multiple>
                @foreach ($services as $service)
                    <option value="{{ $service->id }}" {{ in_array($service->id, $space->services->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $service->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Selección de Modalidades -->
        <div class="mb-3">
            <label for="modalities" class="form-label">Modalidades:</label>
            <select name="modalities[]" id="modalities" class="form-control" multiple>
                @foreach ($modalities as $modality)
                    <option value="{{ $modality->id }}" {{ in_array($modality->id, $space->modalities->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $modality->name }}
                    </option>
                @endforeach
            </select>
        </div>


        <!-- Datos de la Dirección -->
        <h4>Dirección</h4>
        <div class="mb-3">
            <label for="address_name" class="form-label">Nombre de la Dirección</label>
            <input type="text" class="form-control" value="{{$space->address_name}}" name="address_name">
        </div>

        <input type="submit" value="Update">
    </form>
</x-app-layout>