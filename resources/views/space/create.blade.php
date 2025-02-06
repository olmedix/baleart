<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Espacio</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="container mt-5">
        <h2>Crear Nuevo Espacio</h2>
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
                <label for="name" class="form-label">Nombre del Espacio</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="regNumber" class="form-label">Número de Registro</label>
                <input type="text" class="form-control" id="regNumber" name="regNumber" required>
            </div>

            <div class="mb-3">
                <label for="observation_CA" class="form-label">Observación (Catalán)</label>
                <textarea class="form-control" id="observation_CA" name="observation_CA" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label for="observation_ES" class="form-label">Observación (Español)</label>
                <textarea class="form-control" id="observation_ES" name="observation_ES" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label for="observation_EN" class="form-label">Observación (Inglés)</label>
                <textarea class="form-control" id="observation_EN" name="observation_EN" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="phone" name="phone">
            </div>

            <div class="mb-3">
                <label for="website" class="form-label">Sitio Web</label>
                <input type="url" class="form-control" id="website" name="website">
            </div>

            <div class="mb-3">
                <label for="accessType">Tipo de acceso</label>
                <select name="accessType" id="accessType" class="form-control">
                    <option value="">Seleccione un tipo de acceso</option>
                    <option value="y">Si</option>
                    <option value="n">No</option>
                </select>
            </div>

            <!-- Tipo de Espacio -->
            <label for="space_type_id">Tipo de Espacio:</label>
            <select name="space_type_id" id="space_type_id" class="form-control">
                <option value="">Seleccione un tipo de espacio</option>
                @foreach ($spaceTypes as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>

            <!-- Datos de la Dirección -->
            <h4>Dirección</h4>
            <div class="mb-3">
                <label for="address_name" class="form-label">Nombre de la Dirección</label>
                <input type="text" class="form-control" id="address_name" name="address_name" required>
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

            <button type="submit" class="btn btn-primary">Guardar Espacio</button>
        </form>
    </div>
</body>

</html>