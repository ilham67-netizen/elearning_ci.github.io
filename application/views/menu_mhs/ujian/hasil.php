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
                     <li class="breadcrumb-item"><a href="<?= site_url('menu_mhs/ujian') ?>">Menu Ujian</a></li>
                     <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
                 </ol>
             </nav>
         </div>
     </div>
 </div>
 <section class="section">
     <div class="card">

         <div class="card-body">
             <center>
                 <h3>Jumlah Benar = <?= $benar; ?></h3>
                 <h3>Jumlah Salah = <?= $salah; ?></h3>
                 <h3>Jumlah Tidak Dijawab = <?= $tidak_dikerjakan; ?></h3>
                 <h3>Jumlah Nilai = <?= $nilai; ?></h3>
             </center>
             <a href="<?= site_url('menu_mhs/ujian') ?>" class="btn btn-primary">Kembali Ke Menu</a>
         </div>
     </div>
 </section>