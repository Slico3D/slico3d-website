$ErrorActionPreference = 'Stop'
Set-Location $PSScriptRoot
$backupDir = Join-Path (Join-Path $PSScriptRoot 'backups') (Get-Date -Format 'yyyyMMdd-HHmmss')
New-Item -ItemType Directory -Path $backupDir -Force | Out-Null
$mount = "${backupDir}:/backup"
docker compose run --rm --user '0:0' --volume $mount --entrypoint sh wpcli -c 'wp db export /backup/database.sql --allow-root && if [ -d wp-content/uploads ]; then tar -czf /backup/uploads.tar.gz -C wp-content uploads; fi && wp plugin list --format=json --allow-root > /backup/plugins.json && wp core version --allow-root > /backup/wordpress-version.txt'
if ($LASTEXITCODE -ne 0) { throw 'Kopia nie zostala ukonczona. Sprawdz komunikat powyzej.' }
Write-Host "Kopia bazy i mediow: $backupDir"
Write-Host 'Kod motywu jest w GitHubie. Plik .env zachowaj osobno w prywatnym, bezpiecznym miejscu.'
