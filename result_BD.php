<?php
include("database/BDinfo.php");

spl_autoload_register(function($class){
    include_once('model/'.$class.'.php');
});

$sumId = array_sum($_POST); //суммирует первые цифры элементов. В данном случае это id из БД
//если форма пуста, то все первые значения = 0

if (!isset($_POST['button']) || ($sumId <= 0)) {
    echo "Комплектующие не выбраны <br>";
    echo "<br><a href='index.php'>Вернуться к выбору компонентов</a>";
}else {
    $accessories = new Accessories($host, $login, $password, $db);
    $currentOrderTable = $accessories->insertInBd();
    if (!$currentOrderTable) {
        echo "Попытка ввода некорректных данных!";
        echo "<br><a href='index.php'>Вернуться к выбору компонентов</a>";
    }else{
        echo '<br>Заказ добавлен в базу данных<br>';
        echo "<br><a href='index.php'>Вернуться к выбору компонентов</a>";
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
                <td><?php echo $currentOrderTable[0]; ?></td>
                <td><?php echo $currentOrderTable[1]; ?></td>
                <td><?php echo $currentOrderTable[2]; ?></td>
                <td><?php echo $currentOrderTable[3]; ?></td>
                <td><?php echo $currentOrderTable[4]; ?></td>
            </tr>
        </table>

        </body>
        </html>
        <?php
    }
}
?>