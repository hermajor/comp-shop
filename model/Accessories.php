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
        $motherboard = htmlentities($_POST['motherboard'], ENT_QUOTES);
        $video_card = htmlentities($_POST['video_card'], ENT_QUOTES);
        $ram = htmlentities($_POST['ram'], ENT_QUOTES);
        $hd = htmlentities($_POST['hd'], ENT_QUOTES);

        if (is_numeric($motherboard) && is_numeric($video_card) && is_numeric($ram) && is_numeric($hd)) {
            $result = $this->connection->query("SELECT * FROM comp_shop.motherboard WHERE id = $motherboard");
            $motherboard = $result->fetch_assoc();

            $result = $this->connection->query("SELECT * FROM comp_shop.video_card WHERE id = $video_card");
            $video_card = $result->fetch_assoc();

            $result = $this->connection->query("SELECT * FROM comp_shop.ram WHERE id = $ram");
            $ram = $result->fetch_assoc();

            $result = $this->connection->query("SELECT * FROM comp_shop.hd WHERE id = $hd");
            $hd = $result->fetch_assoc();

            if (isset($motherboard, $video_card, $ram, $hd)) {

                $sum = ($motherboard['price'] + $video_card['price'] + $ram['price'] + $hd['price']);
                $table = [$motherboard['model'], $video_card['model'], $ram['model'], $hd['model'], $sum];

            $result = $this->connection->prepare("INSERT comp_shop.order_list (motherboard, video_card, ram, hd, total) VALUES (?, ?, ?, ?, ?)");
            $result->bind_param("ssssi", $motherboard['model'], $video_card['model'], $ram['model'], $hd['model'], $sum);
            $result->execute();
            $result->close();

                return $table;
            } else {
                return false;//число, но значение не верное. Меньше 0 или больше кол-ва строк в таблице(БД)
            }
        } else {
            return false;//post не число
        }
    }

}