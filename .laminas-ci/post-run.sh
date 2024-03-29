#!/usr/bin/env bash

# $1 = Exit Status of Job
# $2 = User
# $3 = WorkDir
# $4 = The JOB Json String

#JOB=$4
#PHP_VERSION=$(echo "${JOB}" | jq -r '.php')
if [[ -f ./coverage.xml ]]; then
    vendor/bin/ocular code-coverage:upload --repository=g/alexz707/InvoiceNinjaModule --format=php-clover ./coverage.xml
fi

