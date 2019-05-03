<?php 

  if (isset($_POST['simpan'])) {

    echo "<script>window.location.href='index.php?p=alternatif&d=$_POST[dataran]'</script>";
  }

 ?>

<div class="row">
    <!-- left column -->
    <div class="col-md-8">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Pilih Dataran Wilayah</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Dataran</label>
              <select name="dataran" class="form-control">
                <option value="">-- Pilih Dataran --</option>
                <option value="rendah">Rendah (0-200 Mdpl)</option>
                <option value="sedang">Sedang (201-499 Mdpl)</option>
                <option value="tinggi">Tinggi (500-1500 Mdpl)</option>
              </select>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary" name="simpan">Pilih</button>
            <!-- <a href="#" class="right btn btn-primary">Lihat rangking</a> -->
          </div>
        </form>
      </div>
      <!-- /.box -->


    <?php  
      $sql = "select * from alternatif";
      $query = mysqli_query($con, $sql);
      $data = mysqli_fetch_assoc($query);
      $row = mysqli_num_rows($query);

      if ($row > 0 && $data['lihat'] == '0') {
    ?>

    <a href="index.php?p=rank" class="btn btn-primary">Lihat Ranking</a>

    <?php 
      } else if($data['lihat'] == '1'){

        $sql = "TRUNCATE TABLE alternatif;";
        $query = mysqli_query($con, $sql);
        if ($query){
          $sql = "TRUNCATE TABLE nilai_alternatif;";
          $query = mysqli_query($con, $sql);
          if ($query){
            echo "Data telah direset ulang";
          } else {
            echo mysqli_error($con);
          }
        }
        else
          echo mysqli_error($con);
      }

    ?>

    </div>
    <!--/.col (left) -->
    
  </div>
  <!-- /.row -->