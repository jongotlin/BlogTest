#!/usr/bin/env bash

# exit when any command fails
set -e

ENV="dev"
FIXTURES="tests"

function usage()
{
cat << EOF
OPTIONS:
   -h      Show this message
   -t      Deploy test environment
   -p      Deploy prod environment
EOF
}

while getopts ":thpd" OPTION; do
    case $OPTION in
        t)
            ENV="test"
            ;;
        p)
            ENV="prod"
            ;;
        h)
            usage
            exit 1
            ;;
     esac
done

rm -rf var/cache/$ENV/*

echo "Build env is $ENV"

php bin/console cache:warm --env=$ENV
php bin/console doctrine:database:drop --force --if-exists --env=$ENV
php bin/console doctrine:database:create --env=$ENV
php bin/console doctrine:schema:update --force --env=$ENV
php bin/console doctrine:fixtures:load --no-interaction --env=$ENV
