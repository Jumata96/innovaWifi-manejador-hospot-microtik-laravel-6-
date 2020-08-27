<!-- START LEFT SIDEBAR NAV-->
        <aside id="left-sidebar-nav" data-valor="0" class="nav-expanded nav-lock nav-collapsible">
          <div class="brand-sidebar">
            <h1 class="logo-wrapper" style="padding-top: 8px; padding-left: 15px">
              <a href="http://innovawisp.com" class="brand-logo darken-1" target="_blank">
                <img src="{{asset('images/logo/InnovaWifi3.png')}}" alt="InnovaWifi" style=" height: 43px">               
              </a>
              <a href="#" class="navbar-toggler" id="radio" onclick="Materialize.fadeInImage('#sideusuario')" style="margin-left: 70px">
                <i class="material-icons" id="radio2">radio_button_checked</i>
              </a>
            </h1>
          </div>
          <ul id="slide-out" class="side-nav fixed leftside-navigation">
            <li class="no-padding">
              <ul class="collapsible" data-collapsible="accordion">
            <!--  <li class="purple darken-4" id="sideusuario" style="height: 100px; padding-top: 10px; margin-bottom: 10px; background: url({{asset('images/fondo-perfil.png')}}); background-size: 270px">
                  <div class="row">
                      <div class="col col s5 m5 l5">
                          <img src="{{asset('images/usu-perfil.png')}}" alt="" class="circle responsive-img valign profile-image purple lighten-5" style="height: 70px; width: 70px">
                      </div>
                      <div class="col col s7 m7 l7" style="margin-left: -15px; width: 128px">
                          
                          <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown" style="width: 130%">{{ substr(Auth::user()->nombre,0,9) }}<i class="mdi-navigation-arrow-drop-down right"></i></a><ul id="profile-dropdown" class="dropdown-content" style="width: 100px; padding-top: 20px; border: 10px">
                              <li><a href="#"><i class="mdi-action-face-unlock"></i> Perfil</a>
                              </li>
                              <li><a href="#"><i class="mdi-action-settings"></i> Config.</a>
                              </li>
                              <li><a href="#"><i class="mdi-communication-live-help"></i> Ayuda</a>
                              </li>
                              <li class="divider"></li>
                              
                              <li style="padding-top: 15px"><a href="http://localhost/innovamk/public/cerrar"><i class="mdi-hardware-keyboard-tab"></i> Cerrar</a>
                              </li>
                          </ul>
                          <p class="user-roal">Administrator</p>
                      </div>
                  </div>
              </li>  -->
                <li class="bold">
                  <a class=" waves-effect waves-cyan" href="{{ url('/home') }}">
                    <i class="material-icons">dashboard</i>
                    <span class="nav-text">DashBoard</span>
                  </a>                  
                </li> 
                
                <li class="bold">
                  <a class="collapsible-header waves-effect waves-cyan">
                    <i class="material-icons">local_offer</i>
                    <span class="nav-text">Tickets</span>
                  </a>
                  <div class="collapsible-body">
                    <ul>
                      
                      <li>
                        <a href="{{ url('/tickets/registrarVenta') }}">
                          <i class="material-icons">keyboard_arrow_right</i>
                          <span>Registrar Ventas</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li> 
          </ul>
          <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only gradient-45deg-light-blue-cyan gradient-shadow">
            <i class="material-icons">menu</i>
          </a>
        </aside>
        <!-- END LEFT SIDEBAR NAV-->