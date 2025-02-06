<x-app-layout>
    <div class="container mt-5 w-4/5 mx-auto">
        <form action="{{ route('spaces.store') }}" method="POST">
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <!-- Datos del Espacio -->
            <div class="mb-3">
                <label for="name" class="form-label block">Nombre del Espacio</label>
                <input type="text" class="form-control block w-1/2" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="regNumber" class="form-label block">Número de Registro</label>
                <input type="text" class="form-control block w-1/2" id="regNumber" name="regNumber" required>
            </div>

            <div class="mb-3">
                <label for="observation_CA" class="form-label block">Observación (Catalán)</label>
                <textarea class="form-control block w-1/2" id="observation_CA" name="observation_CA"
                    rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label for="observation_ES" class="form-label block">Observación (Español)</label>
                <textarea class="form-control block w-1/2" id="observation_ES" name="observation_ES"
                    rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label for="observation_EN" class="form-label">Observación (Inglés)</label>
                <textarea class="form-control block w-1/2" id="observation_EN" name="observation_EN"
                    rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label block">Correo Electrónico</label>
                <input type="email" class="form-control block w-1/2" id="email" name="email">
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label block">Teléfono</label>
                <input type="text" class="form-control block w-1/2" id="phone" name="phone">
            </div>

            <div class="mb-3">
                <label for="website" class="form-label block">Sitio Web</label>
                <input type="url" class="form-control block w-1/2" id="website" name="website">
            </div>

            <div class="mb-3">
                <label for="accessType">Tipo de acceso</label>
                <select name="accessType" id="accessType" class="form-control">
                    <option value="">Seleccione un tipo de acceso</option>
                    <option value="y">Si</option>
                    <option value="n">No</option>
                    <option value="p">P</option>
                </select>
            </div>

            <!-- Tipo de Espacio -->
            <div class="mb-3">
                <label for="space_type_id">Tipo de Espacio:</label>
                <select name="space_type_id" id="space_type_id" class="form-control">
                    <option value="">Seleccione un tipo de espacio</option>
                    @foreach ($spaceTypes as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Servicios -->
            <div class="mb-3">
                <label for="services">Servicios:</label>
                <select name="services[]" id="services" class="form-control" multiple>
                    @foreach ($services as $service)
                        <option value="{{ $service->id }}" {{ in_array($service->id, old('services', [])) ? 'selected' : '' }}>
                            {{ $service->name }}
                        </option>
                    @endforeach
                </select>
            </div>










            <!-- Datos de la Dirección -->
            <h4 class="mt-8 mb-2 font-bold text-2xl pl-48">Dirección</h4>
            <div class="mb-3">
                <label for="address_name" class="form-label block">Nombre de la Dirección</label>
                <input type="text" class="form-control w-1/2" id="address_name" name="address_name" required>
            </div>

            <div class="mb-3">
                <label for="municipality_id" class="form-label">Municipio</label>
                <select class="form-control" id="municipality_id" name="municipality_id" required>
                    @foreach ($municipalities as $municipality)
                        <option value="{{ $municipality->id }}">{{ $municipality->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="zone_id" class="form-label">Zona</label>
                <select class="form-control" id="zone_id" name="zone_id" required>
                    @foreach ($zones as $zone)
                        <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="my-6 ml-48 border border-blue-800 bg-blue-600 font-semibold p-2">Guardar
                Espacio</button>
        </form>
    </div>
</x-app-layout>