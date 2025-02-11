<x-app-layout>
    <div class="container mt-5 w-4/5 mx-auto">
        <form action="{{ route('spaces.store') }}" method="POST">
            @csrf

            @if ($errors->any())
                <div class="bg-red-500 text-white font-semibold p-3 w-1/2">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <!-- Datos del Espacio -->
            <div class="mb-3">
                <label for="name" class="form-label block font-semibold">Nombre del Espacio</label>
                <input type="text" class="form-control block w-1/2" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="regNumber" class="form-label block font-semibold">Número de Registro</label>
                <input type="text" class="form-control block w-1/2" id="regNumber" style="display: block;"
                    name="regNumber" required>
            </div>

            <div class="mb-3 editor-container">
                <label for="observation_CA" class="form-label block font-semibold">Observación (Catalán)</label>
                <textarea class="form-control block w-1/2 text-left editor" style="display: block;"
                    name="observation_CA"></textarea>
            </div>

            <div class="mb-3 editor-container">
                <label for="observation_ES" class="form-label block font-semibold">Observación (Español)</label>
                <textarea class="form-control block w-1/2 text-left editor" style="display: block;"
                    name="observation_ES"></textarea>
            </div>

            <div class="mb-3 editor-container">
                <label for="observation_EN" class="form-label font-semibold">Observación (Inglés)</label>
                <textarea class="form-control block w-1/2 text-left editor" name="observation_EN"></textarea>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label block font-semibold">Correo Electrónico</label>
                <input type="email" class="form-control block w-1/2" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label block font-semibold">Teléfono</label>
                <input type="text" class="form-control block w-1/2" id="phone" name="phone" required>
            </div>

            <div class="mb-3">
                <label for="website" class="form-label block font-semibold">Sitio Web</label>
                <input type="url" class="form-control block w-1/2" id="website" name="website" required>
            </div>

            <div class="mb-3">
                <label class="block font-semibold" for="accessType">Tipo de acceso</label>
                <select name="accessType" id="accessType" class="form-control">
                    <option value="y">Si</option>
                    <option value="n">No</option>
                    <option value="p">Parcial</option>
                </select>
            </div>

            <!-- Tipo de Espacio -->
            <div class="mb-3">
                <label class="block font-semibold" for="space_type_id">Tipo de Espacio:</label>
                <select name="space_type_id" id="space_type_id" class="form-control">
                    @foreach ($spaceTypes as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>

            <h3 class="block mt-8 text-2xl font-semibold">Elige varias opciones con ( CTRL + click )</h3>

            <section class="flex">

                <!-- Servicios -->
                <div class="mb-3 mr-28">
                    <label class="block font-semibold mt-2" for="services">Servicios</label>
                    <select name="services[]" id="services" class="form-control h-52" multiple>
                        @foreach ($services as $service)
                            <option value="{{ $service->id }}">
                                {{ $service->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Modalidades -->
                <div class="mb-3">
                    <label class="block font-semibold mt-2" for="modalities">Modalidades</label>
                    <select name="modalities[]" id="modalities" class="form-control h-52" multiple>
                        @foreach ($modalities as $modality)
                            <option value="{{ $modality->id }}">
                                {{ $modality->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </section>

            <!-- Datos de la Dirección -->
            <h4 class="mt-8 mb-2 font-bold text-2xl pl-48">Dirección</h4>

            <div class="mb-3">
                <label for="address_name" class="form-label block font-semibold">Nombre de la Dirección</label>
                <input type="text" class="form-control w-1/2" id="address_name" name="address_name" required>
            </div>

            <div class="mb-3">
                <label for="municipality_id" class="form-label block font-semibold">Municipio</label>
                <select class="form-control" id="municipality_id" name="municipality_id" required>
                    @foreach ($municipalities as $municipality)
                        <option value="{{ $municipality->id }}">{{ $municipality->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="zone_id" class="form-label block font-semibold">Zona</label>
                <select class="form-control" id="zone_id" name="zone_id" required>
                    @foreach ($zones as $zone)
                        <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit"
                class="my-6 ml-48 text-white border border-blue-800 bg-blue-600 hover:bg-blue-800 hover:text-white font-semibold p-2">Guardar
                Espacio</button>

            <script>
                const {
                    ClassicEditor,
                    Essentials,
                    Bold,
                    Italic,
                    Font,
                    Paragraph
                } = CKEDITOR;

                document.addEventListener("DOMContentLoaded", function () {
                    document.querySelectorAll('.editor').forEach(editor => {
                        ClassicEditor
                            .create(editor, {
                                licenseKey: 'eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE3NzA4NTQzOTksImp0aSI6ImRmMTg0ZjAyLTBhZDItNGJlMC1iYjdmLTM5YTdiNDQ5ZGY3YSIsImxpY2Vuc2VkSG9zdHMiOlsiMTI3LjAuMC4xIiwibG9jYWxob3N0IiwiMTkyLjE2OC4qLioiLCIxMC4qLiouKiIsIjE3Mi4qLiouKiIsIioudGVzdCIsIioubG9jYWxob3N0IiwiKi5sb2NhbCJdLCJ1c2FnZUVuZHBvaW50IjoiaHR0cHM6Ly9wcm94eS1ldmVudC5ja2VkaXRvci5jb20iLCJkaXN0cmlidXRpb25DaGFubmVsIjpbImNsb3VkIiwiZHJ1cGFsIl0sImxpY2Vuc2VUeXBlIjoiZGV2ZWxvcG1lbnQiLCJmZWF0dXJlcyI6WyJEUlVQIl0sInZjIjoiNzhkYmQ1MGIifQ.pqqrxqor7a8k8utf8cKOzFD_4pMG-de4CvNgbSvYZq2QSuWOIjV5HpXx3lww-t9Goe6ZepiA_mxHo-FOE79SQA',
                                plugins: [Essentials, Bold, Italic, Font, Paragraph],
                                toolbar: [
                                    'undo', 'redo', '|', 'bold', 'italic', '|',
                                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|'
                                ]
                            })
                            .catch(error => console.error('Error al inicializar CKEditor:', error));
                    });
                });
            </script>
        </form>


    </div>

</x-app-layout>