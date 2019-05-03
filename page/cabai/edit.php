<?php 
  
  $id = $_GET['id'];
  $sql = "select * from cabai where id_cabai='$id'";
  $query = mysqli_query($con, $sql);
  $data = mysqli_fetch_array($query);


	if (isset($_POST['simpan'])) {

		$cabai = $_POST['cabai'];
    $dataran = $_POST['dataran'];

		$sql = "update cabai set nama_cabai='$cabai', dataran='$dataran' where id_cabai='$id'";
		$query = mysqli_query($con, $sql);
		if ($query) {
			echo "<script>alert('Data berhasil diubah!');window.location.href='index.php?p=cabai'</script>";
		} else {
			echo "Error : " . mysqli_error($con);
		}
	}

 ?>

<div class="row">
    <!-- left column -->
    <div class="col-md-8">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Form Kriteria</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Cabai</label>
              <input type="text" class="form-control input-lg" id="exampleInputEmail1" placeholder="Masukan Nama Cabai" name="cabai" required value="<?= $data['nama_cabai'] ?>">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Dataran</label>
              <select name="dataran" class="form-control input-lg">
                <option value="">-- Pilih Dataran --</option>
                <option value="rendah" <?= ($data['dataran']=='rendah')?'selected':'' ?>>Rendah</option>
                <option value="sedang" <?= ($data['dataran']=='sedang')?'selected':'' ?>>Sedang</option>
                <option value="tinggi" <?= ($data['dataran']=='tinggi')?'selected':'' ?>>Tinggi</option>
              </select>
            </div>
            
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
          </div>
        </form>
      </div>
      <!-- /.box -->


    </div>
    <!--/.col (left) -->
    
  </div>
  <!-- /.row -->