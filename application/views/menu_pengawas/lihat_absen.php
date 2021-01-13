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
                            <th>Tanggal Absen</th>
                            <th>Jam Absen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($row as $data) : ?>
                            <tr>
                                <td><?= $data->nim; ?></td>
                                <td><?= $data->nama_mhs; ?></td>
                                <td><?= indo_date($data->tanggal_absen); ?></td>
                                <td><?= date('H:i', strtotime($data->tanggal_absen)); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>