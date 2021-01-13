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
                <table width="100" class="table table-borderless">
                    <?php
                    $i = 1;
                    foreach ($row as $d) :
                        foreach ($d->gambar as $data) : ?>
                            <tr>
                                <td></td>
                                <td> <img style="width: 300px; height: 300px;" src="<?= base_url('upload_gambar/' . $data->nama_file); ?>"></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <th width="7%">NO. <?= $i++; ?></th>
                            <th><?= $d->pertanyaan; ?></th>
                        </tr>
                        <?php foreach ($d->opsi as $key) : ?>
                            <tr>
                                <td></td>
                                <td><?= 'A. ' . $key->opsi_a; ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><?= 'B. ' . $key->opsi_b; ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><?= 'C. ' . $key->opsi_c; ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><?= 'D. ' . $key->opsi_d; ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><?= 'E. ' . $key->opsi_e; ?></td>
                            </tr>
                        <?php
                        endforeach;
                        if ($d->kunci_jawaban != '-') {
                        ?>
                            <tr>
                                <td></td>
                                <th>Kunci Jawaban : <?= $d->kunci_jawaban; ?></th>
                            </tr>

                            <?php }
                        foreach ($d->jawaban as $c) {
                            if ($c->jawaban != '-') {
                            ?>
                                <tr>
                                    <td></td>
                                    <td>Jawaban : <?= $c->jawaban; ?></td>
                                </tr>
                            <?php } else {
                            ?>
                                <tr>
                                    <td></td>
                                    <th>Jawaban : <?= $c->jawaban_opsi; ?></th>
                                </tr>
                        <?php
                            }
                        } ?>
                        <tr>

                            <td colspan="3">
                                <hr>
                            </td>
                        </tr>
                    <?php
                    endforeach;

                    ?>


                </table>
                <table width="100%">
                    <?php if (isset($nilai->benar)) { ?>
                        <tr>
                            <th width="20%">Benar</th>
                            <th>:</th>
                            <th><?= $nilai->benar; ?></th>
                        </tr>
                        <tr>
                            <th>Salah</th>
                            <th>:</th>
                            <th><?= $nilai->salah; ?></th>
                        </tr>
                        <tr>
                            <th>Tidak Dikerjakan</th>
                            <th>:</th>
                            <th><?= $nilai->tidak_dikerjakan; ?></th>
                        </tr>
                    <?php } ?>
                    <tr>
                        <th>Nilai</th>
                        <th>:</th>
                        <th><?= $nilai->nilai; ?></th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</section>