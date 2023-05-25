<?php

// Memasukkan file konfigurasi dan kelas yang diperlukan
include('config/db.php');
include('classes/DB.php');
include('classes/Food.php');
include('classes/Template.php');

// Membuat objek food dan menginisialisasi koneksi database
$food = new food($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$food->open();

// Cari
if (isset($_POST['btn-search'])) {
    // Metode mencari data
    $food->search($_POST['search']);
} else if (isset($_POST['order'])) {
    // sorting by
    $food->sortBy($_POST['order']);
} else {
    // Mengambil data makanan
    $food->getFood();
}

// Menyiapkan variabel-variabel yang digunakan untuk template
$mainTitle = 'Food';
$formLabel = 'food';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Food Name</th>
<th scope="row">Action</th>
</tr>';
$nav = '<li><a href="food.php" class="nav-link px-2 link-secondary">Food</a></li>
<li><a href="sauce.php" class="nav-link px-2 link-body-emphasis">Sauce</a></li>';

// Membuat objek template dengan menggunakan skin_table.html sebagai template
$view = new Template('templates/skin_table.html');

$data = null;
$no = 1;

// Mengisi data dengan hasil query dari objek food
while ($div = $food->getResult()) {
    $data .= 
    '<tr>
        <th scope="row" style="width: 10%;">' . $no . '</th>
        <td>' . $div['food_name'] . '</td>
        <td style="font-size: 22px; width: 20%;">
            <a href="food.php?id=' . $div['food_id'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>
            &nbsp;
            <a href="food.php?hapus=' . $div['food_id'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

// Proses tambah data makanan
if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        if ($food->addFood($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'food.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'food.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}

// Proses hapus data makanan
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($food->deleteFood($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'food.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'food.php';
            </script>";
        }
    }
}

// Proses ubah data makanan
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($food->updateFood($id, $_POST) > 0) {
                echo "<script>
                    alert('Data berhasil diubah!');
                    document.location.href = 'food.php';
                </script>";
            } else {
                echo "<script>
                    alert('Data gagal diubah!');
                    document.location.href = 'food.php';
                </script>";
            }
        }

        // Mendapatkan data makanan berdasarkan ID
        $food->getFoodById($id);
        $row = $food->getResult();

        $dataUpdate = $row['food_name'];
        $btn = 'Simpan';
        $title = 'Ubah';

        // Mengganti placeholder pada template dengan data yang diubah
        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

// Menutup koneksi database
$food->close();

// Mengganti placeholder pada template dengan data yang telah diproses
$view->replace('NAV_IS_CLICK', $nav);
$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_TABEL', $data);

// Menampilkan template yang telah diproses
$view->write();
