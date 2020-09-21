<!-- START HEADER -->
    <header id="header" class="page-topbar z-depth-3">
      <!-- start header nav-->
      <div class="navbar-fixed ">
        <nav class="navbar-color" style="background-color: #33AFE8">
          <div class="nav-wrapper">
            <div class="header-search-wrapper hide-on-med-and-down sideNav-lock">
              <i class="material-icons">search</i>
              <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Buscar en InnovaMk" />
            </div>
            <ul class="right hide-on-med-and-down">
              <li>
                <a href="javascript:void(0);" class="waves-effect waves-block waves-light translation-button" data-activates="translation-dropdown">
                  <span class="flag-icon flag-icon-gb"></span>
                </a>
              </li>
              <li>
                <a href="javascript:void(0);" class="fullscreenNavClass waves-effect waves-block waves-light toggle-fullscreen">
                  <i class="material-icons">settings_overscan</i>
                </a>
              </li>
              <!--
              <li>
                <a href="javascript:void(0);" class="waves-effect waves-block waves-light notification-button" data-activates="notifications-dropdown">
                  <i class="material-icons">notifications_none
                    <small class="notification-badge">5</small>
                  </i>
                </a>
              </li>
            -->
              <li>
                <a href="javascript:void(0);" class="waves-effect waves-block waves-light profile-button" data-activates="profile-dropdown">
                  <span class="avatar-status avatar-online">
                    <img src="{{asset('images/avatar/avatar-7.png')}}" alt="avatar">
                    <i></i>
                  </span>
                </a>
              </li>
            </ul>
          
            <!-- notifications-dropdown -->
            <!--
            <ul id="notifications-dropdown" class="dropdown-content">
              <li>
                <h6>NOTIFICACIONES
                  <span class="new badge">5</span>
                </h6>
              </li>
              <li class="divider"></li>
              <li>
                <a href="#!" class="grey-text text-darken-2">
                  <span class="material-icons icon-bg-circle cyan small">add_shopping_cart</span>Se realizo una nueva venta!</a>
                <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">2 horas antes</time>
              </li>
              <li>
                <a href="#!" class="grey-text text-darken-2">
                  <span class="material-icons icon-bg-circle red small">stars</span> Completed the task</a>
                <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">3 days ago</time>
              </li>
              
            </ul>

          -->
            <!-- profile-dropdown -->
            <ul id="profile-dropdown" class="dropdown-content">
              <li><a href="#" style="color: black">
                <i class="material-icons">face</i> Perfil</a>
              </li>
             
              <li class="divider"></li>                              
              <li style="padding-top: 15px"><a href="{{ url('cerrar') }}"  style="color: black">
                <i class="material-icons">keyboard_tab</i> Cerrar</a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </header>
    <!-- END HEADER -->
    