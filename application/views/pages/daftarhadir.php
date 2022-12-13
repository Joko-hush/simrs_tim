  <header class="header-2">
      <div class="page-header min-vh-25 relative" style="background-image: url('<?= base_url(); ?>assets/img/long_corridor.webp')">
          <span class="mask bg-gradient-primary opacity-4"></span>
          <div class="container">
              <h1 class="text-dark"><?= $judul; ?></h1>
          </div>
      </div>
  </header>

  <div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6">
      <section class="pt-3 pb-4" id="count-stats">
          <div class="container">

              <div class="table-responsive">
                  <table class="table table-sm table-bordered stripped text-center" id="myTable">
                      <thead>
                          <tr>
                              <th>NO</th>
                              <th>NAMA</th>
                              <th>PANGKAT</th>
                              <th>BAGIAN/UNIT</th>
                              <th>TTD</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php $i = 1;
                            foreach ($daftarhadir as $m) : ?>
                              <tr>
                                  <td><?= $i++; ?></td>
                                  <td>
                                      <?= $m['nama']; ?>
                                  </td>
                                  <td><?= $m['pangkat']; ?></td>
                                  <td><?= $m['bagian']; ?></td>
                                  <td>
                                      <a href="<?= base_url('assets/img/ttd/') . $m['ttd']; ?>" target="_blank()">
                                          <img src="<?= base_url('assets/img/ttd/') . $m['ttd']; ?>" alt="tanda tangan" class="img img-thumbnail" width="250">
                                      </a>
                                  </td>
                              </tr>
                          <?php endforeach; ?>
                      </tbody>
                  </table>
              </div>

          </div>
  </div>
  </section>
  </div>