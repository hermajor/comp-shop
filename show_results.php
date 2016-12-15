<?php
//session_start();
//коннект к БД
include("database/db_connect.php");

$max_posts = 5;//кол-во записей на странице

$test1 = 'DESC';
$test2 = 'ASC';

if($result = $con->query("SELECT * FROM comp_shop.order_list ORDER BY date $test1")) {
    if ($result->num_rows != 0) { //если выбранный массив не пустой. Кол-во строк не равно 0
        $num_posts = $result->num_rows;//записываем кол-во строк из БД
        $num_pages = ceil($num_posts / $max_posts);

        if (isset($_GET['page']) && is_numeric($_GET['page'])) { // is_numeric - Проверяет, является ли переменная числом или строкой, содержащей число
            $get_page = $_GET['page'];
            if ($get_page > 0 && $get_page <= $num_pages) {
                $start = ($get_page - 1) * $max_posts;
                $end = $start + $max_posts;
            } else {
                $start = 0;
                $end = $max_posts;
                $get_page = 1;
            }
        } else {
            $start = 0;
            $end = $max_posts;
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

//Выводим записи из БД
        include("view/show_res_table.php");
        echo "<br><a href='index.php'>На главную</a> <br>";
        
    } else {
        echo "Нет данныз для отображения(Таблица в БД пуста)";
    }
} else {
    echo "Error: " . $mysqli->error;//если возникли проблемы с подключением
}