<?php
//коннект к БД
include("database/db_connect.php");
include ("model/Accessories.php");

$sumId = array_sum($_POST); //суммирует первые цифры элементов. В данном случае это id из БД
//если форма пуста, то все первые значения = 0

if (!isset($_POST['button2']) || ($sumId <= 0)) {
    echo "Комплектующие не выбраны <br>";
    echo "<br><br><a href='index.php'>Вернуться к выбору компонентов</a>";
}else {
    $accessories = new Accessories($connection);
    $table1 = $accessories->insertInBd();

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
            <td><?php echo $table1[0];?></td>
            <td><?php echo $table1[1];?></td>
            <td><?php echo $table1[2];?></td>
            <td><?php echo $table1[3];?></td>
            <td><?php echo $table1[4];?></td>
        </tr>
    </table>

    </body>
    </html>
    <?php
}
?>