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