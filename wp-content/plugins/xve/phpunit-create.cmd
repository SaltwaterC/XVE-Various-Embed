@echo off
cls

md tests
call:create_test XVE_URL_Toolkit

pause
exit

:create_test
	echo Creating skeleton class for %~1
	call phpunit --skeleton-test %~1
	move classes\%~1Test.php tests
goto:eof
