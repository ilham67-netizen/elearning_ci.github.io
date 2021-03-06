<?php
$jam = timediff($tugas->jam_tersisa);
$menit = timediff2($tugas->jam_tersisa);
if ($tugas->hari_tersisa < 0 || $jam < 0 || $menit < 0) {
?>
    <script>
        alert('Pengumpulan Tugas Sudah Telat');
        window.location = "<?= site_url('menu_mhs/tugas') ?>";
    </script>
<?php
}
date_default_timezone_set('Asia/Jakarta'); ?>
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3><?= $title; ?></h3>
            <br>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= site_url($this->uri->segment(0)) ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= site_url('menu_mhs/tugas') ?>">Menu Tugas</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<section class="section">
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <form class="form form-vertical" action="<?= site_url('menu_mhs/tugas/process') ?>" method="POST">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Kode Tugas</label>
                                    <input type="text" class="form-control" readonly="" required="" name="kd_tugas" placeholder="Masukkan Kode Tugas" autocomplete="off" value="<?= $tugas->kd_tugas ?>">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>NIM</label>
                                    <input type="text" readonly="" class="form-control" required="" name="nim" value="<?= $this->session->userdata('userid') ?>" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" required="" name="nama" value="<?= $this->session->userdata('name') ?>" autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="dropzone">
                                <div class="dz-message" style="height: 100px;">
                                    <center>
                                        <h3 style="margin-top: 50px;"> Klik atau Drop File Tugas Di sini</h3><br><span data-feather="upload-cloud"></span>
                                    </center>
                                </div>
                            </div>
                            <center><input type="submit" name="add" class="btn btn-primary ml-1" value="Kumpulkan"></center>

                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>

</div>

<script type="text/javascript">
    Dropzone.autoDiscover = false;
    var foto_upload = new Dropzone(".dropzone", {
        url: "<?= site_url('menu_mhs/tugas/file_upload/' . $this->uri->segment(4)) ?>",
        maxFilesize: 7,
        method: "post",
        acceptedFiles: ".jpg, .png, .jpeg, .pdf, .zip",
        paramName: "userfile",
        dictInvalidFileType: "Type file ini tidak dizinkan",
        addRemoveLinks: true,
    });
    foto_upload.on("sending", function(a, b, c) {
        a.token = Math.random();
        c.append("token_foto", a.token);
    });

    foto_upload.on("removedfile", function(a) {
        var token = a.token;
        $.ajax({
            type: "POST",
            data: {
                token: token
            },
            url: "<?= site_url('menu_mhs/tugas/hapus_file') ?>",
            cache: false,
            dataType: 'json',
            success: function() {
                console.log("remove file sukses");
            },
            error: function() {
                console.log("remove file gagal");
            }
        });
    });
</script>