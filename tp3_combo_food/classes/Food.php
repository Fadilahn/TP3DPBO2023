<?php

class Food extends DB
{
    // Mengambil semua data food
    function getFood()
    {
        $query = "SELECT * FROM food";
        return $this->execute($query);
    }

    // Mengambil data food berdasarkan ID
    function getFoodById($id)
    {
        $query = "SELECT * FROM food WHERE food_id=$id";
        return $this->execute($query);
    }

    // Mencari data berdasarkan parameter
    function search($keyword)
    {
        $query = "SELECT * FROM food WHERE food_name LIKE '%".$keyword."%'";
        return $this->execute($query);
    }

    // Mengurutkan berdasarkan yang di klik
    function sortBy($sort)
    {
        $query = "SELECT * FROM food ORDER BY food_$sort";
        return $this->execute($query);
    }

    // Menambahkan data food baru
    function addFood($data)
    {
        $foodName = $data['name'];
        $query = "INSERT INTO food (food_name) VALUES ('$foodName')";
        return $this->executeAffected($query);
    }

    // Memperbarui data food berdasarkan ID
    function updateFood($id, $data)
    {
        $foodName = $data['name'];
        $query = "UPDATE food SET food_name='$foodName' WHERE food_id=$id";
        return $this->executeAffected($query);
    }

    // Menghapus data food berdasarkan ID
    function deleteFood($id)
    {
        $query = "DELETE FROM food WHERE food_id=$id";
        return $this->executeAffected($query);
    }
}