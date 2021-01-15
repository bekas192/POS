<?php 
    error_reporting(0);
    $x=$brg->row_array();
    ?>
    <table>
    <tr>
        <th style="width:200px;"></th>
        <th>Nama Barang</th>
        <th>Satuan</th>
        <th>Stok</th>
        <th>Harga(Rp)</th>
        <th>Diskon(Rp)</th>
        <th>Jumlah</th>
    </tr>
    <tr>
        <td style="width:200px;"></th>
        <td><input type="text" name="nabar" value="<?php echo $x['name'];?>" style="width:380px;margin-right:5px;" class="form-control input-sm" readonly></td>
        <td><input type="text" name="satuan" value="<?php echo $x['price'];?>" style="width:120px;margin-right:5px;" class="form-control input-sm" readonly></td>
        
        <td><button type="submit" class="btn btn-sm btn-primary">Ok</button></td>
    </tr>
    </table>
					