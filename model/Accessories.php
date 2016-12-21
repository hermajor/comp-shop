<?php

class Model
{

    protected $connection;
    public function __construct($connection)
    {
        $this->connection = $connection;
    }

}

class Accessories extends Model
{
    
    function getAccessories($type)
    {
        $result = $this->connection->query("SELECT * FROM comp_shop.$type");
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
            $accessories[] = $row;
        }
        return $accessories;
    }

    function getResultsFromBD($start, $end)
    {
        $result = $this->connection->query("SELECT * FROM comp_shop.order_list ORDER BY id DESC LIMIT $start, $end");
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
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

        $motherboard2 = explode(",", $_POST['motherboard']);//разбиваем строку по запятой и записываем кусочки в массив $motherboard2
        $video_card2 = explode(",", $_POST['video_card']);
        $ram2 = explode(",", $_POST['ram']);
        $hd2 = explode(",", $_POST['hd']);

        $sum = $motherboard2[2]+$video_card2[2]+$ram2[2]+$hd2[2];//сумма заказа

        $result = $this->connection->prepare("INSERT comp_shop.order_list (motherboard, video_card, ram, hd, total) VALUES (?, ?, ?, ?, ?)");
        $result->bind_param("sssss", $motherboard2[1], $video_card2[1], $ram2[1], $hd2[1], $sum);
        $result->execute();
        $result->close();

        $table = [$motherboard2[1], $video_card2[1], $ram2[1], $hd2[1], $sum];

        return $table;
    }
    
}