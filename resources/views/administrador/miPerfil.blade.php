<x-dashboard>
    <div class="container">
        <form class="shadow-lg p-3 my-5 rounded" action="{{ route('admin.updateMiPerfil', $user) }}" method="POST" style="background-color: #e5d9b0;" enctype="multipart/form-data" novalidate>
            @method('PATCH')
            @csrf
            <div class="row mt-3">
                <div class="col-lg-6">
                    <h1 class="text-center my-3">DATOS PERSONALES</h1>
                    <p class="text-center">Actualiza tu infomación personal como por ejemplo:</p>
                    <ul>
                        <li class="text-center" style="list-style-position: inside;">Fotografía</li>
                        <li class="text-center" style="list-style-position: inside;">Nombre</li>
                        <li class="text-center" style="list-style-position: inside;">Correo electrónico</li>
                    </ul>
                </div>
                <div class="col-lg-6 shadow">
                    <label class="form-label mb-3" for="profile_photo_path">Foto</label>
                    <br>
                    @if(Auth::user()->profile_photo_path == null)
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                        </svg>
                    @else
                        <img class="rounded-circle me-2" src="/img/avatares/{{ Auth::user()->profile_photo_path }}" style="width: 60px; height: 60px;">
                    @endif
                    <input class="form-control mt-3 @error('foto') is-invalid @enderror" type="file" name="profile_photo_path">
                    @error('profile_photo_path')
                        <div class="invalid-feedback">
                            <strong> {{ $message }} </strong>
                        </div>
                    @enderror

                    <br>
                    <label class="form-label" for="name">Nombre</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required>
                    @error('name')
                        <div class="invalid-feedback">
                            <strong> {{ $message }} </strong>
                        </div>
                    @enderror
                    
                    <br>
                    <label class="form-label" for="email">Correo electrónico</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required>
                    @error('email')
                        <div class="invalid-feedback">
                            <strong> {{ $message }} </strong>
                        </div>
                    @enderror

                    <br>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success px-4 py-2">Agregar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-dashboard>