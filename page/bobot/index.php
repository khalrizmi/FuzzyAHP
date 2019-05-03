<?php 

  if (isset($_GET['delete'])) {
    $sql = "truncate table nilai_kriteria";
    $query = mysqli_query($con, $sql);
    if ($query) {
      echo "<script>alert('Data telah dihapus!');window.location.href='index.php?p=bobot'</script>";
    }else {
      echo mysqli_error($con);
    }
  }

  $sql = "select * from kriteria";
  $query = mysqli_query($con, $sql);
  $count = mysqli_num_rows($query);

  if (isset($_POST['simpan'])) {
    for ($x=1; $x <=$count ; $x++) { 
      for ($y=1; $y <=$count ; $y++) {
        $split = explode("-", $_POST['position'.$x.$y]);
        if ($_POST['nilai'.$x.$y] != "") {
         // echo  $split[0] .",". $split[1] . "=" . $_POST['nilai'.$x.$y].' '; 
         $id = $_POST['id'.$x.$y];
         $nilai = $_POST['nilai'.$x.$y];
         $sql = "insert into nilai_kriteria values(null, '$id', '$split[0]', '$split[1]', '$nilai')";
         mysqli_query($con, $sql);
        }
      }
    }
    
    for ($x=1; $x <=$count ; $x++) { 
      for ($y=1; $y<=$x-1; $y++) { 
        // echo $x."-".$y.":";
        // echo 1/$_POST['nilai'.$y.$x]." ";
        $id = $_POST['id'.$x.$y];
        $nilai = 1/$_POST['nilai'.$y.$x];
        $sql = "insert into nilai_kriteria values(null, '$id', '$x', '$y', '$nilai')";
        mysqli_query($con, $sql);
      }
    }

    echo "<script>alert('Data berhasil disimpan!');window.location.href='index.php?p=bobot'</script>";
  }

  $query = mysqli_query($con, "select * from nilai_kriteria");
  $sudah_isi = mysqli_num_rows($query);

 ?>
<div class="row">
    <div class="col-xs-12">

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Table With Full Features</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

    <?php if ($sudah_isi == 0): ?>
        <form method="post">
          <table class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Kriteria</th>
              <?php 
                $sql = "select * from kriteria";
                $query = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_assoc($query)):
               ?>
              <th><?= $row['kriteria'] ?></th>
              <?php endwhile; ?>
            </tr>
            </thead>
            <tbody>
            	<?php 
                  $x = 1;
                  $sql = "select * from kriteria";
                  $query = mysqli_query($con, $sql);
                  $count = mysqli_num_rows($query);
                  while ($row = mysqli_fetch_assoc($query)):
                    $id = $row['id_kriteria'];
                 ?>
              <tr>
                <td><b><?= $row['kriteria'] ?></b></td>
                <?php 
                  for ($y=1; $y<=$count ; $y++):
                 ?>
                  <?php 
                    if ($y==$x) {
                      echo "<td><input type='number' name='nilai$x$y' value='1' class='form-control' readonly></td>";
                      echo "<input type='hidden' name='position$x$y' value='$x-$y'>";
                      echo "<input type='hidden' name='id$x$y' value='$id'>";
                    } else {
                      if ($y < $x) {
                        echo "<td><input type='number' name='nilai$x$y' class='form-control' readonly></td>";  //disabled
                        echo "<input type='hidden' name='position$x$y' value='$x-$y'>";
                        echo "<input type='hidden' name='id$x$y' value='$id'>";
                      } else  {
                        echo "<td><input type='number' name='nilai$x$y' class='form-control'></td>";
                        echo "<input type='hidden' name='position$x$y' value='$x-$y'>";
                        echo "<input type='hidden' name='id$x$y' value='$id'>";
                      }
                    }
                   ?>
                <?php endfor; ?>
              </tr>
              <?php 
                $x++; 
                endwhile; 
              ?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="<?= $count + 1 ?>" align="right">
                  <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                </td>
              </tr>
            </tfoot>
          </table>
        </form>
    <?php else: ?>
      <table class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Kriteria</th>
              <?php 
                $sql = "select * from kriteria";
                $query = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_assoc($query)):
               ?>
              <th><?= $row['kriteria'] ?></th>
              <?php endwhile; ?>
            </tr>
            </thead>
            <tbody>
              <?php 
                  $x = 1;
                  $sql = "select * from kriteria";
                  $query = mysqli_query($con, $sql);
                  $count = mysqli_num_rows($query);
                  while ($row = mysqli_fetch_assoc($query)):
                 ?>
              <tr>
                <td><b><?= $row['kriteria'] ?></b></td>
                <?php 
                  for ($y=1; $y<=$count ; $y++):
                    $sql = "select * from nilai_kriteria where baris='$x' and kolom='$y'";
                    $query2 = mysqli_query($con, $sql);
                    $data = mysqli_fetch_assoc($query2);
                 ?>
                  <td><?= round($data['nilai'], 3) ?></td>
                <?php endfor; ?>
              </tr>
              <?php 
                $x++; 
                endwhile; 
              ?>
              </tbody>

              <tfoot>
                <tr>
                  <td>Total</td>
                  <?php 
                      $i = 1;
                      $sql = "SELECT SUM(nilai) as nilai FROM `nilai_kriteria` GROUP BY kolom";
                      $query = mysqli_query($con, $sql);
                      while ($row = mysqli_fetch_assoc($query)):
                   ?>
                   <td><?= round($row['nilai'], 3) ?></td>
                  <?php $i++; endwhile; ?>
                </tr>
                <tr>
                  <td colspan="<?= ($count+1) ?>" align="right">
                    <a href="index.php?p=bobot&delete" class="btn btn-danger" onclick="return confirm('Semua nilai akan terhapus, Ingin melanjutkan?')">Hapus</a>
                  </td>
                </tr>
              </tfoot>
            
          </table>
    <?php endif; ?>
        

        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->