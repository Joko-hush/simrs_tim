  <header class="header-2">
    <div class="page-header min-vh-25 relative" style="background-image: url('<?= base_url(); ?>assets/img/long_corridor.webp')">
      <!-- <div class="page-header min-vh-50 relative" style="background-image: url('<?= base_url(); ?>assets/img/bg2.jpg')"> -->
      <span class="mask bg-gradient-primary opacity-4"></span>
      <div class="container">
        <h1 class="text-white"><?= $judul; ?></h1>

        <?= $this->session->flashdata('message'); ?>
        <?php unset($_SESSION['message']); ?>
      </div>
    </div>
  </header>

  <div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6">
    <section class="pt-3 pb-4" id="count-stats">
      <div class="container">
        <div class="row">
          <div class="col-sm-4">
            <button type="button" class="btn bg-gradient-primary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
              Tambah
            </button>
          </div>
          <div class="col-sm-8 text-end">
            <form action="<?= base_url('ekspedisi/index'); ?>" method="post" enctype='multipart/form-data'>
              <div class="row align-middle">
                <div class="col-sm-3">Tanggal</div>
                <div class="col-sm-4">
                  <div class="input-group input-group-static mb-4">
                    <label>Dari</label>
                    <input class="form-control" type="date" name="date1" id="date1" value="<?= $date1; ?>">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="input-group input-group-static mb-4">
                    <label>Sampai</label>
                    <input class="form-control" type="date" name="date2" id="date2" value="<?= $date2; ?>">
                  </div>
                </div>
                <div class="col-sm-1">
                  <button type="submit" class="btn btn-success">Cari</button>
                </div>
            </form>
          </div>
        </div>
      </div>


      <div class="table-responsive">
        <table class="table table-bordered table-sm" id="tableKegiatan">
          <thead>
            <tr>
              <!-- <th></th> -->
              <th>No</th>
              <th>Nomor</th>
              <th>Perihal</th>
              <th>Penerima</th>
              <th>Status</th>
              <th>Option</th>
            </tr>
          </thead>
          <tbody class="align-middle">
            <?php $n = 1;
            foreach ($ekspedisi as $e) : ?>
              <?php
              if ($e['status'] == 1) {
                $c = "SELESAI";
              } else {
                $c = 'DIPROSES';
              }
              ?>
              <tr>
                <td><?= $n++; ?></td>
                <td><?= $e['nomor']; ?></td>
                <td><?= $e['perihal']; ?></td>
                <td><?= $e['penerima']; ?></td>
                <td><?= $c; ?></td>
                <td>
                  <a href="<?= base_url('ekspedisi/paraf') . '?id=' . $e['id']; ?>" class="btn btn-success">
                    PARAF
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
  </div>
  </section>
  </div>



  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">INPUT KEGIATAN</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <form method="POST" action="<?= base_url('ekspedisi/tambah'); ?>">
            <div class="col-lg-12">
              <div class="input-group input-group-static mb-4" id="form_unit">
                <label>Unit</label>
                <Select class="form-control chosen-select" name="unit" id="unit">
                  <option value="-"></option>
                  <option value="-">-</option>
                  <?php foreach ($subunit as $su) : ?>
                    <option value="<?= $su['subunit']; ?>"><?= $su['subunit']; ?></option>
                  <?php endforeach; ?>
                </Select>
              </div>
            </div>
            <div class="col-lg-12" id="form_unitLain">
              <div class="input-group input-group-static mb-4">
                <label>Unit Lain</label>
                <input type="text" class="form-control" name="unitlain" id="unitlain" placeholder="di isi bila tidak ada di daftar unit">
              </div>
            </div>
            <div class="row justify-space-between py-2">
              <div class="col-lg-12">
                <div class="input-group input-group-static mb-4">
                  <label>Nomor</label>
                  <input type="text" name="nomor" id="nomor" class="form-control">
                </div>
              </div>

              <div class="col-lg-12">
                <div class="input-group input-group-static mb-4">
                  <label>Perihal</label>
                  <input type="text" name="perihal" id="perihal" class="form-control">
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn bg-gradient-dark mb-0" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="simpan" class="btn bg-gradient-primary mb-0">Save changes</button>
          </form>
        </div>
      </div>
    </div>
  </div>


  <script type="text/javascript">
    var sig = $('#sig').signature({
      syncField: '#signature64',
      syncFormat: 'PNG'
    });
    $('#clear').click(function(e) {
      e.preventDefault();
      sig.signature('clear');
      $("#signature64").val('');
    });

    $(".chosen-select").chosen({
      disable_search_threshold: 10,
      width: "100%",
      max_selected_options: 3,
      no_results_text: "Oops, nothing found!"
    });

    const a = document.querySelector('#form_unitLain');

    window.addEventListener('load', () => {
      a.style.display = 'none';
    })

    $("#unit").change(function() {
      let e = $("#unit option:selected").val();
      if (e == '-') {
        a.style.display = 'block';
      } else {
        a.style.display = 'none';
      }
    });
  </script>