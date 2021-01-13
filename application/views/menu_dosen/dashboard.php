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
                                <h3 class='card-title'>Jumlah Mahasiswa</h3>
                                <div class="card-right d-flex align-items-center">
                                    <p><?= $jml_mhs_ampu; ?></p>
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
                                <h3 class='card-title'>JUMLAH TUGAS</h3>
                                <div class="card-right d-flex align-items-center">
                                    <p><?= $jml_tugas_ampu; ?></p>
                                </div>
                            </div>
                            <div class="chart-wrapper">
                                <canvas id="canvas3" style="height:100px !important"></canvas>
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
                                <h3 class='card-title'>JUMLAH MATKUL</h3>
                                <div class="card-right d-flex align-items-center">
                                    <p><?= $jml_matkul_ampu; ?></p>
                                </div>
                            </div>
                            <div class="chart-wrapper">
                                <canvas id="canvas4" style="height:100px !important"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class='card-heading p-1 pl-3'>Jadwal Perkuliahan</h3>
                    </div>
                    <div class="card-body">
                        <div id='calendar'></div>
                    </div>
                </div>

            </div>

        </div> -->
    </section>
    </div>
    <script>
        //                 document.addEventListener('DOMContentLoaded', function() {
        //                   var initialLocaleCode = 'id';
        //     // var localeSelectorEl = document.getElementById('locale-selector');

        //     var calendarEl = document.getElementById('calendar');
        //     var calendar = new FullCalendar.Calendar(calendarEl, {
        //       theme: 'journal',
        //       headerToolbar: {
        //         left: 'prev,next today',
        //         center: 'title',
        //         right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        //       },
        //       initialDate: '2020-09-12',
        //       locale: initialLocaleCode,
        //       buttonIcons: false, // show the prev/next text
        //       weekNumbers: true,
        //       navLinks: true, // can click day/week names to navigate views
        //       dayMaxEvents: true, // allow "more" link when too many events
        //       events: [
        //       {
        //         title: 'All Day Event',
        //         start: '2020-09-01'
        //       },
        //       {
        //         title: 'Long Event',
        //         start: '2020-09-07',
        //         end: '2020-09-10'
        //       },
        //       {
        //         groupId: 999,
        //         title: 'Repeating Event',
        //         start: '2020-09-09T16:00:00'
        //       },
        //       {
        //         groupId: 999,
        //         title: 'Repeating Event',
        //         start: '2020-09-16T16:00:00'
        //       },
        //       {
        //         title: 'Conference',
        //         start: '2020-09-11',
        //         end: '2020-09-13'
        //       },
        //       {
        //         title: 'Meeting',
        //         start: '2020-09-12T10:30:00',
        //         end: '2020-09-12T12:30:00'
        //       },
        //       {
        //         title: 'Lunch',
        //         start: '2020-09-12T12:00:00'
        //       },
        //       {
        //         title: 'Meeting',
        //         start: '2020-09-12T14:30:00'
        //       },
        //       {
        //         title: 'Happy Hour',
        //         start: '2020-09-12T17:30:00'
        //       },
        //       {
        //         title: 'Dinner',
        //         start: '2020-09-12T20:00:00'
        //       },
        //       {
        //         title: 'Birthday Party',
        //         start: '2020-09-13T07:00:00'
        //       },
        //       {
        //         title: 'Click for Google',
        //         url: 'http://google.com/',
        //         start: '2020-09-28'
        //       }
        //       ]
        //     });

        //     calendar.render();

        // //     // build the locale selector's options
        // //     calendar.getAvailableLocaleCodes().forEach(function(localeCode) {
        // //       var optionEl = document.createElement('option');
        // //       optionEl.value = localeCode;
        // //       optionEl.selected = localeCode == initialLocaleCode;
        // //       optionEl.innerText = localeCode;
        // //       localeSelectorEl.appendChild(optionEl);
        // //   });

        // //     // when the selected option changes, dynamically change the calendar option
        // //     localeSelectorEl.addEventListener('change', function() {
        // //       if (this.value) {
        // //         calendar.setOption('locale', this.value);
        // //     }
        // // });


        // });
    </script>