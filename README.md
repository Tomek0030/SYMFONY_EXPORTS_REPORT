# SYMFONY_EXPORTS_REPORT

Aplikacja wyświetla raport wykonanych eksportów.

Baza: PostgreSql</br>
Symfony: wersja 6.1</br>
PHP: wersja 8.1</br>
Dostęp do bazy danych – Doctrine.<br/>
Raport filtruje dane wg zakresu dat i lokalu<br/>

Skrypt do przebudowy bazy ./tests.sh tests -db</br>
#!/bin/bash</br></br>
if [ "$2" == "-db" ]</br>
then</br>
echo "rebuilding database ..."</br>
php bin/console doctrine:schema:drop -n -q --force --full-database</br>
rm migrations/*.php</br>
php bin/console make:migration</br>
php bin/console doctrine:migrations:migrate -n -q</br>
php bin/console doctrine:fixtures:load -n -q</br>
fi</br>
</br>
if [ -n "$1" ]</br>
then</br>
./bin/phpunit $1</br>
else</br>
./bin/phpunit</br>
fi</br>


![image](https://user-images.githubusercontent.com/88075057/181354549-e174d8ff-5fdf-4299-bc4d-0cb9876de89e.png)

![image](https://user-images.githubusercontent.com/88075057/181354786-f4d7dc67-a3d2-420b-956b-cbb9a5d82832.png)
