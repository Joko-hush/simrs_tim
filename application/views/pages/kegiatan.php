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
        <form method="POST" action="<?= base_url('pages/saveparaf'); ?>">
          <input type="hidden" name="id" value="<?= $kunjungan['id']; ?>">
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

          <br />
          <div class="row text-center">
            <div class="col-sm-6">
              <a href="<?= base_url('pages'); ?>" class="btn btn-danger mx-auto">Batal</a>
            </div>
            <div class="col-sm-6">
              <button type="submit" class="btn btn-info mx-auto">Simpan</button>
            </div>
          </div>

        </form>
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