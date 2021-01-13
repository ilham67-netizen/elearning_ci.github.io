 <div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3><?= $title;?></h3>
            <br>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= site_url($this->uri->segment(0)) ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $title;?></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<section class="section">
    <div class="card">

        <div class="card-body">
         <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModalCenter">
            TAMBAH
        </button>
        <br>
        <br>
        <table class='table table-striped' id="dataTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Fakultas</th>
                    <th>Nama Fakultas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
              <?php 
              $no = 1;
              foreach ($row as $d) {
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $d->kd_fakultas ?></td>
                    <td><?= $d->nama_fakultas ?></td>
                    <td><a class="badge bg-success" href="<?= site_url('master_data/fakultas/edit/' . $d->kd_fakultas) ?>"><i data-feather="edit" width="20"></i>Edit</a>
                        <a href="<?= site_url('master_data/fakultas/del/'.$d->kd_fakultas) ?>" class="badge bg-danger tombol-delete">  <i data-feather="trash" width="20"></i> Delete</a>
                    </td> 

                </tr>
            <?php } ?>
        </tbody>

    </table>
</div>
</div>
<!-- Vertically Centered modal Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
role="document">
<div class="modal-content">
 <div class="modal-header bg-primary">
    <h5 class="modal-title white" id="myModalLabel160">Tambah Fakultas</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <i data-feather="x"></i>
    </button>
</div>
<div class="modal-body">
    <form class="form form-vertical" action="<?= site_url('master_data/fakultas/process') ?>" method="POST">
        <div class="form-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label >Kode Fakultas</label>
                        <input type="number" class="form-control" required="" name="kd_fakultas" placeholder="Masukkan Kode Fakultas" autocomplete="off">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label >Nama Fakultas</label>
                        <input type="text" class="form-control" required="" name="nama_fakultas" placeholder="Masukkan Nama Fakultas" autocomplete="off">
                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <input type="submit" name="add" class="btn btn-primary ml-1" value="Submit">                                
                </div>
            </div>
        </div>
    </form>
</div>

</div>
</div>
</div>
</section>