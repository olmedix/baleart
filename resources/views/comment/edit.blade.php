<x-app-layout>

    <!-- En caso contrario, mostramos el formulario, es llamada inicial -->
    <div class="container mt-5 w-4/5 mx-auto">
        <form action="{{ route('comments.update', ['comment' => $comment->id]) }}" method="post">
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
                <label for="comment" class="form-label block font-semibold">Comentario</label>
                <input type="text" class="form-control block w-1/2" style="@error('name') border-color:RED; @enderror"
                    value="{{ old('comment', $comment->comment) }}" name="comment">
            </div>

            <div class="mb-3">
                <label for="score" class="form-label block font-semibold">Puntuación</label>
                <input type="text" class="form-control block w-1/2" style="@error('score') border-color:RED; @enderror"
                    value="{{old('score', $comment->score)}}" name="score">
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

</x-app-layout>