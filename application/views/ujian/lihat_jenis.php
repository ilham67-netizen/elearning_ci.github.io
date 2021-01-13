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
                    <li class="breadcrumb-item"><a href="<?= site_url('ujian/lihat_fakultas/' . $this->uri->segment(3)) ?>">Lihat Fakultas</a></li>
                    <li class="breadcrumb-item active"><?= $title; ?></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<section class="section">
    <div class="card">
        <div class="card-body">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_tambah">
                TAMBAH
            </button>
            <br>
            <br>
            <div class="table-responsive">
                <table class='table table-striped' id="dataTable">
                    <thead>
                        <tr>
                            <th>Kode Pengawas</th>
                            <th>Nama Ujian</th>
                            <th>Kode Paket</th>
                            <th>Jenis Soal</th>
                            <th>Waktu Ujian</th>
                            <th>Durasi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($row as $data) : ?>
                            <tr>
                                <td><?= $data->kd_pengawas; ?></td>
                                <td><?= $data->nama_ujian; ?></td>
                                <td><?= $data->kd_paket; ?></td>
                                <td><?= jenis_soal($data->jenis_soal); ?></td>
                                <td><?= indo_date($data->tanggal_ujian) . '||' . date('H:i', strtotime($data->tanggal_ujian)); ?></td>
                                <td><?= $data->waktu_soal . '(Telat ' . $data->batas_telat . ')'; ?> Menit</td>
                                <td><?php if ($data->status > 0) {
                                        echo '<a class="badge bg-success" href="#">Sudah Diaktifkan</a>';
                                    } else {
                                        echo '<a class="badge bg-danger">Belum Diaktifkan</a>';
                                    } ?></td>
                                <td><a class="badge bg-success" href="<?= site_url('ujian/edit_hal/' . $this->uri->segment(3) . '/' . $this->uri->segment(4) . '/' . $data->kd_pengawas) ?>"><i data-feather="edit" width="20"></i>Edit</a>
                                    <a href="<?= site_url('ujian/del/' . $this->uri->segment(3) . '/' . $this->uri->segment(4) . '/' . $data->kd_pengawas) ?>" class="badge bg-danger tombol-delete"> <i data-feather="trash" width="20"></i> Delete</a>
                                    <?php if ($data->status > 0) {
                                        echo '<a href="' . site_url('ujian/hal_detail/' . $this->uri->segment(3) . '/' . $this->uri->segment(4) . '/' . $data->kd_pengawas) . '" class="badge bg-success"> <i data-feather="eye" width="20"></i> Lihat Detail</a>';
                                    } ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Vertically Centered modal Modal -->
    <div class="modal fade" id="modal_tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title white" id="myModalLabel160">Tambah Ujian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= site_url('ujian/process/' . $this->uri->segment(3) . '/' . $this->uri->segment(4)); ?>" method="POST">
                        <div class="form-group">
                            <label for="">Kode Pengawas</label>
                            <input type="text" class="form-control" name="kd_pengawas" value="<?= $kd_auto ?>" autocomplete="off" readonly placeholder="Masukkan Nomor Induk Pegawai" required>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Pengawas</label>
                            <input type="text" class="form-control" autocomplete="off" name="nama_pengawas" placeholder="Masukkan Nama Pengawas" required>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Ujian</label>
                            <input type="text" class="form-control" autocomplete="off" name="nama_ujian" placeholder="Masukkan Nama Ujian" required>
                        </div>
                        <div class="form-group">
                            <label>Paket Soal</label>
                            <select class="choices form-control" name="kd_paket" id="kd_paket" required="">
                                <option selected="" value="">--- Pilih Paket ---</option>
                                <?php foreach ($paket as $row2) : ?>
                                    <option value=" <?php echo $row2->kd_paket; ?>">(<?php echo $row2->kd_paket; ?>)<?php echo $row2->nama_matkul; ?>/<?php echo $row2->nama_kelas; ?>/<?php echo jenis_soal($row2->jenis_soal); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="choices form-control" name="status" required="">
                                <option selected="" value="">--- Pilih Status ---</option>
                                <option value="0">Belum Diaktifkan</option>
                                <option value="1">Sudah Diaktifkan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Waktu Ujian</label>
                            <input type="datetime-local" class="form-control" name="waktu_ujian" placeholder="Masukkan Waktu Ujian" required>
                        </div>
                        <div class="form-group">
                            <label for="">Batas Keterlambatan</label>
                            <input type="number" class="form-control" name="batas_telat" placeholder="Masukkan Batas Keterlambatan dalam Menit" required>
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Masukkan Password Login Pengawas" required>
                            <div id="isi"></div>
                        </div>

                        <div class="modal-footer">
                            <a class="btn btn-" class="btn btn-default" data-dismiss="modal">Tutup</a>
                            <input class="btn btn-primary" type="submit" name="add" value="Tambah"></input>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $('#kd_paket').change(function() {
        var kd_paket = $(this).val();

        $.ajax({
            url: "<?= site_url('ujian/get_paket') ?>",
            method: "POST",
            data: {
                kd_paket: kd_paket
            },
            async: true,
            dataType: 'json',
            success: function(data) {

                var html = '';
                var i;
                html += '<input type="hidden" class="form-control" name="nip_dosen" value="' + data.nip_dosen + '" autocomplete="off">';
                $('#isi').html(html);

            }
        });
        return false;
    });
</script>