<?php
require 'function.php';
require 'cek.php';



?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!--<link rel="stylesheet" href="figma.css">-->
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Stok Barang</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">RPL</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            
            
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-stack"></i></div>
                                Stock Barang
                            </a>
                            <a class="nav-link" href="brg_masuk.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-box-arrow-in-down"></i></div>
                                Barang Masuk
                            </a>
                            <a class="nav-link" href="brg_keluar.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-box-arrow-up"></i></div>
                                Barang Keluar
                            </a>
                            <a class="nav-link" href="cetak.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-clipboard2-data-fill"></i></div>
                                Laporan Barang
                            </a>
                            <a class="nav-link" href="logout.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-power"></i></div>
                                Logout
                            </a>

                           
                            
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Stock Barang</h1>
                    
                        
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                    Tambah Barang Baru
                                </button>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2">
                                    Tambah Barang Gudang
                                </button>
                            </div>
                            <div class="card-body">
                                <div class ="search-box">
                                    <form method="POST">
                                        <input class="search-txt" type="text" name="keyword" placeholder="Cari">
                                        <button type="submit" class="search-btn" name="pencarian">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </form>
                                </div> 
                                <br>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Barang</th>
                                                <th>Kategori Barang</th>
                                                <th>Jumlah Barang</th>
                                                <th>Harga Barang</th>
                                                <th>Jumlah Stock Gudang</th>
                                                <th>Jumlah Seluruh Stock</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            <?php
                                                if (isset($query)) {
                                                    $ambilsemuadatastock = $query;
                                                }else{
                                                    $ambilsemuadatastock = mysqli_query($conn, "SELECT * FROM `tbl_barang` m LEFT JOIN `tbl_gudang` s ON s.`brg_id` = m.`brg_id`");
                                                }
                                                $i = 1;
                                                while ($data=mysqli_fetch_array($ambilsemuadatastock)){
                                                    $namabarang = $data['brg_nama'];
                                                    $kategoribarang = $data['brg_kategori'];
                                                    $jumlahbarang = $data['brg_quantity'];
                                                    $hargabarang = $data['brg_harga'];
                                                    $stockgudang = $data['gud_quantity'];
                                                    $stockseluruh = $stockgudang + $jumlahbarang;
                                                    $idb = $data['brg_id'];
                                            ?>

                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $namabarang; ?></td>
                                                <td><?= $kategoribarang; ?></td>
                                                <td><?= $jumlahbarang; ?></td>
                                                <td><?= $hargabarang; ?></td>
                                                <td><?= $stockgudang; ?></td>
                                                <td><?=$stockseluruh; ?></td>
                                                <td>
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editmodal<?=$idb;?>">
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletemodal<?=$idb;?>">
                                                    Delete
                                                </button>
                                                </td>
                                            </tr>
                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deletemodal<?=$idb;?>">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                    <h4 class="modal-title">Delete Barang</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal Body -->
                                                    <div class="modal-body">
                                                        <form action="" method="POST">
                                                    <h5>Apakah Anda yakin ingin menghapus <?=$namabarang;?> ? </h5>
                                                    <input type="hidden" name="idb" value="<?=$idb;?>">
                                                    </div>
                                                    
                                                    
                                                    <!-- Modal Footer -->
                                                    <div class="modal-footer">
                                                        <button type ="submit" class ="btn btn-warning" name="deletebarang">Ok</button>
                                                    </div>
                                                    </form>
                                                </div>
                                                </div>
                                            </div>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="editmodal<?=$idb;?>">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                    <h4 class="modal-title">Edit Barang</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    
                                                    <!-- Modal body -->
                                                    <form method ="post">
                                                    <div class="modal-body">
                                                    <input type="text" name="namabarang" value="<?=$namabarang;?>"  class="form-control"required>
                                                    <br>
                                                    <label for="kategori"> Kode Kategori Barang: </label>
                                                        <select name="kategori" class ="form-control" value="<?=$kategoribarang;?>" id="kategori">
                                                        <option value ="1"> 1 </option>
                                                        <option value ="2"> 2 </option>
                                                        <option value ="3"> 3 </option>
                                                        </select>
                                                        <br>
                                                    <input type="number" name="quantity" value="<?=$jumlahbarang;?>" class="form-control"required>
                                                    <br>
                                                    <input type="number" name="price" value="<?=$hargabarang;?>" class="form-control"required>
                                                    </div>
                                                    <input type="hidden" name="idb" value="<?=$idb;?>">
                                                    <!-- Modal Footer -->
                                                    <div class="modal-footer">
                                                        <button type ="submit" class ="btn btn-warning" name="editbarang">Ok</button>
                                                    <div>
                                                </form>
                                                </div>
                                                </div>
                                            </div>
                                            <?php
                                                 };
                                            ?>
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <<script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <!--<script src="assets/demo/datatables-demo.js"></script>-->
        
    </body>
    
    <!-- The Modal -->
  <div class="modal fade" id="myModal2">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Barang Gudang</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form method ="post">
        <div class="modal-body">
            <select name="idbarang" class ="form-control">
              <?php
                $ambildata=mysqli_query($conn, "SELECT * FROM tbl_barang");
                while($fetcharray = mysqli_fetch_array($ambildata)){
                    $namabarang= $fetcharray['brg_nama'];
                    $idbarang = $fetcharray['brg_id']; 
                ?>
            
                <option value="<?=$idbarang;?>"><?=$namabarang;?></option>
                
                <?php 
                    }
                ?>

              
              
            </select>
            <br>
          <input type="number" name="gudquantity" placeholder="Quantity Gudang" class="form-control"required>
        </div>
        
        
        <!-- Modal footer -->
        <div class="modal-footer">
            <button type ="submit" class ="btn btn-primary" name="addnewbarang2">Submit</button>
        </div>
        </form>
        
      </div>
    </div>
  </div>
      <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Barang</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form method ="post">
        <div class="modal-body">
          <input type="text" name="namabarang" placeholder="Nama Barang"  class="form-control"required>
          <br>
          <label for="kategori"> Kode Kategori Barang: </label>
            <select name="kategori" id="kategori" class ="form-control">
                <?php
                    $ambildata = mysqli_query($conn, "SELECT * FROM tbl_kategori");
                    while($fetcharray= mysqli_fetch_array($ambildata)){
                        $katnamabarang = $fetcharray['kat_nama'];
                        $idkategori = $fetcharray['kat_id']; 
                ?>
              <option value ="<?=$idkategori;?>"><?=$idkategori;?>-<?=$katnamabarang;?></option>
              <?php
                }
              ?>
            </select>
            <br>
          <input type="number" name="quantity" placeholder="Quantity" class="form-control"required>
          <br>
          <input type="number" name="price" placeholder="Price" class="form-control"required>
        </div>
        
        
        <!-- Modal footer -->
        <div class="modal-footer">
            <button type ="submit" class ="btn btn-primary" name="addnewbarang">Submit</button>
        </div>
        </form>
        <!--Modal Diatas Jangan Dioprek-->
      </div>
    </div>
  </div>
</html>


