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
                <textarea class="form-control block w-1/2 editor" style="@error('comment') border-color:RED; @enderror"
                    name="comment">
                        {{ old('comment', $comment->comment) }}
                </textarea>
            </div>

            <div class="mb-3">
                <label for="score" class="form-label block font-semibold">Puntuación</label>
                <select name="score" class="form-control" style="@error('score') border-color:RED; @enderror">
                    <option value="1" {{ old('score', $comment->score) == 1 ? 'selected' : '' }}>1</option>
                    <option value="2" {{ old('score', $comment->score) == 2 ? 'selected' : '' }}>2</option>
                    <option value="3" {{ old('score', $comment->score) == 3 ? 'selected' : '' }}>3</option>
                    <option value="4" {{ old('score', $comment->score) == 4 ? 'selected' : '' }}>4</option>
                    <option value="5" {{ old('score', $comment->score) == 5 ? 'selected' : '' }}>5</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label block font-semibold">Estado</label>
                <select name="status" class="form-control" style="@error('status') border-color:RED; @enderror">
                    <option value="y" {{ old('status', $comment->status) == 'y' ? 'selected' : '' }}>Sí</option>
                    <option value="n" {{ old('status', $comment->status) == 'n' ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="space_id" class="form-label block font-semibold">Espacio asociado</label>
                <input type="text" class="text-gray-500 bg-gray-300 form-control block w-1/2"
                    style="@error('space_id') border-color:RED; @enderror"
                    value="{{ old('space_id', $comment->space->name) }}" name="space_id" disabled>
            </div>

            <div class="mb-3">
                <label for="user_id" class="form-label block font-semibold">Usuario</label>
                <input type="text" class="text-gray-500 bg-gray-300 form-control block w-1/2"
                    style="@error('user_id') border-color:RED; @enderror"
                    value="{{ old('user_id', $comment->user->name . ' ' . $comment->user->lastName) }}" name="user_id"
                    disabled>
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