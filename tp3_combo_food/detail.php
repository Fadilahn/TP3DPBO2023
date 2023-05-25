<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Menu.php');
include('classes/Template.php');

$menu = new Menu($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$menu->open();

$data = nulL;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $menu->getMenuById($id);
        $row = $menu->getResult();

        $data .= '<div class="card-header text-center bg-dark">
        <h3 class="my-0 text-primary">Detail ' . $row['menu_name'] . '</h3>
        </div>
        <div class="card-body text-end">
            <div class="row">
                <div class="col-3">
                    <div class="row justify-content-center" style="max-width: 300px;">
                        <img src="assets/images/' . $row['menu_image'] . '" class="img-thumbnail" alt="' . $row['menu_image'] . '" width="60">
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card px-3">
                            <table border="0" class="text-start">
                                <tr>
                                    <td>Name</td>
                                    <td>:</td>
                                    <td>' . $row['menu_name'] . '</td>
                                </tr>
                                <tr>
                                    <td>Price</td>
                                    <td>:</td>
                                    <td>' . $row['menu_price'] . '</td>
                                </tr>
                                <tr>
                                    <td>Description</td>
                                    <td>:</td>
                                    <td>' . $row['menu_desc'] . '</td>
                                </tr>
                                <tr>
                                    <td>Food</td>
                                    <td>:</td>
                                    <td>' . $row['food_name'] . '</td>
                                </tr>
                                <tr>
                                    <td>Sauce</td>
                                    <td>:</td>
                                    <td>' . $row['sauce_name'] . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="add.php?id=' . $row['menu_id'] . '"><button type="button" class="btn btn-success text-white">Ubah Data</button></a>
                <a href="detail.php?hapus=' . $row['menu_id'] . '"><button type="button" class="btn btn-danger">Hapus Data</button></a>
            </div>';
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($menu->deleteMenu($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'index.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'index.php';
            </script>";
        }
    }
}

$menu->close();

$detail = new Template('templates/skin_detail.html');

$detail->replace('DATA_DETAIL_MENU', $data);

$detail->write();
