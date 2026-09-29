{{-- Barra de navegación compartida por todo el sistema --}}
<nav class="navbar navbar-dark bg-dark">
    <div class="container">

        <a class="navbar-brand d-flex align-items-center gap-2 mb-0"
           href="{{ route('inicio') }}">

            @if (file_exists(public_path('images/logo.png')))

                <img src="{{ asset('images/logo.png') }}"
                     alt="Instituto Tecnológico de Coracora"
                     style="
                         width: 42px;
                         height: 42px;
                         object-fit: contain;
                         background: #ffffff;
                         border-radius: 50%;
                         padding: 3px;
                     ">

            @else

                <span aria-hidden="true"
                      style="
                          display: inline-flex;
                          align-items: center;
                          justify-content: center;
                          width: 42px;
                          height: 42px;
                          background: #ffffff;
                          color: #6d4c41;
                          border-radius: 50%;
                          font-size: 22px;
                      ">🏛️</span>

            @endif

            <span class="d-flex flex-column lh-sm">
                <strong>📚 Biblioteca Virtual</strong>
                <small style="opacity: .75;">
                    Instituto Tecnológico de Coracora
                </small>
            </span>

        </a>


        <div class="d-flex flex-wrap gap-2 py-1">

            <a href="{{ route('inicio') }}"
               class="btn btn-sm {{ ($navActual ?? '') === 'inicio' ? 'btn-light' : 'btn-outline-light' }}">
                Inicio
            </a>

            <a href="{{ route('libros.index') }}"
               class="btn btn-sm {{ ($navActual ?? '') === 'libros' ? 'btn-light' : 'btn-outline-light' }}">
                Libros
            </a>

            <a href="{{ route('autores.index') }}"
               class="btn btn-sm {{ ($navActual ?? '') === 'autores' ? 'btn-light' : 'btn-outline-light' }}">
                Autores
            </a>

            <a href="{{ route('editores.index') }}"
               class="btn btn-sm {{ ($navActual ?? '') === 'editores' ? 'btn-light' : 'btn-outline-light' }}">
                Editores
            </a>

            <a href="{{ route('traductores.index') }}"
               class="btn btn-sm {{ ($navActual ?? '') === 'traductores' ? 'btn-light' : 'btn-outline-light' }}">
                Traductores
            </a>

        </div>

    </div>
</nav>
