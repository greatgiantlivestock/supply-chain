<?php
    // if ($folder = opendir('../interface/From/')) {
    if ($folder = opendir('../interface/From/')) {
        while (false !== ($file = readdir($folder))) {
            if ($file != "." && $file != "..") {
                $trim = substr($file,0,2);
                if($trim =="MR"){
                    // $fh = fopen('../interface/From/'.$file,'r');
                    $fh = fopen('../interface/From/'.$file,'r');
                    $linecount=0;
                    $cn = mysqli_connect("localhost","homt3248_ms","moha11mmad","homt3248_supplychain");
                    while ($line = fgets($fh)) {
                        if(strlen($line)>100){
                            $nama_rph = trim(substr($line,0,12));
                            $kota = substr($line,12,12);
                            $alamat = substr($line,24,40);
                            $trim_line = substr($line,0,1);
                            if($trim_line == 'R'){
                                $jenis_rph = 'RPH';
                            }else if($trim_line == 'D'){
                                $jenis_rph = 'Depot';
                            }
                            $qjmlHd = "SELECT count(*) as jml FROM mst_rph WHERE nama_rph='$nama_rph'";
                            $ExecQ = mysqli_query($cn,$qjmlHd);
                            $row = mysqli_fetch_assoc($ExecQ);
                            $jml = $row['jml']; 
                            $resultHd="";
                            if($jml == 0){
                                $sql1 = "INSERT INTO mst_rph(nama_rph,kota,alamat,koordinat,jenis_rph,jenis_berat)
                                        values ('$nama_rph','$kota','$alamat','','$jenis_rph',0)";
                                $resultHd = mysqli_query($cn,$sql1);
                            }else{
                                $sql2 = "UPDATE mst_rph SET nama_rph='$nama_rph',kota='$kota',alamat='$alamat',koordinat='',jenis_rph='$jenis_rph',jenis_berat=0";
                                $resultHd = mysqli_query($cn,$sql2);
                            }
                            if ($resultHd) {
                                $linecount++;
                            }   
                        }
                    }
                    if($linecount != 0){
                        echo "Success";
                        $sebelum = "../interface/From/".$file;
                        $sesudah = "../interface/Backup/".$file;
                        echo copy($sebelum, $sesudah);
                        if (!copy($sebelum, $sesudah)) {
                            echo " File gagal dipindahkan ke folder backup";
                        }else{
                            echo " File sukses dipindahkan di folder backup";
                            unlink($sebelum);
                        }
                    }else{
                        echo "Gagal";
                    }
                    fclose($fh);
                }
            }
        }
        closedir($folder);
    }
?>