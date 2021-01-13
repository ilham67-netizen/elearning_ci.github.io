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
                    <li class="breadcrumb-item"><a href="<?= site_url($this->uri->segment(1).'/'.$this->uri->segment(2))?>">Menu Matkul</a></li>
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
               <form class="form form-vertical" action="<?= site_url('master_data/matkul/process') ?>" method="POST">
                <div class="form-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label >Kode matkul</label>
                                <input type="text" class="form-control" readonly="" required="" name="kd_matkul" value="<?= $row->kd_matkul ?>" placeholder="Masukkan Kode matkul" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label >Nama matkul</label>
                                <input type="text" class="form-control" required="" name="nama_matkul" value="<?= $row->nama_matkul ?>" placeholder="Masukkan Nama matkul" autocomplete="off">
                            </div> 
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label >Fakultas</label>                 
                                <select class="choices form-control" name="fakultas" id="fakultas" required>
                                    <option value="<?= $row->fakultas; ?>" selected><?= $row->nama_fakultas; ?></option>
                                    <?php foreach($fakultas as $row2):?>
                                        <option value="<?php echo $row2->kd_fakultas;?>"><?php echo $row2->nama_fakultas;?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group" >
                                <div id="prodi">
                                    <label >Prodi</label>
                                    <select class="choices form-control"  name="prodi" required="" id="prodi3" >
                                        <option selected="" value="<?= $row->prodi; ?>"><?= $row->nama_prodi; ?></option>
                                        <?php foreach($prodi as $row2):?>
                                            <option value="<?php echo $row2->kd_prodi;?>"><?php echo $row2->nama_prodi;?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div id="prodi2"></div>
                            </div>
                        </div>
                        <div class="col-12" >
                            <div class="form-group" >
                                <div id="kelas">
                                    <label >Kelas</label>
                                    <select class="choices form-control"  name="kelas" required="">
                                       <option selected="" value="<?= $row->kelas; ?>"><?= $row->nama_kelas; ?></option>
                                   </select>
                               </div>
                               <div id="kelas2"></div>
                           </div>
                       </div>
                       <div class="col-12">
                        <div class="form-group">
                            <div id="dosen">
                                <label >Dosen</label>
                                <select class="choices form-control"  name="dosen" required="">
                                    <option selected="" value="<?= $row->nip_dosen; ?>"><?= $row->nama_dosen; ?></option>
                                    <?php foreach($dosen as $row2):?>
                                        <option value="<?php echo $row2->nip_dosen;?>"><?php echo $row2->nama_dosen;?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div id="dosen2"></div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group" style="margin-bottom: 100px;">     
                            <label >Semester</label>
                            <select class="choices form-select"  name="semester" required="">
                                <option value="<?= $row->semester; ?>" selected=""><?= $row->semester; ?></option>
                               <?php for ($i=1; $i <= 7; $i++) { 
                                if ($i == $row->semester) {
                                    
                                }else{
                                ?>

                                    <option value="<?php echo $i?>"><?php echo $i;?></option>
                               <?php } } ?>
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
                    $('#prodi').remove();             
                    html += '<label >Prodi</label>';
                    html += ' <select class="js-choice form-select" id="prodi3"  name="prodi" required="">'
                    html += '<option value="" selected>--- Pilih Prodi ---</option>';
                    for(i=0; i<data.length; i++){
                        html += '<option value='+data[i].kd_prodi+'>'+data[i].nama_prodi+'</option>';
                    }
                    html += ' </select>';

                    $('#prodi2').html(html);
                    const choices = new Choices('.js-choice');

                }
            });
            return false;
        }); 
        $('#prodi2').change(function(){ 
            var id_prodi=$("#prodi3").val();
            var id_fakultas = $('#fakultas').val();
            $.ajax({
                url : "<?= site_url('master_data/matkul/getkelas')?>",
                method : "POST",
                data : {id_prodi: id_prodi},
                async : true,
                dataType : 'json',
                success: function(data){

                    var html = '';
                    var i;
                    $('#kelas').remove();             
                    html += '<label >Kelas</label>';
                    html += ' <select class="js-choice2 form-control" id="kelas3"  name="kelas" required="">'
                    html += '<option value="" selected>--- Pilih Kelas ---</option>';
                    for(i=0; i<data.length; i++){
                        html += '<option value='+data[i].kd_kelas+'>'+data[i].nama_kelas+'</option>';
                    }
                    html += ' </select>';

                    $('#kelas2').html(html);
                    const choices = new Choices('.js-choice2');

                }
            });
            return false;
        }); 
        $('#prodi3').change(function(){ 
            var id_prodi=$("#prodi3").val();
            $.ajax({
                url : "<?= site_url('master_data/matkul/getkelas')?>",
                method : "POST",
                data : {id_prodi: id_prodi},
                async : true,
                dataType : 'json',
                success: function(data){

                    var html = '';
                    var i;
                    $('#kelas').remove();             
                    html += '<label >Kelas</label>';
                    html += ' <select class="js-choice2 form-control" id="kelas3"  name="kelas" required="">'
                    html += '<option value="" selected>--- Pilih Kelas ---</option>';
                    for(i=0; i<data.length; i++){
                        html += '<option value='+data[i].kd_kelas+'>'+data[i].nama_kelas+'</option>';
                    }
                    html += ' </select>';

                    $('#kelas2').html(html);
                    const choices = new Choices('.js-choice2');

                }
            });
            return false;
        }); 
        $('#prodi2').change(function(){ 
            var id_prodi=$("#prodi3").val();
            $.ajax({
                url : "<?= site_url('master_data/matkul/getdosen')?>",
                method : "POST",
                data : {id_prodi: id_prodi},
                async : true,
                dataType : 'json',
                success: function(data){

                    var html = '';
                    var i;
                    $('#dosen').remove();             
                    html += '<label >Dosen</label>';
                    html += ' <select class="js-choice3 form-control" id="dosen3"  name="dosen" required="">'
                    html += '<option value="" selected>--- Pilih Dosen ---</option>';
                    for(i=0; i<data.length; i++){
                        html += '<option value='+data[i].nip_dosen+'>'+data[i].nama_dosen+'</option>';
                    }
                    html += ' </select>';

                    $('#dosen2').html(html);
                    const choices = new Choices('.js-choice3');

                }
            });
            return false;
        }); 

        $('#prodi3').change(function(){ 
            var id_prodi=$("#prodi3").val();
            $.ajax({
                url : "<?= site_url('master_data/matkul/getdosen')?>",
                method : "POST",
                data : {id_prodi: id_prodi},
                async : true,
                dataType : 'json',
                success: function(data){

                    var html = '';
                    var i;
                    $('#dosen').remove();             
                    html += '<label >Dosen</label>';
                    html += ' <select class="js-choice3 form-select" id="dosen3"  name="dosen" required="">'
                    html += '<option value="" selected>--- Pilih Dosen ---</option>';
                    for(i=0; i<data.length; i++){
                        html += '<option value='+data[i].nip_dosen+'>'+data[i].nama_dosen+'</option>';
                    }
                    html += ' </select>';

                    $('#dosen2').html(html);
                    const choices = new Choices('.js-choice3');

                }
            });
            return false;
        }); 
    });
</script>