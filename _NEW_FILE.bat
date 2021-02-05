@echo off
@echo Arguments that contain spaces spaces must me enclosed in "".

:promptowner
set /p Ow= Enter owner name (e.g. NPEU): 

if [%Ow%]==[] goto checkowner

:promptname
set /p Nm= Enter new file extension name (e.g. API): 

if [%Nm%]==[] goto checkname

:promptdesc
set /p Ds= Enter new file description (e.g. "Data API"):

if [%Ds%]==[] goto checkdesc

php -f _build-new-file/index.php owner=%Ow% name=%Nm% group=%Gp% description=%Ds%

pause
goto :eof


:checkowner
@echo You must enter an owner name
pause
goto :promptowner

:checkname
@echo You must enter a name
pause
goto :promptname

:checkdesc
@echo You must enter a description
pause
goto :promptdesc

