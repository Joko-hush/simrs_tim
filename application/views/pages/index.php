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
              Tambah Kegiatan
            </button>
          </div>
          <div class="col-sm-8 text-end">
            <form action="<?= base_url('pages/index'); ?>" method="post" enctype='multipart/form-data'>
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
              <th></th>
              <th>No</th>
              <th>Waktu</th>
              <th>Unit</th>
              <th>Permasalahan</th>
              <th>Penyelsaian</th>
              <th>Client</th>
              <th>Paraf</th>
              <th>Status</th>
              <th>Option</th>
            </tr>
          </thead>
          <tbody class="align-middle">
            <?php $n = 1;
            foreach ($kegiatan as $k) : ?>
              <?php
              $u = $this->master_models->getAllSubUnitByUnit($k['unit_id']);
              if ($k['status'] == 1) {
                $c = "SELESAI";
              } else {
                $c = 'DIPROSES';
              }

              ?>
              <tr class="<?= $c; ?>">
                <td class="text-center">
                  <a href="<?= base_url('pages/lihatKunjungan') . '?id=' . $k['id']; ?>">
                    <i class="fa-solid fa-eye"></i>
                  </a>
                </td>
                <td><?= $n++; ?></td>
                <td><?= $k['waktu']; ?></td>
                <?php if (!$u) : ?>
                  <td></td>
                <?php else : ?>
                  <td><?= $u['unit']; ?></td>
                <?php endif; ?>
                <td><?= $k['masalah']; ?></td>
                <td><?= $k['penyelsaian']; ?></td>
                <td><?= $k['mengetahui']; ?></td>
                <td>
                  <a href="<?= base_url('pages/paraf') . '?id=' . $k['id']; ?>" class="btn btn-success">
                    PARAF
                  </a>
                </td>
                <td><?= $c; ?></td>
                <td>
                  <a href="<?= base_url('pages/edit') . '?id=' . $k['id']; ?>" class="btn btn-warning">
                    EDIT
                  </a>
                  <a href="<?= base_url('pages/delete') . '?id=' . $k['id']; ?>" class="btn btn-danger" onclick="return confirm('Anda akan menghapus kegiatan ini. Lanjutkan?')">
                    DELETE
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

          <form method="POST" action="<?= base_url('pages/tambahKegiatan'); ?>">
            <div class="row justify-space-between py-2">
              <div class="col-lg-12">
                <div class="input-group input-group-static mb-4">
                  <label>Unit</label>
                  <Select class="form-control" name="unit">
                    <option value="">Pilih Unit</option>
                    <?php foreach ($subunit as $su) : ?>
                      <option value="<?= $su['subunit']; ?>"><?= $su['subunit']; ?></option>
                    <?php endforeach; ?>
                  </Select>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="input-group input-group-static mb-4">
                  <label>Unit Lain</label>
                  <input type="text" class="form-control" name="unitlain" id="unitlain" placeholder="di isi bila tidak ada di daftar unit">
                </div>
              </div>
              <div class="col-lg-12">
                <div class="input-group input-group-static mb-4">
                  <label>Jenis Masalah</label>
                  <Select class="form-control" name="jp">
                    <option value="">Pilih Jenis Permasalahan</option>
                    <?php foreach ($masalah as $m) : ?>
                      <option value="<?= $m['id']; ?>"><?= $m['masalah']; ?></option>
                    <?php endforeach; ?>
                  </Select>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="input-group input-group-static mb-4">
                  <label>Permasalahan</label>
                  <textarea class="form-control" name="masalah" id="masalah" rows="5"></textarea>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="input-group input-group-static mb-4">
                  <label>Penyelsaian Masalah</label>
                  <textarea class="form-control" name="penyelsaian" id="penyelsaian" rows="5"></textarea>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="input-group input-group-static mb-4">
                  <label>Tambahkan File</label>
                  <input class="form-control" type="file" name="image" id="image">
                </div>
              </div>
              <div class="col-lg-12">
                <div class="input-group input-group-static mb-4">
                  <label>Nama</label>
                  <input class="form-control" type="text" name="client" id="client">
                </div>
              </div>

              <div class="col-md-12">
                <label class="text-left" for="">Tanda Tangan:</label>

                <br />
                <div id="sig"></div>
                <br />
                <button id="clear" class="btn btn-primary">Hapus Tanda Tangan</button>
                <textarea id="signature64" name="signed" style="display: none"></textarea>
              </div>

            </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn bg-gradient-dark mb-0" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn bg-gradient-primary mb-0">Save changes</button>
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
  </script>