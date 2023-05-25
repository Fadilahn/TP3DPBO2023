<?php

// Memasukkan file konfigurasi dan kelas yang diperlukan
include('config/db.php');
include('classes/DB.php');
include('classes/Sauce.php');
include('classes/Template.php');

// Membuat objek food dan menginisialisasi koneksi database
$sauce = new Sauce($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$sauce->open();

// Cari
if (isset($_POST['btn-search'])) {
    // Metode mencari data
    $sauce->search($_POST['search']);
} else if (isset($_POST['order'])) {
    // sorting by
    $sauce->sortBy($_POST['order']);
} else {
    // Mengambil data makanan
    $sauce->getSauce();
}

// Menyiapkan variabel-variabel yang digunakan untuk template
$mainTitle = 'Sauce';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Sauce Name</th>
<th scope="row">Action</th>
</tr>';
$nav = '<li><a href="food.php" class="nav-link px-2 link-body-emphasis">Food</a></li>
<li><a href="sauce.php" class="nav-link px-2 link-secondary">Sauce</a></li>';

// Membuat objek template dengan menggunakan skin_table.html sebagai template
$view = new Template('templates/skin_table.html');

$data = null;
$no = 1;

// Mengisi data dengan hasil query dari objek saus
while ($div = $sauce->getResult()) {
    $data .= 
    '<tr>
        <th scope="row" style="width: 10%;">' . $no . '</th>
        <td>' . $div['sauce_name'] . '</td>
        <td style="font-size: 22px; width: 20%;">
            <a href="sauce.php?id=' . $div['sauce_id'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>
            &nbsp;
            <a href="sauce.php?hapus=' . $div['sauce_id'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

// Proses tambah data saus
if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        if ($sauce->addSauce($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'sauce.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'sauce.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}

// Proses hapus data saus
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($sauce->deleteSauce($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'sauce.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'sauce.php';
            </script>";
        }
    }
}

// Proses ubah data saus
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($sauce->updateSauce($id, $_POST) > 0) {
                echo "<script>
                    alert('Data berhasil diubah!');
                    document.location.href = 'sauce.php';
                </script>";
            } else {
                echo "<script>
                    alert('Data gagal diubah!');
                    document.location.href = 'sauce.php';
                </script>";
            }
        }

        // Mendapatkan data saus berdasarkan ID
        $sauce->getSauceById($id);
        $row = $sauce->getResult();

        $dataUpdate = $row['sauce_name'];
        $btn = 'Simpan';
        $title = 'Ubah';

        // Mengganti placeholder pada template dengan data yang diubah
        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

// Menutup koneksi database
$sauce->close();

// Mengganti placeholder pada template dengan data yang telah diproses
$view->replace('NAV_IS_CLICK', $nav);
$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_TABEL', $data);

// Menampilkan template yang telah diproses
$view->write();
