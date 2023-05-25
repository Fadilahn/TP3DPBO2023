<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Menu.php');
include('classes/Food.php');
include('classes/Sauce.php');
include('classes/Template.php');

// Buat instance menu
$menu = new Menu($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$menu->open(); // Buka koneksi

/*connect ke database tabel Food*/
$food = new Food($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$food->open();
$food->getFood();
$optionsFood = null;

/*connect ke database tabel Sauce*/
$sauce = new Sauce($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$sauce->open();
$sauce->getSauce();
$optionsSauce = null;

$view = new Template('templates/skin_add.html');

$image_update = '';
$name_update = '';
$price_update = '';
$desc_update = '';

if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        if ($menu->addMenu($_POST, $_FILES) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'index.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'add.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';

    // Looping untuk menampilkan data dalam tabel HTML
    while ($row = $food->getResult()) {
        $optionsFood .= "<option value=". $row['food_id']. ">" . $row['food_name'] . "</option>";
    }

    // Looping untuk menampilkan data dalam tabel HTML
    while ($row = $sauce->getResult()) {
        $optionsSauce .= "<option value=". $row['sauce_id']. ">" . $row['sauce_name'] . "</option>";
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($menu->updateMenu($id, $_POST, $_FILES) > 0) {
                echo "<script>
                    alert('Data berhasil diubah!');
                    document.location.href = 'index.php';
                </script>";
            } else {
                echo "<script>
                    alert('Data gagal diubah!');
                    document.location.href = 'index.php';
                </script>";
            }
        }

        $btn = 'Simpan';
        $title = 'Ubah';

        $menu->getMenuById($id);
        $row = $menu->getResult();

        $image_update = $row['menu_image'];
        $name_update = $row['menu_name'];
        $price_update = $row['menu_price'];
        $desc_update = $row['menu_desc'];
        $food_update = $row['food_id'];
        $sauce_update = $row['sauce_id'];

        // Looping untuk menampilkan data dalam tabel HTML
        while ($row = $food->getResult()) {
            $selected = ($row['food_id'] == $sauce_update) ? 'selected' : '';
            $optionsFood .= '<option value="' . $row['food_id'] . '" ' . $selected . '>' . $row['food_name'] . '</option>';
        }

        // Looping untuk menampilkan data dalam tabel HTML
        while ($row = $sauce->getResult()) {
            $selected = ($row['sauce_id'] == $sauce_update) ? 'selected' : '';
            $optionsSauce .= '<option value="' . $row['sauce_id'] . '" ' . $selected . '>' . $row['sauce_name'] . '</option>';
        }

    }
}

$menu->close();
$food->close();
$sauce->close();

$view->replace('IMAGE_VAL_UPDATE', $image_update);
$view->replace('NAME_VAL_UPDATE', $name_update);
$view->replace('PRICE_VAL_UPDATE', $price_update);
$view->replace('DESC_VAL_UPDATE', $desc_update);

$view->replace('OPTIONS_FOOD', $optionsFood);
$view->replace('OPTIONS_SAUCE', $optionsSauce);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);

$view->write();