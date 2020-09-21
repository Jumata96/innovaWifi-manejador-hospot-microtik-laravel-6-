<!-- START LEFT SIDEBAR NAV-->
{{--         <aside id="left-sidebar-nav" data-valor="0" class="nav-expanded nav-lock nav-collapsible"> --}}
             <aside  id="left-sidebar-nav"   data-valor="1" class="sidenav-main full main-full nav-collapsible   sidenav-active-square {{ (Auth::user()->menu_colapsible == 1)? 'nav-collapsed' : 'nav-lock'}}">


          <div class="brand-sidebar">
            @if(Auth::user()->menu_colapsible == 0) 
            <h1 class="logo-wrapper" style="padding-top: 8px; padding-left: 15px">
              <a href="http://innovawisp.com" class="brand-logo darken-1" target="_blank">
                <img src="{{asset('images/logo/InnovaWifi3.png')}}" alt="InnovaWifi" style=" height: 43px">               
              </a>
              <a href="#" class="navbar-toggler" id="radio" onclick="Materialize.fadeInImage('#sideusuario')" style="margin-left: 70px">
                <i class="material-icons" id="radio2">radio_button_unchecked</i>
              </a>
            </h1>
            @else
            <h1 class="logo-wrapper white" style="padding-top: 8px; padding-left: 15px">
              <a href="http://innovawisp.com" class="brand-logo darken-1" target="_blank">
                <img src="{{asset('images/Isotipo.png')}}" alt="InnovaWifi" style=" height: 43px ;background-image: url('{{asset('images/Isotipo.png')}}') !importar;" >  
                <span id="LogoInnovaTec" style="color:black;" class="logo-text hide-on-med-and-down "><b >Innova</b>Wifi</span>             
              </a>
                
              <a href="#" class="navbar-toggler"   id="radio" onclick="Materialize.fadeInImage('#sideusuario')" style="margin-left: 70px;padding-top: 5px;">
                <i class="material-icons"  style="color:black;"   id="radio2">radio_button_checked</i>
              </a>
            </h1> 

          @endif
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
                    <i class="material-icons">settings</i>
                    <span class="nav-text">Configuración</span>
                  </a>
                  <div class="collapsible-body">
                    <ul>
                      <li>
                        <a href="{{ url('/empresa') }}">
                          <i class="material-icons">keyboard_arrow_right</i>
                          <span> Editor de Empresas</span>
                        </a>
                      </li>
                      <li>
                        <a href="{{ url('/router') }}">
                          <i class="material-icons">keyboard_arrow_right</i>
                          <span> Agregar Router</span>
                        </a>
                      </li>
                      <li>
                        <a href="{{ url('/zonas') }}">
                          <i class="material-icons">keyboard_arrow_right</i>
                          <span>Puntos de venta</span>
                        </a>
                      </li> 
                      <li>
                        <a href="{{ url('/usuarios') }}">
                          <i class="material-icons">keyboard_arrow_right</i>
                          <span> Usuarios del Sistema</span>
                        </a>
                      </li>
                     
                      <li>
                        <a href="{{ url('/perfiles') }}">
                          <i class="material-icons">keyboard_arrow_right</i>
                          <span>Perfiles</span>
                        </a>
                      </li>
                      <li>
                        <a href="{{ url('/parametros-generales') }}">
                          <i class="material-icons">keyboard_arrow_right</i>
                          <span>Parametros</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
                
                <li class="bold">
                  <a class="collapsible-header waves-effect waves-cyan">
                    <i class="material-icons">wifi</i>
                    <span class="nav-text">Hotspot</span>
                  </a>
                  <div class="collapsible-body">
                    <ul>                     
                      <li><a href="{{ url('/carrusel') }}">
                      <i class="material-icons">keyboard_arrow_right</i>
                      <span>Carrusel</span></a>
                      </li> 
                      <li><a href="{{ url('/hotspot/bienvenida') }}">
                      <i class="material-icons">keyboard_arrow_right</i>
                      <span>Bienvenida</span></a>
                      </li> 
                      <li><a href="{{ url('/hotspot/lstPublicidad') }}">
                      <i class="material-icons">keyboard_arrow_right</i>
                      <span>Publicidad</span></a>
                      </li> 
                      <li><a href="{{ url('/hotspot/logout') }}">
                      <i class="material-icons">keyboard_arrow_right</i>
                      <span>Logout</span></a>
                      </li> 
                      <li><a href="{{ url('/social') }}">
                      <i class="material-icons">keyboard_arrow_right</i>
                      <span>Redes Sociales</span></a>
                      </li>                         
                    </ul>
                  </div>
                </li>

                <li class="bold">
                  <a class="collapsible-header waves-effect waves-cyan">
                    <i class="material-icons">people</i>
                    <span class="nav-text">Usuarios</span>
                  </a>
                  <div class="collapsible-body">
                    <ul>
                      <li><a href="{{ url('/hotspot/usuarios') }}">
                      <i class="material-icons">keyboard_arrow_right</i>
                      <span>Usuarios Registrados</span></a>
                      </li>
                      <li><a href="{{ url('/conexiones') }}">
                      <i class="material-icons">keyboard_arrow_right</i>
                      <span>Conexiones</span></a>
                      </li> 
                    </ul>
                  </div>
                </li>

                <li class="bold">
                  <a class="collapsible-header waves-effect waves-cyan">
                    <i class="material-icons">local_offer</i>
                    <span class="nav-text">Tickets</span>
                  </a>
                  <div class="collapsible-body">
                    <ul>
                      <li><a href="{{ url('/tickets/registrar') }}">
                      <i class="material-icons">keyboard_arrow_right</i>
                      <span>Registrar</span></a>
                      </li>  
                      <li>
                        <a href="{{ url('/tickets/Asignar') }}">
                          <i class="material-icons">keyboard_arrow_right</i>
                          <span>Asignar tickets</span>
                        </a>
                      </li>
                      <li>
                        <a href="{{ url('/tickets/Asignados/historialVentas') }}">
                          <i class="material-icons">keyboard_arrow_right</i>
                          <span>Historial tickets</span>
                        </a>
                      </li>
                      <li>
                        <a href="{{ url('/tickets/Asignados/saldo') }}">
                          <i class="material-icons">keyboard_arrow_right</i>
                          <span>Saldo</span>
                        </a>
                      </li>
                      <li><a href="{{ url('/tickets/reporte-venta-trabajador') }}">
                      <i class="material-icons">keyboard_arrow_right</i>
                      <span>Reporte de Venta</span></a>
                      </li>
                       <li>
                        <a href="{{ url('/parametros-reportes') }}">
                          <i class="material-icons">keyboard_arrow_right</i>
                          <span>Parametros</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>

                <li class="bold">
                  <a class="collapsible-header waves-effect waves-cyan">
                    <i class="material-icons">style  </i>
                    <span class="nav-text">Campañas</span>
                  </a>
                  <div class="collapsible-body">
                    <ul>
                      <li><a href="{{ url('/campana') }}">
                      <i class="material-icons">keyboard_arrow_right</i>
                      <span>Nueva Campaña</span></a>
                      </li>                       
                    </ul>
                  </div>
                </li>

                <li class="bold">
                  <a class="collapsible-header waves-effect waves-cyan">
                    <i class="material-icons">mail </i>
                    <span class="nav-text">Correos</span>
                  </a>
                  <div class="collapsible-body">
                    <ul>
                      <li><a href="{{ url('/correo') }}">
                      <i class="material-icons">keyboard_arrow_right</i>
                      <span>Bandeja de Entrada</span></a>
                      </li>                       
                    </ul>
                  </div>
                </li>
                                
                <li class="bold">
                  <a class="collapsible-header waves-effect waves-cyan">
                    <i class="material-icons">equalizer</i>
                    <span class="nav-text">Reportes</span>
                  </a>
                  <div class="collapsible-body">
                    <ul>
                      <li><a href="{{ url('#') }}">
                        <i class="material-icons">keyboard_arrow_right</i>
                        <span>Registro de usuarios</span></a>
                      </li>     
                      <li><a href="{{ url('#') }}">
                        <i class="material-icons">keyboard_arrow_right</i>
                        <span>Recurrencia de clientes</span></a>
                      </li>                       
                    </ul>
                  </div>
                </li>
              </ul>
            </li>
            <li class="li-hover">
              <p class="ultra-small margin more-text" id="mas_opciones">Mas opciones</p>
            </li>
            <li>
              <a href="{{url('/colores')}}" target="_blank">
                <i class="material-icons">palette</i>
                <span class="nav-text">Colores</span>
              </a>
            </li>
            <!--
            <li>
              <a href="" target="_blank">
                <i class="material-icons">import_contacts</i>
                <span class="nav-text">Documentación</span>
              </a>
            </li>
            <li>
              <a href="" target="_blank">
                <i class="material-icons">help_outline</i>
                <span class="nav-text">Soporte</span>
              </a>
            </li> 
          -->
          </ul>
          <div class="navigation-background"></div><a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only"{{--  href="#" data-target="slide-out" --}}><i class="material-icons">menu</i></a>
          
         {{--  <a href="#" data-activates="slide-out" class=" sidenav-trigger btn-sidenav-toggle sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only gradient-45deg-light-blue-cyan gradient-shadow">
            <i class="material-icons">menu</i> --}}
          </a>
        </aside>
        <!-- END LEFT SIDEBAR NAV-->