@REM Install Windows Subsystem for Linux Version 2 using Ubuntu, Docker,
@REM Visual Studio Code, and NodeJS on Windows.
@REM You may need to run this file in a terminal with admin permissions.
@REM
@REM Usage:
@REM   install-windows.bat

@ECHO OFF

ECHO Installing NodeJS LTS for Windows
call winget install -e --id OpenJS.NodeJS.LTS
