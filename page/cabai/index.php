<?php 

  if (isset($_GET['delete'])) {
    $id = $_GET['id'];
    $sql = "delete from cabai where id_cabai='$id'";
    $query = mysqli_query($con, $sql);
    if ($query) {
      echo "<script>alert('Data berhasil dihapus!');window.location.href='index.php?p=cabai'</script>";
    } else {
      echo mysqli_error($con);
    }
  }

 ?>

<div class="row">
    <div class="col-xs-12">

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Table With Full Features</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Id</th>
              <th>Kriteria</th>
              <th>Dataran</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            	<?php 

            		$sql = "select * from cabai";
            		$query = mysqli_query($con, $sql);
            		while ($row = mysqli_fetch_assoc($query)):

            	 ?>
            	 <tr>
            	 	<td><?= $row['id_cabai'] ?></td>
            	 	<td><?= $row['nama_cabai'] ?></td>
                <td><?= $row['dataran'] ?></td>
                <td>
                  <a href="index.php?p=cabai&act=edit&id=<?= $row['id_cabai'] ?>" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i></a>
                  <a href="index.php?p=cabai&delete&id=<?= $row['id_cabai'] ?>" class="btn btn-danger" onclick="return confirm('Apakah data akan dihapus?')"><i class="glyphicon glyphicon-trash"></i></a>
                </td>
            	 </tr>
            	<?php endwhile; ?>
            </tbody>
            <tfoot>
            <tr>
              <th>Id</th>
              <th>Kriteria</th>
              <th>Dataran</th>
              <th>Aksi</th>
            </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->