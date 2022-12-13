  <header class="header-2">
      <div class="page-header min-vh-25 relative" style="background-image: url('<?= base_url(); ?>assets/img/long_corridor.webp')">
          <!-- <div class="page-header min-vh-50 relative" style="background-image: url('<?= base_url(); ?>assets/img/bg2.jpg')"> -->
          <span class="mask bg-gradient-primary opacity-4"></span>
          <div class="container">

              <h1 class="text-dark"><?= $judul; ?></h1>
              <?= $this->session->flashdata('message'); ?>
              <?php unset($_SESSION['message']); ?>

          </div>
      </div>
  </header>

  <div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6">
      <section class="pt-3 pb-4" id="count-stats">
          <div class="container">
              <div class="row">
                  <div class="col-sm-5">

                  </div>
                  <div class="col-md-7">
                      <form action="<?= base_url('meeting/index'); ?>" method="post">
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
              <div class="col-sm-3  ">
                  <button type="button" class="btn btn-sm bg-gradient-primary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                      Tambah Acara
                  </button>
              </div>
              <?php if ($device == 'PC/Laptop') : ?>
                  <div class="table-responsive">
                      <table class="table table-sm table-bordered stripped" id="myTable">
                          <thead>
                              <tr>
                                  <th>NAMA</th>
                                  <th>TGL</th>
                                  <th>JAM</th>
                                  <th>DAFTAR HADIR</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php foreach ($meeting as $m) : ?>
                                  <tr>
                                      <td>
                                          <a href="<?= base_url('meeting/detail') . '?id=' . $m['id']; ?>" style="direction: none;">
                                              <?= $m['nama']; ?>
                                          </a>
                                      </td>
                                      <td><?= $m['tgl']; ?></td>
                                      <td><?= substr($m['mulai'], 0, 8); ?></td>
                                      <td>
                                          <a href="<?= base_url('meeting/daftarHadir') . '?id=' . $m['id']; ?>">Buka Daftar Hadir</a>
                                      </td>
                                  </tr>
                              <?php endforeach; ?>
                          </tbody>
                      </table>
                  </div>
              <?php else : ?>
                  <ol>
                      <?php foreach ($meeting as $me) : ?>
                          <li>
                              <a href="<?= base_url('meeting/detail') . '?id=' . $me['id']; ?>" style="direction: none;">
                                  <?= $me['nama']; ?>
                              </a>
                          </li>
                      <?php endforeach; ?>
                  </ol>
              <?php endif; ?>
          </div>
  </div>
  </section>
  </div>

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">INPUT ACARA</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">

                  <form method="POST" action="<?= base_url('meeting/save'); ?>">
                      <div class="row justify-space-between py-2">
                          <div class="col-lg-12">
                              <div class="input-group input-group-static mb-4">
                                  <label>Nama Acara</label>
                                  <input type="text" class="form-control" name="nama" id="nama" placeholder="Di isi dengan nama Acara">
                              </div>
                          </div>
                          <div class="col-lg-12">
                              <div class="input-group input-group-static mb-4">
                                  <label>Tanggal</label>
                                  <input type="date" class="form-control" name="tgl" id="tgl" placeholder="Tanggal diselenggarakan">
                              </div>
                          </div>
                          <div class="col-lg-12">
                              <div class="input-group input-group-static mb-4">
                                  <label>Jam Mulai</label>
                                  <input type="time" class="form-control" name="mulai" id="mulai" placeholder="Tanggal diselenggarakan">
                              </div>
                          </div>
                          <div class="col-lg-12">
                              <div class="input-group input-group-static mb-4">
                                  <label>Jam Selesai</label>
                                  <input type="time" class="form-control" name="akhir" id="akhir" placeholder="Tanggal diselenggarakan">
                              </div>
                          </div>
                      </div>
              </div>
              <div class="modal-footer justify-content-between">
                  <button type="button" class="btn bg-gradient-dark mb-0" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn bg-gradient-primary mb-0" id="save">Save changes</button>
                  </form>
              </div>
          </div>
      </div>
  </div>