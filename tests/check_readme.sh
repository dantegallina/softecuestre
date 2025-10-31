#!/usr/bin/env bash
set -euo pipefail

PROJECT_ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")"/.. && pwd)"
cd "$PROJECT_ROOT"

TARGET_FILE="README.md"

if [[ ! -f "$TARGET_FILE" ]]; then
  echo "ERROR: $TARGET_FILE no existe en el repositorio." >&2
  exit 1
fi

if [[ ! -s "$TARGET_FILE" ]]; then
  echo "ERROR: $TARGET_FILE está vacío." >&2
  exit 1
fi

echo "Prueba superada: $TARGET_FILE existe y contiene contenido." 
