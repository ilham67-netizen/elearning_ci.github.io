<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url() ?>assets/custom/css/bootstrap.css">
    <link href="<?= base_url('assets/editor_mirror/') ?>css/main.css" rel="stylesheet">
    <link rel=stylesheet href="<?= base_url('assets/editor_mirror/') ?>lib/codemirror.css">
    <link rel="stylesheet" href="<?= base_url('assets/editor_mirror/') ?>css/material-darker.css">
    <script src="<?= base_url('assets/editor_mirror/') ?>js/1.12.4/jquery.min.js"></script>
    <script src="<?= base_url('assets/editor_mirror/') ?>js/1.12.4/jquery-ui.js"></script>
    <script src="<?= base_url('assets/plugins/bootstrap/') ?>js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/editor_mirror/') ?>lib/codemirror.js"></script>
    <script src='<?= base_url('assets/editor_mirror/') ?>lib/xml.js'></script>
    <script src='<?= base_url('assets/editor_mirror/') ?>lib/javascript.js'></script>
    <script src='<?= base_url('assets/editor_mirror/') ?>lib/css.js'></script>
    <script src='<?= base_url('assets/editor_mirror/') ?>lib/closetag.js'></script>
    <script src='<?= base_url('assets/editor_mirror/') ?>js/custom.js'></script>
    <script src='<?= base_url('assets/editor_mirror/') ?>js/php.js'></script>
    <script src='<?= base_url('assets/editor_mirror/') ?>js/clike/clike.js'></script>
    <script src='<?= base_url('assets/editor_mirror/') ?>js/htmlmixed/htmlmixed.js'></script>
    <script src="<?= base_url() ?>assets/countdown/js/jquery.plugin.min.js"></script>
    <script src="<?= base_url() ?>assets/countdown/js/jquery.countdown.js"></script>
    <script src="<?= base_url() ?>assets/sweet_alert/sweetalert2.all.min.js"></script>
    <style type="text/css">
        .CodeMirror {
            height: auto;
        }
    </style>
    <style>
        #timer {
            float: right;

        }

        #timer {
            color: #f5fe02;
            text-align: right;
        }
    </style>
</head>
<?php //$waktu = "120"; 
?>

<body>
    <div class="card">
        <div class="card-header" style="background-color:blue;">
            <center><a class="btn btn-success btn-lg" data-toggle="modal" id="show_data" style=" float: left; margin-right: 10px; margin-left: 500px;" data-id="<?= $this->uri->segment(6); ?>" data-jenis="<?= $row->jenis_soal; ?>">UBAH NILAI</a>
                <a href="<?= site_url("menu_dosen/pengaturan_ujian/download_soal/" . $row->kd_paket) ?>" class="btn btn-danger btn-lg center-block" style=" float: left; margin-right: 10px; ">SOAL</a>
            </center>
            <form class="form">
                <input type="submit" class="btn btn-secondary btn-lg" value="RUN"></input>


        </div>

        <div id="mainContent" class="mainContent">
            <div id="mainContentHolder">
                <div id="draggable"></div>
                <div class="main-left">
                    <div class="left-inner-content">
                        <div class="left-inner-main">

                            <textarea id='editor' name='editor'><?= $jawab->teks_koding ?></textarea>
                            <input type="hidden" value="<?= $row->kd_paket ?>" name="kd_paket">
                            <input type="hidden" value="<?= $row->kd_pengawas ?>" name="kd_pengawas">

                        </div>
                    </div>
                </div>
                </form>
                <div class="main-right">
                    <div class="right-inner-content">
                        <div class="right-inner-main">

                            <div id="iframewrapper" style="background-color: #ffff;">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
<!-- Vertically Centered modal Modal -->
<div class="modal fade" id="modal_detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title white" id="myModalLabel160">Penilaian Ujian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group">
                        <label for="">NIM</label>
                        <input type="text" class="form-control input-lg" name="nim" value="" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Kode Pengawas</label>
                        <input type="text" class="form-control" name="kd_pengawas" value="" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Mahasiswa</label>
                        <input type="text" class="form-control" name="nama_mhs" value="" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Nilai</label>
                        <input type="number" class="form-control input-lg" name="nilai" placeholder="Masukkkan Nilai Tugas" required>
                        <input type="hidden" name="kd_paket">
                        <input type="hidden" name="jenis">
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-" class="btn btn-default" data-dismiss="modal">Tutup</a>
                        <a class="btn btn-primary" id="btn_update">Ubah Nilai</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // Initialize CodeMirror editor with a nice html5 canvas demo.
    var editor = CodeMirror.fromTextArea(document.getElementById('editor'), {
        mode: 'application/x-httpd-php',
        lineNumbers: true,
        theme: 'material-darker',

    });
    // submitTryit();
</script>
<script type="text/javascript">
    jQuery(document).ready(function($) {

        $(function() {
            // $('#klik_modal').on('click', function() {
            //     $('#myModal').modal();
            // })

            $('.form').submit(function() {
                $.ajax({
                    type: 'POST',
                    url: "<?= base_url('assets/editor_mirror/try_php.php') ?>",
                    data: $(this).serialize(),
                    success: function() {
                        $.ajax({
                            type: 'GET',
                            url: "<?= base_url('assets/editor_mirror/jajal2.php') ?>",
                            data: $(this).serialize(),
                            success: function(data) {
                                $('#iframewrapper').html(data);
                                var ifr = document.createElement("iframe");
                                ifr.setAttribute("frameborder", "0");
                                ifr.setAttribute("id", "iframeOutput");
                                document.getElementById("iframewrapper").innerHTML = "";
                                document.getElementById("iframewrapper").appendChild(ifr);
                                var ifrw = (ifr.contentWindow) ? ifr.contentWindow : (ifr.contentDocument.document) ? ifr.contentDocument.document : ifr.contentDocument;
                                ifrw.document.open();
                                ifrw.document.write(data);
                                ifrw.document.close();

                            }
                        });


                    }
                });
                return false;
            });

        });
        //GET UPDATE
        $('#show_data').on('click', function() {
            var id = $(this).attr('data-id');
            var jenis = $(this).attr('data-jenis');
            $.ajax({
                type: "GET",
                url: "<?= site_url('menu_dosen/pengaturan_ujian/jajal2') ?>",
                dataType: "JSON",
                data: {
                    id: id,
                    jenis: jenis
                },
                success: function(data) {
                    $.each(data.nilai, function(nim, kd_pengawas, nilai) {
                        $('#modal_detail').modal('show');
                        $('[name="nim"]').val(data.nilai.nim);
                        $.each(data.mahasiswa, function(nama_mhs) {
                            $('[name="nama_mhs"]').val(data.mahasiswa.nama_mhs);
                        });
                        $('[name="kd_pengawas"]').val(data.nilai.kd_pengawas);
                        $('[name="kd_paket"]').val(data.nilai.kd_paket);
                        $('[name="jenis"]').val(jenis);
                        if (data.nilai.nilai != null) {
                            $('[name="nilai"]').val(data.nilai.nilai);
                        }
                    });
                }
            });
            return false;
        });
        //Update Barang
        $('#btn_update').on('click', function() {
            var nim = $('[name="nim"]').val();
            var nama = $('[name="nama_mhs"]').val();
            var nilai = $('[name="nilai"]').val();
            var kd_pengawas = $('[name="kd_pengawas"]').val();
            var kd_paket = $('[name="kd_paket"]').val();
            var jenis = $('[name="jenis"]').val();
            $.ajax({
                type: "POST",
                url: "<?= site_url('menu_dosen/pengaturan_ujian/add_nilai_ujian') ?>",
                dataType: "JSON",
                data: {
                    nim: nim,
                    nama: nama,
                    nilai: nilai,
                    kd_pengawas: kd_pengawas,
                    kd_paket: kd_paket,
                    jenis: jenis
                },
                success: function(data) {
                    $('[name="nim"]').val("");
                    $('[name="nama_mhs"]').val("");
                    $('[name="nilai"]').val("");
                    $('[name="kd_pengawas"]').val("");
                    $('[name="kd_paket"]').val("");
                    $('[name="jenis"]').val("");
                    $('#modal_detail').modal('hide');
                    Swal.fire({
                        title: data.hasil,
                        text: 'Klik OK',
                        icon: data.icon
                    });
                },
                error: function(data) {
                    $('[name="nim"]').val("");
                    $('[name="nama_mhs"]').val("");
                    $('[name="nilai"]').val("");
                    $('[name="kd_pengawas"]').val("");
                    $('[name="kd_paket"]').val("");
                    $('[name="jenis"]').val("");
                    $('#modal_detail').modal('hide');
                    Swal.fire({
                        title: data.hasil,
                        text: 'Klik OK',
                        icon: data.icon
                    });
                }
            });
            return false;
        });
    });
</script>


</body>

</html>