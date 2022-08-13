<?php
$conn = new mysqli("localhost", "root", "", "demo");
if ($conn->connect_error) {die("Ошибка: невозможно подключиться: " . $conn->connect_error);}
$conn->set_charset("utf8mb4");

//если нажата кнопка show
if (isset($_POST["show"])){
    //то находим в отправляемом массиве $_POST идентификатор выбранной категории
    $cat_id = $_POST["select_cat"];

    //и находим описание данной категории
    $sql = "SELECT `description` FROM cats WHERE ID='$cat_id'";
    $description_raw = $conn->query($sql) or die("Fehler in der query ".$conn->error."<br>".$sql);

    //если оно конечно существует
    if ($result = $description_raw->fetch_object()){
        $desc = $result->description; 
    }
}

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


echo "<form method='post'>";
echo "<select name='select_cat'>";
while($сat = $cats->fetch_object()){
    echo "<option value='$сat->id'>$сat->name</option>";
}

//добавляем кнопку
echo "<input type='submit' name='show'>";

echo "</select></form>";

//там выше в самом началале страницы мы находили описание
//если оно существует и чему-нибудь равно, то выводим его

if (isset($desc) && $desc){
    echo "<div>$desc</div>";
}