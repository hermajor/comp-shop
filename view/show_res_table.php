<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Список заказов</title>
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <table>
        <caption>Список заказов</caption>
        <tr>
            <th>Номер заказа</th>
            <th>Материнская плата</th>
            <th>Видеокарта</th>
            <th>Оперативная память</th>
            <th>Жесткий диск</th>
            <th>Сумма заказа, $</th>
            <th>Дата</th>
        </tr>
    <?php
        for ($i = $start; $i < $end; $i++) {
        if ($i == $num_posts) {
        break;
        }
        $result->data_seek($i);//Перемещает указатель результата на выбранную строку
        $row = $result->fetch_row(); //Получение строки результирующей таблицы в виде массива
    ?>
            <tr class="elements">
                <td><?php echo $row[0];?></td>
                <td><?php echo $row[1];?></td>
                <td><?php echo $row[2];?></td>
                <td><?php echo $row[3];?></td>
                <td><?php echo $row[4];?></td>
                <td><?php echo $row[5];?></td>
                <td><?php echo $row[6];?></td>
            </tr>
    <?php
        }
     ?>
    </table>
</body>
</html>