<?php
session_start();
include '../../koneksi/koneksi.php';

$nomorurut_suratmasuk               = mysqli_real_escape_string($db, $_POST['nomorurut_suratmasuk']);
$tanggalmasuk_suratmasuk	        = mysqli_real_escape_string($db, $_POST['tanggalmasuk_suratmasuk']);
$gol	                            = mysqli_real_escape_string($db, $_POST['gol']);
$jabatan	                        = mysqli_real_escape_string($db, $_POST['jabatan']);
$kode_suratmasuk                    = mysqli_real_escape_string($db, $_POST['kode_suratmasuk']);
$sifat_surat                        = mysqli_real_escape_string($db, $_POST['sifat_surat']);
$tempat_berangkat                   = mysqli_real_escape_string($db, $_POST['tempat_berangkat']);
$no_berkas                          = mysqli_real_escape_string($db, $_POST['no_berkas']);
$alamat	                            = mysqli_real_escape_string($db, $_POST['alamat']);
$tgl_lhp                            = mysqli_real_escape_string($db, $_POST['tgl_lhp']);
$perihal 	                        = mysqli_real_escape_string($db, $_POST['perihal']);


date_default_timezone_set('Asia/Jakarta');
$tanggal_entry  = date("Y-m-d H:i:s");
$thnNow = date("Y");

$nama_file_lengkap 		= $_FILES['file_suratmasuk']['name'];
$nama_file 		= substr($nama_file_lengkap, 0, strripos($nama_file_lengkap, '.'));
$ext_file		= substr($nama_file_lengkap, strripos($nama_file_lengkap, '.'));
$tipe_file 		= $_FILES['file_suratmasuk']['type'];
$ukuran_file 	= $_FILES['file_suratmasuk']['size'];
$tmp_file 		= $_FILES['file_suratmasuk']['tmp_name'];

$tgl_masuk                  = date('Y-m-d H:i:s', strtotime($tanggalmasuk_suratmasuk));


if (
	!($nomorurut_suratmasuk == '') and !($tanggalmasuk_suratmasuk == '') and !($gol  == '') and !($jabatan == '') and !($kode_suratmasuk == '') and !($sifat_surat == '')  and !($tempat_berangkat == '') and !($no_berkas == '') and !($alamat == '') and !($tgl_lhp == '') and !($perihal == '')  and
	($tipe_file == "application/pdf") and ($ukuran_file <= 10340000)
) {

	$nama_baru = $thnNow . '-' . $nomorurut_suratmasuk . $ext_file;
	$path = "../surat_masuk/" . $nama_baru;
	move_uploaded_file($tmp_file, $path);

	$sql = "INSERT INTO tb_suratmasuk(nomorurut_suratmasuk, tanggalmasuk_suratmasuk, gol, jabatan, kode_suratmasuk, sifat_surat, tempat_berangkat, no_berkas,  alamat, tgl_lhp, perihal)
				values ('$nomorurut_suratmasuk', '$tanggalmasuk_suratmasuk', '$gol ', '$jabatan', '$kode_suratmasuk', '$sifat_surat', '$tempat_berangkat', '$no_berkas', '$alamat', '$tgl_lhp', '$perihal')";
	$execute = mysqli_query($db, $sql);

	echo "<Center><h2><br>Terima Kasih<br>Laporan Telah Dimasukkan</h2></center>
			<meta http-equiv='refresh' content='2;url=../datasuratmasuk.php'>";
} else {
	echo "<Center><h2>Silahkan isi semua kolom lalu tekan submit<br>Terima Kasih</h2></center>
			<meta http-equiv='refresh' content='2;url=../inputsuratmasuk.php'>";
}
