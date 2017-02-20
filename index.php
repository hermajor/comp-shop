<?php
//namespace PHP_TASK;
include "PHP_TASK/ErrorHandler.php";

(new PHP_TASK\ErrorHandler())->register();
//foo();
//echo $var;

/*
include("database/BDinfo.php");

spl_autoload_register(function($class){
    include_once('model/'.$class.'.php');
});

$accessories = new Accessories($host, $login, $password, $db);

$motherboard = $accessories->getAccessories('motherboard');
$video_card = $accessories->getAccessories('video_card');
$ram = $accessories->getAccessories('ram');
$hd = $accessories->getAccessories('hd');
//В каждой таблице БД есть нулевая строка со значениями id = 0, name = '-', price = 0 и т.д. = '-'
?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>comp-shop</title>
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <div class="form">
        <form action="result_BD.php" method="POST">
            <h4>Эта форма покажет результат и запишет в БД</h4>
            Материнская плата:
            <select size="1" name="motherboard">
<!--                <option value='0' selected>-</option>-->
                <?php
                foreach ($motherboard as $key=>$mod){
                    echo "<option value='" . $mod['id'] . "'>" . $mod['model'] . "</option>";//value формы может передавать только строки
                }
                ?>
            </select><br><br>

            Видео карта:
            <select size="1" name="video_card">
                <?php
                foreach ($video_card as $mod){
                    echo "<option value='" . $mod['id'] . "'>" . $mod['model'] . "</option>";
                }
                ?>
            </select><br><br>

            Оперативная память:
            <select size="1" name="ram">
                <?php
                foreach ($ram as $mod){
                    echo "<option value='" . $mod['id'] . "'>" . $mod['model'] . "</option>";
                }
                ?>
            </select><br><br>

            Жесткий диск:
            <select size="1" name="hd">
                <?php
                foreach ($hd as $mod){
                    echo "<option value='" . $mod['id'] . "'>" . $mod['model'] . "</option>";
                }
                ?>
            </select><br><br>

            <br><input name="button" type="submit" value="Оформить заказ и занести в БД">
        </form>
    </div>

    <br><a href='show_results.php'>ПОСМОТРЕТЬ ВСЕ ЗАКАЗЫ ИЗ БД</a>
</body>
</html>
*/