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
                    <li class="breadcrumb-item active"><?= $title; ?></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<section class="section">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class='table table-striped' id="dataTable">
                    <thead>
                        <tr>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Nama Matkul</th>
                            <th>Jenis Soal</th>
                            <th>Status Pengerjaan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($row as $d) :
                        ?>
                            <?php foreach ($d->mhs as $data) : ?>
                                <tr>
                                    <td><?= $data->nim ?></td>
                                    <td><?= $data->nama_mhs; ?></td>
                                    <td><?= $data->nama_matkul; ?></td>
                                    <td><?= jenis_soal($d->jenis_soal); ?></td>
                                    <td><?php if ($data->cek_nilai > 0) {
                                            echo '<span class="badge bg-success">Sudah Mengerjakan</span>';
                                        } else {
                                            echo '<span class="badge bg-danger">Belum Mengerjakan</span>';
                                        } ?></td>
                                </tr>
                            <?php endforeach; ?>

                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>