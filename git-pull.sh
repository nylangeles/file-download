#!/bin/bash
# echo "Script executed from: ${PWD}"

BASEDIR=$(dirname $0)
# echo "Script location: ${BASEDIR}"

cd ${BASEDIR}

git pull origin main