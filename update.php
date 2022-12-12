<?php

//tangkap id dari method GET
$id = $_GET['id'];

//buat koneksi dg mysql
$conn = mysqli_connect("localhost","root","","todolist");

//cek koneksi
if (mysqli_connect_errno()){
    echo "Koneksi Gagal ";
    exit();
}else{
    echo "Koneksi Berhasil ";
}

//buat query select semua todolist
$query = "UPDATE task SET status=1 WHERE id='$id' ";

//jalankan query
$sql = mysqli_query($conn,$query);
mysqli_close($conn);

if ($sql){
    echo "Data Berhasil Diupdate";
    header("Refresh:0; url=index.php");
}else{
    echo "Gagal Update ".mysqli_error($conn);
}

?>