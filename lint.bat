@echo off
echo Rodando verificacao de codigo...

C:\xampp\php\php.exe -l index.php
C:\xampp\php\php.exe -l login.php
C:\xampp\php\php.exe -l logout.php

C:\xampp\php\php.exe -l src\conexao.php
C:\xampp\php\php.exe -l src\inserir.php
C:\xampp\php\php.exe -l src\editar.php
C:\xampp\php\php.exe -l src\excluir.php

echo.
echo Verificacao finalizada!
pause