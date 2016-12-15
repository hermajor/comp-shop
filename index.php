<?php
//session_start();

//коннект к БД
include("database/db_connect.php");

$result = $con->query("SELECT * FROM comp_shop.motherboard");


while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { //Выбирает одну строку из результирующего набора и помещает ее в ассоциативный массив, обычный массив или в оба
//используя этот цикл мы по очереди получаем доступ к каждой выбранной записи. Она находится в $row
    
    $motherboard[] = $row;//['model']; //сейчас содержит массив массивов (модель, цена) model, price
}

$result2 = $con->query("SELECT * FROM comp_shop.video_card");
while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
    $video_card[] = $row2;
}
$result3 = $con->query("SELECT * FROM comp_shop.ram");
while ($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
    $ram[] = $row3;
}
$result4 = $con->query("SELECT * FROM comp_shop.hd");
while ($row4 = mysqli_fetch_array($result4, MYSQLI_ASSOC)) {
    $hd[] = $row4;
}

$emptyValue = [0, '-', 0, 0, 0, 0, 0, 0];//массив который будем подставлять в форму по умолчанию(при пустых значениях)
$emptyValueStr = implode(",", $emptyValue);
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
        <h4>Эта форма просто покажет результат</h4>
        <form action="result.php" method="POST">
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

            <br><br><input name="button1" type="submit" value="Оформить заказ">
        </form>
    </div>

<!--*******************************************************************************************************************-->

    <div class="form form_bd">
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

    <?php echo "<br><br><a href='show_results.php?page=1'>ПОСМОТРЕТЬ ВСЕ ЗАКАЗЫ ИЗ БД</a> <br>";?>

</body>
</html>
