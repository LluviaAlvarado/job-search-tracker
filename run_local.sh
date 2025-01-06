#!/bin/bash

set -e
set -x

echo "Building Application"

echo "Running Backend"
composer run dev

echo "Running Frontend"
npm run dev

echo "Application Running Localy!"