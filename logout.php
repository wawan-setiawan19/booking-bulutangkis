<?php

//memulai sesi
session_start();

//menghapus semua variabel sesi
session_unset();

//menghancurkan sesi
session_destroy();

//mengarahkan pengguna ke halaman login
header("Location: login.php");
exit;
