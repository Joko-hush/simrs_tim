 <!-- Navbar -->
 <div class="container position-sticky z-index-sticky top-0">
     <div class="row">
         <div class="col-12">
             <nav class="navbar navbar-expand-lg  blur border-radius-xl top-0 z-index-fixed shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
                 <div class="container-fluid px-0">
                     <a class="navbar-brand font-weight-bolder ms-sm-3" href="<?= base_url(); ?>" rel="tooltip" title="TIM SIMRS DUSTIRA" data-placement="bottom">
                         SIMRS
                     </a>
                     <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                         <span class="navbar-toggler-icon mt-2">
                             <span class="navbar-toggler-bar bar1"></span>
                             <span class="navbar-toggler-bar bar2"></span>
                             <span class="navbar-toggler-bar bar3"></span>
                         </span>
                     </button>
                     <div class="collapse navbar-collapse pt-3 pb-2 py-lg-0 w-100" id="navigation">
                         <ul class="navbar-nav navbar-nav-hover ms-auto">
                             <li class="nav-item dropdown dropdown-hover mx-2">
                                 <a class="nav-link ps-2 d-flex cursor-pointer align-items-center" id="dropdownMenuPages" data-bs-toggle="dropdown" aria-expanded="false">
                                     <i class="material-icons opacity-6 me-2 text-md">dashboard</i>
                                     Pages
                                     <img src="<?= base_url(); ?>assets/img/down-arrow-dark.svg" alt="down-arrow" class="arrow ms-auto ms-md-2">
                                 </a>
                                 <div class="dropdown-menu dropdown-menu-animation ms-n3 dropdown-md p-3 border-radius-xl mt-0 mt-lg-3" aria-labelledby="dropdownMenuPages">
                                     <div class="d-none d-lg-block">
                                         <h6 class="dropdown-header text-dark font-weight-bolder d-flex align-items-center px-1">
                                             WEB APP
                                         </h6>

                                         <a href="<?= base_url('pages'); ?>" class="dropdown-item border-radius-md">
                                             <span>KEGIATAN SIM KELILING</span>
                                         </a>

                                     </div>
                                 </div>
                             </li>
                             <?php if ($this->session->userdata('phone') == '62881024913954') : ?>
                                 <li class="nav-item dropdown dropdown-hover mx-2">
                                     <a class="nav-link ps-2 d-flex cursor-pointer align-items-center" id="dropdownMenuPages" data-bs-toggle="dropdown" aria-expanded="false">
                                         <i class="material-icons opacity-6 me-2 text-md">dashboard</i>
                                         Admin
                                         <img src="<?= base_url(); ?>assets/img/down-arrow-dark.svg" alt="down-arrow" class="arrow ms-auto ms-md-2">
                                     </a>
                                     <div class="dropdown-menu dropdown-menu-animation ms-n3 dropdown-md p-3 border-radius-xl mt-0 mt-lg-3" aria-labelledby="dropdownMenuPages">
                                         <div class="d-none d-lg-block">
                                             <h6 class="dropdown-header text-dark font-weight-bolder d-flex align-items-center px-1">
                                                 ADMIN
                                             </h6>
                                             <a href="<?= base_url('admin/dashboard'); ?>" class="dropdown-item border-radius-md">
                                                 <span>DASHBOARD</span>
                                             </a>
                                             <a href="<?= base_url('admin/deleted'); ?>" class="dropdown-item border-radius-md">
                                                 <span>DELETED</span>
                                             </a>
                                             <a href="<?= base_url('aktivity/aktivitasUser'); ?>" class="dropdown-item border-radius-md">
                                                 <span>Log User</span>
                                             </a>

                                         </div>
                                     </div>
                                 </li>
                             <?php endif; ?>
                             <li class="nav-item dropdown dropdown-hover mx-2">
                                 <a class="nav-link ps-2 d-flex cursor-pointer align-items-center" id="dropdownMenuPages" data-bs-toggle="dropdown" aria-expanded="false">
                                     <!-- <i class="material-symbols-outlined opacity-6 me-2 text-md">User</i> -->
                                     <?= $this->session->userdata('user'); ?>
                                     <img src="<?= base_url(); ?>assets/img/down-arrow-dark.svg" alt="down-arrow" class="arrow ms-auto ms-md-2">
                                 </a>
                                 <div class="dropdown-menu dropdown-menu-animation ms-n3 dropdown-md p-3 border-radius-xl mt-0 mt-lg-3" aria-labelledby="dropdownMenuPages">
                                     <div class="d-none d-lg-block">
                                         <h6 class="dropdown-header text-dark font-weight-bolder d-flex align-items-center px-1">
                                             Account
                                         </h6>
                                         <a href="<?= base_url('aktivity/aktivitasPerUser'); ?>" class="dropdown-item border-radius-md">
                                             <span>Aktivity</span>
                                         </a>
                                         <a href="<?= base_url('auth/ubahPassword'); ?>" class="dropdown-item border-radius-md">
                                             <span>Change Password</span>
                                         </a>
                                         <a href="<?= base_url('auth/logout'); ?>" class="dropdown-item border-radius-md">Log Out</a>
                                     </div>
                                 </div>
                             </li>

                         </ul>
                     </div>
                 </div>
             </nav>
             <!-- End Navbar -->
         </div>
     </div>
 </div>