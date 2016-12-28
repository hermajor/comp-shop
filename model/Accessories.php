<?php

class Model
{

    protected $connection;
    public function __construct($host, $login, $password, $db)
    {
        $this->connection = new mysqli($host, $login, $password, $db);
        $this->connection->query("SET NAMES 'utf8'");
        if ($this->connection->connect_error) {
            die('Ошибка подключения (' . $this->connection->connect_errno . ') '
                . $this->connection->connect_error);
        }
    }

}

class Accessories extends Model
{

    function getAccessories($type)
    {
        $accessories = [];
        $result = $this->connection->query("SELECT * FROM comp_shop.$type");
        while ($row = $result->fetch_assoc()) {
            $accessories[] = $row;
        }
        return $accessories;
    }

    function getResultsFromBD($start, $end)
    {
        $accessoriesShow = [];
        $result = $this->connection->query("SELECT * FROM comp_shop.order_list ORDER BY id DESC LIMIT $start, $end");
        while ($row = $result->fetch_assoc()) {
            $accessoriesShow[] = $row;
        }
        return $accessoriesShow;
    }

    function getNumberPostsFromBD()
    {
        $result = $this->connection->query("SELECT * FROM comp_shop.order_list");
        $num_posts = $result->num_rows;
        return $num_posts;
    }

    function insertInBd()
    {
        $motherboard = explode("|", htmlentities($_POST['motherboard'], ENT_QUOTES));
        $video_card = explode("|", htmlentities($_POST['video_card'], ENT_QUOTES));
        $ram = explode("|", htmlentities($_POST['ram'], ENT_QUOTES));
        $hd = explode("|", htmlentities($_POST['hd'], ENT_QUOTES));

        if ((isset($motherboard[1], $video_card[1], $ram[1], $hd[1], $motherboard[2], $video_card[2], $ram[2], $hd[2])) && (is_numeric($motherboard[2]) && is_numeric($video_card[2]) && is_numeric($ram[2]) && is_numeric($hd[2]))) {

            $sum = $motherboard[2] + $video_card[2] + $ram[2] + $hd[2];

//            $result = $this->connection->prepare("INSERT comp_shop.order_list (motherboard, video_card, ram, hd, total) VALUES (?, ?, ?, ?, ?)");
//            $result->bind_param("ssssi", $motherboard[1], $video_card[1], $ram[1], $hd[1], $sum);
//            $result->execute();
//            $result->close();

            $table = [$motherboard[1], $video_card[1], $ram[1], $hd[1], $sum];

            return $table;
        } else {
            return false;
        }
    }

//--Второй вариант
//    function insertInBd()
//    {
////        1. Передаем в $_POST только id
////        2. Проверяем его на integer, htmlspecialchars, filter_input и т.д.
////        3. Создаем запрос к БД на поиск нужного компонента в нужной таблице
////        4. Получаем массив "чистых" данных из БД и уже работаем с ними
////        5. Повторяем для каждого компонента (4 раза)
////
////        6. Для записи в БД используем подготовленный запрос всё равно
////        6.5 Так же весь этот метод стоит вынести в отдельный класс
////
////    Не знаю что лучше: передать небольшие строки из формы и всячески их проверять, либо делать еще +4 запроса к БД
////    Первый вариант выглядит компактнее и менее затратным по ресурсам, второй более надежным.
//    }

}