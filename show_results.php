<?php
include("database/BDinfo.php");

spl_autoload_register(function($class){
    include_once('model/'.$class.'.php');
});

$accessories = new Accessories($host, $login, $password, $db);

$max_posts = 4;//кол-во записей на странице

    if ($accessories->getNumberPostsFromBD() != 0) { //Смотрим $result->num_rows
        $num_posts = $accessories->getNumberPostsFromBD();//записываем кол-во всех строк из БД по num_rows
        $num_pages = ceil($num_posts / $max_posts);

        if (isset($_GET['page']) && is_numeric($_GET['page'])) { // is_numeric - Проверяет, является ли переменная числом или строкой, содержащей число
            $get_page = htmlentities($_GET['page'], ENT_QUOTES);
            if ($get_page > 0 && $get_page <= $num_pages) {
                $start = ($get_page - 1) * $max_posts;
            } else {
                $start = 0;
                $get_page = 1;
            }
        } else {
            $start = 0;
            $get_page = 1;
        }

//Пагинация
        echo "<div class='pagination'>";

        //ссылка на первую страницу
        if ($get_page >= 4) {
            echo "<a href='show_results.php?page=1'>1</a> ... ";
        }
        //основная пагинация
        for ($i = $get_page - 2; $i <= $get_page + 2; $i++) {
            if (($i < 1) || ($i > $num_pages)) {
                echo "";
            } elseif ($get_page == $i) {
                echo "<a href='show_results.php?page=$i'>[$i]</a> ";
            } else {
                echo "<a href='show_results.php?page=$i'>$i</a> ";
            }
        }
        //ссылка на последнюю страницу
        if (!(($num_pages - 2) <= $get_page)) {
            echo " ... <a href='show_results.php?page=$num_pages'>$num_pages</a>";
        }
        echo "</div>";

//Выводим записи из БД и строим таблицу
?>
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
    $tableAll = $accessories->getResultsFromBD($start, $max_posts);
    foreach ($tableAll as $res):
?>
            <tr class="elements">
                <td><?php echo $res['id'];?></td>
                <td><?php echo $res['motherboard'];?></td>
                <td><?php echo $res['video_card'];?></td>
                <td><?php echo $res['ram'];?></td>
                <td><?php echo $res['hd'];?></td>
                <td><?php echo $res['total'];?></td>
                <td><?php echo $res['date'];?></td>
            </tr>
<?php
    endforeach;
?>
</table>
</body>
</html>
<?php
        echo "<br><a href='index.php'>На главную</a> <br>";
    } else {
        echo "Нет данных для отображения(Таблица в БД пуста)";
    }