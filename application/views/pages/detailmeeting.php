  <header class="header-2">
      <div class="page-header min-vh-25 relative" style="background-image: url('<?= base_url(); ?>assets/img/long_corridor.webp')">
          <!-- <div class="page-header min-vh-50 relative" style="background-image: url('<?= base_url(); ?>assets/img/bg2.jpg')"> -->
          <span class="mask bg-gradient-primary opacity-4"></span>
          <div class="container">
              <h1 class="text-white"><?= $judul; ?></h1>
          </div>
      </div>
  </header>

  <div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6">
      <section class="pt-3 pb-4" id="count-stats">
          <div class="container">

              <div class="card">
                  <div class="card-header text-center">
                      <h3><?= $m['nama']; ?></h3>
                  </div>
                  <div class="card-body text-center">
                      <div class="row">
                          <div class="col-sm-6">
                              <h5>Tanggal</h5>
                              <p><?= $m['tgl']; ?></p>
                          </div>
                          <div class="col-sm-6">
                              <h5>Waktu</h5>
                              <p>
                                  <?= substr($m['mulai'], 0, 8); ?> - <?= substr($m['selesai'], 0, 8); ?>
                              </p>
                          </div>
                      </div>
                      <div class="text-center">
                          <h5>Link untuk isi daftar hadir:</h5>
                          <p>
                              <a href="<?= base_url('absen/index') . '?id=' . $m['id']; ?>" style="direction: none;">
                                  <?= base_url('absen/index') . '?id=' . $m['id']; ?>
                              </a>
                          </p>
                          <figure>
                              <img class="img img-thumbnail" width="150" src="<?= base_url('assets/img/qrcode/') . $m['qr']; ?>" alt="qr code absen">
                              <figcaption>QR CODE ABSEN</figcaption>
                          </figure>
                          <h6>Bagikan Link untuk isi kehadiran:</h6>
                          <div class="row">
                              <div class="col">
                                  <a href="whatsapp://send?text=link%20absen%20<?= base_url('absen/index') . '?id=' . $m['id']; ?>" data-action="share/whatsapp/share">
                                      <img src="<?= base_url('assets/img/logos/wa.svg'); ?>" alt="share kehadiran to wa" class="img img-thumbnail" width="80">
                                  </a>
                              </div>
                              <div class="col">
                                  <a href="mailto:?Subject=Kehadiran&Body=Link%20untik%20mengisi%20daftar%20hadir%20<?= $m['nama'] . ' ' . base_url('absen/index') . '?id=' . $m['id']; ?>">
                                      <img src="<?= base_url('assets/img/logos/email.svg'); ?>" alt="Email" class="img img-thumbnail" width="80" />
                                  </a>
                              </div>
                              <div class="col">
                                  <a href="http://www.facebook.com/sharer.php?u<?= base_url('absen/index') . '?id=' . $m['id']; ?>" target="_blank">
                                      <img src="<?= base_url('assets/img/logos/fb.svg'); ?>" alt="Facebook" class="img img-thumbnail" width="80" />
                                  </a>
                              </div>

                          </div>
                          <h5 class="mt-3">DAFTAR HADIR:</h5>
                          <p>
                              <a href="<?= base_url('meeting/daftarHadir') . '?id=' . $m['id']; ?>">Klik Disini</a>
                          </p>

                      </div>
                  </div>
              </div>

          </div>
  </div>
  </section>
  </div>