<?php
    // if ($folder = opendir('.../interface/From/')) {
    if ($folder = opendir('../interface/From/')) {
        while (false !== ($file = readdir($folder))) {
            if ($file != "." && $file != "..") {
                $trim = substr($file,0,2);
                if($trim =="CM"){
                    // $fh = fopen('.../interface/From/'.$file,'r');
                    $fh = fopen('../interface/From/'.$file,'r');
                    $linecount=0;
                    $linecount1=0;
                    $cn = mysqli_connect("localhost","homt3248_ms","moha11mmad","homt3248_supplychain");
                    while ($line = fgets($fh)) {
                        if(strlen($line)>275){
                            $beast_id = substr($line,0,12);
                            $visual_tag = substr($line,12,10);
                            $lot = substr($line,22,10);
                            $rfid = substr($line,32,20);
                            $tanggal_kirim = substr($line,58,8);
                            $tanggal_kirim_ = date("Y-m-d", strtotime($tanggal_kirim));
                            $curweight = substr($line,66,8);
                            $nota = substr($line,74,10);
                            $abattoir_code = substr($line,84,10);
                            $abbatoir = trim(substr($line,94,35));
                            $cust = substr($line,139,35);
                            $matdesc = substr($line,186,30);
                            $no_kendaraan = substr($line,216,14);
                            $shipping_point = trim(substr($line,230,18));
                            $jam_kirim = substr($line,52,6);
                            $jam_kirim_ = date("H:i:s", strtotime($jam_kirim));
                            $session = substr($line,248,15);
                            $type_exit = substr($line,263,2);
                            $exporter = substr($line,275,35);
                            $qjmlAsal = "SELECT count(*) as jml FROM asal_sapi WHERE asal_sapi='$shipping_point'";
                            $ExecQAsal = mysqli_query($cn,$qjmlAsal);
                            $rowAsal = mysqli_fetch_assoc($ExecQAsal);
                            $jmlAsal = $rowAsal['jml']; 
                            if($jmlAsal==0){
                                $sqlAsal = "INSERT INTO asal_sapi(asal_sapi)
                                            values ('$shipping_point')";
                                    $resultAsal = mysqli_query($cn,$sqlAsal);
                            }
                            $qjmlHd = "SELECT count(*) as jml FROM pengiriman WHERE no_pengiriman='$nota'";
                            $ExecQ = mysqli_query($cn,$qjmlHd);
                            $row = mysqli_fetch_assoc($ExecQ);
                            $jml = $row['jml']; 
                            $resultHd="";
                            if($jml == 0){
                                $qRPH = "SELECT id_rph FROM mst_rph WHERE nama_rph like '%$abbatoir%'";
                                $ExecQ1 = mysqli_query($cn,$qRPH);
                                $row1 = mysqli_fetch_assoc($ExecQ1);
                                $id_rph = $row1['id_rph'];
                                if($id_rph==''){
                                    $sqlRph = "INSERT INTO mst_rph(abattoir,nama_rph,jenis_rph,jenis_berat)
                                            values ('$abattoir_code','$abbatoir','Belum Didefinisikan','0')";
                                    $resultRph = mysqli_query($cn,$sqlRph);
                                    $qRPH1 = "SELECT id_rph FROM mst_rph WHERE nama_rph like '%$abbatoir%'";
                                    $ExecQ11 = mysqli_query($cn,$qRPH1);
                                    $row11 = mysqli_fetch_assoc($ExecQ11);
                                    $id_rph1 = $row11['id_rph'];
                                    $movement_number = "Log".".".$id_rph1.".".date("ymd").date("Hi");
                                    $sql1 = "INSERT INTO pengiriman(id_rph,no_pengiriman,tanggal_kirim,jam_kirim,keterangan,status_terima,tanggal_terima,jam_terima,keterangan_terima,konfirmasi)
                                            values ('$id_rph1','$nota','$tanggal_kirim_','$jam_kirim_','','0','','','','0')";
                                    $resultHd = mysqli_query($cn,$sql1);
                                    $qPengiriman1 = "SELECT id_pengiriman FROM pengiriman WHERE no_pengiriman ='$nota'";
                                    $ExecQ21 = mysqli_query($cn,$qPengiriman1);
                                    $row21 = mysqli_fetch_assoc($ExecQ21);
                                    $id_pengiriman1 = $row21['id_pengiriman'];
                                    $sql3 = "INSERT INTO movement_log(id_pengiriman_transit,id_pengiriman,move_from,asal_sapi,abattoir,move_to,move_time,movement_number,user)
                                            values ('$id_pengiriman1','$id_pengiriman1','$shipping_point','$shipping_point','$abattoir_code','$abbatoir','$tanggal_kirim_ $jam_kirim_','$movement_number','Interface SAP')";
                                    $resultMove_log = mysqli_query($cn,$sql3);
                                }else{
                                    $movement_number = "Log".".".$id_rph.".".date("ymd").date("Hi"); 
                                    $sql1 = "INSERT INTO pengiriman(id_rph,no_pengiriman,tanggal_kirim,jam_kirim,keterangan,status_terima,tanggal_terima,jam_terima,keterangan_terima,konfirmasi)
                                            values ('$id_rph','$nota','$tanggal_kirim_','$jam_kirim_','','0','','','','0')";
                                    $resultHd = mysqli_query($cn,$sql1);
                                    $qPengiriman1 = "SELECT id_pengiriman FROM pengiriman WHERE no_pengiriman ='$nota'";
                                    $ExecQ21 = mysqli_query($cn,$qPengiriman1);
                                    $row21 = mysqli_fetch_assoc($ExecQ21);
                                    $id_pengiriman1 = $row21['id_pengiriman'];
                                    $sql3 = "INSERT INTO movement_log(id_pengiriman_transit,id_pengiriman,move_from,asal_sapi,abattoir,move_to,move_time,movement_number,user)
                                            values ('$id_pengiriman1','$id_pengiriman1','$shipping_point','$shipping_point','$abattoir_code','$abbatoir','$tanggal_kirim_ $jam_kirim_','$movement_number','Interface SAP')";
                                    $resultMove_log = mysqli_query($cn,$sql3);
                                }
                                $qcekrfid = "SELECT count(*) as jml FROM pengiriman_detail WHERE beast_id='$beast_id'";
                                $ExecQ3 = mysqli_query($cn,$qcekrfid);
                                $row3 = mysqli_fetch_assoc($ExecQ3);
                                $jml3 = $row3['jml']; 
                                $resultDt="";
                                $qPengiriman = "SELECT id_pengiriman FROM pengiriman WHERE no_pengiriman ='$nota'";
                                $ExecQ2 = mysqli_query($cn,$qPengiriman);
                                $row2 = mysqli_fetch_assoc($ExecQ2);
                                $id_pengiriman = $row2['id_pengiriman'];
                                if($jml3 == 0){
                                    $sql2 = "INSERT INTO pengiriman_detail(id_pengiriman,nota,eartag,shipment,material_description,beast_id,rfid,berat,customer,no_kendaraan,status_terima,session,type_exit,exporter)
                                            values ($id_pengiriman,'$nota','$visual_tag','$lot','$matdesc','$beast_id','$rfid','$curweight','$cust','$no_kendaraan',0,'$session','$type_exit','$exporter')";
                                    $resultDt = mysqli_query($cn,$sql2);
                                }else{
                                    $qConfirmTerm = "SELECT count(*)as jml,tanggal_terima,jam_terima FROM pengiriman JOIN pengiriman_detail ON pengiriman.id_pengiriman=pengiriman_detail.id_pengiriman WHERE pengiriman_detail.beast_id='$beast_id' AND pengiriman_detail.status_terima='1'";
                                    $ExqConfirmTerm = mysqli_query($cn,$qConfirmTerm);
                                    $rowConfirmTerm = mysqli_fetch_assoc($ExqConfirmTerm);
                                    $nilai = $rowConfirmTerm['jml'];
                                    if($nilai>0){
                                        $tanggal1=$rowConfirmTerm['tanggal_terima'];
                                        $jam1=$rowConfirmTerm['jam_terima'];
                                        $qUpdTglPgrmn = "UPDATE pengiriman SET status_terima='1',tanggal_terima='$tanggal1',jam_terima='$jam1' WHERE id_pengiriman='$id_pengiriman'";
                                        $exc=mysqli_query($cn,$qUpdTglPgrmn);
                                    }
                                    $qBeastPrgimn = "UPDATE pengiriman_detail set id_pengiriman='$id_pengiriman',nota='$nota' WHERE beast_id='$beast_id'";
                                    $xqBeastPrgimn = mysqli_query($cn,$qBeastPrgimn);
                                    $qcekrfidPnrn = "SELECT count(*) as jml FROM penerimaan_detail WHERE beast_id='$beast_id'";
                                    $ExecQ3Pnrn = mysqli_query($cn,$qcekrfidPnrn);
                                    $row3Pnrn = mysqli_fetch_assoc($ExecQ3Pnrn);
                                    $jml3Pnrn = $row3Pnrn['jml']; 
                                    if($jml3Pnrn>0){
                                        $qBeastPnrimn = "UPDATE penerimaan_detail set id_pengiriman='$id_pengiriman',nota='$nota' WHERE beast_id='$beast_id'";
                                        $xqBeastPnrimn = mysqli_query($cn,$qBeastPnrimn);
                                    }
                                }
                            }else{
                                $qcekSapi = "SELECT count(*) as jml FROM pengiriman_detail WHERE beast_id ='$beast_id'";
                                $ExecQSapi = mysqli_query($cn,$qcekSapi);
                                $rowSapi = mysqli_fetch_assoc($ExecQSapi);
                                $jmlSapi = $rowSapi['jml'];
                                if($jmlSapi==0){
                                    //insert detail pengiriman disini
                                    $qPengiriman = "SELECT id_pengiriman FROM pengiriman WHERE no_pengiriman ='$nota'";
                                    $ExecQ2 = mysqli_query($cn,$qPengiriman);
                                    $row2 = mysqli_fetch_assoc($ExecQ2);
                                    $id_pengiriman = $row2['id_pengiriman'];
                                    $sql2 = "INSERT INTO pengiriman_detail(id_pengiriman,nota,eartag,shipment,material_description,beast_id,rfid,berat,customer,no_kendaraan,status_terima,session,type_exit,exporter)
                                            values ($id_pengiriman,'$nota','$visual_tag','$lot','$matdesc','$beast_id','$rfid','$curweight','$cust','$no_kendaraan',0,'$session','$type_exit','$exporter')";
                                    $resultDt = mysqli_query($cn,$sql2);
                                }else{
                                    $qPengiriman1 = "SELECT id_pengiriman FROM pengiriman WHERE no_pengiriman ='$nota'";
                                    $ExecQ21 = mysqli_query($cn,$qPengiriman1);
                                    $row21 = mysqli_fetch_assoc($ExecQ21);
                                    $id_pengiriman1 = $row21['id_pengiriman'];
                                    $qConfirmTerm = "SELECT count(*)as jml,tanggal_terima,jam_terima FROM pengiriman JOIN pengiriman_detail ON pengiriman.id_pengiriman=pengiriman_detail.id_pengiriman WHERE pengiriman_detail.beast_id='$beast_id' AND pengiriman_detail.status_terima='1'";
                                    $ExqConfirmTerm = mysqli_query($cn,$qConfirmTerm);
                                    $rowConfirmTerm = mysqli_fetch_assoc($ExqConfirmTerm);
                                    $nilai = $rowConfirmTerm['jml'];
                                    if($nilai>0){
                                        $tanggal1=$rowConfirmTerm['tanggal_terima'];
                                        $jam1=$rowConfirmTerm['jam_terima'];
                                        $qUpdTglPgrmn = "UPDATE pengiriman SET status_terima='1',tanggal_terima='$tanggal1',jam_terima='$jam1' WHERE id_pengiriman='$id_pengiriman1'";
                                        $exc=mysqli_query($cn,$qUpdTglPgrmn);
                                    }
                                    $qBeastPrgimn = "UPDATE pengiriman_detail set id_pengiriman='$id_pengiriman1',nota='$nota' WHERE beast_id='$beast_id'";
                                    $xqBeastPrgimn = mysqli_query($cn,$qBeastPrgimn);
                                    $qcekrfidPnrn = "SELECT count(*) as jml FROM penerimaan_detail WHERE beast_id='$beast_id'";
                                    $ExecQ3Pnrn = mysqli_query($cn,$qcekrfidPnrn);
                                    $row3Pnrn = mysqli_fetch_assoc($ExecQ3Pnrn);
                                    $jml3Pnrn = $row3Pnrn['jml']; 
                                    if($jml3Pnrn>0){
                                        $qBeastPnrimn = "UPDATE penerimaan_detail set id_pengiriman='$id_pengiriman1',nota='$nota' WHERE beast_id='$beast_id'";
                                        $xqBeastPnrimn = mysqli_query($cn,$qBeastPnrimn);
                                    }
                                } 
                            }
                            if ($resultHd) {
                                $linecount++;
                            }   
                            if ($resultDt) {
                                $linecount1++;
                            }   
                        }
                    }
                    if($linecount != 0 || $linecount1 != 0){
                        echo "Interface Success";
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