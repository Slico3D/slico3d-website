param([switch]$NoBrowser)
$ErrorActionPreference = 'Stop'
Set-Location $PSScriptRoot

if (-not (Get-Command docker -ErrorAction SilentlyContinue)) {
    throw 'Zainstaluj Docker Desktop: https://docs.docker.com/desktop/setup/install/windows-install/'
}
docker info *> $null
if ($LASTEXITCODE -ne 0) { throw 'Uruchom Docker Desktop i poczekaj, az bedzie gotowy.' }
docker compose version *> $null
if ($LASTEXITCODE -ne 0) { throw 'Potrzebny jest Docker Compose v2, zawarty w Docker Desktop.' }

function New-LocalSecret {
    $bytes = New-Object byte[] 24
    $rng = [System.Security.Cryptography.RandomNumberGenerator]::Create()
    try { $rng.GetBytes($bytes) } finally { $rng.Dispose() }
    return ([BitConverter]::ToString($bytes)).Replace('-', '').ToLowerInvariant()
}

if (-not (Test-Path '.env')) {
    $settings = @(
        'SHOP_PORT=8080', 'MAIL_PORT=8025',
        "DB_PASSWORD=$(New-LocalSecret)",
        "DB_ROOT_PASSWORD=$(New-LocalSecret)",
        'LOCAL_ADMIN_USER=slico_admin',
        "LOCAL_ADMIN_PASSWORD=$(New-LocalSecret)",
        'LOCAL_ADMIN_EMAIL=admin@example.invalid'
    )
    [IO.File]::WriteAllLines((Join-Path $PSScriptRoot '.env'), $settings, (New-Object Text.UTF8Encoding($false)))
    Write-Host 'Utworzono prywatne ustawienia lokalne w .env.'
}

docker compose config --quiet
if ($LASTEXITCODE -ne 0) { throw 'Konfiguracja jest niepoprawna. Sprawdz .env.' }
docker compose up -d db wordpress mailpit
if ($LASTEXITCODE -ne 0) { throw 'Nie udalo sie uruchomic srodowiska.' }
docker compose run --rm wpcli
if ($LASTEXITCODE -ne 0) { throw 'Instalacja sklepu nie powiodla sie. Mozesz ponownie uruchomic start.ps1.' }

$portLine = Get-Content '.env' | Where-Object { $_ -match '^SHOP_PORT=' } | Select-Object -First 1
$port = if ($portLine) { ($portLine -split '=', 2)[1] } else { '8080' }
$url = "http://localhost:$port"
Write-Host "Sklep: $url"
Write-Host "Panel: $url/wp-admin/"
Write-Host 'Login i haslo znajdziesz w lokalnym pliku .env (LOCAL_ADMIN_USER / LOCAL_ADMIN_PASSWORD).'
if (-not $NoBrowser) { Start-Process $url }
