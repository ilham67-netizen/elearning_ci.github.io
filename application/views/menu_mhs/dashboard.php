    <div class="page-title">
        <h3>Dashboard</h3>
        <p class="text-subtitle text-muted">A good dashboard to display your statistics</p>
    </div>
    <section class="section">
        <div class="row mb-2">
            <div class="col-12 col-md-3">
                <div class="card card-statistic">
                    <div class="card-body p-0">
                        <div class="d-flex flex-column">
                            <div class='px-3 py-3 d-flex justify-content-between'>
                                <h3 class='card-title'>Jumlah Mata Kuliah</h3>
                                <div class="card-right d-flex align-items-center">
                                    <p><?= $jml_matkul; ?></p>
                                </div>
                            </div>
                            <div class="chart-wrapper">
                                <canvas id="canvas1" style="height:100px !important"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="card card-statistic">
                    <div class="card-body p-0">
                        <div class="d-flex flex-column">
                            <div class='px-3 py-3 d-flex justify-content-between'>
                                <h3 class='card-title'>Jumlah Tugas</h3>
                                <div class="card-right d-flex align-items-center">
                                    <p><?= $jml_tugas; ?></p>
                                </div>
                            </div>
                            <div class="chart-wrapper">
                                <canvas id="canvas3" style="height:100px !important"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class='card-heading p-1 pl-3'>Jadwal Perkuliahan</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div id='calendar1'></div>
                                </div>
                                <div class="col">
                                    <div id='calendar2'></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
    </section>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var initialLocaleCode = 'id';
            // var localeSelectorEl = document.getElementById('locale-selector');

            var calendarEl = document.getElementById('calendar1');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                themeSystem: 'dark',
                headerToolbar: {
                    left: 'prev,next, today',
                    center: 'title',
                    right: 'dayGridMonth'
                },
                initialDate: '<?= date('Y-m-d') ?>',
                initialView: 'dayGridMonth',
                locale: initialLocaleCode,
                buttonIcons: true, // show the prev/next text
                weekNumbers: true,
                navLinks: true, // can click day/week names to navigate views
                dayMaxEvents: true, // allow "more" link when too many events
                events: [
                    <?php foreach ($jadwal as $d) : {
                            # code...
                        } ?> {
                            title: '<?= $d->nama_kuliah . "(" . $d->nama_matkul . ")" ?>',
                            start: '<?= date('Y-m-d', strtotime($d->waktu_mulai)) ?>T<?= date('H:i', strtotime($d->waktu_mulai)) ?>'
                        },
                    <?php endforeach; ?>
                ]
            });

            calendar.render();

        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var initialLocaleCode = 'id';
            // var localeSelectorEl = document.getElementById('locale-selector');

            var calendarEl = document.getElementById('calendar2');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                themeSystem: 'dark',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'listMonth'
                },
                initialDate: '<?= date('Y-m-d') ?>',
                initialView: 'listMonth',
                locale: initialLocaleCode,
                buttonIcons: true, // show the prev/next text
                weekNumbers: true,
                navLinks: true, // can click day/week names to navigate views
                dayMaxEvents: true, // allow "more" link when too many events
                events: [
                    <?php foreach ($jadwal as $d) : {
                            # code...
                        } ?> {
                            title: '<?= $d->nama_kuliah . "(" . $d->nama_matkul . ")" ?>',
                            start: '<?= date('Y-m-d', strtotime($d->waktu_mulai)) ?>T<?= date('H:i', strtotime($d->waktu_mulai)) ?>'
                        },
                    <?php endforeach; ?>
                ]
            });

            calendar.render();

            //     // build the locale selector's options
            //     calendar.getAvailableLocaleCodes().forEach(function(localeCode) {
            //       var optionEl = document.createElement('option');
            //       optionEl.value = localeCode;
            //       optionEl.selected = localeCode == initialLocaleCode;
            //       optionEl.innerText = localeCode;
            //       localeSelectorEl.appendChild(optionEl);
            //   });

            //     // when the selected option changes, dynamically change the calendar option
            //     localeSelectorEl.addEventListener('change', function() {
            //       if (this.value) {
            //         calendar.setOption('locale', this.value);
            //     }
            // });


        });
    </script>