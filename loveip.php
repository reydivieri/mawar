<?php
    include "function.php";
    include "cek.php";
?>
                                                
                                                <form method="POST">
                                                    <div class="modal-body">
                                                        <input type="text" name="namabarang" value="<?=$namabarang;?>"  class="form-control"required>
                                                        <br>
                                                        <input type="date" name="tanggal" value="<?=$tanggal;?>"  class="form-control"required>
                                                        <br>
                                                        <input type="text" name="penerima" value="<?=$penerima;?>" class="form-control"required>
                                                        <br>
                                                        <input type="number" name="quantity" value="<?=$qty;?>" class="form-control"required>
                                                    </div>

                                                        <input type="hidden" name="idb" value="<?=$idb;?>">
                                                        <input type="hidden" name="idm" value="<?=$idm;?>">
                                                    <!-- Modal Footer -->
                                                    <div class="modal-footer">
                                                        <button type="submit" class ="btn btn-warning" name="editbarangmasuk" value="true">Ok</button>
                                                    <div>
                                                </form>