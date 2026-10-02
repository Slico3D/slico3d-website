$ErrorActionPreference = 'Stop'
Set-Location $PSScriptRoot
docker compose stop
if ($LASTEXITCODE -ne 0) { throw 'Nie udalo sie zatrzymac srodowiska.' }
Write-Host 'Sklep zatrzymany. Baza i pliki pozostaja na komputerze.'
