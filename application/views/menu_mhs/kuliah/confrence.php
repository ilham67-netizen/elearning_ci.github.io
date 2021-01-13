<?php if ($jadwal->waktu_akhir != '' || $jadwal->waktu_akhir != NULL) {
    echo "<script>
 			alert('Kuliah Sudah Berakhir');
    window.location='" . site_url('menu_mhs/kuliah') . "';
 			</script>";
} else { ?>
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Materi Kuliah :<?= $jadwal->nama_kuliah; ?></h3>
                <br>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url($this->uri->segment(0)) ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div style="height: 800px;"></div>
                <iframe src="<?= $jadwal->link ?>" allow="camera;microphone" class="responsive-iframe"></iframe>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 style="float: left;">Materi Kuliah</h3>
                <div style="position: absolute; right:10px;">
                    <a class="btn btn-danger" id="refresh"><span data-feather="refresh-cw"></span> Refresh</a>
                </div>
            </div>
            <div class="card-body">
                <div class="se-pre-con"></div>
                <div id="filemateri">
                    <div class="row">
                        <?php foreach ($file as $data) :
                        ?>
                            <div class="col-2">
                                <center>
                                    <img src="<?= base_url('images/') . 'file.png' ?>" width="64" height="64">
                                    <label><?= $data->nama_file ?></label>
                                    <a href="<?= base_url('upload_materi/' . $data->nama_file); ?>" class="btn btn-sm btn-outline-primary mt-2">Download</a>
                                </center>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div id="filemateri2"></div>
                <div id="filemateri3"></div>
                <br>
                <?php if ($jadwal->allow_absen > 0) {
                    echo '<center><button href="" id="btn_absen" class="btn btn-primary"> ABSEN</button></center>';
                } else {
                    echo '<center><button disabled id="btn_absen" class="btn btn-primary"> ABSEN</button></center>';
                } ?>

            </div>
        </div>
    </section>
    <script type="text/javascript">
        $("#refresh").on('click', function() {
            // $('#loading-image').show();
            $.ajax({
                url: "<?= site_url('menu_mhs/kuliah/refresh_file') ?>",
                method: "POST",
                data: {
                    kd_jadwal: "<?= $this->uri->segment(4) ?>"
                },
                async: true,
                dataType: 'json',
                beforeSend: function() {
                    $('.se-pre-con').show();
                },
                success: function(data) {
                    var html = '';
                    var i;
                    $('#filemateri').remove();
                    $('#btn_absen').remove();

                    html += ' <div class="row">';
                    for (i = 0; i < data.file2.length; i++) {
                        html += ' <div class="col-2">';
                        html += ' <center>';
                        html += '<img src="<?= base_url("images/") . "file.png" ?>" width="64" height="64">';
                        html += '<label> ' + data.file2[i].nama_file + '</label>';
                        html += '<a class="btn btn-sm btn-outline-primary mt-2" href="<?= base_url("upload_materi/") ?>' + data.file2[i].nama_file + '">DOWNLOAD</a>';
                        html += ' </center>';
                        html += '</div>';
                    }
                    html += ' </div>';
                    if (data.jadwal2.allow_absen > 0) {
                        html += '<br><center><button id="btn_absen" class="btn btn-primary"> ABSEN</button></center>';
                    } else {
                        html += '<br><center><button disabled id="btn_absen" class="btn btn-primary"><span data-feather="x-octagon"></span> ABSEN</button></center>';
                    }
                    $('#filemateri2').html(html);
                },
                complete: function() {
                    // $('.se-pre-con').hide();
                }
            });
            return false;
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#filemateri2").on('click', '#btn_absen', function() {
                var kd_jadwal = '<?= $this->uri->segment(4); ?>';
                $.ajax({
                    type: "POST",
                    data: {
                        kd_jadwal: kd_jadwal,
                        nim: "<?= $this->session->userdata('userid') ?>"
                    },
                    url: "<?= site_url('menu_mhs/kuliah/absen_mhs') ?>",
                    cache: false,
                    dataType: 'json',
                    success: function(data) {
                        console.log('Absen Berhasil');
                        Swal.fire({
                            title: data.hasil,
                            text: 'Klik OK',
                            icon: data.icon
                        });
                    },
                    error: function(data) {
                        console.log('Absen Gagal');
                        Swal.fire({
                            title: data.hasil,
                            text: 'Klik OK',
                            icon: data.icon
                        });
                    }
                });
            });
            $("#btn_absen").on('click', function() {
                var kd_jadwal = '<?= $this->uri->segment(4); ?>';
                $.ajax({
                    type: "POST",
                    data: {
                        kd_jadwal: kd_jadwal,
                        nim: "<?= $this->session->userdata('userid') ?>"
                    },
                    url: "<?= site_url('menu_mhs/kuliah/absen_mhs') ?>",
                    cache: false,
                    dataType: 'json',
                    success: function(data) {
                        console.log('Absen Berhasil');
                        Swal.fire({
                            title: data.hasil,
                            text: 'Klik OK',
                            icon: data.icon
                        });
                    },
                    error: function(data) {
                        console.log('Absen Gagal');
                        Swal.fire({
                            title: data.hasil,
                            text: 'Klik OK',
                            icon: data.icon
                        });
                    }
                });
            });
        });
    </script>

<?php } ?>