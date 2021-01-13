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
                    <li class="breadcrumb-item"><a href="<?= site_url($this->uri->segment(1).'/'.$this->uri->segment(2))?>">Menu Fakultas</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $title;?></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<section class="section">
    <div class="card">
    <div class="card-content">
        <div class="card-body">
         <form class="form form-vertical" action="<?= site_url('master_data/fakultas/process') ?>" method="POST">
        <div class="form-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label >Kode Fakultas</label>
                        <input type="number" class="form-control" readonly="" required="" name="kd_fakultas" value="<?= $row->kd_fakultas ?>" placeholder="Masukkan Kode Fakultas" autocomplete="off">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label >Nama Fakultas</label>
                        <input type="text" class="form-control" required="" name="nama_fakultas" value="<?= $row->nama_fakultas ?>" placeholder="Masukkan Nama Fakultas" autocomplete="off">
                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <input type="submit" name="edit" class="btn btn-primary ml-1" value="Submit">                                
                </div>
            </div>
        </div>
    </form>
    </div>
</div>
    </div>
</section>
</div>