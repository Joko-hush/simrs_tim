  <?php
    foreach ($jmlUnit as $j) {
        $unit[] = $j['unit'];
        $jml[] = (float)$j['jml'];
    }
    foreach ($jm as $m) {
        $msl[] = $m['m'];
        $jmsl[] = (float)$m['jm'];
    }
    ?>
  <header class="header-2">
      <div class="page-header min-vh-25 relative">
          <!-- <div class="page-header min-vh-50 relative" style="background-image: url('<?= base_url(); ?>assets/img/bg2.jpg')"> -->
          <!-- <span class="mask bg-gradient-primary opacity-4"></span> -->
          <div class="container">
              <div class="row">
                  <div class="col-md-5">
                      <h1 class="text-dark"><?= $judul; ?></h1>
                      <?= $this->session->flashdata('message'); ?>
                      <?php unset($_SESSION['message']); ?>
                  </div>
                  <div class="col-md-7">
                      <form action="<?= base_url('admin/dashboard'); ?>" method="post">
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
      </div>
  </header>
  <div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6">
      <section class="pt-3 pb-4" id="count-stats">
          <div class="container mt-3">
              <div class="row">
                  <div class="col-md-4 mt-1">
                      <a type="button" data-bs-toggle="modal" data-bs-target="#semuaKegiatan">
                          <div class="card card-body bg-gradient-primary text-center shadow-md mx-auto">
                              <h1 class="text-white text-primary"><span id="state1" countTo="<?= $jumlahkegiatan; ?>">0</span></h1>
                              <h5 class="text-white mt-3">JUMLAH KUNJUNGAN</h5>

                          </div>
                      </a>

                  </div>
                  <div class="col-md-4 mt-1">
                      <a type="button" data-bs-toggle="modal" data-bs-target="#belumKegiatan">
                          <div class="card card-body bg-gradient-warning text-center shadow-md mx-auto">
                              <h1 class="text-white text-primary"><span id="state2" countTo="<?= $jumlahbelum; ?>">0</span></h1>
                              <h5 class="text-white mt-3">BELUM SELESAI</h5>
                          </div>
                      </a>
                  </div>
                  <div class="col-md-4 mt-1">
                      <a type="button" data-bs-toggle="modal" data-bs-target="#selesaiKegiatan">
                          <div class="card card-body bg-gradient-success text-center shadow-md mx-auto">
                              <h1 class="text-white text-primary"><span id="state3" countTo="<?= $jumlahselesai; ?>">0</span></h1>
                              <h5 class="text-white mt-3">SELESAI</h5>
                          </div>
                      </a>
                  </div>
              </div>

              <div class="row mt-3">
                  <div class="col-md-6 mt-3 min-vh-25 relative">
                      <div class="chart-container">
                          <canvas id="grafikKunjunganPerMasalah" class="min-vh-25 relative"></canvas>
                      </div>
                      <script>
                          var ctx = document.getElementById('grafikKunjunganPerMasalah').getContext('2d');
                          var myChart = new Chart(ctx, {
                              type: 'polarArea',
                              data: {
                                  labels: <?= json_encode($msl); ?>,
                                  datasets: [{
                                      label: 'Jumlah Kunjungan Per Masalah',
                                      data: <?= json_encode($jmsl); ?>,
                                      backgroundColor: [
                                          '#d63384',
                                          '#fd7e14',
                                          '#6f42c1',
                                          '#6c757d',
                                          '#596CFF',
                                          '#20c997'
                                      ],
                                      borderColor: [
                                          '#d63384',
                                          '#fd7e14',
                                          '#6f42c1',
                                          '#6c757d',
                                          '#596CFF',
                                          '#20c997'
                                      ],
                                      borderWidth: 2
                                  }]
                              },

                              options: {
                                  scales: {
                                      yAxes: [{
                                          ticks: {
                                              beginAtZero: true
                                          }
                                      }]
                                  },
                                  plugins: {
                                      title: {
                                          display: true,
                                          text: 'JUMLAH KUNJUNGAN Berdasarkan Masalah',
                                          padding: {
                                              top: 10,
                                              bottom: 30
                                          }
                                      }
                                  },
                                  animations: {
                                      tension: {
                                          duration: 1000,
                                          easing: 'linear',
                                          from: 1,
                                          to: 0,
                                          loop: true
                                      }
                                  }
                              }
                          });
                      </script>
                  </div>
                  <div class="col-md-6 mt-3 min-vh-25 relative">
                      <div class="chart-container">
                          <canvas id="grafikKunjunganPerUnit" class="min-vh-25 relative"></canvas>
                      </div>
                      <script>
                          var ctx = document.getElementById('grafikKunjunganPerUnit').getContext('2d');
                          var myChart = new Chart(ctx, {
                              type: 'line',
                              data: {
                                  labels: <?= json_encode($unit); ?>,
                                  datasets: [{
                                      label: 'Jumlah Kunjungan',
                                      data: <?= json_encode($jml); ?>,
                                      backgroundColor: [
                                          '#d63384',
                                          '#fd7e14',
                                          '#6f42c1',
                                          '#6c757d',
                                          '#596CFF',
                                          '#20c997'
                                      ],
                                      borderColor: [
                                          '#d63384',
                                          '#fd7e14',
                                          '#6f42c1',
                                          '#6c757d',
                                          '#596CFF',
                                          '#20c997'
                                      ],
                                      borderWidth: 2
                                  }]
                              },

                              options: {
                                  scales: {
                                      yAxes: [{
                                          ticks: {
                                              beginAtZero: true
                                          }
                                      }]
                                  },
                                  plugins: {
                                      title: {
                                          display: true,
                                          text: 'JUMLAH KUNJUNGAN PER UNIT',
                                          padding: {
                                              top: 10,
                                              bottom: 30
                                          }
                                      }
                                  },
                                  animations: {
                                      tension: {
                                          duration: 1000,
                                          easing: 'linear',
                                          from: 1,
                                          to: 0,
                                          loop: true
                                      }
                                  }
                              }
                          });
                      </script>
                  </div>

              </div>
          </div>
      </section>
  </div>



  <!-- Modal -->
  <div class="modal fade" id="semuaKegiatan" tabindex="-1" aria-labelledby="semuaKegiatanLabel" aria-hidden="true">
      <div class="modal-dialog modal-fullscreen">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="semuaKegiatanLabel">Semua Kegiatan</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <div class="container">
                      <div class="table-responsive p-5">
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
                                      <th>TIM</th>
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
                                          <td class="text-wrap"><?= substr($k['waktu'], 0, 19); ?></td>
                                          <?php if (!$u) : ?>
                                              <td></td>
                                          <?php else : ?>
                                              <td><?= $u['unit']; ?></td>
                                          <?php endif; ?>
                                          <td class="text-wrap"><?= $k['masalah']; ?></td>
                                          <td class="text-wrap"><?= $k['penyelsaian']; ?></td>
                                          <td><?= $k['mengetahui']; ?></td>
                                          <td>
                                              <a href="<?= base_url('pages/paraf') . '?id=' . $k['id']; ?>" class="btn btn-success">
                                                  PARAF
                                              </a>
                                          </td>
                                          <td><?= $c; ?></td>
                                          <?php
                                            $tim = $k['user_id'] . ',' . $k['partner'];
                                            $tim = explode(',', $tim);
                                            $ca = count($tim);
                                            // return $tim;
                                            $i = 0;
                                            $ahh = [];
                                            while ($i < $ca) {
                                                $this->db->select('user');
                                                $this->db->where('id', trim($tim[$i]));
                                                $user = $this->db->get('user')->row_array();
                                                if (!$user) {
                                                    $user['user'] = '';
                                                }
                                                $ahh[] = $user['user'];
                                                $i++;
                                            }
                                            $tim_it = implode(', ', $ahh);
                                            ?>
                                          <td class="text-wrap">
                                              <?= $tim_it; ?>
                                          </td>
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
              </div>
              <div class="modal-footer justify-content-between">
                  <button type="button" class="btn bg-gradient-dark mb-0" data-bs-dismiss="modal">Close</button>
                  <!-- <button type="button" class="btn bg-gradient-primary mb-0">Save changes</button> -->
              </div>
          </div>
      </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="belumKegiatan" tabindex="-1" aria-labelledby="belumKegiatanLabel" aria-hidden="true">
      <div class="modal-dialog modal-fullscreen">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="belumKegiatanLabel">Semua Kegiatan Belum Selesai</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <div class="container">
                      <div class="table-responsive p-5">
                          <table class="table table-bordered table-sm" id="tableKegiatanBelumSelesai">
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
                                      <th>User</th>
                                      <th>Option</th>
                                  </tr>
                              </thead>
                              <tbody class="align-middle">
                                  <?php $n = 1;
                                    foreach ($belum as $b) : ?>
                                      <?php
                                        $ub = $this->master_models->getAllSubUnitByUnit($b['unit_id']);
                                        if ($b['status'] == 1) {
                                            $p = "SELESAI";
                                        } else {
                                            $p = 'DIPROSES';
                                        }

                                        ?>
                                      <tr class="<?= $p; ?>">
                                          <td class="text-center">
                                              <a href="<?= base_url('pages/lihatKunjungan') . '?id=' . $b['id']; ?>">
                                                  <i class="fa-solid fa-eye"></i>
                                              </a>
                                          </td>
                                          <td><?= $n++; ?></td>
                                          <td class="text-wrap"><?= substr($b['waktu'], 0, 19); ?></td>
                                          <?php if (!$ub) : ?>
                                              <td></td>
                                          <?php else : ?>
                                              <td><?= $ub['unit']; ?></td>
                                          <?php endif; ?>
                                          <td class="text-wrap"><?= $b['masalah']; ?></td>
                                          <td class="text-wrap"><?= $b['penyelsaian']; ?></td>
                                          <td><?= $b['mengetahui']; ?></td>
                                          <td>
                                              <a href="<?= base_url('pages/paraf') . '?id=' . $b['id']; ?>" class="btn btn-success">
                                                  PARAF
                                              </a>
                                          </td>
                                          <td><?= $c; ?></td>
                                          <?php
                                            $tim = $b['user_id'] . ',' . $b['partner'];
                                            $tim = explode(',', $tim);
                                            $ca = count($tim);
                                            // return $tim;
                                            $i = 0;
                                            $ahh = [];
                                            while ($i < $ca) {
                                                $this->db->select('user');
                                                $this->db->where('id', trim($tim[$i]));
                                                $user = $this->db->get('user')->row_array();
                                                if (!$user) {
                                                    $user['user'] = '';
                                                }
                                                $ahh[] = $user['user'];
                                                $i++;
                                            }
                                            $tim_it = implode(', ', $ahh);
                                            ?>
                                          <td class="text-wrap">
                                              <?= $tim_it; ?>
                                          </td>
                                          <td>
                                              <a href="<?= base_url('pages/edit') . '?id=' . $b['id']; ?>" class="btn btn-warning">
                                                  EDIT
                                              </a>
                                              <a href="<?= base_url('pages/delete') . '?id=' . $b['id']; ?>" class="btn btn-danger" onclick="return confirm('Anda akan menghapus kegiatan ini. Lanjutkan?')">
                                                  DELETE
                                              </a>
                                          </td>
                                      </tr>
                                  <?php endforeach; ?>
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
              <div class="modal-footer justify-content-between">
                  <button type="button" class="btn bg-gradient-dark mb-0" data-bs-dismiss="modal">Close</button>
                  <!-- <button type="button" class="btn bg-gradient-primary mb-0">Save changes</button> -->
              </div>
          </div>
      </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="selesaiKegiatan" tabindex="-1" aria-labelledby="selesaiKegiatanLabel" aria-hidden="true">
      <div class="modal-dialog modal-fullscreen">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="selesaiKegiatanLabel">Semua Kegiatan Selesai</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <div class="container">
                      <div class="table-responsive p-5">
                          <table class="table table-bordered table-sm" id="tableKegiatanSelesai">
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
                                      <th>User</th>
                                      <th>Option</th>
                                  </tr>
                              </thead>
                              <tbody class="align-middle">
                                  <?php $n = 1;
                                    foreach ($selesai as $s) : ?>
                                      <?php
                                        $us = $this->master_models->getAllSubUnitByUnit($s['unit_id']);
                                        if ($s['status'] == 1) {
                                            $ps = "SELESAI";
                                        } else {
                                            $ps = 'DIPROSES';
                                        }

                                        ?>
                                      <tr class="<?= $ps; ?>">
                                          <td class="text-center">
                                              <a href="<?= base_url('pages/lihatKunjungan') . '?id=' . $s['id']; ?>">
                                                  <i class="fa-solid fa-eye"></i>
                                              </a>
                                          </td>
                                          <td><?= $n++; ?></td>
                                          <td class="text-wrap"><?= substr($s['waktu'], 0, 19); ?></td>
                                          <?php if (!$us) : ?>
                                              <td></td>
                                          <?php else : ?>
                                              <td><?= $us['unit']; ?></td>
                                          <?php endif; ?>
                                          <td class="text-wrap"><?= $s['masalah']; ?></td>
                                          <td class="text-wrap"><?= $s['penyelsaian']; ?></td>
                                          <td><?= $s['mengetahui']; ?></td>
                                          <td>
                                              <a href="<?= base_url('pages/paraf') . '?id=' . $s['id']; ?>" class="btn btn-success">
                                                  PARAF
                                              </a>
                                          </td>
                                          <td><?= $c; ?></td>
                                          <?php
                                            $tim = $s['user_id'] . ',' . $s['partner'];
                                            $tim = explode(',', $tim);
                                            $ca = count($tim);
                                            // return $tim;
                                            $i = 0;
                                            $ahh = [];
                                            while ($i < $ca) {
                                                $this->db->select('user');
                                                $this->db->where('id', trim($tim[$i]));
                                                $user = $this->db->get('user')->row_array();
                                                if (!$user) {
                                                    $user['user'] = '';
                                                }
                                                $ahh[] = $user['user'];
                                                $i++;
                                            }
                                            $tim_it = implode(', ', $ahh);
                                            ?>
                                          <td class="text-wrap">
                                              <?= $tim_it; ?>
                                          </td>
                                          <td>
                                              <a href="<?= base_url('pages/edit') . '?id=' . $s['id']; ?>" class="btn btn-warning">
                                                  EDIT
                                              </a>
                                              <a href="<?= base_url('pages/delete') . '?id=' . $s['id']; ?>" class="btn btn-danger" onclick="return confirm('Anda akan menghapus kegiatan ini. Lanjutkan?')">
                                                  DELETE
                                              </a>
                                          </td>
                                      </tr>
                                  <?php endforeach; ?>
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
              <div class="modal-footer justify-content-between">
                  <button type="button" class="btn bg-gradient-dark mb-0" data-bs-dismiss="modal">Close</button>
                  <!-- <button type="button" class="btn bg-gradient-primary mb-0">Save changes</button> -->
              </div>
          </div>
      </div>
  </div>