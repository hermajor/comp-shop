<?php
//коннект к БД
include("database/db_connect.php");
include ("model/Accessories.php");

$accessories = new Accessories($connection);

$motherboard = $accessories->getAccessories('motherboard');
$video_card = $accessories->getAccessories('video_card');
$ram = $accessories->getAccessories('ram');
$hd = $accessories->getAccessories('hd');

$emptyValueStr = '0, -, 0, 0, 0, 0, 0, 0';//строка-"массив" который будем подставлять в форму по умолчанию(при пустых значениях)
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
                <option value='<?php echo $emptyValueStr; ?>' selected>-</option>
                <?php
                foreach ($motherboard as $mod){
                    $arraystr = implode(",", $mod);//записываем массив в строку - элементы разделены запятой ","
                    echo "<option value='" . $arraystr . "'>" . $mod['model'] . "</option>";//value формы может передавать только строки
                }
                ?>
            </select><br><br>

            Видео карта:
            <select size="1" name="video_card">
                <option value='<?php echo $emptyValueStr; ?>' selected>-</option>
                <?php
                foreach ($video_card as $mod){
                    $arraystr = implode(",", $mod);
                    echo "<option value='" . $arraystr . "'>" . $mod['model'] . "</option>";
                }
                ?>
            </select><br><br>

            Оперативная память:
            <select size="1" name="ram">
                <option value='<?php echo $emptyValueStr; ?>' selected>-</option>
                <?php
                foreach ($ram as $mod){
                    $arraystr = implode(",", $mod);
                    echo "<option value='" . $arraystr . "'>" . $mod['model'] . "</option>";
                }
                ?>
            </select><br><br>

            Жесткий диск:
            <select size="1" name="hd">
                <option value='<?php echo $emptyValueStr; ?>' selected>-</option>
                <?php
                foreach ($hd as $mod){
                    $arraystr = implode(",", $mod);
                    echo "<option value='" . $arraystr . "'>" . $mod['model'] . "</option>";
                }
                ?>
            </select><br><br>

            <br><br><input name="button2" type="submit" value="Оформить заказ и занести в БД">
        </form>
    </div>

    <?php echo "<br><br><a href='show_results.php'>ПОСМОТРЕТЬ ВСЕ ЗАКАЗЫ ИЗ БД</a> <br>";?>
</body>
</html>
