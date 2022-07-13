 <title>Sales University - Print Transkrip</title>
 <?php
    $path = base_url("assets/img/cover.png");
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    ?>
 <img src="<?php echo $base64 ?>" style="width:100%" />
 <h4 style="text-align: center;">TRANSKRIP NILAI</h4>
 <table class="table" style="margin-bottom:5px ; width:100%;">
     <tbody>
         <tr>
             <td scope="row" class="noBorder text-center">Nama</td>
             <td class="noBorder"> : </td>
             <td class="noBorder"><?= $user->nama ?> </td>
         </tr>
         <tr>
             <td scope="row" class="noBorder text-center">NIS</td>
             <td class="noBorder"> : </td>
             <td class="noBorder"><?= $user->nis ?></td>
         </tr>
         <tr>
             <td scope="row" class="noBorder text-center">Tanggal Lahir</td>
             <td class="noBorder"> : </td>
             <?php
                $ttl = date_create($user->ttl);
                ?>
             <td class="noBorder"><?= date_format($ttl, 'd F Y')  ?></td>
         </tr>
     </tbody>
 </table>
 <hr>
 <table class="table" style="margin-bottom:5px ;">
     <tbody>
         <tr>
             <td class="noBorder">Absensi</td>
             <td class="noBorder"> : </td>
             <td class="noBorder"><?= $absen ?>/<?= $total_absen ?></td>
         </tr>
         <tr>
             <td scope="row" class="noBorder text-center">Ketepatan Absen</td>
             <td class="noBorder"> : </td>
             <?php
                if ($total_absen <= 0) $total_absen = 1;
                $ketepatan  = ($akurasi->akurasi / $total_absen); ?>
             <td class="noBorder"><?= $ketepatan ?>%</td>
         </tr>
     </tbody>
 </table>

 <style type="text/css">
     .tg {
         border-collapse: collapse;
         border-color: #9ABAD9;
         border-spacing: 0;
         width: 100%;
         text-align: center;
     }

     .tg td {
         background-color: #EBF5FF;
         border-color: #9ABAD9;
         border-style: solid;
         border-width: 1px;
         color: #444;
         font-family: Arial, sans-serif;
         font-size: 14px;
         overflow: hidden;
         padding: 10px 5px;
         word-break: normal;
         text-align: center;
     }

     .tg th {
         background-color: #409cff;
         border-color: #9ABAD9;
         border-style: solid;
         border-width: 1px;
         color: #fff;
         font-family: Arial, sans-serif;
         font-size: 14px;
         font-weight: normal;
         overflow: hidden;
         padding: 10px 5px;
         word-break: normal;

     }

     .tg .tg-jpc1 {
         font-size: 10px;
         text-align: left;
         vertical-align: top;
         text-align: center;
     }

     .tg .tg-0lax {
         text-align: left;
         vertical-align: top;
         text-align: center;
     }
 </style>
 <table class="tg">
     <thead>
         <tr>
             <th class="tg-0lax">No</th>
             <th class="tg-0lax">Semester</th>
             <th class="tg-0lax">Kode Course</th>
             <th class="tg-0lax">Course</th>
             <th class="tg-0lax">Nilai</th>
             <th class="tg-0lax">Grade</th>
         </tr>
     </thead>
     <tbody>
         <?php
            $no = 1;
            foreach ($transkrip as $t) { ?>
             <tr>
                 <td class="tg-0lax"><?= $no++ ?></td>
                 <td class="tg-0lax"><?= $t->id_semester ?></td>
                 <td class="tg-0lax"><?= $t->kode_mapel ?></td>
                 <td class="tg-0lax"><?= $t->nama_mapel ?></td>
                 <td class="tg-0lax"><?= $t->nilai_final ?></td>
                 <?php foreach ($mutu as $mu) { ?>
                     <?php
                        $pisah = explode("-", $mu->nilai);
                        ?>
                     <?php if ($t->nilai_final >= $pisah[0] && $t->nilai_final <= $pisah[1]) { ?>
                         <td class="tg-0lax"><b style="color: black;"><?= $mu->mutu ?></b></td>
                     <?php
                            break;
                        } ?>
                 <?php } ?>
             </tr>
         <?php  } ?>
     </tbody>
 </table>