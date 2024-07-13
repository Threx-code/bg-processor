#!/usr/bin/env bash

DIR=$(dirname $0)

. "$DIR"/helpers.sh

log "Pulling project CVEListV5 upstream repository..."

REPO_CVELIST_V5=git@github.com:Threx-code/cvelistV5.git # This is the forked repository
UPSTREAM_CVELIST_V5=git@github.com:CVEProject/cvelistV5.git # This is the original repository

DIR_REPO_CVELIST_V5=./vendor/cyberrest/cvelistV5

if [ -d "$DIR_REPO_CVELIST_V5" ]; then
    cd "$DIR_REPO_CVELIST_V5" || exit
    git remote -v
    git remote add upstream $UPSTREAM_CVELIST_V5
    git remote -v
    git fetch upstream
    git checkout main
    git merge upstream/main --allow-unrelated-histories
    git push origin main
else
    log "$DIR_REPO_CVELIST_V5 does not exist"
fi
