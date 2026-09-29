<?php

require __DIR__ . '/vendor/autoload.php';

$app = require __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Arrancamos la aplicación para poder usar helpers como config() y url().
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$pdo = new PDO('mysql:host=127.0.0.1;dbname=bd_libro;charset=utf8mb4', 'root', '');

$valor = function (string $sql) use ($pdo) {
    $v = $pdo->query($sql)->fetchColumn();

    return $v === false ? null : $v;
};

$idLibro      = $valor('SELECT ID_libro FROM libros ORDER BY ID_libro LIMIT 1');
$idAutor      = $valor('SELECT ID_autores FROM autores ORDER BY ID_autores LIMIT 1');
$idEditor     = $valor('SELECT ID_editores FROM editores ORDER BY ID_editores LIMIT 1');
$idTraductor  = $valor('SELECT ID_traductores FROM traductores ORDER BY ID_traductores LIMIT 1');

$rutas = [
    '/'                                                => 'inicio',
    '/libros'                                          => 'libros',
    '/libros/create'                                   => 'libros',
    '/libros/' . $idLibro                              => 'libros',
    '/libros/' . $idLibro . '/edit'                    => 'libros',
    '/autores'                                         => 'autores',
    '/autores/create'                                  => 'autores',
    '/autores/' . $idAutor                             => 'autores',
    '/autores/' . $idAutor . '/edit'                   => 'autores',
    '/editores'                                        => 'editores',
    '/editores/create'                                 => 'editores',
    '/editores/' . $idEditor                           => 'editores',
    '/editores/' . $idEditor . '/edit'                 => 'editores',
    '/traductores'                                     => 'traductores',
    '/traductores/create'                              => 'traductores',
    '/traductores/' . $idTraductor                     => 'traductores',
    '/traductores/' . $idTraductor . '/edit'           => 'traductores',
];

$base = rtrim(config('app.url'), '/');

$enlacesNav = [
    '"' . $base . '"',          // Inicio  ->  http://localhost
    '"' . $base . '/libros' . '"',
    '"' . $base . '/autores' . '"',
    '"' . $base . '/editores' . '"',
    '"' . $base . '/traductores' . '"',
];

$fallos = [];

foreach ($rutas as $uri => $seccion) {

    $request  = Illuminate\Http\Request::create($uri, 'GET');
    $response = $kernel->handle($request);
    $html     = $response->getContent();
    $status   = $response->getStatusCode();

    $errores = [];

    if ($status !== 200) {
        $errores[] = "HTTP {$status}";
    }

    // --- barra de navegación presente y completa ---
    $nav = '';
    if (preg_match('#<nav.*?</nav>#s', $html, $m)) {
        $nav = $m[0];
    } else {
        $errores[] = 'SIN NAVBAR';
    }

    if ($nav !== '') {
        foreach ($enlacesNav as $enlace) {
            if (strpos($nav, $enlace) === false) {
                $errores[] = 'nav sin ' . $enlace;
            }
        }

        foreach (['Inicio', 'Libros', 'Autores', 'Editores', 'Traductores'] as $texto) {
            if (strpos($nav, $texto) === false) {
                $errores[] = 'nav sin texto "' . $texto . '"';
            }
        }

        if (strpos($nav, 'Biblioteca Virtual') === false) {
            $errores[] = 'nav sin marca "Biblioteca Virtual"';
        }

        if (strpos($nav, 'Instituto Tecnológico de Coracora') === false) {
            $errores[] = 'nav sin instituto';
        }
    }

    // --- bootstrap local ---
    if (strpos($html, "asset('bootstrap.min.css')") !== false) {
        // ok: sigue en Blade
    } elseif (strpos($html, '/bootstrap.min.css') === false) {
        $errores[] = 'sin bootstrap.min.css';
    }

    if (stripos($html, 'cdn.jsdelivr') !== false || stripos($html, 'cdn.bootcdn') !== false
        || stripos($html, 'stackpath') !== false || stripos($html, '@vite') !== false) {
        $errores[] = 'referencia CDN/Vite';
    }

    // --- secciones propias ---
    if ($uri === '/') {
        if (strpos($html, 'Libros disponibles') === false) {
            $errores[] = 'falta seccion "Libros disponibles"';
        }
        if (strpos($html, 'Ver libros') === false) {
            $errores[] = 'falta boton "Ver libros"';
        }
        if (strpos($html, 'Biblioteca Virtual') === false) {
            $errores[] = 'falta titulo Biblioteca Virtual';
        }
    }

    printf("%-46s %s%s\n", $uri, $status, $errores ? '  >>> ' . implode(' | ', $errores) : '  OK');

    if ($errores) {
        $fallos[] = $uri;
    }

    $kernel->terminate($request, $response);
}

// --- comprobación del logo (fallback) ---
$logoExiste = file_exists(__DIR__ . '/public/images/logo.png');
echo "\npublic/images/logo.png: " . ($logoExiste ? 'EXISTE (se usará <img>)' : 'NO EXISTE (se usará el icono alternativo)') . "\n";

// --- assets locales ---
foreach (['bootstrap.min.css', 'app.css', 'bootstrap.bundle.min.js'] as $a) {
    printf("public/%-26s %s\n", $a, file_exists(__DIR__ . '/public/' . $a) ? 'OK' : 'FALTA');
}

echo "\n" . (empty($fallos) ? "TODO OK" : "FALLOS: " . implode(', ', $fallos)) . "\n";

exit(empty($fallos) ? 0 : 1);
