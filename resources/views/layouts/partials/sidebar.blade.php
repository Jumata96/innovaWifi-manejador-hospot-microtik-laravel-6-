  <!-- START MAIN -->
  <div id="main">
    <!-- START WRAPPER -->
    <div class="wrapper">

      <!-- START LEFT SIDEBAR NAV-->
      <aside id="left-sidebar-nav">
          <ul id="slide-out" class="side-nav fixed leftside-navigation">
              <li class="teal darken-3" style="height: 100px; padding-top: 10px; margin-bottom: 10px; background: url({{asset('images/fondo-perfil.png')}}); background-size: 270px">
                  <div class="row">
                      <div class="col col s5 m5 l5">
                          <img src="{{asset('images/usu-perfil.png')}}" alt="" class="circle responsive-img valign profile-image green lighten-4" style="height: 70px; width: 70px">
                      </div>
                      <div class="col col s7 m7 l7" style="margin-left: -15px; width: 128px">
                          <ul id="profile-dropdown" class="dropdown-content" style="width: 100px; padding-top: 20px; border: 10px">
                              <li><a href="#"><i class="mdi-action-face-unlock"></i> Perfil</a>
                              </li>
                              <li><a href="#"><i class="mdi-action-settings"></i> Config.</a>
                              </li>
                              <li><a href="#"><i class="mdi-communication-live-help"></i> Ayuda</a>
                              </li>
                              <li class="divider"></li>
                              
                              <li style="padding-top: 15px"><a href="{{ url('cerrar') }}"><i class="mdi-hardware-keyboard-tab"></i> Cerrar</a>
                              </li>
                          </ul>
                          <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown" style="width: 130%">{{ substr(Auth::user()->nombre,0,9) }}<i class="mdi-navigation-arrow-drop-down right"></i></a>
                          <p class="user-roal">Administrator</p>
                      </div>
                  </div>
              </li>
              <li class="bold"><a href="{{ url('/home') }}" class="waves-effect waves-cyan"><i class="mdi-action-room" style="color: #6B6B6B"></i>Inicio</a>
              </li>              
              <li class="no-padding">
                  <ul class="collapsible collapsible-accordion">
                      <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-action-settings" style="color: #6B6B6B"></i>Configuración</a>
                          <div class="collapsible-body">
                              <ul>
                                  <li><a href="{{ url('/empresa') }}">Editor de Empresas</a>
                                  </li> 
                                  <li><a href="{{ url('/router') }}">Agregar Router</a>
                                  </li>                                       
                                  <li><a href="{{ url('#') }}">Usuarios del Sistema</a>
                                  </li> 
                                  <li><a href="{{ url('/perfiles') }}">Perfiles</a>
                                  </li> 
                              </ul>
                          </div>
                      </li>
                      <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-action-settings-remote" style="color: #6B6B6B"></i>Hotspot</a>
                          <div class="collapsible-body">
                              <ul>
                                  <li><a href="{{ url('#') }}">Conexiones</a>
                                  </li> 
                                  <li><a href="{{ url('#') }}">Redes Sociales</a>
                                  </li>                                       
                                  <li><a href="{{ url('#') }}">Campañas</a>
                                  </li> 
                                  <li><a href="{{ url('#') }}">Fichas</a>
                                  </li> 
                                  <li><a href="{{ url('#') }}">Herramientas</a>
                                  </li> 
                              </ul>
                          </div>
                      </li>
                      <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-action-account-circle" style="color: #6B6B6B"></i>Clientes</a>
                          <div class="collapsible-body">
                              <ul>
                                  <li><a href="{{ url('/clientes') }}">Clientes</a>
                                  </li> 
                                  <li><a href="{{ url('/clientes/herramientas') }}">Herramientas</a>
                                  </li>  
                                  <li><a href="{{ url('#') }}">Mapa de Clientes</a>
                                  </li>                                 
                              </ul>
                          </div>
                      </li>
                      <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-action-wallet-membership" style="color: #6B6B6B"></i>Facturación</a>
                          <div class="collapsible-body">
                              <ul>
                                  <li><a href="{{ url('#') }}">Registar Pago</a>
                                  </li> 
                                  <li><a href="{{ url('#') }}">Caja</a>
                                  </li>                                      
                                  <li><a href="{{ url('#') }}">Tipo de Documentos</a>
                                  </li> 
                                  <li><a href="{{ url('#') }}">Formas de Pago</a>
                                  </li> 
                              </ul>
                          </div>
                      </li>
                      <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-action-dashboard" style="color: #6B6B6B"></i>Almacén</a>
                          <div class="collapsible-body">
                              <ul>
                                  <li><a href="{{ url('/equipos') }}">Equipos</a>
                                  </li> 
                                  <li><a href="{{ url('#') }}">Proveedores</a>
                                  </li> 
                                  <li><a href="{{ url('#') }}">Grupos</a>
                                  </li>                                       
                                  <li><a href="{{ url('#') }}">Marca</a>
                                  </li> 
                                  <li><a href="{{ url('#') }}">Modelo</a>
                                  </li> 
                                  <li><a href="{{ url('#') }}">Tipo de Equipos</a>
                                  </li> 
                                  <li><a href="{{ url('#') }}">Estados</a>
                                  </li> 
                                  <li><a href="{{ url('#') }}">Unidad de Medida</a>
                                  </li> 
                                  <li><a href="{{ url('#') }}">Motivos de Ope.</a>
                                  </li> 
                              </ul>
                          </div>
                      </li>
                      <li class="bold"><a href="#" class="waves-effect waves-cyan"><i class="mdi-communication-email" style="color: #6B6B6B"></i> Mensajes<span class="new badge">4</span></a>
                      </li> 
                      <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-action-assessment" style="color: #6B6B6B"></i>Reportes</a>
                          <div class="collapsible-body">
                              <ul>
                                  <li><a href="{{ url('#') }}">Mis Ventas</a>
                                  </li> 
                                  <li><a href="{{ url('#') }}">Stock de Equipos</a>
                                  </li>                                       
                                  <li><a href="{{ url('#') }}">Salidas de Almacen</a>
                                  </li> 
                                  <li><a href="{{ url('#') }}">Historial Clientes</a>
                                  </li> 
                              </ul>
                          </div>
                      </li>
                    </ul>          
                </li>
              <li class="li-hover"><div class="divider"></div></li>
              <li class="li-hover"><p class="ultra-small margin more-text">Total Alquilado</p></li>
              <li class="li-hover">
                  <div class="row">
                      <div class="col s12 m12 l12">
                          <div class="sample-chart-wrapper">                            
                              <div class="ct-chart ct-golden-section" id="ct2-chart"></div>
                          </div>
                      </div>
                  </div>
              </li>
          </ul>
          <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only darken-2" style="margin-top: 4px"><i class="mdi-navigation-menu"></i></a>
      </aside>
      <!-- END LEFT SIDEBAR NAV-->
                 