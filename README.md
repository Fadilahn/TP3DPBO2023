# TP3DPBO2023
Membuat program GUI menggunakan PHP sesuai dengan spesifikasi soal [TP2](https://docs.google.com/document/d/15WBS8LSBHvTNCENUFC_3ZiiyhaylNzYAH62rl-OUZNU/edit)
---
- -
Saya Muhammad Fadhillah Nursyawal NIM 2107135 mengerjakan soal TP 3
dalam mata kuliah Desain Pemrograman Berorientasi Objek 
untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

## Desain Program
Program ini menggunakan bahasa PHP untuk menampilkan view dan mengambil database dari mysql. 

berikut merupakan desain database:

![Alt text](Desain%20Database/Screenshot%202023-05-25%20152111.png)

Desain database ini menggunakan database MySQL dengan nama "db_combo_food". Database ini terdiri dari tiga tabel utama: "food", "sauce", dan "menu".
- Tabel "food": Tabel ini digunakan untuk menyimpan jenis makanan yang dapat dipilih dalam menu.
- Tabel "sauce": Tabel ini digunakan untuk menyimpan jenis saus yang dapat dipilih dalam menu.
- Tabel "menu": Tabel ini digunakan untuk menyimpan informasi tentang menu yang tersedia.
food_id dan sauce_id merupakan foreign key yang terhubung ke tabel food dan sauce, sehingga berkaitan antara menu dengan jenis makanan dan saus.

## Penjelasan Alur
berikut merupakan simulasi dari dari program yang saya buat:

1. didalam halaman menu terdapat list card yang merupakan list menu dalam database, lalu didalam halaman tersebut dapat menambahkan menu dengan menekan btn, dapat sorting berdasarkan nama dan harga, dan search.
2. saat klik card lalu akan dipindahkan ke halaman detail dari menunya, disitu terdapat ubah data dan delete data
3. dalam add dan ubah data memakai skin yang sama, isi datannya langsung submit nanti datanya masuk ke database
4. lalu dalam nav bar terdapat food dan sauce
5. terakhir ada food dan sauce yang sama sama ada table dan card untuk tambah sekaligus ubah data, selengkapnya ada di video

## Dokumentasi
Home
![Alt text](Screenshot/Screenshot%202023-05-24%20235535.png)

Ubdah data
![Alt text](Screenshot/Screenshot%202023-05-24%20235626.png)

Daftar Food
![Alt text](Screenshot/Screenshot%202023-05-25%20152644.png)

Detail
![Alt text](Screenshot/Screenshot%202023-05-25%20152830.png)