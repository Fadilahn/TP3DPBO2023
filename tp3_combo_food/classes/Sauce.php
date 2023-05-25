<?php

class Sauce extends DB
{
    // Mengambil semua data sauce
    function getSauce()
    {
        $query = "SELECT * FROM sauce";
        return $this->execute($query);
    }

    // Mengambil data sauce berdasarkan ID
    function getSauceById($id)
    {
        $query = "SELECT * FROM sauce WHERE sauce_id=$id";
        return $this->execute($query);
    }

    // Mencari data berdasarkan parameter
    function search($keyword)
    {
        $query = "SELECT * FROM sauce WHERE sauce_name LIKE '%".$keyword."%'";
        return $this->execute($query);
    }

    // Mengurutkan berdasarkan yang di klik
    function sortBy($sort)
    {
        $query = "SELECT * FROM sauce ORDER BY sauce_$sort";
        return $this->execute($query);
    }

    // Menambahkan data sauce baru
    function addSauce($data)
    {
        $sauceName = $data['name'];
        $query = "INSERT INTO sauce (sauce_name) VALUES ('$sauceName')";
        return $this->executeAffected($query);
    }

    // Memperbarui data sauce berdasarkan ID
    function updateSauce($id, $data)
    {
        $sauceName = $data['name'];
        $query = "UPDATE sauce SET sauce_name='$sauceName' WHERE sauce_id=$id";
        return $this->executeAffected($query);
    }

    // Menghapus data sauce berdasarkan ID
    function deleteSauce($id)
    {
        $query = "DELETE FROM sauce WHERE sauce_id=$id";
        return $this->executeAffected($query);
    }
}