   <div class="page-heading">
       <div class="page-title">
           <div class="row">
               <div class="text-center">
                   <div class="d-block">
                       <img src="<?= base_url('assets/image/logo-sn.png') ?>" alt="Logo" width="100" height="75">
                   </div>
                   <h3>Pemasukan</h3>
                   <p class="text-subtitle text-muted">Pemasukan Tamanpedia.</p>
               </div>
           </div>
       </div>
       <section class="section">
           <div class="card">
               <div class="card-header">
                   <h4 class="card-title">Tambah Pemasukan</h4>
               </div>
               <div class="card-body">
                   <button class="btn btn-small btn-success" data-bs-toggle="modal" data-bs-target="#modal_pemasukan">+ Tambah</button>
               </div>
           </div>

           <hr />
           <!-- Section 2 -->
           <h6 class="card-title mb-2">Data Pemasukan</h6>
           <div class="row">
               <div class="col-6 col-lg-3 col-md-6">
                   <div class="card">
                       <div class="card-body px-4 py-4-5">
                           <div class="row">
                               <div class="col">
                                   <h6 class="text-muted font-semibold">Hari ini</h6>
                                   <h6 class="font-extrabold mb-0" id="pemasukan_hari_ini">112.000</h6>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
               <div class="col-6 col-lg-3 col-md-6">
                   <div class="card">
                       <div class="card-body px-4 py-4-5">
                           <div class="row">
                               <div class="col">
                                   <h6 class="text-muted font-semibold">Bulan ini</h6>
                                   <h6 class="font-extrabold mb-0" id="pemasukan_bulan_ini">112.000</h6>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
               <div class="col-6 col-lg-3 col-md-6">
                   <div class="card">
                       <div class="card-body px-4 py-4-5">
                           <div class="row">
                               <div class="col">
                                   <h6 class="text-muted font-semibold">Tahun ini</h6>
                                   <h6 class="font-extrabold mb-0" id="pemasukan_tahun_ini">112.000</h6>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>

           <hr />
           <!-- Section 3 -->
           <h6 class="card-title mb-2">Pemasukan Terbaru</h6>
           <div class="col-12" id="data-pemasukan">

           </div>
           <a href="<?= base_url('pemasukan') ?>" class="btn btn-sm btn-primary">Selengkapnya</a>

           <hr />
       </section>

       <!-- MODAL PEMASUKAN -->
       <div class="modal fade" id="modal_pemasukan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
           <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title" id="exampleModalCenterTitle">Form Pemasukan
                       </h5>
                       <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                           <i data-feather="x"></i>
                       </button>
                   </div>
                   <div class="modal-body">
                       <form class="form form-vertical" id="form-pemasukan">
                           <div class="form-body">
                               <div class="row">
                                   <div class="col-12">
                                       <div class="form-group">
                                           <label for="pemasukan_tgl text-sm">Tanggal</label>
                                           <input type="date" id="pemasukan_tgl" class="form-control" name="pemasukan_tgl" required>
                                       </div>
                                   </div>
                                   <div class="col-12">
                                       <div class="form-group">
                                           <label for="pemasukan_kategori text-sm">Kategori Pemasukan</label>
                                           <select class="form form-select pemasukan_kategori" name="pemasukan_kategori" id="pemasukan_kategori" required>
                                               <option value=" "></option>
                                               <?php
                                                $i = 0;
                                                foreach ($kategori as $kt) : ?>
                                                   <option value="<?= $kt->kategori_id ?>"><?= $kt->kategori; ?></option>
                                               <?php endforeach; ?>
                                           </select>
                                       </div>
                                   </div>
                                   <div class="col-12">
                                       <div class="form-group">
                                           <label for="pemasukan_sumber text-sm">Kontributor</label>
                                           <input type="text" id="pemasukan_sumber" class="form-control" name="pemasukan_sumber" placeholder="Cth: Sumarno" required>
                                       </div>
                                   </div>
                                   <div class="col-12">
                                       <div class="form-group">
                                           <label for="contact-info-vertical">Total</label>
                                           <div class="input-group mb-3">
                                               <span class="input-group-text" id="basic-addon1">Rp.</span>
                                               <input type="text" name="pemasukan_total" class="form-control pemasukan_total rupiah" placeholder="0" aria-label="Total" aria-describedby="basic-addon1" required>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="col-12">
                                       <div class="form-group">
                                           <label for="contact-info-vertical">Keterangan</label>
                                           <textarea class="form-control" placeholder="Keterangan" name="pemasukan_keterangan" id="floatingTextarea" rows="5" required></textarea>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </form>
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-light-secondary btn-sm" data-bs-dismiss="modal">
                           <span class="d-sm-block">Close</span>
                       </button>
                       <button type="button" class="btn btn-primary ml-1 btn-sm" id="btn-add-pemasukan">
                           <span class="d-sm-block">Simpan</span>
                       </button>
                   </div>
               </div>
           </div>
       </div>
   </div>
   </div>
   </div>
   <script>
       $(document).ready(function() {
           $('.sidebar-item').removeClass('active');
           $('#sidebar-dashboard').addClass('active');
           $('.rupiah').priceFormat({
               prefix: '',
               centsLimit: 0,
               thousandSeparator: ','
           });
           $('.rupiah_satuan').priceFormat({
               prefix: '',
               centsLimit: 0,
               thousandSeparator: ','
           });
           getToday();
           getMonth();
           getYear();
           renderPemasukan();
       });

       //BTN ADD Pemasukan
       $('#btn-add-pemasukan').on('click', function() {
           // Get CSRF token
           var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
           var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';

           // Get form values
           var formData = {
               [csrfName]: csrfHash, // Include CSRF token
               'pemasukan_kategori': $('select[name=pemasukan_kategori]').val(),
               'pemasukan_tgl': $('input[name=pemasukan_tgl]').val(),
               'pemasukan_sumber': $('input[name=pemasukan_sumber]').val(),
               'pemasukan_total': $('input[name=pemasukan_total]').val(),
               'pemasukan_keterangan': $('textarea[name=pemasukan_keterangan]').val()
           };

           // Convert numeric value properly
           if (formData.pemasukan_total) {
               formData.pemasukan_total = parseFloat(
                   formData.pemasukan_total.replace(/[^0-9.]/g, '')
               ) || 0;
           }

           $.ajax({
               type: 'POST',
               url: '<?= site_url("pemasukan/add") ?>',
               data: formData,
               dataType: 'json', // 👈 Critical for JSON parsing
               success: function(response) {
                   if (response.status === 'success') {
                       window.location.reload();
                   } else {
                       alert('Error: ' + response.message);
                   }
               },
               error: function(xhr) {
                   var url = '<?= site_url("pemasukan/add") ?>';
                   console.log(url);
                   console.error("AJAX Error:", xhr.responseText);
                   alert('Terjadi kesalahan. Cek konsol untuk detail.');
               }
           });
       });


       function renderPemasukan() {
           $.ajax({
                   url: '<?= base_url('pemasukan/get_data') ?>',
                   type: 'POST',
                   dataType: 'json'
               })
               .done(function(response) {
                   const container = $('#data-pemasukan');
                   let html = '';
                   // Check if response is valid and has data
                   if (Array.isArray(response) && response.length > 0) {
                       // Show maximum 5 items
                       const itemsToShow = response.slice(0, 5);
                       itemsToShow.forEach(item => {
                           html += `
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="text-right">
                                            ${item.pemasukan_tgl || '-'}
                                        </div>
                                        <h6>${item.pemasukan || 'No Category'}</h6>
                                        <p>${item.pemasukan_keterangan || 'No Description'}</p>
                                        <hr>
                                        <h6>Rp. ${formatRupiah(item.pemasukan_total?.toString() || '0')}</h6>
                                    </div>
                                </div>
                            </div>`;
                       });
                   } else {
                       html = `
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body text-center">
                                        <h6>Data Kosong</h6>
                                    </div>
                                </div>
                            </div>`;
                   }
                   container.html(html);
               })
               .fail(function(xhr, status, error) {
                   console.error('AJAX Error:', status, error);
                   $('#data-pemasukan').html(`
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body text-center text-danger">
                                <h6>Gagal memuat data</h6>
                            </div>
                        </div>
                    </div>`);
               });
       }

       //Format Rupiah
       function formatRupiah(angka, prefix) {
           var number_string = angka.replace(/[^,\d]/g, '').toString(),
               split = number_string.split(','),
               sisa = split[0].length % 3,
               rupiah = split[0].substr(0, sisa),
               ribuan = split[0].substr(sisa).match(/\d{3}/gi);

           // tambahkan titik jika yang di input sudah menjadi angka ribuan
           if (ribuan) {
               separator = sisa ? ',' : '';
               rupiah += separator + ribuan.join(',');
           }

           rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
           return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
       }

       //Get Selected Value ID 
       function get_selected_id() {
           var e = document.getElementById('select_kategori');
           var value = e.value;
           var text = e.options[e.selectedIndex].text;
           return text;
       }

       function getToday() {
           const padNumber = num => num.toString().padStart(2, '0'); // Helper for date formatting
           const today = new Date();

           // Format dates as YYYY-MM-DD
           const dateString = `${today.getFullYear()}-${padNumber(today.getMonth() + 1)}-${padNumber(today.getDate())}`;

           $.ajax({
                   type: 'GET', // Changed to GET as we're fetching data
                   url: '<?= base_url('pemasukan/get_data_by_date') ?>',
                   dataType: 'json',
                   data: {
                       datefrom: dateString,
                       dateto: dateString
                   }
               })
               .done(response => {
                   // 1. Access the nested array
                   const items = response.data || [];

                   // 2. Validate structure
                   const isValidResponse = (
                       Array.isArray(items) &&
                       items.length > 0 &&
                       items.every(item => 'pemasukan_total' in item)
                   );

                   // 3. Calculate total
                   const total = isValidResponse ?
                       items.reduce((sum, item) => sum + (Number(item.pemasukan_total) || 0), 0) :
                       0;

                   $('#pemasukan_hari_ini').html(`<span class="currency-symbol">Rp</span>${formatRupiah(total.toString())}`);
               })
               .fail((xhr, status, error) => {
                   console.error('Error fetching today\'s data:', error);
                   $('#pemasukan_hari_ini').html(`<span class="error-text">Gagal memuat data</span>`);
               });
       }

       function getMonth() {
           const padNumber = num => num.toString().padStart(2, '0'); // Helper for date formatting

           const today = new Date();

           var datefrom = `${today.getFullYear()}-${padNumber(today.getMonth() + 1)}-${padNumber(1)}`;
           var dateto = `${today.getFullYear()}-${padNumber(today.getMonth() + 1)}-${padNumber(31)}`;

           console.log(datefrom);
           console.log(dateto);

           $.ajax({
                   type: 'GET', // Changed to GET as we're fetching data
                   url: '<?= base_url('pemasukan/get_data_by_date') ?>',
                   dataType: 'json',
                   data: {
                       datefrom: datefrom,
                       dateto: dateto
                   }
               })
               .done(response => {
                   // 1. Access the nested array
                   const items = response.data || [];
                   console.log(items);

                   // 2. Validate structure
                   const isValidResponse = (
                       Array.isArray(items) &&
                       items.length > 0 &&
                       items.every(item => 'pemasukan_total' in item)
                   );

                   // 3. Calculate total
                   const total = isValidResponse ?
                       items.reduce((sum, item) => sum + (Number(item.pemasukan_total) || 0), 0) :
                       0;

                   $('#pemasukan_bulan_ini').html(`<span class="currency-symbol">Rp</span>${formatRupiah(total.toString())}`);
               })
               .fail((xhr, status, error) => {
                   console.error('Error fetching Monthly\'s data:', error);
                   $('#pemasukan_bulan_ini').html(`<span class="error-text">Gagal memuat data</span>`);
               });
       }

       function getYear() {
           const tgl = new Date();
           let d = tgl.getDate();
           let m = tgl.getMonth() + 1;
           let y = tgl.getFullYear();

           var datefrom = y + "-" + "1" + "-" + "1";
           var dateto = y + "-" + m + "-" + d;


           $.ajax({
               type: 'POST',
               url: '<?= base_url('pemasukan/get_data_by_date') ?>',
               dataType: 'json',
               data: {
                   'datefrom': datefrom,
                   'dateto': dateto
               },
               success: function(response) {
                   var i;
                   var sum = 0;
                   if (response.length != 0) {
                       for (i = 0; i < response.length; i++) {
                           sum += parseInt(response[i].pemasukan_total)
                       }
                   }
                   $('#pemasukan_tahun_ini').text("Rp. " + formatRupiah(sum.toString()))
               },
           })
       }
   </script>