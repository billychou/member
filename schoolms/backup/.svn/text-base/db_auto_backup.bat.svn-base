@echo off 
set NAME=dailybackup 
set TIME=20:01:00 
set DAY=MON,TUE,WED,THU,FRI,SAT,SUN 
set COMMAND=php\php.exe htdocs\www\backup\db_auto_backup.php 
%SystemDrive% cd %windir%\tasks\ if exist %NAME%.job del %NAME%.job  
schtasks /create /tn %NAME% /tr "%COMMAND%" /sc weekly /d %DAY% /st %TIME% /ru system
pause