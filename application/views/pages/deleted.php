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

          </div>
          <div class="col-sm-8 text-end">
            <form action="<?= base_url('pages/index'); ?>" method="post">
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
              <th>Status</th>
              <th>Option</th>
              <th>User</th>
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
              $user = $this->master_models->getUserById($k['user_id']);
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
                <td><?= $c; ?></td>
                <td>
                  <a href="<?= base_url('admin/restore') . '?id=' . $k['id']; ?>" class="btn btn-warning" onclick="return confirm('Apakah Anda Yakin akan mengembalikan kegiatan terhapus ini?')">
                    Kembalikan
                  </a>
                </td>
                <td><?= $user['user']; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
  </div>
  </section>
  </div>