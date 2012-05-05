"c:\xampp\mysql\bin\mysqladmin.exe" --user=root --force --password= drop ajentities
"c:\xampp\mysql\bin\mysqladmin.exe" --user=root --password= create ajentities
"c:\xampp\mysql\bin\mysql" --user=root --password= ajentities  < %~dp0sql\ajentities.sql
