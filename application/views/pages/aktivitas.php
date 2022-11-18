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
              <div class="table-responsive">
                  <table class="table table-bordered table-sm" id="tableKegiatan">
                      <thead>
                          <tr>
                              <th>No</th>
                              <th>Waktu</th>
                              <th>User</th>
                              <th>Aktivitas</th>
                              <th>Client</th>
                              <th>Ket</th>
                          </tr>
                      </thead>
                      <tbody class="align-middle">
                          <?php $n = 1;
                            foreach ($logs as $l) : ?>
                              <tr>
                                  <td><?= $n++; ?></td>
                                  <td><?= date('Y-m-d H:i:s', $l['waktu']); ?></td>
                                  <?php $u = $this->master_models->getUserById($l['user_id']); ?>
                                  <td><?= $u['user']; ?></td>
                                  <td><?= $l['aktifitas']; ?></td>
                                  <td><?= $l['dari']; ?></td>
                                  <td><?= $l['menjadi']; ?></td>
                              </tr>
                          <?php endforeach; ?>
                      </tbody>
                  </table>
              </div>
          </div>

      </section>
  </div>