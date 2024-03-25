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
              <!-- <th></th> -->
              <th>No</th>
              <th>Waktu</th>
              <th>Unit</th>
              <th>Permasalahan</th>
              <th>Penyelsaian</th>
              <th>Client</th>
              <th>Paraf</th>
              <th>Status</th>
              <th>Tim IT</th>
              <th>Option</th>
            </tr>
          </thead>
          <tbody class="align-middle">
            <?php $n = 1;
            foreach ($kegiatan['user'] as $ku) : ?>
              <?php
              $u = $this->master_models->getAllSubUnitByUnit($ku['unit_id']);
              if ($ku['status'] == 1) {
                $c = "SELESAI";
              } else {
                $c = 'DIPROSES';
              }

              ?>
              <tr class="<?= $c; ?>">
                <!-- <td class="text-center">
                  <a href="<?= base_url('pages/lihatKunjungan') . '?id=' . $ku['id']; ?>">
                    <i class="fa-solid fa-eye"></i>
                  </a>
                </td> -->
                <td>
                  <span>
                    <?= $n++; ?>
                  </span>
                  <a class="badge text-bg-success" href="<?= base_url('pages/lihatKunjungan') . '?id=' . $ku['id']; ?>">
                    <i class="fa-solid fa-eye"></i>
                  </a>
                </td>
                <td class="text-wrap"><?= substr($ku['waktu'], 0, 19); ?></td>
                <?php if (!$u) : ?>
                  <td></td>
                <?php else : ?>
                  <td><?= $u['unit']; ?></td>
                <?php endif; ?>
                <td class="text-wrap"><?= $ku['masalah']; ?></td>
                <td class="text-wrap"><?= $ku['penyelsaian']; ?></td>
                <td><?= $ku['mengetahui']; ?></td>
                <td class="text-wrap">
                  <?php
                  $u = base_url('pages/paraf') . '?id=' . $ku['id'];
                  $client = base_url('paraf/shareparaf') . '?id=' . $ku['id'];
                  ?>
                  <a href="<?= $u; ?>" class="btn btn-success">
                    PARAF
                  </a>
                  <a href="whatsapp://send?text=<?= $client; ?>" class="btn btn-primary"><i class="fa-solid fa-share-nodes"></i></a>
                </td>
                <td><?= $c; ?></td>
                <?php
                $tim = $ku['user_id'] . ',' . $ku['partner'];
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
                  <a href="<?= base_url('pages/edit') . '?id=' . $ku['id']; ?>" class="btn btn-warning">
                    EDIT
                  </a>
                  <a href="<?= base_url('pages/delete') . '?id=' . $ku['id']; ?>" class="btn btn-danger" onclick="return confirm('Anda akan menghapus kegiatan ini. Lanjutkan?')">
                    DELETE
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
            <?php $i = 1;
            foreach ($kegiatan['partner'] as $kp) : ?>
              <?php
              $u = $this->master_models->getAllSubUnitByUnit($kp['unit_id']);
              if ($kp['status'] == 1) {
                $c = "SELESAI";
              } else {
                $c = 'DIPROSES';
              }

              ?>
              <tr class="<?= $c; ?>">
                <td class="text-center">
                  <a href="<?= base_url('pages/lihatKunjungan') . '?id=' . $kp['id']; ?>">
                    <i class="fa-solid fa-eye"></i>
                  </a>
                </td>
                <td><?= $i++; ?></td>
                <td class="text-wrap"><?= substr($kp['waktu'], 0, 19); ?></td>
                <?php if (!$u) : ?>
                  <td></td>
                <?php else : ?>
                  <td><?= $u['unit']; ?></td>
                <?php endif; ?>
                <td><?= $kp['masalah']; ?></td>
                <td><?= $kp['penyelsaian']; ?></td>
                <td><?= $kp['mengetahui']; ?></td>
                <td>
                  <a href="<?= base_url('pages/paraf') . '?id=' . $kp['id']; ?>" class="btn btn-success">
                    PARAF
                  </a>
                </td>
                <td><?= $c; ?></td>

                <?php
                $timp = $kp['user_id'] . ',' . $kp['partner'];
                $timp = explode(',', $timp);
                $ca = count($timp);
                // return $timp;
                $i = 0;
                $ahh = [];
                while ($i < $ca) {
                  $this->db->select('user');
                  $this->db->where('id', trim($tim[$i]));
                  $userp = $this->db->get('user')->row_array();
                  if (!$userp) {
                    $userp['user'] = '';
                  }
                  $ahhp[] = $userp['user'];
                  $i++;
                }
                $tim_itp = implode(', ', $ahhp);
                ?>
                <td class="text-wrap">
                  <?= $tim_itp; ?>
                </td>
                </td>
                <td>
                  <a href="<?= base_url('pages/edit') . '?id=' . $kp['id']; ?>" class="btn btn-warning">
                    EDIT
                  </a>
                  <a href="<?= base_url('pages/delete') . '?id=' . $kp['id']; ?>" class="btn btn-danger" onclick="return confirm('Anda akan menghapus kegiatan ini. Lanjutkan?')">
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
                  <label>Partner</label>
                  <Select class="form-control chosen-select mx-auto" name="partner[]" multiple="multiple">
                    <?php foreach ($partner as $co) : ?>
                      <option value="<?= $co['id']; ?>"><?= $co['user']; ?></option>
                    <?php endforeach; ?>
                  </Select>
                </div>
              </div>
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
              <div class="col-lg-12">
                <div class="input-group input-group-static mb-4">
                  <label>Jenis Masalah</label>
                  <Select class="form-control chosen-select" name="jp">
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