<?php
//session_start();
if (!isset($_POST['button1'])) {
    echo "Комплектующие не выбраны <br>";
    echo "<br><br><a href='index.php'>Вернуться к выбору компонентов</a>";
}else {

    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    $motherboard2 = explode(",", $_POST['motherboard']);//разбиваем строку по запятой и записываем кусочки в массив $motherboard2
    $video_card2 = explode(",", $_POST['video_card']);
    $ram2 = explode(",", $_POST['ram']);
    $hd2 = explode(",", $_POST['hd']);
    
    echo "<br><br><a href='index.php'>Вернуться к выбору компонентов</a>";
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>comp-shop</title>
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

    <table cellspacing="0">
        <caption>Ваш заказ</caption>
        <tr>
            <th>Материнская плата</th>
            <th>Видеокарта</th>
            <th>Оперативная память</th>
            <th>Жесткий диск</th>
            <th>Сумма заказа</th>
        </tr>
        <tr class="elements">
            <td><?php echo $motherboard2[1];?></td>
            <td><?php echo $video_card2[1];?></td>
            <td><?php echo $ram2[1];?></td>
            <td><?php echo $hd2[1];?></td>
            <td><?php echo ($motherboard2[2]+$video_card2[2]+$ram2[2]+$hd2[2]);?></td>
        </tr>
    </table>

</body>
</html>
<?php
}
?>

