  <header class="header-2">
      <div class="page-header min-vh-25 relative" style="background-image: url('<?= base_url(); ?>assets/img/long_corridor.webp')">
          <!-- <div class="page-header min-vh-50 relative" style="background-image: url('<?= base_url(); ?>assets/img/bg2.jpg')"> -->
          <span class="mask bg-gradient-primary opacity-4"></span>
          <div class="container">
              <h1 class="text-white"><?= $judul; ?></h1>
          </div>
      </div>
  </header>
  <?php
    $this->db->where('id', $k['unit_id']);
    $u = $this->db->get('m_unit')->row_array();
    $this->db->where('id', $k['masalah_id']);
    $m = $this->db->get('jenis_masalah')->row_array();
    ?>

  <div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6">
      <section class="pt-3 pb-4" id="count-stats">
          <div class="container">
              <div class="row">
                  <div class="col-lg-7 mx-auto d-flex justify-content-center flex-column">
                      <h3 class="text-center">Detail Kegiatan</h3>
                      <form role="form" id="contact-form" method="post" autocomplete="off">
                          <div class="card-body">
                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="input-group input-group-static mb-4">
                                          <label>Tanggal</label>
                                          <input class="form-control" value="<?= $k['waktu']; ?>" type="datetime" disabled>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="input-group input-group-static mb-4">
                                          <label>Jenis Masalah</label>
                                          <input class="form-control" value="<?= $m['masalah']; ?>" type="text" disabled>
                                      </div>
                                  </div>
                                  <div class="col-md-6 ">
                                      <div class="input-group input-group-static mb-4">
                                          <label>INSTALASI</label>
                                          <input class="form-control" value="<?= $k['instalasi']; ?>" type="text" disabled>
                                      </div>
                                  </div>
                                  <div class="col-md-6 ">
                                      <div class="input-group input-group-static mb-4">
                                          <label>UNIT</label>
                                          <input class="form-control" value="<?= $u['sub_unit']; ?>" type="text" disabled>
                                      </div>
                                  </div>
                              </div>

                              <div class="input-group mb-4 input-group-static">
                                  <label>Permasalahan</label>
                                  <textarea name="message" class="form-control" id="message" rows="4" disabled><?= $k['masalah']; ?></textarea>
                              </div>
                              <div class="input-group mb-4 input-group-static">
                                  <label>Penyelsaian</label>
                                  <textarea name="message" class="form-control" id="message" rows="4" disabled><?= $k['penyelsaian']; ?></textarea>
                              </div>
                              <div class="input-group input-group-static mb-4">
                                  <label>Penerima (USER)</label>
                                  <input class="form-control" value="<?= $k['mengetahui']; ?>" type="text" disabled>
                              </div>
                              <div class="input-group mb-4 input-group-static">
                                  <label>TTD :</label>
                                  <img src="<?= base_url('assets/img/ttd/') . $k['paraf']; ?>" alt="paraf">
                              </div>
                              <div class="row text-center">
                                  <div class="col-md-4">
                                      <a href="<?= base_url('pages/edit') . '?id=' . $k['id']; ?>" class="btn btn-warning mx-auto">EDIT</a>
                                  </div>
                                  <div class="col-md-4">
                                      <a href="<?= base_url('pages/paraf') . '?id=' . $k['id']; ?>" class="btn btn-success mx-auto">PARAF</a>
                                  </div>
                                  <div class="col-md-4">
                                      <a href="<?= base_url('pages/delete') . '?id=' . $k['id']; ?>" class="btn btn-danger" onclick="return confirm('Anda akan menghapus kegiatan ini. Lanjutkan?')" class="btn btn-danger mx-auto">DELETE</a>
                                  </div>
                              </div>
                              <div class="row text-center mt-3">
                                  <div class="col-md-12">
                                      <a href="<?= base_url('pages'); ?>" class="btn btn-dark w-100">CLOSE</a>
                                  </div>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>

          </div>
      </section>
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