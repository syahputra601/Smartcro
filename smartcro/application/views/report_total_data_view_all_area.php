<html>
<head>
	<title>Preview Report All Area Total Data</title>
    <style>
    .tableFixHead thead th { position: sticky; top: 0; z-index: 1; }
    </style>
</head>
<body style="width: 500%;">
<!-- <center>
  <?= @$case_all_area ?>
</center> -->
<?php
if(@$case_all_area == '1'){//jika hanya per Area saja
?>
<h1 style="text-align: center;">REPORT DATA TELEPON PERHARI</h1>
<center>
  <?= @$year.'-'.@$month ?>
</center>
<!-- <br> -->
<?php
}else{//jika bukan per Area
?>
<h1 style="text-align: center;">REPORT ALL AREA TELEPON PERHARI</h1>
<center>
  <?= @$year.'-'.@$month ?>
</center>
<!-- <br> -->
<?php
}
?>
<?php
$joinDate = $year.'-'.$month.'-01';
//start to call library
$CI =& get_instance();
$CI->load->library('MyLibrary');
$LibraryMy = new MyLibrary();
$library_get_month = array($LibraryMy->last_day_of_the_month($joinDate));
$lastDay = $library_get_month[0];
$getDay = substr($lastDay,-2);
$library_get_name_month = array($LibraryMy->convert_name_month($month));
$getNameMonth = $library_get_name_month[0];
// print_r($getDay);
// echo "<br>";
// print_r($getNameMonth);
// echo "<br>";
//end to call library
//start parameter to every view all area
$data['page'] = 'Report';
$data['month'] = $month;//date('m');
$data['year'] = $year;//date('Y');
$data['lastDay'] = $lastDay;
$data['getDay'] = $getDay;
$data['nameMonth'] = $getNameMonth;
$data['controller'] = $this;
$data['case_all_area'] = '1';//jika all area
$data['case_per_area'] = '0';//jika all area
//end parameter to every view all area
?>
<div class="tableFixHead">
<?php
//start view Jakarta
$this->load->view('report_total_data_view_jatim',$data);
//end view Jakarta
//start view Kaltim
// $this->load->view('report_total_data_view_kaltim',$data);
// //end view Kaltim
// //start view Kalbar
// $this->load->view('report_total_data_view_kalbar',$data);
// //end view Kalbar
// //start view Kalsel
// $this->load->view('report_total_data_view_kalsel',$data);
// //end view Kalsel
// //start view Sumsel/Palembang
// $this->load->view('report_total_data_view_sumsel',$data);
//end view Sumsel/Palembang
?>
</div>
</body>
</html>