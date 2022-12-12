<?php
    
    $conn = mysqli_connect("localhost","root","","todolist");

    if (mysqli_connect_errno()){
        echo "Koneksi Gagal ";
        exit();
    }else{
        //echo "Koneksi Berhasil ";
    }

    //buat query select semua todolist
    $query = "SELECT * FROM task";

    //baca data hasil query
    $items = [];
    if ($result = mysqli_query($conn,$query)){
        //ambil data satu per satu
        while ($row = mysqli_fetch_assoc($result)){
            $items[] = $row;
        }

        //var_dump(&item);

        mysqli_free_result($result);
    }

    //section insert item
    //tangkap data item dari form method post
    if(isset($_POST['item'])){
        $item = $_POST['item'];

        //buat query untuk memasukkan item
        $query = "INSERT INTO task (item) values ('$item')";

        //jalankan query
        if (mysqli_query($conn,$query)){
            echo "Data Berhasil Disimpan";
            header("Refresh:0");
        }else{
            echo "Error ".mysqli_error($conn);
        }
    }

    mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List JasTip</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<body>
<section class="vh-100" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-lg-9 col-xl-7">
        <div class="card rounded-3">
          <div class="card-body p-4">

            <h4 class="text-center my-3 pb-3">List Pesanan JasTip</h4>

            <form class="row row-cols-lg-auto g-3 justify-content-center align-items-center mb-4 pb-2" method="POST">
              <div class="col-12">
                <div class="form-outline">

                  <input type="text" id="form1" class="form-control" name="item" placeholder="Ketik menu Anda disini"/>
                  
                </div>
              </div>

              <div class="col-12">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>

            <table class="table mb-4">
              <thead>
                <tr>
                  <th scope="col">No.</th>
                  <th scope="col">List Barang Jastip</th>
                  <th scope="col">Status</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($items as $key=>$value): ?>
                <tr>
                  <th scope="row"><?php echo $key+1; ?></th>
                  <td><?php echo $value['item'] ;?></td>
                  <td><?php echo ($value['status'] == 0) ? "Barang Ada" : "Stok Kosong"; ?></td>
                  <td>
                    <a href="<?php echo 'delete.php?id='.$value['id']; ?>" type="submit" class="btn btn-danger">Hapus</a>
                    <a href="<?php echo 'update.php?id='.$value['id']; ?>" type="submit" class="btn btn-success ms-1">Edit</a>
                    
                  </td>
                </tr>
                <?php endforeach; ?>
                
              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>