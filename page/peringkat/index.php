<?php 

  $sql =  "update alternatif set lihat = '1'";
  mysqli_query($con, $sql);


 ?>

<div class="row">
    <div class="col-xs-12">

                  <?php 
                        $nilaibobot = [];
                        $x = 1;
                        $sql = "select * from kriteria";
                        $query = mysqli_query($con, $sql);
                        $count = mysqli_num_rows($query);
                        for ($i=1; $i <= $count; $i++) { 
                          $nilaibobot[$i] = 0;
                        }
                        while ($row = mysqli_fetch_assoc($query)) {

                        for ($y=1; $y <=$count ; $y++) { 
                          $sql = "select * from nilai_kriteria where baris='$x' and kolom='$y'";
                          $query2 = mysqli_query($con, $sql);
                          $data = mysqli_fetch_assoc($query2);
                          if ($data['nilai'] == 1){
                            // echo "<td>1</td>";
                          }
                          else{
                            $b = 0;
                            $c = 0;
                            $d = 0;
                            if ($data['kolom'] >= $x){
                              if ($data['nilai'] == 1) {
                                $b = 1;
                                $d = 1;
                              } else {
                                $b = $data['nilai'] - 1;
                                $d = $data['nilai'] + 1;
                              }
                              $c = $data['nilai'];
                            }else {
                              $c = round($data['nilai'], 2);
                              $sql3 = "select * from nilai_kriteria where baris='$data[kolom]' and kolom='$data[baris]'";
                              $query3 = mysqli_query($con, $sql3);
                              $fetch3 = mysqli_fetch_assoc($query3);
                              $nilai3 = 1;
                              $nilai4 = 1;
                              if ($fetch3['nilai'] != 1){
                                $nilai3 = $fetch3['nilai'] + 1;
                                $nilai4 = $fetch3['nilai'] - 1;
                              }

                              $nilai3 = round(1/$nilai3, 2);
                              $nilai4 = round(1/$nilai4, 2);
                              $b = $nilai3;
                              $d = $nilai4;
                            }
                            $bobot = round($b-$d/($c-$d)-($c-$b), 2);
                            // echo "<td>$b-$d ($c-$d)-($c-$b) </td>";
                            $nilaibobot[$y] = $bobot + $nilaibobot[$y];
                            // echo "<td>$bobot</td>";                            

                          }
                        }
                        $x++;
                      }
                     ?>
                    <?php 
                      $totalbobot = [];
                        for ($i=1; $i<=$count; $i++)
                          $totalbobot[$i] = 0;

                        $x = 1;
                        for ($i=1; $i <= $count ; $i++) { 
                          $nilai = $nilaibobot[$i];
                          $nilai=round(($nilai+1)/$count, 2);
                          $totalbobot[$i] = $nilai;
                          // echo "<th>$nilai</th>";
                        }
                     ?>
                  
        

      <div class="box box-primary box-solid">
          <div class="box-header with-border">
            <h3 class="box-title"> Nilai</h3>
              <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div><!-- /.box-tools -->
          </div>

            <div class="box-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                  <?php
                  $sql = "select * from kriteria";
                  $query = mysqli_query($con, $sql);
                  ?>
                    <tr>
                        <th>No</th>
                        <!-- <th>Nama</th> -->
                        <th>Alternatif</th>
                       <?php while($row = mysqli_fetch_array($query)) {?>
                            <th><?php echo $row['kriteria']; ?></th>
                      <?php
                            }?>
                    </tr>

                    <?php 
                      $no = 0;
                      $sql = "select * from alternatif inner join cabai on alternatif.id_cabai = cabai.id_cabai";
                      $query = mysqli_query($con, $sql);
                      while ($row = mysqli_fetch_assoc($query)):
                        $no++;
                     ?>
                    <tr>
                      <td><?= $no ?></td>
                      <!-- <td><?= $row['nama'] ?></td> -->
                      <td><?= $row['nama_cabai'] ?></td>
                      <?php
                        $sql2 = "select * from kriteria";
                        $query2 = mysqli_query($con, $sql2);
                        while ($row2 = mysqli_fetch_assoc($query2)) {
                          $sql3 = "select * from nilai_alternatif where id_alternatif='$row[id_alternatif]' and id_kriteria='$row2[id_kriteria]'";
                          $query3 = $con->query($sql3);
                          $fetch = mysqli_fetch_array($query3);
                          echo "<td>$fetch[nilai]</td>";
                        }
                        ?>  
                    </tr>
                    <?php endwhile; ?>
                </thead>
                <tbody>
                  
                </tbody>
              </table>
            </div>
      </div>

      <div class="box box-primary box-solid">
          <div class="box-header with-border">
            <h3 class="box-title"> Ranking</h3>
              <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div><!-- /.box-tools -->
          </div>

            <div class="box-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                  <?php
                  $sql = "select * from kriteria";
                  $query = mysqli_query($con, $sql);
                  ?>
                    <tr>
                        <th>No</th>
                        <!-- <th>Nama</th> -->
                        <th>Alternatif</th>
                       <?php while($row = mysqli_fetch_array($query)) {?>
                            <th><?php echo $row['kriteria']; ?></th>
                      <?php
                            }?>
                          <th>Total</th>
                    </tr>

                </thead>
                <tbody>
                  <?php 
                        $ranking = 0;
                        $nama = "";
                      $no = 0;
                      $sql = "select * from alternatif inner join cabai on alternatif.id_cabai = cabai.id_cabai";
                      $query = mysqli_query($con, $sql);
                      while ($row = mysqli_fetch_assoc($query)):
                        $no++;
                     ?>
                    <tr>
                      <td><?= $no ?></td>
                      <!-- <td><?= $row['nama'] ?></td> -->
                      <td><?= $row['nama_cabai'] ?></td>
                      <?php
                        $y = 1;
                        $total = 0;
                        $sql2 = "select * from kriteria";
                        $query2 = mysqli_query($con, $sql2);
                        while ($row2 = mysqli_fetch_assoc($query2)) {
                          $sql3 = "select * from nilai_alternatif where id_alternatif='$row[id_alternatif]' and id_kriteria='$row2[id_kriteria]'";
                          $query3 = $con->query($sql3);
                          $fetch = mysqli_fetch_array($query3);
                          $nilai = $fetch['nilai']*$totalbobot[$y];
                          $total = $total + $nilai;


                          echo "<td>$nilai</td>";
                          $y++;
                        }
                        ?>  
                        <td>
                          <?php 
                            $hasil = round($total/$count, 2) ;
                            echo $hasil;

                            if ($hasil > $ranking) {
                                $ranking = $hasil;
                                $nama = $row['nama_cabai'];
                             }
                            ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>                  
                </tbody>
                <tfoot>
                  <tr>
                    <th colspan="<?= $count+4 ?>" class="text-center">Rangking pertama diraih oleh <?= $nama ?> dengan perolehan total <?= $ranking ?></th>
                  </tr>
                </tfoot>
              </table>
            </div>
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->