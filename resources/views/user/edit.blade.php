<x-app-layout>

    <!-- En caso contrario, mostramos el formulario, es llamada inicial -->
    <div class="container mt-5 w-4/5 mx-auto">
        <form action="{{ route('users.update', ['user' => $user->id]) }}" method="post">
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
                <label for="name" class="form-label block font-semibold">Nombre</label>
                <input type="text" class="form-control block w-1/2" style="@error('name') border-color:RED; @enderror"
                    value="{{ old('name', $user->name) }}" name="name">
            </div>

            <div class="mb-3">
                <label for="lastName" class="form-label block font-semibold">Apellido</label>
                <input type="text" class=" form-control block w-1/2"
                    style="@error('lastName') border-color:RED; @enderror"
                    value="{{ old('lastName', $user->lastName) }}" name="lastName">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label block font-semibold">Email</label>
                <input type="email" class="form-control block w-1/2" style="@error('email') border-color:RED; @enderror"
                    value="{{ old('email', $user->email) }}" name="email">
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label block font-semibold">Teléfono</label>
                <input type="text" class=" form-control block w-1/2" style="@error('phone') border-color:RED; @enderror"
                    value="{{ old('phone', $user->phone) }}" name="phone">
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