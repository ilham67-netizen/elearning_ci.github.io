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

            </h3>
            <center><a style=" float: left; margin-right: 10px; margin-left: 500px;" href="<?= site_url("pelatihan/download_pelatihan/" . $this->uri->segment(4)) ?>" class="btn btn-danger center-block" style=" float: left; margin-right: 10px; ">SOAL</a></center>
            <form class="form">
                <input type="submit" class="btn btn-default" value="RUN"></input>
        </div>
    </div>
    </div>

    <div id="mainContent" class="mainContent">
        <div id="mainContentHolder">
            <div id="draggable"></div>
            <div class="main-left">
                <div class="left-inner-content">
                    <div class="left-inner-main">
                        <textarea id='editor' name='editor'></textarea>
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
                                }
                            });


                        }
                    });
                    return false;
                });
            });
        });
    </script>
</body>

</html>