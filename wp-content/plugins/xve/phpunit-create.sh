#!/bin/bash

function create_test
{
	echo "Creating skeleton class for $1"
	phpunit --skeleton-test $1
	mv classes/${1}Test.php tests
}

mkdir -p tests
create_test XVE_URL_Toolkit

exit 0

