<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="template/materialize/assets/" data-template="vertical-menu-template-no-customizer">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>PT. RUTAN</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="template/materialize/assets/img/logo_cC2.png" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap" rel="stylesheet" />

  <!-- Icons -->
  <link rel="stylesheet" href="template/materialize/assets/vendor/fonts/materialdesignicons.css" />
  <link rel="stylesheet" href="template/materialize/assets/vendor/fonts/fontawesome.css" />
  <link rel="stylesheet" href="template/materialize/assets/vendor/fonts/flag-icons.css" />

  <!-- Menu waves for no-customizer fix -->
  <link rel="stylesheet" href="template/materialize/assets/vendor/libs/node-waves/node-waves.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="template/materialize/assets/vendor/css/rtl/core.css" />
  <link rel="stylesheet" href="template/materialize/assets/vendor/css/rtl/theme-default.css" />
  <link rel="stylesheet" href="template/materialize/assets/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="template/materialize/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
  <link rel="stylesheet" href="template/materialize/assets/vendor/libs/typeahead-js/typeahead.css" />
  <link rel="stylesheet" href="template/materialize/assets/vendor/libs/animate-css/animate.css" />
  <link rel="stylesheet" href="template/materialize/assets/vendor/libs/plyr/plyr.css" />
  <link rel="stylesheet" href="template/materialize/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
  <link rel="stylesheet" href="template/materialize/assets/vendor/libs/typeahead-js/typeahead.css" />
  <link rel="stylesheet" href="template/materialize/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
  <link rel="stylesheet" href="template/materialize/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
  <link rel="stylesheet" href="template/materialize/assets/vendor/libs/apex-charts/apex-charts.css" />
  <link rel="stylesheet" href="template/materialize/assets/vendor/libs/swiper/swiper.css" />
  <link rel="stylesheet" href="template/materialize/assets/vendor/libs/bootstrap-select/bootstrap-select.css" />
  <link rel="stylesheet" href="template/materialize/assets/vendor/libs/select2/select2.css" />
  <link rel="stylesheet" href="template/materialize/assets/vendor/libs/tagify/tagify.css" />
  <link rel="stylesheet" href="template/materialize/assets/vendor/libs/nouislider/nouislider.css" />
  <link rel="stylesheet" href="template/materialize/assets/vendor/libs/datatables-fixedcolumns-bs5/fixedcolumns.bootstrap5.css" />
  <link rel="stylesheet" href="template/materialize/assets/vendor/libs/datatables-fixedheader-bs5/fixedheader.bootstrap5.css" />

  <link rel="stylesheet" href="https://cdn.datatables.net/2.1.2/css/dataTables.dataTables.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.0/css/buttons.dataTables.css" />

  <!-- Page CSS -->
  <style>
    .disabled {
      pointer-events: none;
      opacity: 0.5;
    }
  </style>
  <!-- Helpers -->
  <script src="template/materialize/assets/vendor/js/helpers.js"></script>
  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="template/materialize/assets/js/config.js"></script>
</head>

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->

      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
          <a href="javascript:void(0)" class="app-brand-link">
            <span class="app-brand-logo demo">
              <span style="color: var(--bs-primary)">
                <!--     <svg width="268" height="150" viewBox="0 0 38 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M30.0944 2.22569C29.0511 0.444187 26.7508 -0.172113 24.9566 0.849138C23.1623 1.87039 22.5536 4.14247 23.5969 5.92397L30.5368 17.7743C31.5801 19.5558 33.8804 20.1721 35.6746 19.1509C37.4689 18.1296 38.0776 15.8575 37.0343 14.076L30.0944 2.22569Z" fill="currentColor" />
                  <path d="M30.171 2.22569C29.1277 0.444187 26.8274 -0.172113 25.0332 0.849138C23.2389 1.87039 22.6302 4.14247 23.6735 5.92397L30.6134 17.7743C31.6567 19.5558 33.957 20.1721 35.7512 19.1509C37.5455 18.1296 38.1542 15.8575 37.1109 14.076L30.171 2.22569Z" fill="url(#paint0_linear_2989_100980)" fill-opacity="0.4" />
                  <path d="M22.9676 2.22569C24.0109 0.444187 26.3112 -0.172113 28.1054 0.849138C29.8996 1.87039 30.5084 4.14247 29.4651 5.92397L22.5251 17.7743C21.4818 19.5558 19.1816 20.1721 17.3873 19.1509C15.5931 18.1296 14.9843 15.8575 16.0276 14.076L22.9676 2.22569Z" fill="currentColor" />
                  <path d="M14.9558 2.22569C13.9125 0.444187 11.6122 -0.172113 9.818 0.849138C8.02377 1.87039 7.41502 4.14247 8.45833 5.92397L15.3983 17.7743C16.4416 19.5558 18.7418 20.1721 20.5361 19.1509C22.3303 18.1296 22.9391 15.8575 21.8958 14.076L14.9558 2.22569Z" fill="currentColor" />
                  <path d="M14.9558 2.22569C13.9125 0.444187 11.6122 -0.172113 9.818 0.849138C8.02377 1.87039 7.41502 4.14247 8.45833 5.92397L15.3983 17.7743C16.4416 19.5558 18.7418 20.1721 20.5361 19.1509C22.3303 18.1296 22.9391 15.8575 21.8958 14.076L14.9558 2.22569Z" fill="url(#paint1_linear_2989_100980)" fill-opacity="0.4" />
                  <path d="M7.82901 2.22569C8.87231 0.444187 11.1726 -0.172113 12.9668 0.849138C14.7611 1.87039 15.3698 4.14247 14.3265 5.92397L7.38656 17.7743C6.34325 19.5558 4.04298 20.1721 2.24875 19.1509C0.454514 18.1296 -0.154233 15.8575 0.88907 14.076L7.82901 2.22569Z" fill="currentColor" />
                  <defs>
                    <linearGradient id="paint0_linear_2989_100980" x1="5.36642" y1="0.849138" x2="10.532" y2="24.104" gradientUnits="userSpaceOnUse">
                      <stop offset="0" stop-opacity="1" />
                      <stop offset="1" stop-opacity="0" />
                    </linearGradient>
                    <linearGradient id="paint1_linear_2989_100980" x1="5.19475" y1="0.849139" x2="10.3357" y2="24.1155" gradientUnits="userSpaceOnUse">
                      <stop offset="0" stop-opacity="1" />
                      <stop offset="1" stop-opacity="0" />
                    </linearGradient>
                  </defs>
                </svg>-->
                <img src="template/materialize/assets/img/logo.gif" width="50px" alt="">
              </span>
            </span>
            <span class="app-brand-text demo menu-text fw-bold ms-2" style="white-space: nowrap; font-size: 24px; line-height: 1; color: black; margin-top:16px;">PT. RUTAN<label style="color:#808991; font-size: 11px; margin-top: 2%; white-space: nowrap; margin-left: 8%; color: black;">v0824.1.1</label>     <p style="font-size: 10px; font-weight: 500;">Solusi Pangan Indonesia</p></span>                   
          </a>

          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M11.4854 4.88844C11.0081 4.41121 10.2344 4.41121 9.75715 4.88844L4.51028 10.1353C4.03297 10.6126 4.03297 11.3865 4.51028 11.8638L9.75715 17.1107C10.2344 17.5879 11.0081 17.5879 11.4854 17.1107C11.9626 16.6334 11.9626 15.8597 11.4854 15.3824L7.96672 11.8638C7.48942 11.3865 7.48942 10.6126 7.96672 10.1353L11.4854 6.61667C11.9626 6.13943 11.9626 5.36568 11.4854 4.88844Z" fill="currentColor" fill-opacity="0.6" />
              <path d="M15.8683 4.88844L10.6214 10.1353C10.1441 10.6126 10.1441 11.3865 10.6214 11.8638L15.8683 17.1107C16.3455 17.5879 17.1192 17.5879 17.5965 17.1107C18.0737 16.6334 18.0737 15.8597 17.5965 15.3824L14.0778 11.8638C13.6005 11.3865 13.6005 10.6126 14.0778 10.1353L17.5965 6.61667C18.0737 6.13943 18.0737 5.36568 17.5965 4.88844C17.1192 4.41121 16.3455 4.41121 15.8683 4.88844Z" fill="currentColor" fill-opacity="0.38" />
            </svg>
          </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
          <!-- Dashboards -->
          <!-- <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
              <div data-i18n="Dashboards">Dashboards</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item">
                <a href="javascript:void(0);" onclick="page.view('callcenter_newreport')" class="menu-link">
                  <div data-i18n="eCommerce">eCommerce</div>
                </a>
              </li>

            </ul>
          </li> -->
          <?php

          // $menu = getDaftarMenu($_SESSION[_session_app_id]['emp_no'], 0);
          $menu = $_SESSION[_session_app_id]['menu'];
          foreach ($menu as $key => $row) {
            if (count($row["submenu"]) > 0) {
              echo '<li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons mdi ' . $row['icon'] . '"></i>
                        <div data-i18n="' . $row['nmmenu'] . '">' . $row['nmmenu'] . '</div>
                      </a>';
              echo '<ul class="menu-sub">';
              foreach ($row["submenu"] as $keysub => $submenu) {
                echo '<li class="menu-item">
                    <a href="javascript:void(0);" onclick="page.view(\'' . $submenu['link'] . '\', \'' . $submenu['nmmenu'] . '\')" class="menu-link">
                      <div data-i18n="' . $submenu['nmmenu'] . '">' . $submenu['nmmenu'] . '</div>
                    </a>
                </li>';
              }
              echo '</ul>';
            }else {
              echo '<li class="menu-item">
                        <a href="javascript:void(0);" onclick="page.view(\'' . $row['link'] . '\', \'' . $submenu['nmmenu'] . '\')"  class="menu-link">
                        <i class="menu-icon tf-icons mdi ' . $row['icon'] . '"></i>
                        <div data-i18n="' . $row['nmmenu'] . '">' . $row['nmmenu'] . '</div>
                      </a>';
            }
            echo '</li>';
          }
          // for ($i = 0; $i < count($menu); $i++) {
          //   // $submenu = getDaftarMenu($_SESSION[_session_app_id]['emp_no'], $menu[$i]['idmenu']);
          //   $submenu = $_SESSION[_session_app_id]['menu'][$i]['submenu'];
          //   if (count($submenu) > 0) {
          //     echo '<li class="menu-item">
          //               <a href="javascript:void(0);" class="menu-link menu-toggle">
          //               <i class="menu-icon tf-icons mdi ' . $menu[$i]['icon'] . '"></i>
          //               <div data-i18n="' . $menu[$i]['nmmenu'] . '">' . $menu[$i]['nmmenu'] . '</div>
          //             </a>';
          //     echo '<ul class="menu-sub">';
          //     for ($j = 0; $j < count($submenu); $j++) {
          //       echo '<li class="menu-item">
          //           <a href="javascript:void(0);" onclick="page.view(\'' . $submenu[$j]['link'] . '\')" class="menu-link">
          //             <div data-i18n="' . $submenu[$j]['nmmenu'] . '">' . $submenu[$j]['nmmenu'] . '</div>
          //           </a>
          //       </li>';
          //     }
          //     echo '</ul>';
          //   } else {
          //     echo '<li class="menu-item">
          //               <a href="javascript:void(0);" onclick="page.view(\'' . $menu[$i]['link'] . '\')"  class="menu-link">
          //               <i class="menu-icon tf-icons mdi ' . $menu[$i]['icon'] . '"></i>
          //               <div data-i18n="' . $menu[$i]['nmmenu'] . '">' . $menu[$i]['nmmenu'] . '</div>
          //             </a>';
          //   }
          //   echo '</li>';
          // }
          ?>

          <!-- Layouts -->

          <!-- Front Pages -->


          <!-- Apps & Pages -->

          <!-- e-commerce-app menu start -->

          <!-- e-commerce-app menu end -->
          <!-- Academy menu start -->

        </ul>
      </aside>
      <!-- / Menu -->

      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->

        <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="template/materialize/javascript:void(0)">
              <i class="mdi mdi-menu mdi-24px"></i>
            </a>
          </div>

          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

            <ul class="navbar-nav flex-row align-items-center ms-auto">
              <!-- User -->
              <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0)" data-bs-toggle="dropdown">
                  <div class="avatar avatar-online">
                    <img src="template/materialize/assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <a class="dropdown-item" href="template/materialize/pages-account-settings-account.html">
                      <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                          <div class="avatar avatar-online">
                            <img src="template/materialize/assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                          </div>
                        </div>
                        <div class="flex-grow-1">
                          <span class="fw-medium d-block"><?= $_SESSION[_session_app_id]['first_name'] ?></span>
                          <small class="text-muted d-block"><?= $_SESSION[_session_app_id]['emp_no'] ?></small>
                          <small class="text-muted"><?= $_SESSION[_session_app_id]['nama_cabangrep'] ?></small>
                        </div>
                      </div>
                    </a>
                  </li>

                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <!-- 
                  <li>
                    <a class="dropdown-item" href="template/materialize/pages-profile-user.html">
                      <i class="mdi mdi-account-outline me-2"></i>
                      <span class="align-middle">My Profile</span>
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="template/materialize/pages-account-settings-account.html">
                      <i class="mdi mdi-cog-outline me-2"></i>
                      <span class="align-middle">Settings</span>
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="template/materialize/pages-account-settings-billing.html">
                      <span class="d-flex align-items-center align-middle">
                        <i class="flex-shrink-0 mdi mdi-credit-card-outline me-2"></i>
                        <span class="flex-grow-1 align-middle">Billing</span>
                        <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                      </span>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="template/materialize/pages-faq.html">
                      <i class="mdi mdi-help-circle-outline me-2"></i>
                      <span class="align-middle">FAQ</span>
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="template/materialize/pages-pricing.html">
                      <i class="mdi mdi-currency-usd me-2"></i>
                      <span class="align-middle">Pricing</span>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li> -->
                  <li>
                    <a class="dropdown-item" href="logout">
                      <i class="mdi mdi-logout me-2"></i>
                      <span class="align-middle">Log Out</span>
                    </a>
                  </li>
                </ul>
              </li>
              <!--/ User -->
            </ul>
          </div>

          <!-- Search Small Screens -->
          <div class="navbar-search-wrapper search-input-wrapper d-none">
            <input type="text" class="form-control search-input container-xxl border-0" placeholder="Search..." aria-label="Search..." />
            <i class="mdi mdi-close search-toggler cursor-pointer"></i>
          </div>
        </nav>

        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->
          <div class="container-xxl flex-grow-1 container-p-y" id="rutan_content">
          </div>
          <!-- <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="pt-3 mb-0"><span class="fw-light text-muted">Academy /</span> Course Details</h4>

            <div class="card g-3 mt-5">
              <div class="card-body row g-3">
                <div class="col-lg-8">
                  <div class="d-flex justify-content-between align-items-center flex-wrap mb-2 gap-1">
                    <div class="me-1">
                      <h5 class="mb-1">UI/UX Basic Fundamentals</h5>
                      <p class="mb-1">Prof. <span class="fw-medium text-heading"> Devonne Wallbridge </span></p>
                    </div>
                    <div class="d-flex align-items-center">
                      <span class="badge bg-label-danger rounded-pill">UI/UX</span>
                      <i class="mdi mdi-share-variant-outline mdi-24px mx-4"></i>
                      <i class="mdi mdi-bookmark-multiple-outline mdi-24px"></i>
                    </div>
                  </div>
                  <div class="card academy-content shadow-none border">
                    <div class="p-2">
                      <div class="cursor-pointer">
                        <video class="w-100" poster="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.jpg" id="plyr-video-player" playsinline controls>
                          <source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4" type="video/mp4" />
                        </video>
                      </div>
                    </div>
                    <div class="card-body">
                      <h5 class="mb-2">About this course</h5>
                      <p class="mb-0 pt-1">
                        Learn web design in 1 hour with 25+ simple-to-use rules and guidelines — tons of amazing web
                        design resources included!
                      </p>
                      <hr class="my-4" />
                      <h5>By the numbers</h5>
                      <div class="d-flex flex-wrap">
                        <div class="me-5">
                          <p class="text-nowrap">
                            <i class="mdi mdi-check-all mdi-24px me-2"></i>Skill level: All Levels
                          </p>
                          <p class="text-nowrap">
                            <i class="mdi mdi-account-outline mdi-24px me-2"></i>Students: 38,815
                          </p>
                          <p class="text-nowrap"><i class="mdi mdi-web mdi-24px me-2"></i>Languages: English</p>
                          <p class="text-nowrap"><i class="mdi mdi-content-copy mdi-24px me-2"></i>Captions: Yes</p>
                        </div>
                        <div>
                          <p class="text-nowrap"><i class="mdi mdi-pencil-outline mdi-24px me-2"></i>Lectures: 19</p>
                          <p class="text-nowrap">
                            <i class="mdi mdi-timer-outline mdi-24px me-2"></i>Video: 1.5 total hours
                          </p>
                        </div>
                      </div>
                      <hr class="mb-4 mt-2" />
                      <h5>Description</h5>
                      <p class="mb-4">
                        The material of this course is also covered in my other course about web design and
                        development with HTML5 & CSS3. Scroll to the bottom of this page to check out that course,
                        too! If you're already taking my other course, you already have all it takes to start
                        designing beautiful websites today!
                      </p>
                      <p class="mb-4">
                        "Best web design course: If you're interested in web design, but want more than just a "how to
                        use WordPress" course,I highly recommend this one." — Florian Giusti
                      </p>
                      <p>
                        "Very helpful to us left-brained people: I am familiar with HTML, CSS, JQuery, and Twitter
                        Bootstrap, but I needed instruction in web design. This course gave me practical, impactful
                        techniques for making websites more beautiful and engaging." — Susan Darlene Cain
                      </p>
                      <hr class="my-4" />
                      <h5>Instructor</h5>
                      <div class="d-flex justify-content-start align-items-center user-name">
                        <div class="avatar-wrapper">
                          <div class="avatar avatar-sm me-2">
                            <img src="template/materialize/assets/img/avatars/1.png" alt="Avatar" class="rounded-circle" />
                          </div>
                        </div>
                        <div class="d-flex flex-column">
                          <h6 class="mb-0">Devonne Wallbridge</h6>
                          <small>Web Developer, Designer, and Teacher</small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="accordion stick-top" id="courseContent">
                    <div class="accordion-item shadow-none border border-bottom-0 active my-0 overflow-hidden">
                      <div class="accordion-header border-0" id="headingOne">
                        <button type="button" class="accordion-button bg-lighter rounded-0" data-bs-toggle="collapse" data-bs-target="#chapterOne" aria-expanded="true" aria-controls="chapterOne">
                          <span class="d-flex flex-column">
                            <span class="h5 mb-1">Course Content</span>
                            <span class="text-body fw-normal">2 / 5 | 4.4 min</span>
                          </span>
                        </button>
                      </div>
                      <div id="chapterOne" class="accordion-collapse collapse show" data-bs-parent="#courseContent">
                        <div class="accordion-body py-3 border-top">
                          <div class="form-check d-flex align-items-center mb-3">
                            <input class="form-check-input" type="checkbox" id="defaultCheck1" checked="" />
                            <label for="defaultCheck1" class="form-check-label ms-3">
                              <span class="mb-0 h6">1. Welcome to this course</span>
                              <span class="text-body d-block">2.4 min</span>
                            </label>
                          </div>
                          <div class="form-check d-flex align-items-center mb-3">
                            <input class="form-check-input" type="checkbox" id="defaultCheck2" checked="" />
                            <label for="defaultCheck2" class="form-check-label ms-3">
                              <span class="mb-0 h6">2. Watch before you start</span>
                              <span class="text-body d-block">4.8 min</span>
                            </label>
                          </div>
                          <div class="form-check d-flex align-items-center mb-3">
                            <input class="form-check-input" type="checkbox" id="defaultCheck3" />
                            <label for="defaultCheck3" class="form-check-label ms-3">
                              <span class="mb-0 h6">3. Basic design theory</span>
                              <span class="text-body d-block">5.9 min</span>
                            </label>
                          </div>
                          <div class="form-check d-flex align-items-center mb-3">
                            <input class="form-check-input" type="checkbox" id="defaultCheck4" />
                            <label for="defaultCheck4" class="form-check-label ms-3">
                              <span class="mb-0 h6">4. Basic fundamentals</span>
                              <span class="text-body d-block">3.6 min</span>
                            </label>
                          </div>
                          <div class="form-check d-flex align-items-center">
                            <input class="form-check-input" type="checkbox" id="defaultCheck5" />
                            <label for="defaultCheck5" class="form-check-label ms-3">
                              <span class="mb-0 h6">5. What is ui/ux</span>
                              <span class="text-body d-block">10.6 min</span>
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item shadow-none border border-bottom-0 my-0">
                      <div class="accordion-header border-0" id="headingTwo">
                        <button type="button" class="bg-lighter rounded-0 accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#chapterTwo" aria-expanded="false" aria-controls="chapterTwo">
                          <span class="d-flex flex-column">
                            <span class="h5 mb-1">Web Design for Web Developers</span>
                            <span class="text-body fw-normal">1 / 4 | 4.4 min</span>
                          </span>
                        </button>
                      </div>
                      <div id="chapterTwo" class="accordion-collapse collapse" data-bs-parent="#courseContent">
                        <div class="accordion-body py-3 border-top">
                          <div class="form-check d-flex align-items-center mb-3">
                            <input class="form-check-input" type="checkbox" id="defCheck1" checked="" />
                            <label for="defCheck1" class="form-check-label ms-3">
                              <span class="mb-0 h6">1. How to use Pages in Figma</span>
                              <span class="text-body d-block">8:31 min</span>
                            </label>
                          </div>
                          <div class="form-check d-flex align-items-center mb-3">
                            <input class="form-check-input" type="checkbox" id="defCheck2" />
                            <label for="defCheck2" class="form-check-label ms-3">
                              <span class="mb-0 h6">2. What is Lo Fi Wireframe</span>
                              <span class="text-body d-block">2 min</span>
                            </label>
                          </div>
                          <div class="form-check d-flex align-items-center mb-3">
                            <input class="form-check-input" type="checkbox" id="defCheck3" />
                            <label for="defCheck3" class="form-check-label ms-3">
                              <span class="mb-0 h6">3. How to use color in Figma</span>
                              <span class="text-body d-block">5.9 min</span>
                            </label>
                          </div>
                          <div class="form-check d-flex align-items-center">
                            <input class="form-check-input" type="checkbox" id="defCheck4" />
                            <label for="defCheck4" class="form-check-label ms-3">
                              <span class="mb-0 h6">4. Frames vs Groups in Figma</span>
                              <span class="text-body d-block">3.6 min</span>
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item shadow-none border border-bottom-0 my-0">
                      <div class="accordion-header border-0" id="headingThree">
                        <button type="button" class="bg-lighter rounded-0 accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#chapterThree" aria-expanded="false" aria-controls="chapterThree">
                          <span class="d-flex flex-column">
                            <span class="h5 mb-1">Build Beautiful Websites!</span>
                            <span class="text-body fw-normal">0 / 6 | 4.4 min</span>
                          </span>
                        </button>
                      </div>
                      <div id="chapterThree" class="accordion-collapse collapse" data-bs-parent="#courseContent">
                        <div class="accordion-body py-3 border-top">
                          <div class="form-check d-flex align-items-center mb-3">
                            <input class="form-check-input" type="checkbox" id="defCheck-01" />
                            <label for="defCheck-01" class="form-check-label ms-3">
                              <span class="mb-0 h6">1. Section & Div Block</span>
                              <span class="text-body d-block">8:31 min</span>
                            </label>
                          </div>
                          <div class="form-check d-flex align-items-center mb-3">
                            <input class="form-check-input" type="checkbox" id="defCheck-02" />
                            <label for="defCheck-02" class="form-check-label ms-3">
                              <span class="mb-0 h6">2. Read-Only Version of Chat App</span>
                              <span class="text-body d-block">8 min</span>
                            </label>
                          </div>
                          <div class="form-check d-flex align-items-center mb-3">
                            <input class="form-check-input" type="checkbox" id="defCheck-03" />
                            <label for="defCheck-03" class="form-check-label ms-3">
                              <span class="mb-0 h6">3. Webflow Autosave</span>
                              <span class="text-body d-block">2.9 min</span>
                            </label>
                          </div>
                          <div class="form-check d-flex align-items-center mb-3">
                            <input class="form-check-input" type="checkbox" id="defCheck-04" />
                            <label for="defCheck-04" class="form-check-label ms-3">
                              <span class="mb-0 h6">4. Canvas Settings</span>
                              <span class="text-body d-block">7.6 min</span>
                            </label>
                          </div>
                          <div class="form-check d-flex align-items-center mb-3">
                            <input class="form-check-input" type="checkbox" id="defCheck-05" />
                            <label for="defCheck-05" class="form-check-label ms-3">
                              <span class="mb-0 h6">5. HTML Tags</span>
                              <span class="text-body d-block">10 min</span>
                            </label>
                          </div>
                          <div class="form-check d-flex align-items-center">
                            <input class="form-check-input" type="checkbox" id="defCheck-06" />
                            <label for="defCheck-06" class="form-check-label ms-3">
                              <span class="mb-0 h6">6. Footer (Chat App)</span>
                              <span class="text-body d-block">9.10 min</span>
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item shadow-none border my-0 overflow-hidden">
                      <div class="accordion-header border-0" id="headingFour">
                        <button type="button" class="bg-lighter rounded-0 accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#chapterFour" aria-expanded="false" aria-controls="chapterFour">
                          <span class="d-flex flex-column">
                            <span class="h5 mb-1">Final Project</span>
                            <span class="text-body fw-normal">2 / 3 | 4.4 min</span>
                          </span>
                        </button>
                      </div>
                      <div id="chapterFour" class="accordion-collapse collapse" data-bs-parent="#courseContent">
                        <div class="accordion-body py-3 border-top">
                          <div class="form-check d-flex align-items-center mb-3">
                            <input class="form-check-input" type="checkbox" id="defCheck-101" checked="" />
                            <label for="defCheck-101" class="form-check-label ms-3">
                              <span class="mb-0 h6">1. Responsive Blog Site</span>
                              <span class="text-body d-block">10:0 min</span>
                            </label>
                          </div>
                          <div class="form-check d-flex align-items-center mb-3">
                            <input class="form-check-input" type="checkbox" id="defCheck-102" checked="" />
                            <label for="defCheck-102" class="form-check-label ms-3">
                              <span class="mb-0 h6">2. Responsive Portfolio</span>
                              <span class="text-body d-block">13:00 min</span>
                            </label>
                          </div>
                          <div class="form-check d-flex align-items-center mb-3">
                            <input class="form-check-input" type="checkbox" id="defCheck-103" />
                            <label for="defCheck-103" class="form-check-label ms-3">
                              <span class="mb-0 h6">3. Responsive eCommerce Website</span>
                              <span class="text-body d-block">15 min</span>
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> -->
          <!-- / Content -->

          <!-- Footer -->
          <!-- <footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl">
              <div class="footer-container d-flex align-items-center justify-content-between py-3 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , made with <span class="text-danger"><i class="tf-icons mdi mdi-heart"></i></span> by
                  <a href="template/materialize/https://pixinvent.com" target="_blank" class="footer-link fw-medium">Pixinvent</a>
                </div>
                <div class="d-none d-lg-inline-block">
                  <a href="template/materialize/https://themeforest.net/licenses/standard" class="footer-link me-4" target="_blank">License</a>
                  <a href="template/materialize/https://1.envato.market/pixinvent_portfolio" target="_blank" class="footer-link me-4">More Themes</a>

                  <a href="template/materialize/https://demos.pixinvent.com/materialize-html-admin-template/documentation/" target="_blank" class="footer-link me-4">Documentation</a>

                  <a href="template/materialize/https://pixinvent.ticksy.com/" target="_blank" class="footer-link d-none d-sm-inline-block">Support</a>
                </div>
              </div>
            </div>
          </footer> -->
          <!-- / Footer -->

          <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>

    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>
  </div>
  <!-- / Layout wrapper -->

  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="template/materialize/assets/vendor/libs/jquery/jquery.js"></script>
  <script src="template/materialize/assets/vendor/libs/popper/popper.js"></script>
  <script src="template/materialize/assets/vendor/js/bootstrap.js"></script>
  <script src="template/materialize/assets/vendor/libs/node-waves/node-waves.js"></script>
  <script src="template/materialize/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="template/materialize/assets/vendor/libs/hammer/hammer.js"></script>
  <script src="template/materialize/assets/vendor/libs/i18n/i18n.js"></script>
  <script src="template/materialize/assets/vendor/libs/typeahead-js/typeahead.js"></script>
  <script src="template/materialize/assets/vendor/js/menu.js"></script>

  <!-- endbuild -->

  <!-- Vendors JS -->
  <script src="template/materialize/assets/vendor/libs/plyr/plyr.js"></script>
  <script src="template/materialize/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
  <script src="template/materialize/assets/vendor/libs/apex-charts/apexcharts.js"></script>
  <script src="template/materialize/assets/vendor/libs/swiper/swiper.js"></script>
  <script src="template/materialize/assets/vendor/libs/bs-stepper/bs-stepper.js"></script>
  <script src="template/materialize/assets/vendor/libs/bootstrap-select/bootstrap-select.js"></script>
  <script src="template/materialize/assets/vendor/libs/select2/select2.js"></script>
  <script src="template/materialize/assets/vendor/libs/tagify/tagify.js"></script>
  <script src="template/materialize/assets/vendor/libs/@form-validation/umd/bundle/popular.min.js"></script>
  <script src="template/materialize/assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js"></script>
  <script src="template/materialize/assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js"></script>
  <script src="template/materialize/assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
  <script src="template/materialize/assets/vendor/libs/nouislider/nouislider.js"></script>
  <script src="template/materialize/assets/vendor/libs/chartjs/chartjs.js"></script>

  <script src="https://cdn.datatables.net/buttons/3.1.0/js/dataTables.buttons.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.1.0/js/buttons.dataTables.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.1.0/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.1.0/js/buttons.print.min.js"></script>

  <!-- Main JS -->
  <script src="template/materialize/assets/js/main.js"></script>

  <!-- Page JS -->
  <!-- <script src="template/materialize/assets/js/app-academy-course-details.js"></script> -->
  <?php require sis_core('js/autoload.php'); ?>
  <script type="text/javascript">
    // if (session_login.login.id != undefined) {
    //   setWorker();
    // }

    function installment(){
      iss = sendPost("Issue", { type_submit: "getOpenIssue" });
      all = sendPost("Issue", { type_submit: "getAllComb" });
      apk = sendPost("Issue", { type_submit: "getApk" });
      getPG = rutanApi('GetAllPegawai', 'mP60RM7Spq9pMSYPRsCD', {
        iddbase: "DB00000023",
        idapi: "API0000700"
      });
    }
    installment();
  </script>
</body>

</html>