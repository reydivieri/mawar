<?php 
    session_start();
    //Membuat Koneksi
    require 'connection.php';

    

    //Menambah Barang Baru
    if(isset($_POST['addnewbarang'])){
        $namabarang = $_POST['namabarang'];
        $kategori = $_POST['kategori'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];

        $addtotable = mysqli_query($conn, "INSERT INTO tbl_barang (brg_nama,brg_kategori,brg_quantity,brg_harga) VALUES('$namabarang','$kategori','$quantity','$price')");
        if($addtotable){
            header('location:index.php');
        }
        else {
            echo 'gagal';
            header('location:index.php');
        }
    }

    //Menambah Barang Baru Gudang
    if(isset($_POST['addnewbarang2'])){
        $gudquantity = $_POST['gudquantity'];
        $idbarang = $_POST['idbarang'];
        
        $addtotable = mysqli_query($conn, "INSERT INTO tbl_gudang (brg_id,gud_quantity) VALUES('$idbarang','$gudquantity')");
        if($addtotable){
            header('location:index.php');
        }
        else {
            echo 'gagal';
            header('location:index.php');
        }
    }

    //Menambah Barang Masuk
    if(isset($_POST['barangmasuk'])){
        $barangmasuk = $_POST['masukbarang'];
        $penerima = $_POST['penerima'];
        $qty = $_POST['qty'];

        $cekstock = mysqli_query($conn,"SELECT * FROM tbl_barang WHERE brg_id = '$barangmasuk'");
        $ambildatanya = mysqli_fetch_array($cekstock);

        $stocksekarang = $ambildatanya['brg_quantity'];
        $tambahstocksekarangdgqty = $stocksekarang + $qty;

        $addtomasuk = mysqli_query($conn,"INSERT INTO tbl_masuk_brg(idbarang, penerima, qty) VALUES('$barangmasuk','$penerima','$qty') ");
        $updatestock - mysqli_query($conn,"UPDATE tbl_barang SET brg_quantity='$tambahstocksekarangdgqty' WHERE brg_id ='$barangmasuk'");
        if($addtomasuk&&$updatestock){
            header('location:brg_masuk.php');
        }
        else {
            echo 'gagal';
            header('location:brg_masuk.php');
        }
    }

    //Menambah Barang Keluar
    if(isset($_POST['addbrgkeluar'])){
        $barangkeluar = $_POST['barangkeluar'];
        $keterangan = $_POST['keterangan'];
        $qty = $_POST['qty'];

        $cekstock = mysqli_query($conn,"SELECT * FROM tbl_barang WHERE brg_id = '$barangkeluar'");
        $ambildatanya = mysqli_fetch_array($cekstock);

        $stocksekarang = $ambildatanya['brg_quantity'];

        if($stocksekarang >= $qty){
            $tambahstocksekarangdgqty = $stocksekarang - $qty;

            $addtomasuk = mysqli_query($conn,"INSERT INTO tbl_keluar_brg(idbarang, keterangan, qty) VALUES('$barangkeluar','$keterangan','$qty') ");
            $updatestock - mysqli_query($conn,"UPDATE tbl_barang SET brg_quantity='$tambahstocksekarangdgqty' WHERE brg_id ='$barangkeluar'");
            if($addtomasuk&&$updatestock){
                header('location:brg_keluar.php');
            }
            else {
                echo 'gagal';
                header('location:brg_keluar.php');
            }
        } 
        else {
            echo '<script>
                    alert("Stock saat ini tidak mencukupi");
                    window.location.href="brg_keluar.php";
                    </script>';
            
        }
    }

    //Update barang
    if(isset($_POST['editbarang'])){
        $idbarang = $_POST['idb'];
        $namabarang = $_POST['namabarang'];
        $kategori = $_POST['kategori'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];

        $updateedit= mysqli_query($conn, "UPDATE tbl_barang SET brg_nama = '$namabarang', brg_kategori = '$kategori', brg_quantity = '$quantity', brg_harga = '$price' WHERE brg_id ='$idbarang'");
        if($updateedit){
            header('location:index.php');
        }
        else {
            echo 'gagal';
            header('location:index.php');
        }
    }

    //Hapus barang
    if(isset($_POST['deletebarang'])){
        $idbarang = $_POST['idb'];

        $delete = mysqli_query($conn, "DELETE FROM tbl_gudang WHERE brg_id ='$idbarang'");
        if($delete){
            $delete2 = mysqli_query($conn, "DELETE FROM tbl_barang WHERE brg_id ='$idbarang'");
            header('location:index.php');
        }
        else {
            echo 'gagal';
            header('location:index.php');
        }
    }

    //Mengubah data barang masuk
    if(isset($_POST['editbarangmasuk'])){
        $idbarang = $_POST['idb'];
        $idmasuk = $_POST['idm'];
        $penerima = $_POST['penerima'];
        $qty = $_POST['quantity'];
        
        $cekstock = mysqli_query($conn,"SELECT * FROM tbl_barang WHERE brg_id = '$idbarang'");
        $ambildatanya = mysqli_fetch_array($cekstock);

        $stocksekarang = $ambildatanya['brg_quantity'];

        $qtysekarang = mysqli_query($conn, "SELECT * FROM tbl_masuk_brg WHERE idmasuk ='$idmasuk'");
        $qtynya = mysqli_fetch_array($qtysekarang);
        $qtysekarang = $qtynya['qty'];

        if($qty>$qtysekarang){
            $selisih = $qty - $qtysekarang;
            $kurangi = $stocksekarang + $selisih;
            $kurangistocknya = mysqli_query($conn, "UPDATE tbl_barang SET brg_quantity='$kurangi' WHERE brg_id='$idbarang'");
            $updatenya = mysqli_query($conn, "UPDATE tbl_masuk_brg SET qty='$qty', penerima='$penerima' WHERE idmasuk ='$idmasuk'");
            if($kurangistocknya&&$updatenya){
                header('location:brg_masuk.php');
            }
            else {
                echo 'gagal';
                header('location:brg_masuk.php');
            }
        }
        else{
            $selisih = $qtysekarang - $qty;
            $kurangi = $stocksekarang - $selisih;
            $kurangistocknya = mysqli_query($conn, "UPDATE tbl_barang SET brg_quantity='$kurangi'WHERE brg_id ='$idbarang'");
            $updatenya = mysqli_query($conn, "UPDATE tbl_masuk_brg SET qty='$qty', penerima='$penerima' WHERE idmasuk ='$idmasuk'");
            if($kurangistocknya&&$updatenya){
                header('location:brg_masuk.php');
            }
            else {
                echo 'gagal';
                header('location:brg_masuk.php');
            }
        }
    }

    //Menghapus barang masuk
    if(isset($_POST['deletebarangmasuk'])){
        $idmasuk = $_POST['idm'];
        $qty = $_POST['qty2'];
        $idbarang = $_POST['idb'];

        $getdatastock = mysqli_query($conn, "SELECT * FROM tbl_barang WHERE brg_id ='$idbarang'");
        $data = mysqli_fetch_array($getdatastock);
        $stock = $data['brg_quantity'];

        $selisih2 = $stock - $qty;

        $update = mysqli_query($conn,"UPDATE tbl_barang SET brg_quantity='$selisih2' WHERE brg_id='$idbarang'");
        $hapusdata = mysqli_query($conn, "DELETE FROM tbl_masuk_brg WHERE idmasuk ='$idmasuk'");

        if($update&&$hapusdata){
            header('location:brg_masuk.php');
        }
        else{
            header('location:brg_masuk.php');
        }
    }

    //Mengubah data barang keluar
    if(isset($_POST['editbarangkeluar'])){
        $idbarang = $_POST['idb'];
        $idkeluar = $_POST['idk'];
        $keterangan = $_POST['keterangan'];
        $qty = $_POST['quantity'];
        
        $cekstock = mysqli_query($conn,"SELECT * FROM tbl_barang WHERE brg_id = '$idbarang'");
        $ambildatanya = mysqli_fetch_array($cekstock);

        $stocksekarang = $ambildatanya['brg_quantity'];

        $qtysekarang = mysqli_query($conn, "SELECT * FROM tbl_keluar_brg WHERE idkeluar ='$idkeluar'");
        $qtynya = mysqli_fetch_array($qtysekarang);
        $qtysekarang = $qtynya['qty'];

        if($qty>$qtysekarang){
            $selisih = $qty - $qtysekarang;
            $kurangi = $stocksekarang - $selisih;
            $kurangistocknya = mysqli_query($conn, "UPDATE tbl_barang SET brg_quantity='$kurangi' WHERE brg_id='$idbarang'");
            $updatenya = mysqli_query($conn, "UPDATE tbl_keluar_brg SET qty='$qty', keterangan='$keterangan' WHERE idkeluar ='$idkeluar'");
            if($kurangistocknya&&$updatenya){
                header('location:brg_keluar.php');
            }
            else {
                echo 'gagal';
                header('location:brg_keluar.php');
            }
        }
        else{
            $selisih = $qtysekarang - $qty;
            $kurangi = $stocksekarang + $selisih;
            $kurangistocknya = mysqli_query($conn, "UPDATE tbl_barang SET brg_quantity='$kurangi'WHERE brg_id ='$idbarang'");
            $updatenya = mysqli_query($conn, "UPDATE tbl_keluar_brg SET qty='$qty', keterangan='$keterangan' WHERE idkeluar ='$idkeluar'");
            if($kurangistocknya&&$updatenya){
                header('location:brg_keluar.php');
            }
            else {
                echo 'gagal';
                header('location:brg_keluar.php');
            }
        }
    }

    //Menghapus barang keluar
    if(isset($_POST['deletebarangkeluar'])){
        $idkeluar = $_POST['idk'];
        $qty = $_POST['qty3'];
        $idbarang = $_POST['idb'];

        $getdatastock = mysqli_query($conn, "SELECT * FROM tbl_barang WHERE brg_id ='$idbarang'");
        $data = mysqli_fetch_array($getdatastock);
        $stock = $data['brg_quantity'];

        $selisih2 = $stock + $qty;

        $update = mysqli_query($conn,"UPDATE tbl_barang SET brg_quantity='$selisih2' WHERE brg_id='$idbarang'");
        $hapusdata = mysqli_query($conn, "DELETE FROM tbl_keluar_brg WHERE idkeluar ='$idkeluar'");

        if($update&&$hapusdata){
            header('location:brg_keluar.php');
        }
        else{
            header('location:brg_keluar.php');
        }
    }

    
    //Mencari data
    
    if (isset($_POST["pencarian"])){
        $keyword = $_POST['keyword'];

            $query = mysqli_query($conn, "SELECT * FROM `tbl_barang` m LEFT JOIN `tbl_gudang` s ON s.`brg_id` = m.`brg_id`
            WHERE 
            m.brg_nama LIKE '%$keyword%' OR 
            m.brg_kategori LIKE '%$keyword%' OR 
            m.brg_quantity LIKE '%$keyword%' OR 
            m.brg_harga LIKE '%$keyword%';
            ");
    }
    
    

    
    // var_dump($_POST['register']);
    // exit();
    //Register
    if(isset($_POST['register'])){
        $email = $_POST['inputemail'];
        $password = mysqli_real_escape_string($conn, $_POST['inputpassword']);
        $password2 = mysqli_real_escape_string($conn, $_POST['inputconfirmpassword']);
        

        //Cek username ganda

            $result = mysqli_query($conn, "SELECT email FROM login WHERE email ='$email'");
            if(mysqli_fetch_assoc($result)){
                echo "<script>alert('Email sudah ada')</script>";
                return false;
            }
        //Cek konfirm password

            if ($password !== $password2){
                echo "<script>alert('Password tidak sama')</script>";
                return false;
            }
        // Tambah user baru ke db
            mysqli_query($conn, "INSERT INTO login VALUES('','$email','$password')");

            return mysqli_affected_rows($conn);

            header('location:login.php');

    }
    


?>