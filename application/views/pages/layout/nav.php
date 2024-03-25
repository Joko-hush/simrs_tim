 <div class="container position-sticky z-index-sticky top-0">
     <div class="row">
         <div class="col-12">
             <nav class="navbar navbar-expand-lg blur border-radius-xl top-0 z-index-fixed shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
                 <div class="container-fluid">
                     <a class="navbar-brand font-weight-bolder ms-sm-3" href="<?= base_url(); ?>">SIMRS</a>
                     <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                         <span class="navbar-toggler-icon mt-2">
                             <span class="navbar-toggler-bar bar1"></span>
                             <span class="navbar-toggler-bar bar2"></span>
                             <span class="navbar-toggler-bar bar3"></span>
                         </span>
                     </button>
                     <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
                         <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto  navbar-nav-hover ms-auto">
                             <li class="nav-item dropdown dropdown-hover mx-2">
                                 <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                     Pages
                                 </a>
                                 <ul class="dropdown-menu">
                                     <li><a class="dropdown-item border-radius-md" href="<?= base_url('pages'); ?>">KEGIATAN SIM KELILING</a></li>
                                     <li><a class="dropdown-item border-radius-md" href="<?= base_url('ekspedisi'); ?>">Ekspedisi</a></li>
                                     <li><a class="dropdown-item border-radius-md" href="<?= base_url('meeting'); ?>">Pembuatan Acara</a></li>
                                 </ul>
                             </li>
                             <?php if ($this->session->userdata('phone') == '62881024913954') : ?>
                                 <li class="nav-item dropdown dropdown-hover mx-2">
                                     <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                         Admin
                                     </a>
                                     <ul class="dropdown-menu dropdown-hover mx-2">
                                         <li><a class="dropdown-item border-radius-md" href="<?= base_url('admin/dashboard'); ?>">Dashboard</a></li>
                                         <li><a class="dropdown-item border-radius-md" href="<?= base_url('admin/deleted'); ?>">Deleted</a></li>
                                         <li><a class="dropdown-item border-radius-md" href="<?= base_url('aktivity/aktivitasUser'); ?>">Log User</a></li>
                                     </ul>
                                 </li>
                             <?php endif; ?>
                             <li class="nav-item dropdown dropdown-hover mx-2">
                                 <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                     <?= $this->session->userdata('user'); ?>
                                 </a>
                                 <ul class="dropdown-menu">
                                     <li><a class="dropdown-item border-radius-md" href="<?= base_url('aktivity/aktivitasPerUser'); ?>">Aktifitas</a></li>
                                     <li><a class="dropdown-item border-radius-md" href="<?= base_url('auth/ubahPassword'); ?>">Change Password</a></li>
                                     <li><a class="dropdown-item border-radius-md" href="<?= base_url('auth/logout'); ?>">Log Out</a></li>
                                 </ul>
                             </li>
                         </ul>
                     </div>
                 </div>
             </nav>
         </div>
     </div>
 </div>