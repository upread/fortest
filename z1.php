<?php
//Подключение к базе данных (мы используем драйвер mysqli)
$conn = new mysqli("localhost", "root", "", "demo");
if ($conn->connect_error) {die("Ошибка: невозможно подключиться: " . $conn->connect_error);}
$conn->set_charset("utf8mb4");//Установка кодировки

//формируем запрос sql
//в нем мы выбираем все категории (все столбцы и строки) из таблицы cats
//в алфавитном порядке по названию по возрастанию
$sql = "SELECT * FROM cats ORDER BY name ASC";

//выполняем этот запрос
//если что-то не так, то скрипт выдаст ошибку и прекратит работу
$cats = $conn->query($sql) or die("Fehler in der query ".$conn->error."<br>".$sql);

//теперь в цикле мы проходим по всей выборке (результатам запроса)
//цикл while выполняется до тех пор, пока выражение в скобках не закончится
//то есть пока cat не станет равным ничему
while($сat = $cats->fetch_object()){
    //так как cat - это объект, то мы можем извлекать из него значения
    //в данном случае мы извлекаем имя категории
    //оператор echo сразу же печатает это значение
    echo "$сat->name <br />";
}