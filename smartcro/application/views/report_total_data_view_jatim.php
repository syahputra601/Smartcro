<html>
<head>
    <title>Preview Report Total Data Call</title>
    <link rel='stylesheet' href='https://s3-us-west-2.amazonaws.com/s.cdpn.io/5028/basics_3.css'>
    <!-- <link rel="stylesheet" href="./style.css"> -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>css_report/responsive_table_1/style.css">
    <style>
    .tableFixHead thead th { position: sticky; top: 0; z-index: 1; }
    </style>
</head>
<body style="width: 100%;">
<!-- <center>
  <?= @$case_all_area ?>
</center> -->
<?php
if(@$case_per_area == '1'){//jika hanya per Area saja
?>
<center>
<h1 style="text-align: center;">REPORT DATA TELEPON PERHARI</h1>
  <?= @$year.'-'.@$month ?>
</center>
<br>
<?php
}
?>
<!-- style="padding-left: 5%; padding-right: 5%;" -->
<?php
// echo @$getDay;
$sumHeaderTitle = $getDay + 4;
$joinYearMonth = $year.'-'.$month.'-';
$dateLocalHoliday = '2021-05-02';
// echo "<br>";
$checkHoliday = base_url().'C_cro/checkHoliday/'.$dateLocalHoliday;
// $ctrl_test_holiday = $controller->checkHoliday($dateLocalHoliday);
// echo "<br>";
$CI =& get_instance();
// $x = $this->CI->checkHoliday($dateLocalHoliday);
$CI->load->library('MyLibrary');
$LibraryMy = new MyLibrary();
// $perfil_usuario = $usuario->nama_kamu('Aji');
$test_MyLibrary = array($LibraryMy->ary_test($dateLocalHoliday));
// print_r($test_MyLibrary[0]['holiday']);//to call libaray in view in CI PHP
// print_r($ctrl_test_holiday);
// echo "<br>";
$test_MyLibrary2 = array($LibraryMy->getHoliday($dateLocalHoliday));
// print_r($test_MyLibrary2[0]['id']);
?>
<div >
    <div>
        <div class="tableFixHead">
    	<table class="responsive-table" style="width: 100%; height: 100%; display: block; overflow-x: scroll; white-space: nowrap;">
            <thead>
    		<tr>
    			<th colspan="<?= @$sumHeaderTitle ?>" style="text-align: center; background-color: #ADD8E6;">
    				<b>Bulan <?= @$nameMonth ?> <?= @$year ?></b>
    			</th>
    		</tr>
            <tr style="background-color: #ADD8E6;">
    			<th>KOTA AREA</th>
    			<th>CABANG AREA</th>
    			<th>SURVEY(Sales/Service)</th>
    			<?php
    			for ($i=1; $i <= $getDay; $i++) { 
                if($i <= 9){
                    $i = '0'.$i;
                }else{
                    $i = $i;
                }
    			?>
    			<th><?= @$i.'-'.@$nameMonth ?></th>
    			<?php
    			}
    			?>
    			<th>Total</th>
    		</tr>
            </thead>
    		<tr>
    			<td rowspan="4">JATIM</td>
    			<td rowspan="2">SMART PUCANG</td>
    			<td>Sales</td>
    			<?php
    			for ($i=1; $i <= $getDay; $i++) { 
                if($i <= 9){
                    $i = '0'.$i;
                }else{
                    $i = $i;
                }
                $joinLoopDate = $joinYearMonth.$i;
                $MyLibraryHoliday_PCNG = array($LibraryMy->getHoliday($joinLoopDate));
                // $GetDataCountPerDate_JKT = $this->db->query("SELECT count(*) AS total_per_date FROM tb_hedsurv AS a WHERE a.tipe_cust = '1' AND a.id_respon = '6' AND a.tgl_telp = '".$joinLoopDate."' ")->result();
                $GetDataCountPerDate_PCNG = $this->db->query("SELECT count(*) AS total_per_date FROM tb_hedsurv AS a INNER JOIN tb_surv AS b ON a.id_surv=b.id_surv WHERE a.tipe_cust = '1' AND a.id_respon = '6' AND a.tgl_telp = '".$joinLoopDate."' AND b.id_comp = '4' ")->result();
                foreach ($GetDataCountPerDate_PCNG as $row_total_pcng) {
                    $GetTotalPerPCNG = $row_total_pcng->total_per_date;
                }
                if($GetTotalPerPCNG <= 0 || $GetTotalPerPCNG == ''){
                    $TotalPerDatePCNG = '0';
                }else{
                    $TotalPerDatePCNG = $GetTotalPerPCNG;
                }
                $ParentTotalSales_Right_PCNG[] = $TotalPerDatePCNG;
                // echo $this->db->last_query();
                $ArySubSalesTotal_PCNG[] = $TotalPerDatePCNG;
                array_unshift($ArySubSalesTotal_PCNG,"");
                unset($ArySubSalesTotal_PCNG[0]);
                if($MyLibraryHoliday_PCNG[0]['id'] == '0'){//jika hari libur pada hari sabtu/minggu
                ?>
                <td style="background-color: red;"><label><?= @$TotalPerDatePCNG ?></label></td>
                <?php
                }else{//jika bukan hari libur
                    if(@$TotalPerDatePCNG != '0' || @$TotalPerDatePCNG > 0){//warna kuning
                    ?>
                    <td style="background-color: yellow;"><label><?= @$TotalPerDatePCNG ?></label></td>
                    <?php
                    }else{//warna putih
                    ?>
                    <td style=""><label><?= @$TotalPerDatePCNG ?></label></td>
                    <?php
                    }
                }
    			?>
    			<!-- <td><input type="text" name="tgl" value="<?= @$i ?>"></td> -->
    			<?php
    			}
                $ArySumTotalSalesRight_PCNG = array_sum($ParentTotalSales_Right_PCNG);
    			?>
    			<td>
                    <?= @$ArySumTotalSalesRight_PCNG ?>
                    <?php
                    // print_r($ArySubSalesTotal_JKT);
                    // echo ' || ';
                    // $joinAryTest = array($ArySubSalesTotal_JKT, $ArySubSalesTotal_JKT);
                    // $sum = array_sum(array_column($joinAryTest, 21));
                    // print_r($sum);
                    ?>
                </td>
    		</tr>
    		<tr>
    			<td>Service</td>
    			<!-- <td></td>
    			<td></td> -->
    			<?php
    			for ($i=1; $i <= $getDay; $i++) { 
                if($i <= 9){
                    $i = '0'.$i;
                }else{
                    $i = $i;
                }
                $joinLoopDate = $joinYearMonth.$i;
                $MyLibraryHoliday_PCNG = array($LibraryMy->getHoliday($joinLoopDate));
                // $GetDataCountPerDate_JKT = $this->db->query("SELECT count(*) AS total_per_date FROM tb_hedsurv AS a WHERE a.tipe_cust = '1' AND a.id_respon = '6' AND a.tgl_telp = '".$joinLoopDate."' ")->result();
                $GetDataCountPerDate_PCNG = $this->db->query("SELECT count(*) AS total_per_date FROM tb_hedsurv AS a INNER JOIN tb_surv AS b ON a.id_surv=b.id_surv WHERE a.tipe_cust = '2' AND a.id_respon = '6' AND a.tgl_telp = '".$joinLoopDate."' AND b.id_comp = '4' ")->result();
                foreach ($GetDataCountPerDate_PCNG as $row_total_pcng) {
                    $GetTotalPerPCNG = $row_total_pcng->total_per_date;
                }
                if($GetTotalPerPCNG <= 0 || $GetTotalPerPCNG == ''){
                    $TotalPerDatePCNG = '0';
                }else{
                    $TotalPerDatePCNG = $GetTotalPerPCNG;
                }
                $ParentTotalService_Right_PCNG[] = $TotalPerDatePCNG;
                // echo $this->db->last_query();
                $ArySubServiceTotal_PCNG[] = $TotalPerDatePCNG;
                array_unshift($ArySubServiceTotal_PCNG,"");
                unset($ArySubServiceTotal_PCNG[0]);
                if($MyLibraryHoliday_PCNG[0]['id'] == '0'){//jika hari libur pada hari sabtu/minggu
                ?>
                <td style="background-color: red;"><label><?= @$TotalPerDatePCNG ?></label></td>
                <?php
                }else{//jika bukan hari libur
                    if(@$TotalPerDatePCNG != '0' || @$TotalPerDatePCNG > 0){//warna kuning
                    ?>
                    <td style="background-color: yellow;"><label><?= @$TotalPerDatePCNG ?></label></td>
                    <?php
                    }else{//warna putih
                    ?>
                    <td style=""><label><?= @$TotalPerDatePCNG ?></label></td>
                    <?php
                    }
                }
    			?>
    			<!-- <td><input type="text" name="tgl" value="<?= @$i ?>"></td> -->
    			<?php
    			}
                $ArySumTotalServiceRight_PCNG = array_sum($ParentTotalService_Right_PCNG);
    			?>
    			<td>
                    <?= @$ArySumTotalServiceRight_PCNG ?>
                </td>
    		</tr>
    		<tr>
    			<!-- <td></td> -->
    			<td rowspan="2">SMART SIDOARJO</td>
    			<td>Sales</td>
    			<?php
                for ($i=1; $i <= $getDay; $i++) { 
                if($i <= 9){
                    $i = '0'.$i;
                }else{
                    $i = $i;
                }
                $joinLoopDate = $joinYearMonth.$i;
                $MyLibraryHoliday_SDRJ = array($LibraryMy->getHoliday($joinLoopDate));
                $GetDataCountPerDate_SDRJ = $this->db->query("SELECT count(*) AS total_per_date FROM tb_hedsurv AS a INNER JOIN tb_surv AS b ON a.id_surv=b.id_surv WHERE a.tipe_cust = '1' AND a.id_respon = '6' AND a.tgl_telp = '".$joinLoopDate."' AND b.id_comp = '3' ")->result();
                foreach ($GetDataCountPerDate_SDRJ as $row_total_sdrj) {
                    $GetTotalPerSDRJ = $row_total_sdrj->total_per_date;
                }
                if($GetTotalPerSDRJ <= 0 || $GetTotalPerSDRJ == ''){
                    $TotalPerDateSDRJ = '0';
                }else{
                    $TotalPerDateSDRJ = $GetTotalPerSDRJ;
                }
                $ParentTotalSales_Right_SDRJ[] = $TotalPerDateSDRJ;
                // echo $this->db->last_query();
                $ArySubSalesTotal_SDRJ[] = $TotalPerDateSDRJ;
                array_unshift($ArySubSalesTotal_SDRJ,"");
                unset($ArySubSalesTotal_SDRJ[0]);
                if($MyLibraryHoliday_SDRJ[0]['id'] == '0'){//jika hari libur pada hari sabtu/minggu
                ?>
                <td style="background-color: red;"><label><?= @$TotalPerDateSDRJ ?></label></td>
                <?php
                }else{//jika bukan hari libur
                    if(@$TotalPerDateSDRJ != '0' || @$TotalPerDateSDRJ > 0){//warna kuning
                    ?>
                    <td style="background-color: yellow;"><label><?= @$TotalPerDateSDRJ ?></label></td>
                    <?php
                    }else{//warna putih
                    ?>
                    <td style=""><label><?= @$TotalPerDateSDRJ ?></label></td>
                    <?php
                    }
                }
                ?>
                <!-- <td><input type="text" name="tgl" value="<?= @$i ?>"></td> -->
                <?php
                }
                $ArySumTotalSalesRight_SDRJ = array_sum($ParentTotalSales_Right_SDRJ);
                ?>
    			<td>
                    <?= @$ArySumTotalSalesRight_SDRJ ?>       
                </td>
    		</tr>
    		<tr>
    			<td>Service</td>
    			<!-- <td></td>
    			<td></td> -->
    			<?php
                for ($i=1; $i <= $getDay; $i++) { 
                if($i <= 9){
                    $i = '0'.$i;
                }else{
                    $i = $i;
                }
                $joinLoopDate = $joinYearMonth.$i;
                $MyLibraryHoliday_SDRJ = array($LibraryMy->getHoliday($joinLoopDate));
                $GetDataCountPerDate_SDRJ = $this->db->query("SELECT count(*) AS total_per_date FROM tb_hedsurv AS a INNER JOIN tb_surv AS b ON a.id_surv=b.id_surv WHERE a.tipe_cust = '2' AND a.id_respon = '6' AND a.tgl_telp = '".$joinLoopDate."' AND b.id_comp = '3' ")->result();
                foreach ($GetDataCountPerDate_SDRJ as $row_total_sdrj) {
                    $GetTotalPerSDRJ = $row_total_sdrj->total_per_date;
                }
                if($GetTotalPerSDRJ <= 0 || $GetTotalPerSDRJ == ''){
                    $TotalPerDateSDRJ = '0';
                }else{
                    $TotalPerDateSDRJ = $GetTotalPerSDRJ;
                }
                $ParentTotalService_Right_SDRJ[] = $TotalPerDateSDRJ;
                // echo $this->db->last_query();
                $ArySubServiceTotal_SDRJ[] = $TotalPerDateSDRJ;
                array_unshift($ArySubServiceTotal_SDRJ,"");
                unset($ArySubServiceTotal_SDRJ[0]);
                if($MyLibraryHoliday_SDRJ[0]['id'] == '0'){//jika hari libur pada hari sabtu/minggu
                ?>
                <td style="background-color: red;"><label><?= @$TotalPerDateSDRJ ?></label></td>
                <?php
                }else{//jika bukan hari libur
                    if(@$TotalPerDateSDRJ != '0' || @$TotalPerDateSDRJ > 0){//warna kuning
                    ?>
                    <td style="background-color: yellow;"><label><?= @$TotalPerDateSDRJ ?></label></td>
                    <?php
                    }else{//warna putih
                    ?>
                    <td style=""><label><?= @$TotalPerDateSDRJ ?></label></td>
                    <?php
                    }
                }
                ?>
                <!-- <td><input type="text" name="tgl" value="<?= @$i ?>"></td> -->
                <?php
                }
                $ArySumTotalServiceRight_SDRJ = array_sum($ParentTotalService_Right_SDRJ);
                ?>
    			<td>
                    <?= @$ArySumTotalServiceRight_SDRJ ?>          
                </td>
    		</tr>
    		<tr>
    			<td colspan="3" style="width: 8%; background-color: #ADD8E6;">Sub Total</td>
    			<?php
    			for ($i=1; $i <= $getDay; $i++) { 
                $joinLoopDate = $joinYearMonth.$i;
                $MyLibraryHoliday_DPK = array($LibraryMy->getHoliday($joinLoopDate));
                $joinAryTest = array($ArySubSalesTotal_PCNG, $ArySubServiceTotal_PCNG, $ArySubSalesTotal_SDRJ, $ArySubServiceTotal_SDRJ);
                $sumSubTotal = array_sum(array_column($joinAryTest, $i));
                // print_r($sum);
                $arySumSubTotal[] = $sumSubTotal;
                array_unshift($arySumSubTotal,"");
                unset($arySumSubTotal[0]);
    			if($MyLibraryHoliday_DPK[0]['id'] == '0'){//jika hari libur pada hari sabtu/minggu
                ?>
                <td style="background-color: red;"><label>0</label></td>
                <?php
                }else{//jika bukan hari libur
                ?>
                <td style="background-color: #ADD8E6;"><label><?= @$sumSubTotal ?></label></td>
                <?php
                }
                ?>
    			<!-- <td><input type="text" name="tgl" value="<?= @$i ?>"></td> -->
    			<?php
                $TotalSumSubTotal_Jatim = array_sum($arySumSubTotal);
                $aryTotalSumSubTotal_Jatim = $arySumSubTotal;
    			}
    			?>
    			<td style="background-color: #ADD8E6;">
                    <?php
                    // ParentTotalService_Right_TGRG
                    // print_r($arySumSubTotal);
                    // $string1=implode(",",$arySumSubTotal);
                    // print_r(array($string1));
                    // $TotalSumSubTotal2 = array_sum($arySumSubTotal);
                    ?>
                    <?= @$TotalSumSubTotal_Jatim ?>
                </td>
    		</tr>
        <?php
        if(@$case_per_area == '1'){//jika hanya per Area saja
        ?>
    	</table>
        <div>
        <?php
        }
        echo "<br>";
        $this->load->library('session');
        $this->session->set_userdata('AryTotalSumSubTotal_Jatim', $aryTotalSumSubTotal_Jatim);
        $sessAryTotalSumSubTotal_JATIM = $this->session->userdata('aryTotalSumSubTotal_Jatim');
        // print_r($sessAryTotalSumSubTotal_JKT);
        ?>

    </div>
</div>

</body>
</html>