<?php

class Menu extends DB
{
    // Mengambil semua data menu dengan join food dan sauce
    function getMenuJoin()
    {
        $query = "SELECT * FROM menu JOIN food ON menu.food_id=food.food_id JOIN sauce ON menu.sauce_id=sauce.sauce_id ORDER BY menu.menu_id";
        return $this->execute($query);
    }

    // Mengambil semua data menu
    function getMenu()
    {
        $query = "SELECT * FROM menu";
        return $this->execute($query);
    }

    // Mengambil data menu berdasarkan ID
    function getMenuById($id)
    {
        $query = "SELECT * FROM menu JOIN food ON menu.food_id=food.food_id JOIN sauce ON menu.sauce_id=sauce.sauce_id WHERE menu_id=$id";
        return $this->execute($query);
    }

    // Mencari menu berdasarkan kata kunci pada nama menu, nama food, atau nama sauce
    function searchMenu($keyword)
    {
        $query = "SELECT * FROM menu JOIN food ON menu.food_id=food.food_id JOIN sauce ON menu.sauce_id=sauce.sauce_id WHERE 
        menu_name LIKE '%".$keyword."%'";
        return $this->execute($query);
    }

    // Mengurutkan menu berdasarkan nama menu
    function sortMenuBy($sort)
    {
        $query = "SELECT * FROM menu JOIN food ON menu.food_id=food.food_id JOIN sauce ON menu.sauce_id=sauce.sauce_id ORDER BY menu.menu_$sort";
        return $this->execute($query);
    }

    // Menambahkan data menu baru
    function addMenu($data, $file)
    {
        $tmp_file = $file['file_image']['tmp_name'];
        $image = $file['file_image']['name'];

        $dir = "assets/images/$image";

        if (!file_exists($dir)) {
            move_uploaded_file($tmp_file, $dir);
        }

        $name = $data['name'];
        $price = $data['price'];
        $desc = $data['desc'];
        $food_id = $data['food'];
        $sauce_id = $data['sauce'];

        $query = "INSERT INTO menu (menu_name, menu_image, menu_price, menu_desc, food_id, sauce_id) VALUES ('$name', '$image', $price, '$desc', $food_id, $sauce_id)";

        return $this->executeAffected($query);
    }

    // Memperbarui data menu berdasarkan ID
    function updateMenu($id, $data, $file)
    {
        // Check if a new image file was uploaded
        if (!empty($file['file_image']['name'])) {
            // Get the temporary file path and filename of the uploaded image
            $tmp_file = $file['file_image']['tmp_name'];
            $image = $file['file_image']['name'];

            // Set the destination path for the uploaded image
            $dir = "assets/images/$image";

            // check if file exists in directory
            if (!file_exists($dir)) {
                move_uploaded_file($tmp_file, $dir);
            }
        } else {
            // No new image was uploaded, so use the existing image value
            $image = $data['file_image'];
        }

        $name = $data['name'];
        $price = $data['price'];
        $desc = $data['desc'];
        $food_id = $data['food'];
        $sauce_id = $data['sauce'];

        $query = "UPDATE menu SET menu_name='$name', menu_image='$image', menu_price=$price, menu_desc='$desc', food_id=$food_id, sauce_id=$sauce_id WHERE menu_id=$id";

        return $this->executeAffected($query);
    }

    // Menghapus data menu berdasarkan ID
    function deleteMenu($id)
    {
        $query = "DELETE FROM menu WHERE menu_id = $id";
        return $this->executeAffected($query);
    }
}
