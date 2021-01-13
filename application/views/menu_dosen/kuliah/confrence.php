<?php if ($jadwal->waktu_akhir != '' || $jadwal->waktu_akhir != NULL) {
    echo "<script>
 			alert('Kuliah Sudah Berakhir');
    window.location='" . site_url('menu_dosen/kuliah') . "';
 			</script>";
} else { ?>
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Materi Kuliah :<?= $jadwal->nama_kuliah; ?><a href="<?= site_url('menu_dosen/kuliah/keluar_sesi/' . $this->uri->segment(4)); ?>" class="btn icon btn-danger ml-2 logout"><span data-feather="log-out"></span> Keluar Sesi</a></h3>
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
                <div class="form-check form-switch" style="position: absolute; right:200px;">
                    <?php if ($jadwal->status > 0) {
                        echo '<input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault2" checked>';
                    } else {
                        echo '<input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault2">';
                    } ?>
                    <label class="form-check-label" for="flexSwitchCheckDefault">AKTIFKAN KULIAH</label>
                </div>
                <div class="form-check form-switch" style="position: absolute; right:5px;">
                    <?php if ($jadwal->allow_absen > 0) {
                        echo '<input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" checked>';
                    } else {
                        echo '<input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">';
                    } ?>
                    <label class="form-check-label" for="flexSwitchCheckDefault">IJINKAN ABSENSI</label>
                </div>
            </div>
            <div class="card-body">
                <div id="filemateri">
                    <div class="row">
                        <?php foreach ($file as $data) :
                        ?>
                            <div class="col-1">
                                <center>
                                    <img src="<?= base_url('images/') . 'file.png' ?>" width="64" height="64">
                                    <label><?= $data->nama_file ?></label>
                                    <a class="btn btn-sm btn-danger mt-2 tombol-hapus" data-token="<?= $data->token ?>">HAPUS</a>
                                </center>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div id="filemateri2"></div>
                <div class="dropzone">
                    <div class="dz-message" style="height: 100px;">
                        <center>
                            <h3 style="margin-top: 50px;"> Klik atau Drop File Materi Baru Di sini</h3><br><span data-feather="upload-cloud"></span>
                        </center>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <script type="text/javascript">
        Dropzone.autoDiscover = false;
        var foto_upload = new Dropzone(".dropzone", {
            url: "<?= site_url('menu_dosen/jadwal/file_upload/' . $this->uri->segment(4)) ?>",
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
                url: "<?= site_url('menu_dosen/jadwal/hapus_file') ?>",
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
    <script type="text/javascript">
        $(".tombol-hapus").on('click', function(e) {
            e.preventDefault();
            const token = $('.tombol-hapus').data('token');
            Swal.fire({
                title: 'Apakah Anda Yakin Dokumen Akan Dihapus ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus Dokumen!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= site_url('menu_dosen/jadwal/hapus_file2') ?>",
                        method: "POST",
                        data: {
                            token: token,
                            kd_tugas: "<?= $this->uri->segment(4) ?>"
                        },
                        async: true,
                        dataType: 'json',
                        success: function(data) {

                            var html = '';
                            var i;
                            $('#filemateri').remove();
                            for (i = 0; i < data.length; i++) {
                                html += ' <div class="col-1">';
                                html += ' <center>';
                                html += '<img src="<?= base_url("images/") . "file.png" ?>" width="64" height="64">';
                                html += '<label> ' + data[i].nama_file + '</label>';
                                html += '<a class="btn btn-sm btn-danger mt-2 tombol-delete" data-token="' + data[i].token + '">HAPUS</a>';
                                html += ' </center>';
                                html += '</div>';
                            }
                            $('#filemateri2').html(html);
                        }
                    });
                    return false;
                }
            })

        });
    </script>
    <script>
        $(document).ready(function() {
            $("#flexSwitchCheckDefault").on('click', function() {
                var kd_jadwal = '<?= $this->uri->segment(4); ?>';
                if (this.checked) {
                    var status = "1";
                    $.ajax({
                        type: "POST",
                        data: {
                            status: status,
                            kd_jadwal: kd_jadwal
                        },
                        url: "<?= site_url('menu_dosen/kuliah/check_absen') ?>",
                        cache: false,
                        dataType: 'json',
                        success: function(data) {
                            console.log('Absen Aktif');
                            Swal.fire({
                                title: data.hasil,
                                text: 'Klik OK',
                                icon: 'success'
                            });
                        },
                        error: function(data) {
                            console.log('Absen Aktif Gagal');
                            Swal.fire({
                                title: data.hasil,
                                text: 'Klik OK',
                                icon: 'error'
                            });
                        }
                    });
                } else {
                    var status = "0";
                    $.ajax({
                        type: "POST",
                        data: {
                            status: status,
                            kd_jadwal: kd_jadwal
                        },
                        url: "<?= site_url('menu_dosen/kuliah/check_absen') ?>",
                        cache: false,
                        dataType: 'json',
                        success: function(data) {
                            console.log('Absen Tidak Aktif Sukses');
                            Swal.fire({
                                title: data.hasil,
                                text: 'Klik OK',
                                icon: 'success'
                            });
                        },
                        error: function(data) {
                            console.log('Absen Tidak Aktif Gagal');
                            Swal.fire({
                                title: data.hasil,
                                text: 'Klik OK',
                                icon: 'error'
                            });
                        }
                    });
                }

            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#flexSwitchCheckDefault2").on('click', function() {
                var kd_jadwal = '<?= $this->uri->segment(4); ?>';
                if (this.checked) {
                    var status = "1";
                    $.ajax({
                        type: "POST",
                        data: {
                            status: status,
                            kd_jadwal: kd_jadwal
                        },
                        url: "<?= site_url('menu_dosen/kuliah/aktifkan_kuliah') ?>",
                        cache: false,
                        dataType: 'json',
                        success: function(data) {
                            console.log('Kuliah Aktif');
                            Swal.fire({
                                title: data.hasil,
                                text: 'Klik OK',
                                icon: 'success'
                            });
                        },
                        error: function(data) {
                            console.log('Kuliah Aktif Gagal');
                            Swal.fire({
                                title: data.hasil,
                                text: 'Klik OK',
                                icon: 'error'
                            });
                        }
                    });
                } else {
                    var status = "0";
                    $.ajax({
                        type: "POST",
                        data: {
                            status: status,
                            kd_jadwal: kd_jadwal
                        },
                        url: "<?= site_url('menu_dosen/kuliah/aktifkan_kuliah') ?>",
                        cache: false,
                        dataType: 'json',
                        success: function(data) {
                            console.log('Kuliah Tidak Aktif Sukses');
                            Swal.fire({
                                title: data.hasil,
                                text: 'Klik OK',
                                icon: 'success'
                            });
                        },
                        error: function(data) {
                            console.log('Kuliah Tidak Aktif Gagal');
                            Swal.fire({
                                title: data.hasil,
                                text: 'Klik OK',
                                icon: 'error'
                            });
                        }
                    });
                }

            });
        });
    </script>
<?php } ?>