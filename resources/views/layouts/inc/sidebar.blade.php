<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
          <i class="mdi mdi-home menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      {{-- <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <i class="mdi mdi-circle-outline menu-icon"></i>
          <span class="menu-title">UI Elements</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Typography</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pages/forms/basic_elements.html">
          <i class="mdi mdi-view-headline menu-icon"></i>
          <span class="menu-title">Form elements</span>
        </a>
      </li> --}}
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.age_groups') }}">
          <i class="mdi mdi-account-multiple menu-icon"></i>
          <span class="menu-title">Age groups</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.attributes') }}">
          <i class="mdi mdi-database menu-icon"></i>
          <span class="menu-title">Attributes</span>
        </a>
      </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.form_attributes') }}">
                <i class="mdi mdi-note menu-icon"></i>
                <span class="menu-title">Form Attributes</span>
            </a>
        </li>

        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
              <li class="nav-item">
                <a class="nav-link" href="index.html">
                  <i class="mdi mdi-home menu-icon"></i>
                  <span class="menu-title">Dashboard</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                  <i class="mdi mdi-circle-outline menu-icon"></i>
                  <span class="menu-title">TB Analytics</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="C:\Users\TIRDO\Desktop\MajesticAdmin-Free-Bootstrap-Admin-Template-master\template\pages\tables\basic-table.html">ACF</a></li>
                    <li class="nav-item">

                       <a class="nav-link">Contact Investigation</a>
                       <i class="menu-arrow"></i>
                       <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                           <a class="nav-link" href="C:\Users\TIRDO\Desktop\MajesticAdmin-Free-Bootstrap-Admin-Template-master\template\pages\tables\basic-table.html">Bacteriologically</a></li>
                        <li class="nav-item">
                           <a class="nav-link" href="C:\Users\TIRDO\Desktop\MajesticAdmin-Free-Bootstrap-Admin-Template-master\template\pages\tables\basic-table.html">Non Bacteriologically</a>

                        </li>
                      </ul>

                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../../pages/forms/basic_elements.html">
                  <i class="mdi mdi-view-headline menu-icon"></i>
                  <span class="menu-title">Sputum Transportation</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                  <i class="mdi mdi-account menu-icon"></i>
                  <span class="menu-title">FP & SHRS</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="auth">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="../../pages/samples/login.html"> Routeen </a></li>
                    <li class="nav-item"> <a class="nav-link" href="../../pages/samples/login-2.html">  FP Outreach  </a></li>
                    <li class="nav-item"> <a class="nav-link" href="../../pages/samples/register.html"> ADDO-FP Services </a></li>
                    <li class="nav-item"> <a class="nav-link" href="../../pages/samples/register-2.html">Distribution by CHWs</a></li>
                    <li class="nav-item"> <a class="nav-link" href="../../pages/samples/lock-screen.html"> PPFP & PAFP </a></li>
                  </ul>
                </div>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="../../pages/tables/basic-table.html">
                  <i class="mdi mdi-grid-large menu-icon"></i>
                  <span class="menu-title">Youth Intvention Clubs</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../../pages/icons/mdi.html">
                  <i class="mdi mdi-emoticon menu-icon"></i>
                  <span class="menu-title">GBV/FP Section</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../../pages/charts/chartjs.html">
                  <i class="mdi mdi-chart-pie menu-icon"></i>
                  <span class="menu-title">ICHF Section</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../../documentation/documentation.html">
                  <i class="mdi mdi-file-document-box-outline menu-icon"></i>
                  <span class="menu-title">Social Economic Activities</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../../documentation/documentation.html">
                  <i class="mdi mdi-file-document-box-outline menu-icon"></i>
                  <span class="menu-title">Male Champions</span>
                </a>
              </li>
            </ul>
          </nav>


      {{-- <li class="nav-item">
        <a class="nav-link" href="pages/tables/basic-table.html">
          <i class="mdi mdi-grid-large menu-icon"></i>
          <span class="menu-title">Tables</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pages/icons/mdi.html">
          <i class="mdi mdi-emoticon menu-icon"></i>
          <span class="menu-title">Icons</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="documentation/documentation.html">
          <i class="mdi mdi-file-document-box-outline menu-icon"></i>
          <span class="menu-title">Documentation</span>
        </a>
      </li> --}}
    </ul>
</nav>
