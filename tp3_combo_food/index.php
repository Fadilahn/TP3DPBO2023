<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Menu.php');
include('classes/Template.php');

// Buat instance menu
$menu = new Menu($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$menu->open(); // Buka koneksi
// $menu->getMenuJoin(); // Tampilkan data menu

// Cari
if (isset($_POST['btn-search'])) {
    // Metode mencari data
    $menu->searchMenu($_POST['search']);
} else if (isset($_POST['order'])) {
    // sorting by
    $menu->sortMenuBy($_POST['order']);
} else {
    // Metode menampilkan data
    $menu->getMenuJoin();
}

$data = null;

// Ambil data menu dan gabungkan dengan tag HTML
// untuk dipassing ke skin/template
while ($row = $menu->getResult()) {
    $data .= '<div class="col">
        <div class="card h-100 menu-thumbnail">
        <a href="detail.php?id=' . $row['menu_id'] . '">
            <img src="assets/images/' . $row['menu_image'] . '" class="card-img-top" alt="' . $row['menu_image'] . '">
            <div class="card-body">
                <h5 class="card-title text-dark text-center menu-name">' . $row['menu_name'] . '</h5>
                <p class="card-text text-primary menu-price">$ ' . $row['menu_price'] . '.00</p>
            </div>
        </a>
        </div>
    </div>';
}

if(!$data){
    $data = '<div class="col">
        <div class="card h-100 menu-thumbnail">
            <div class="card-body">
                <h5 class="card-title text-center menu-name">Tidak ada menu</h5>
            </div>
        </div>
    </div>';
}

/**
 * <p class="card-text text-success food-name">' . $row['food_name'] . '</p>
 * <p class="card-text text-warning sauce-name">' . $row['sauce_name'] . '</p>
 */

// Tutup koneksi
$menu->close();

// Buat instance template
$home = new Template('templates/skin.html');

// Simpan data ke template
$home->replace('DATA_MENU', $data);
$home->write();
