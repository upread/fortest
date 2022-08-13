<?php
$conn = new mysqli("localhost", "root", "", "demo");
if ($conn->connect_error) {die("Ошибка: невозможно подключиться: " . $conn->connect_error);}
$conn->set_charset("utf8mb4");
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Категории</title>
</head>
<body>
    <h1>Категории</h1>
<?php
$sql = "SELECT * FROM cats ORDER BY name ASC";
$cats = $conn->query($sql) or die("Fehler in der query ".$conn->error."<br>".$sql);

//добавляем форму для отправки данных на сервер
//метод отправки - POST
echo "<form method='post'>";

//а здесь у нас будет выпадающий список
//обратите внимение на имя списка - select_cat - оно нам пригодится, чтобы не спрашивали, откуда оно взялось
echo "<select name='select_cat'>";
while($сat = $cats->fetch_object()){
    //здесь в списке название
    //а в значение (value) кладем идентификатор категории
    echo "<option value='$сat->id'>$сat->name</option>";
}

echo "</select></form>";