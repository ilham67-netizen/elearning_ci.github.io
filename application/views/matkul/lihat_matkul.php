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
                    <th>Kode Matkul</th>
                    <th>Nama Matkul</th>
                    <th>Kelas</th>
                    <th>Dosen</th>
                    <th>Semester</th>
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
                    <td><?= $d->kd_matkul ?></td>
                    <td><?= $d->nama_matkul ?></td>
                    <td><?= $d->nama_kelas ?></td>
                    <td><?= $d->nama_dosen ?></td>
                    <td><?= $d->semester ?></td>
                    <td><a class="badge bg-success" href="<?= site_url('master_data/matkul/edit/' . $d->kd_matkul) ?>"><i data-feather="edit" width="20"></i>Edit</a>
                        <a href="<?= site_url('master_data/matkul/del/'.$d->kd_matkul) ?>" class="badge bg-danger tombol-delete">  <i data-feather="trash" width="20"></i> Delete</a>
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
    <h5 class="modal-title white" id="myModalLabel160">Tambah Matkul</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <i data-feather="x"></i>
    </button>
</div>
<div class="modal-body">
    <form class="form form-vertical" action="<?= site_url('master_data/matkul/process') ?>" method="POST">
        <div class="form-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label >Kode Matkul</label>
                        <input type="text" class="form-control" readonly="" required="" name="kd_matkul" value="<?= $kode_matkul;  ?>" placeholder="Masukkan Kode Matkul" autocomplete="off">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label >Nama Matkul</label>
                        <input type="text" class="form-control" required="" name="nama_matkul" placeholder="Masukkan Nama Matkul" autocomplete="off">
                    </div> 
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label >Fakultas</label>                 
                        <select class="choices form-control" name="fakultas" id="fakultas" required>
                            <option value="" selected>--- Pilih Fakultas ---</option>
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
                            <select class="choices form-select"  name="prodi" required="">
                             <option selected="">--- Pilih Prodi ---</option>
                         </select>
                     </div>
                     <div id="prodi2"></div>
                 </div>
             </div>
             <div class="col-12" >
                <div class="form-group" >
                    <div id="kelas">
                        <label >Kelas</label>
                        <select class="choices form-select"  name="kelas" required="">
                         <option selected="">--- Pilih Kelas ---</option>
                     </select>
                 </div>
                 <div id="kelas2"></div>
             </div>
         </div>
         <div class="col-12">
            <div class="form-group">
                <div id="dosen">
                    <label >Dosen</label>
                    <select class="choices form-select"  name="dosen" required="">
                        <option selected="">--- Pilih Dosen ---</option>
                 </select>
             </div>
             <div id="dosen2"></div>
         </div>
     </div>
      <div class="col-12">
            <div class="form-group" style="margin-bottom: 100px;">     
                    <label >Semester</label>
                    <select class="choices form-select"  name="semester" required="">
                        <option selected="">--- Pilih Semester ---</option>
                        <option >1</option>
                        <option >2</option>
                        <option >3</option>
                        <option >4</option>
                        <option >5</option>
                        <option >6</option>
                        <option >7</option>
                 </select>           
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
                    html += ' <select class="js-choice2 form-select" id="kelas3"  name="kelas" required="">'
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