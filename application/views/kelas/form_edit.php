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
                    <li class="breadcrumb-item"><a href="<?= site_url($this->uri->segment(1).'/'.$this->uri->segment(2))?>">Menu Kelas</a></li>
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
              <form class="form form-vertical" action="<?= site_url('master_data/kelas/process') ?>" method="POST">
                <div class="form-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label >Kode Kelas</label>
                                <input type="text" class="form-control" required="" readonly="" name="kd_kelas" value="<?= $row->kd_kelas ?>" placeholder="Masukkan Kode Kelas" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label >Nama Kelas</label>
                                <input type="text" class="form-control" required="" name="nama_kelas" value="<?= $row->nama_kelas ?>" placeholder="Masukkan Nama Kelas" autocomplete="off">
                            </div> 
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label >Fakultas</label>                 
                                <select class="form-control" name="fakultas" id="fakultas" required>
                                    <option value="<?= $row->fakultas; ?>"><?= $row->nama_fakultas; ?></option>
                                    <?php foreach($fakultas as $row2):?>
                                        <option value="<?php echo $row2->kd_fakultas;?>"><?php echo $row2->nama_fakultas;?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label >Prodi</label>
                                <select class="form-control" name="prodi" id="prodi" required="">
                                   <option selected="" value="<?= $row->prodi; ?>"><?= $row->nama_prodi; ?></option>
                               </select>
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
<script type="text/javascript">
   $(document).ready(function(){

    $('#fakultas').change(function(){ 
        var id=$(this).val();
        $.ajax({
            url : "<?= site_url('master_data/dosen/getprodi')?>",
            method : "POST",
            data : {id: id},
            async : true,
            dataType : 'json',
            success: function(data){

                var html = '';
                var i;
                html += '<option value="" selected>--- Pilih Prodi ---</option>';
                for(i=0; i<data.length; i++){
                    html += '<option value='+data[i].kd_prodi+'>'+data[i].nama_prodi+'</option>';
                }
                $('#prodi').html(html);

            }
        });
        return false;
    }); 

});
</script>