<?php
foreach ($col as $d) {
    if ($d->cek_nilai > 0) {
?>
        <script>
            alert('Anda Sudah Mengikuti Ujian');
            window.location.href = "<?= site_url('menu_mhs/ujian') ?>";
        </script>
<?php
    }
}
if ($this->session->userdata('waktu_start')) {
    $lewat = time() - $this->session->userdata('waktu_start');
} else {
    $data = array(
        'waktu_start' => time()
    );
    $this->session->set_userdata($data);
    $lewat = 0;
}
?>
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
                    <li class="breadcrumb-item"><a href="<?= site_url($this->uri->segment(1) . '/' . $this->uri->segment(2)) ?>">Menu Ujian</a></li>
                    <li class="breadcrumb-item active"><?= $title; ?></li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<section class="section">
    <div class="card">
        <div class="card-header">
            <div id="timer_place">
                <span id="timer">00 : 00 : 00</span>
            </div>
        </div>
        <div class="card-body">
            <center id="sembunyi">
                <h6>1. Klik Tombol Mulai</h6>
                <button class="btn btn-primary" id="mulai">Mulai</button>
            </center>
            <div class="table-responsive">

                <div id="konten">

                </div>

            </div>
            <hr>
            <table id="nav" width="100%">
                <tr>
                    <td align="center"><button class="btn btn-primary" id="pre">Previous</button><button class="btn btn-primary ml-3" id="skip">Skip</button>
                        <button class="btn btn-primary ml-3" id="next">Next & save</button>
                        <button class="btn btn-primary ml-3" id="selesai">Selesai</button></td>
                <tr>
            </table>
        </div>
    </div>
</section>
<script type="text/javascript">
    function waktuHabis() {
        alert('Waktu Anda telah habis');
        // var frmSoal = document.getElementById("frmSoal"); 
        // frmSoal.submit(); 
        window.location.href = "<?= site_url('menu_mhs/ujian/hasil_pilgan') ?>";

    }

    function hampirHabis(periods) {
        if ($.countdown.periodsToSeconds(periods) == 60) {
            $(this).css({
                color: "red"
            });

        }
    }
    $(function() {
        var waktu = <?php foreach ($col as $d) {
                        echo $d->waktu_soal;
                    } ?> * 60;
        var sisa_waktu = waktu - <?php echo $lewat ?>;
        var longWayOff = sisa_waktu;
        $("#timer").countdown({
            until: longWayOff,
            compact: true,
            onExpiry: waktuHabis,
            onTick: hampirHabis
        });
    })
</script>
<script type="text/javascript">
    var count = 0;
    var count2 = -1;
    $('#nav').hide();
    $('#selesai').hide();

    function fungsi_next() {
        count += 1;
        $.ajax({
            type: 'POST',
            url: "<?= site_url('menu_mhs/ujian/jajal') ?>",
            data: {
                nomor_hal: count2 += 1,
                kd_paket: '<?= $row->kd_paket ?>',
                kd_pengawas: '<?= $this->uri->segment(4) ?>'
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                var html = '';
                var i;
                var i2;
                var i3;
                var i4;
                var no = 1;
                $("#sembunyi").remove();
                $("#nav").show();
                html += '<form id="form_submit">'
                html += '<table style="width: 100%;">'
                for (i = 0; i < data.length; i++) {
                    if (count >= data[i].jumlah) {
                        $('#next').hide();
                        $('#skip').hide();
                        $('#selesai').show();
                    }
                    if (count < data[i].jumlah) {
                        $('#next').show();
                        $('#skip').show();
                        $('#selesai').hide();
                    }
                    if (count <= 1) {
                        $('#next').show();
                        $('#skip').show();
                        $('#pre').hide();
                    }
                    if (count > 1) {
                        $('#pre').show();
                    }
                    for (i2 = 0; i2 < data[i].gambar.length; i2++) {
                        html += '<tr>';
                        html += '<td></td>'
                        html += '<td><img style="width: 300px; height: 300px;" src="' + '<?= base_url('upload_gambar/'); ?>' +
                            data[i].gambar[i2].nama_file + '"></td>';
                    }
                    html += '</tr>'
                    html += '<tr>'
                    html += '<td><h4>No. ' + count + '</h4></td>';
                    html += '<td><h3 class="mt-3">' + data[i].pertanyaan + '<input type="hidden" name="kd_soal" value="' + data[i].kd_soal + '"><input type="hidden" name="kd_pengawas" value="<?= $this->uri->segment(4) ?>"></h3></td>';
                    html += '</tr>';
                    for (i3 = 0; i3 < data[i].opsi.length; i3++) {
                        html += '<tr>'
                        html += '<td></td>'
                        html += '<td width= "90%"><h5>A. <input type="radio" required  name="opsi" value="A"'
                        for (i4 = 0; i4 < data[i].jawaban.length; i4++) {
                            if (data[i].jawaban[i4].jawaban_opsi == 'A') {
                                html += 'checked'
                            }
                        }
                        html += '> ' + data[i].opsi[i3].opsi_a + '</h5></td>'
                        html += '</tr>'
                        html += '<tr>'
                        html += '<td></td>'
                        html += '<td><h5>B. <input type="radio" required  name="opsi" value="B"'
                        for (i4 = 0; i4 < data[i].jawaban.length; i4++) {
                            if (data[i].jawaban[i4].jawaban_opsi == 'B') {
                                html += 'checked'
                            }
                        }
                        html += '>' + data[i].opsi[i3].opsi_b + '</h5></td>'
                        html += '</tr>'
                        html += '<tr>'
                        html += '<td></td>'
                        html += '<td><h5>C. <input type="radio" required name="opsi" value="C"'
                        for (i4 = 0; i4 < data[i].jawaban.length; i4++) {
                            if (data[i].jawaban[i4].jawaban_opsi == 'C') {
                                html += 'checked'
                            }
                        }
                        html += '>' + data[i].opsi[i3].opsi_c + '</h5></td>'

                        html += '</tr>'
                        html += '<tr>'
                        html += '<td></td>'
                        html += '<td ><h5>D. <input type="radio" required name="opsi" value="D"'
                        for (i4 = 0; i4 < data[i].jawaban.length; i4++) {
                            if (data[i].jawaban[i4].jawaban_opsi == 'D') {
                                html += 'checked'
                            }
                        }
                        html += '>' + data[i].opsi[i3].opsi_d + '</h5></td>'
                        html += '</tr>'
                        html += '<tr>'
                        html += '<td></td>'
                        html += '<td><h5>E. <input type="radio" required name="opsi" value="E"'
                        for (i4 = 0; i4 < data[i].jawaban.length; i4++) {
                            if (data[i].jawaban[i4].jawaban_opsi == 'E') {
                                html += 'checked'
                            }
                        }
                        html += '>' + data[i].opsi[i3].opsi_e + '</h5></td>'
                        html += '</tr>'
                    }
                }
                html += '</table>'
                html += '</form>'
                $('#konten').html(html);
            }
        });
    }

    function fungsi_prev() {
        count -= 1;
        $.ajax({
            type: 'POST',
            url: "<?= site_url('menu_mhs/ujian/jajal') ?>",
            data: {
                nomor_hal: count2 -= 1,
                kd_paket: '<?= $row->kd_paket ?>',
                kd_pengawas: '<?= $this->uri->segment(4) ?>'
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                var html = '';
                var i;
                var i2;
                var i3;
                var i4;
                var no = 1;
                $("#sembunyi").remove();
                $("#nav").show();
                html += '<form id="form_submit">'
                html += '<table style="width: 100%;">'
                for (i = 0; i < data.length; i++) {
                    if (count >= data[i].jumlah) {
                        $('#next').hide();
                        $('#skip').hide();
                        $('#selesai').show();
                    }
                    if (count < data[i].jumlah) {
                        $('#next').show();
                        $('#skip').show();
                        $('#selesai').hide();
                    }
                    if (count <= 1) {
                        $('#next').show();
                        $('#skip').show();
                        $('#pre').hide();
                    }
                    if (count > 1) {
                        $('#pre').show();
                    }
                    for (i2 = 0; i2 < data[i].gambar.length; i2++) {
                        html += '<tr>';
                        html += '<td></td>'
                        html += '<td><img style="width: 300px; height: 300px;" src="' + '<?= base_url('upload_gambar/'); ?>' +
                            data[i].gambar[i2].nama_file + '"></td>';
                    }
                    html += '</tr>'
                    html += '<tr>'
                    html += '<td><h4>No. ' + count + '</h4></td>';
                    html += '<td><h3>' + data[i].pertanyaan + '<input type="hidden" name="kd_soal" value="' + data[i].kd_soal + '"><input type="hidden" name="kd_pengawas" value="<?= $this->uri->segment(4) ?>"></h3></td>';
                    html += '</tr>';
                    for (i3 = 0; i3 < data[i].opsi.length; i3++) {
                        html += '<tr>'
                        html += '<td></td>'
                        html += '<td width= "90%"><h5>A. <input type="radio" required  name="opsi" value="A"'
                        for (i4 = 0; i4 < data[i].jawaban.length; i4++) {
                            if (data[i].jawaban[i4].jawaban_opsi == 'A') {
                                html += 'checked'
                            }
                        }
                        html += '> ' + data[i].opsi[i3].opsi_a + '</h5></td>'
                        html += '</tr>'
                        html += '<tr>'
                        html += '<td></td>'
                        html += '<td><h5>B. <input type="radio" required  name="opsi" value="B"'
                        for (i4 = 0; i4 < data[i].jawaban.length; i4++) {
                            if (data[i].jawaban[i4].jawaban_opsi == 'B') {
                                html += 'checked'
                            }
                        }
                        html += '>' + data[i].opsi[i3].opsi_b + '</h5></td>'
                        html += '</tr>'
                        html += '<tr>'
                        html += '<td></td>'
                        html += '<td><h5>C. <input type="radio" required name="opsi" value="C"'
                        for (i4 = 0; i4 < data[i].jawaban.length; i4++) {
                            if (data[i].jawaban[i4].jawaban_opsi == 'C') {
                                html += 'checked'
                            }
                        }
                        html += '>' + data[i].opsi[i3].opsi_c + '</h5></td>'

                        html += '</tr>'
                        html += '<tr>'
                        html += '<td></td>'
                        html += '<td ><h5>D. <input type="radio" required name="opsi" value="D"'
                        for (i4 = 0; i4 < data[i].jawaban.length; i4++) {
                            if (data[i].jawaban[i4].jawaban_opsi == 'D') {
                                html += 'checked'
                            }
                        }
                        html += '>' + data[i].opsi[i3].opsi_d + '</h5></td>'
                        html += '</tr>'
                        html += '<tr>'
                        html += '<td></td>'
                        html += '<td><h5>E. <input type="radio" required name="opsi" value="E"'
                        for (i4 = 0; i4 < data[i].jawaban.length; i4++) {
                            if (data[i].jawaban[i4].jawaban_opsi == 'E') {
                                html += 'checked'
                            }
                        }
                        html += '>' + data[i].opsi[i3].opsi_e + '</h5></td>'
                        html += '</tr>'
                    }
                }
                html += '</table>'
                html += '</form>'
                $('#konten').html(html);
            }
        });
    }
    $(document).on('click', '#mulai', function() {
        fungsi_next();
    });
    $(document).on('click', '#next', function() {
        $.ajax({
            method: 'POST',
            url: "<?= site_url('menu_mhs/ujian/simpan') ?>",
            data: $("#form_submit").serialize(),
            dataType: 'json',
            success: function(data) {
                Swal.fire({
                    title: data.hasil,
                    text: 'Klik OK',
                    icon: data.icon
                });
            }
        });
        fungsi_next();
    });
    $(document).on('click', '#pre', function() {
        fungsi_prev();
    });
    $(document).on('click', '#skip', function() {
        fungsi_next();
    });
    $(document).on('click', '#selesai', function() {
        $.ajax({
            method: 'POST',
            url: "<?= site_url('menu_mhs/ujian/simpan') ?>",
            data: $("#form_submit").serialize(),
            dataType: 'json',
            success: function(data) {
                // Swal.fire({
                //     title: data.hasil,
                //     text: 'Klik OK',
                //     icon: data.icon
                // });
                window.location = "<?= site_url('menu_mhs/ujian/hasil_pilgan/' . $this->uri->segment(4)) ?>"
            }
        });
        // fungsi_next();
    });
</script>