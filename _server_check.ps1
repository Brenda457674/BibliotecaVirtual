$ErrorActionPreference = 'Stop'

$dir  = 'C:\Users\Retam\Documents\2026-II\programming\Biblioteca_Virtual'
$base = 'http://127.0.0.1:8000'

# ¿Ya corre un servidor en el puerto 8000?
$yaCorria = $true
try { Invoke-WebRequest -Uri "$base/" -UseBasicParsing -TimeoutSec 2 | Out-Null }
catch { $yaCorria = $false }

$srv = $null

if ($yaCorria) {
    Write-Host "Usando el servidor ya activo en $base"
} else {
    $srv = Start-Process -FilePath 'php' `
                         -ArgumentList 'artisan','serve','--host=127.0.0.1','--port=8000' `
                         -WorkingDirectory $dir -PassThru -WindowStyle Hidden
    Start-Sleep -Seconds 6
    Write-Host "Servidor iniciado (pid $($srv.Id))"
}

$urls   = @('/', '/libros', '/autores', '/editores', '/traductores')
$fallos = @()

foreach ($u in $urls) {
    try {
        $r     = Invoke-WebRequest -Uri ($base + $u) -UseBasicParsing -TimeoutSec 20
        $html  = [string]$r.Content
        $estado = [int]$r.StatusCode
        $p = @()

        if ($estado -ne 200) { $p += "HTTP $estado" }
        if (-not $html.Contains('<nav')) { $p += 'SIN NAVBAR' }

        foreach ($t in @('Inicio','Libros','Autores','Editores','Traductores',
                          'Biblioteca Virtual','Instituto Tecnol')) {
            if (-not $html.Contains($t)) { $p += "falta texto '$t'" }
        }

        # los enlaces de la nav deben apuntar a este mismo servidor
        foreach ($ruta in @('', '/libros', '/autores', '/editores', '/traductores')) {
            $needle = 'href="' + $base + $ruta + '"'
            if (-not $html.Contains($needle)) { $p += "falta $needle" }
        }

        # bootstrap local, sin CDN ni Vite
        if (-not $html.Contains('/bootstrap.min.css')) { $p += 'sin bootstrap.min.css' }
        if ($html.Contains('cdn.jsdelivr') -or $html.Contains('cdnjs.cloudflare')
            -or $html.Contains('@vite') -or $html.Contains('unpkg.com')) {
            $p += 'referencia CDN o Vite'
        }

        if ($u -eq '/') {
            foreach ($t in @('Libros disponibles','Ver libros')) {
                if (-not $html.Contains($t)) { $p += "falta '$t'" }
            }
        }

        $marca = if ($p.Count -eq 0) { 'OK' } else { 'FALLO >>> ' + ($p -join ' | ') }
        Write-Host ("{0,-14} {1}  {2}" -f $u, $estado, $marca)
        if ($p.Count -gt 0) { $fallos += $u }
    }
    catch {
        Write-Host ("{0,-14} ERROR {1}" -f $u, $_.Exception.Message)
        $fallos += $u
    }
}

Write-Host ""
if ($fallos.Count -eq 0) { Write-Host "TODO OK en $base" }
else                     { Write-Host ("FALLOS: " + ($fallos -join ', ')) }

# Detener el servidor solo si lo iniciamos nosotros
if ($srv) {
    Start-Sleep -Seconds 1
    $hijos = Get-CimInstance Win32_Process -Filter "ParentProcessId = $($srv.Id)" |
             Select-Object -ExpandProperty ProcessId
    foreach ($p in $hijos) { try { Stop-Process -Id $p -Force -ErrorAction SilentlyContinue } catch {} }
    try { Stop-Process -Id $srv.Id -Force -ErrorAction SilentlyContinue } catch {}
    Write-Host "Servidor detenido."
}

if ($fallos.Count -gt 0) { exit 1 }
