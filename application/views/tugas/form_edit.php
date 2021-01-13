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
            <li class="breadcrumb-item"><a href="<?= site_url($this->uri->segment(1)) ?>">Menu Tugas</a></li>
            <li class="breadcrumb-item"><a href="<?= site_url($this->uri->segment(1) . '/lihat_tugas/' . $prodi) ?>">Lihat Tugas Prodi</a></li>
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
          <form class="form form-vertical" action="<?= site_url('tugas/process/' . $this->uri->segment(4)) ?>" method="POST">
            <div class="form-body">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label>Kode Tugas</label>
                    <input type="text" class="form-control" readonly="" required="" name="kd_tugas" value="<?= $row->kd_tugas  ?>" autocomplete="off">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label>Tanggal Uplod</label>
                    <input type="text" readonly="" class="form-control" required="" name="tanggal_uplod" value="<?= $row->tanggal_uplod  ?>" autocomplete="off">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label>Judul Tugas</label>
                    <input type="text" class="form-control" required="" name="judul_tugas" value="<?= $row->judul_tugas  ?>" placeholder="Masukkan Judul Tugas" autocomplete="off">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label>Batas Waktu</label>
                    <input type="datetime-local" class="form-control" required="" name="batas_waktu" value="<?= date('Y-m-d\TH:i', strtotime($row->batas_waktu)) ?>" autocomplete="off">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label>Semester</label>
                    <select class="choices form-select" id="semester" name="semester" required="">
                      <option value="<?= $row->semester ?>" selected=""><?= $row->semester ?></option>
                      <?php for ($i = 1; $i <= 7; $i++) {
                        if ($i == $row->semester) {
                        } else {
                      ?>
                          <option value="<?php echo $i ?>"><?php echo $i; ?></option>
                      <?php }
                      } ?>
                    </select>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <div id="kelas">
                      <label>Kelas</label>
                      <select class="choices form-control" name="kelas" id="kelas3" required="">
                        <option selected="" value="<?= $row->kelas ?>"><?= $row->nama_kelas ?></option>
                        <?php foreach ($kelas as $row2) : ?>
                          <option value="<?php echo $row2->kd_kelas; ?>"><?php echo $row2->nama_kelas; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div id="kelas2"></div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <div id="matkul">
                      <label>Mata Kuliah</label>
                      <select class="choices form-control" name="kd_matkul" id="matkul3" required="">
                        <option selected="" value="<?= $row->kd_matkul  ?>"><?= $row->nama_matkul  ?></option>
                      </select>
                    </div>
                    <div id="matkul2"></div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <div id="dosen">
                      <label>Dosen</label>
                      <select class="choices form-control" name="nip_dosen" id="dosen3" required="">
                        <option selected="" value="<?= $row->nip_dosen  ?>"><?= $row->nama_dosen  ?></option>
                      </select>
                    </div>
                    <div id="dosen2"></div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label>Keterangan</label>
                    <textarea name="keterangan" class="form-control" id="exampleFormControlTextarea1" rows="6"><?= $row->keterangan  ?></textarea>
                  </div>
                </div>
                <label style="margin-bottom: 10px;">FILE TUGAS YANG ADA SAAT INI</label>
                <div id="filetgs">
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
                <div id="filetgs2"></div>
                <div class="dropzone" style="margin-top: 50px;">

                  <div class="dz-message" style="height: 100px;">
                    <center>
                      <h3 style="margin-top: 50px;"> Klik atau Drop File Tugas Baru Di sini</h3><br><span data-feather="upload-cloud"></span>
                    </center>
                  </div>

                </div>


                <center><input type="submit" name="edit" class="btn btn-primary ml-1" value="Ubah"></center>

              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  </div>
  <script type="text/javascript">
    $(document).ready(function() {
      //  $('#semester').change(function(){ 

      //   $.ajax({
      //     url : "<?= site_url('tugas/getkelas') ?>",
      //     method : "POST",
      //     data : {prodi: "<?= $this->uri->segment(4) ?>"},
      //     async : true,
      //     dataType : 'json',
      //     success: function(data){

      //       var html = '';
      //       var i;
      //       $('#kelas').remove();             
      //       html += '<label >Kelas</label>';
      //       html += ' <select class="js-choice form-select" id="kelas3"  name="kelas" required="">'
      //       html += '<option value="" selected>--- Pilih Kelas ---</option>';
      //       for(i=0; i<data.length; i++){
      //         html += '<option value='+data[i].kd_kelas+'>'+data[i].nama_kelas+'</option>';
      //       }
      //       html += ' </select>';

      //       $('#kelas2').html(html);
      //       const choices = new Choices('.js-choice');

      //     }
      //   });
      //   return false;
      // }); 
      $('#kelas3').change(function() {
        var id = $(this).val();
        var id2 = $('#semester').val();
        $.ajax({
          url: "<?= site_url('tugas/getmatkul') ?>",
          method: "POST",
          data: {
            kelas: id,
            prodi: "<?= $this->uri->segment(4) ?>",
            semester: id2
          },
          async: true,
          dataType: 'json',
          success: function(data) {

            var html = '';
            var i;
            $('#matkul').remove();
            html += '<label >MATA KULIAH</label>';
            html += ' <select class="js-choice2 form-select" id="matkul3"  name="kd_matkul" required="">';
            html += '<option value="" selected>--- Pilih Matkul ---</option>';
            for (i = 0; i < data.length; i++) {
              html += '<option value=' + data[i].kd_matkul + '>' + data[i].nama_matkul + '</option>';
            }
            html += ' </select>';

            $('#matkul2').html(html);
            const choices = new Choices('.js-choice2');
          }
        });
        return false;
      });

      $('#matkul2').change(function() {
        var id = $('#matkul3').val();
        $.ajax({
          url: "<?= site_url('tugas/getkeldos') ?>",
          method: "POST",
          data: {
            matkul: id
          },
          async: true,
          dataType: 'json',
          success: function(data) {

            var html2 = '';
            var i;
            $('#dosen').remove();
            html2 += '<label >Dosen</label>';
            html2 += ' <select class="js-choice3 form-select" id="dosen3"  name="nip_dosen" required="">';
            for (i = 0; i < data.length; i++) {
              html2 += '<option value=' + data[i].nip_dosen + ' selected disabled>' + data[i].nama_dosen + '</option>';
            }
            html2 += ' </select>';

            $('#dosen2').html(html2);
            const choices2 = new Choices('.js-choice3');
          }
        });
        return false;
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
            url: "<?= site_url('tugas/hapus_file2') ?>",
            method: "POST",
            data: {
              token: token,
              kd_tugas: "<?= $this->uri->segment(3) ?>"
            },
            async: true,
            dataType: 'json',
            success: function(data) {

              var html = '';
              var i;
              $('#filetgs').remove();
              for (i = 0; i < data.length; i++) {
                html += ' <div class="col-1">';
                html += ' <center>';
                html += '<img src="<?= base_url("images/") . "file.png" ?>" width="64" height="64">';
                html += '<label> ' + data[i].nama_file + '</label>';
                html += '<a class="btn btn-sm btn-danger mt-2 tombol-delete" data-token="' + data[i].token + '">HAPUS</a>';
                html += ' </center>';
                html += '</div>';
              }
              $('filetgs2').html(html);
            }
          });
          return false;
        }
      })

    });
  </script>
  <script type="text/javascript">
    Dropzone.autoDiscover = false;
    var foto_upload = new Dropzone(".dropzone", {
      url: "<?= site_url('tugas/file_upload/' . $this->uri->segment(3)) ?>",
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
        url: "<?= site_url('tugas/hapus_file') ?>",
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