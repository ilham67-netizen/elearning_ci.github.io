<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/editor_mirror/') ?>css/bootstrap.min.css">
    <link href="<?= base_url('assets/editor_mirror/') ?>css/main.css" rel="stylesheet">
    <link rel=stylesheet href="<?= base_url('assets/editor_mirror/') ?>lib/codemirror.css">
    <link rel="stylesheet" href="<?= base_url('assets/editor_mirror/') ?>css/material-darker.css">
    <script src="<?= base_url('assets/editor_mirror/') ?>js/1.12.4/jquery.min.js"></script>
    <script src="<?= base_url('assets/editor_mirror/') ?>js/1.12.4/jquery-ui.js"></script>

    <script src="<?= base_url('assets/editor_mirror/') ?>lib/codemirror.js"></script>
    <script src='<?= base_url('assets/editor_mirror/') ?>lib/xml.js'></script>
    <script src='<?= base_url('assets/editor_mirror/') ?>lib/javascript.js'></script>
    <script src='<?= base_url('assets/editor_mirror/') ?>lib/css.js'></script>
    <script src='<?= base_url('assets/editor_mirror/') ?>lib/closetag.js'></script>
    <script src='<?= base_url('assets/editor_mirror/') ?>js/custom.js'></script>
    <script src='<?= base_url('assets/editor_mirror/') ?>js/php.js'></script>
    <script src='<?= base_url('assets/editor_mirror/') ?>js/clike/clike.js'></script>
    <script src='<?= base_url('assets/editor_mirror/') ?>js/htmlmixed/htmlmixed.js'></script>
    <script src="<?= base_url() ?>assets/countdown/js/jquery.plugin.min.js"></script>
    <script src="<?= base_url() ?>assets/countdown/js/jquery.countdown.js"></script>
    <script src="<?= base_url() ?>assets/sweet_alert/sweetalert2.all.min.js"></script>
    <?php
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
    <style type="text/css">
        .CodeMirror {
            height: auto;
        }
    </style>
    <style>
        #timer {
            float: right;

        }

        #timer {
            color: #f5fe02;
            text-align: right;
        }
    </style>
</head>
<?php //$waktu = "120"; 
?>

<body>
    <div class="panel-primary header">
        <div class="panel-heading">
            <h3 class="panel-title">
                <div id="timer_place">
                    <span id="timer">00 : 00 : 00</span>
                </div>
            </h3>
            <center><a class="btn btn-success center-block" id="savexit" style=" float: left; margin-right: 10px; margin-left: 500px;">SAVE&EXIT</a><a href="<?= site_url("menu_mhs/ujian/download_soal/" . $row->kd_paket) ?>" class="btn btn-danger center-block" style=" float: left; margin-right: 10px; ">SOAL</a></center>
            <form class="form">
                <input type="submit" class="btn btn-default" value="RUN&SAVE"></input>


        </div>
    </div>
    </div>

    <div id="mainContent" class="mainContent">
        <div id="mainContentHolder">
            <div id="draggable"></div>
            <div class="main-left">
                <div class="left-inner-content">
                    <div class="left-inner-main">

                        <textarea id='editor' name='editor'><?= $jawab->teks_koding ?></textarea>
                        <input type="hidden" value="<?= $row->kd_paket ?>" name="kd_paket">
                        <input type="hidden" value="<?= $row->kd_pengawas ?>" name="kd_pengawas">

                    </div>
                </div>
            </div>
            </form>
            <div class="main-right">
                <div class="right-inner-content">
                    <div class="right-inner-main">

                        <div id="iframewrapper" style="background-color: #ffff;">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Initialize CodeMirror editor with a nice html5 canvas demo.
        var editor = CodeMirror.fromTextArea(document.getElementById('editor'), {
            mode: 'application/x-httpd-php',
            lineNumbers: true,
            theme: 'material-darker',

        });
        // submitTryit();
    </script>

    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(function() {
                function simpan() {
                    $.ajax({
                        type: 'POST',
                        url: "<?= site_url('menu_mhs/ujian/simpan_koding') ?>",
                        data: $(".form").serialize(),
                        dataType: 'json',
                        success: function(data) {
                            Swal.fire({
                                title: data.hasil,
                                text: 'Klik OK',
                                icon: data.icon
                            });
                        }
                    });
                }

                function update_text() {
                    editor.save();
                }
                $('.form').submit(function() {
                    $.ajax({
                        type: 'POST',
                        url: "<?= base_url('assets/editor_mirror/try_php.php') ?>",
                        data: $(this).serialize(),
                        success: function() {
                            $.ajax({
                                type: 'GET',
                                url: "<?= base_url('assets/editor_mirror/jajal2.php') ?>",
                                data: $(this).serialize(),
                                success: function(data) {
                                    $('#iframewrapper').html(data);
                                    var ifr = document.createElement("iframe");
                                    ifr.setAttribute("frameborder", "0");
                                    ifr.setAttribute("id", "iframeOutput");
                                    document.getElementById("iframewrapper").innerHTML = "";
                                    document.getElementById("iframewrapper").appendChild(ifr);
                                    var ifrw = (ifr.contentWindow) ? ifr.contentWindow : (ifr.contentDocument.document) ? ifr.contentDocument.document : ifr.contentDocument;
                                    ifrw.document.open();
                                    ifrw.document.write(data);
                                    ifrw.document.close();
                                    simpan();
                                }
                            });


                        }
                    });
                    return false;
                });
                $(document).on('click', '#savexit', function() {
                    update_text();
                    simpan();
                    window.location = "<?= site_url('menu_mhs/ujian/hasil_koding/' . $this->uri->segment(4)) ?>"
                });
            });
        });
    </script>
    <script type="text/javascript">
        function waktuHabis() {
            alert('Waktu Anda telah habis');
            // var frmSoal = document.getElementById("frmSoal"); 
            // frmSoal.submit(); 
            window.location.href = "<?= site_url('menu_mhs/ujian/hasil_koding') ?>";
            <?php $this->session->unset_userdata('waktu_start')
            ?>

        }

        function hampirHabis(periods) {
            if ($.countdown.periodsToSeconds(periods) == 60) {
                $(this).css({
                    color: "red"
                });

            }
        }
        $(function() {
            var waktu = <?= $row->waktu_soal ?> * 60;
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
</body>

</html>