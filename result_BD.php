<?php
//session_start();
//коннект к БД
include("database/db_connect.php");

$sumId = array_sum($_POST); //суммирует первые цифры элементов. В данном случае это id из БД
//если форма пуста, то все первые значения = 0

if (!isset($_POST['button2']) || ($sumId <= 0)) {
    echo "Комплектующие не выбраны <br>";
    echo "<br><br><a href='index.php'>Вернуться к выбору компонентов</a>";
}else {
    $motherboard2 = explode(",", $_POST['motherboard']);//разбиваем строку по запятой и записываем кусочки в массив $motherboard2
    $video_card2 = explode(",", $_POST['video_card']);
    $ram2 = explode(",", $_POST['ram']);
    $hd2 = explode(",", $_POST['hd']);

    $sum = $motherboard2[2]+$video_card2[2]+$ram2[2]+$hd2[2];//сумма заказа
    
    $result = $con->prepare("INSERT comp_shop.order_list (motherboard, video_card, ram, hd, total) VALUES (?, ?, ?, ?, ?)");
    $result->bind_param("sssss", $motherboard2[1], $video_card2[1], $ram2[1], $hd2[1], $sum);
    $result->execute();
    $result->close();

    echo '<br>Заказ добавлен в базу данных<br>';
    
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
            <th>Сумма заказа, $</th>
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