<div class="container">
            <!--card stats start-->
            <div id="card-stats">
              <div class="row hide">
                <div class="col s12 m6 l3">
                  <div class="card gradient-45deg-green-teal gradient-shadow min-height-100 white-text animate fadeLeft">
                    <div class="padding-4">
                      <div class="col s7 m7">
                        <i class="material-icons background-round mt-5">perm_identity</i>
                        <p>Nuevos clientes</p>
                      </div>
                      <div class="col s5 m5 right-align">
                        <h5 class="mb-0 white-text">+{{$tot_usuarios}}</h5>
                        <p class="no-margin">Usuarios</p>
                        <p></p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col s12 m6 l3">
                  <div class="card gradient-45deg-indigo-light-blue gradient-shadow min-height-100 white-text">
                    <div class="padding-4">
                      <div class="col s7 m7">
                        <i class="material-icons background-round mt-5">cast_connected </i>
                        <p>Conexiones</p>
                      </div>
                      <div class="col s5 m5 right-align" style="padding-top: 0px; margin-top: 0px">
                        <h5 class="mb-0 white-text">{{$tot_conexion}}</h5>
                        <p class="no-margin">Total</p>
                        <p></p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col s12 m6 l3">
                  <div class="card  purple lighten-1 gradient-shadow min-height-100 white-text">
                    <div class="padding-4">
                      <div class="col s7 m7">
                        <i class="material-icons background-round mt-5">timeline</i>
                        <p>Carga del CPU</p>
                      </div>
                      <div class="col s5 m5 right-align">
                        <h5 class="mb-0 white-text">{{$load_cpu}}%</h5>
                        <p class="no-margin"></p>
                        <p></p>
                      </div>
                    </div>
                  </div>
                </div>
               
                <div class="col s12 m6 l3">
                  <div class="card gradient-45deg-purple-deep-purple min-height-100 white-text">
                    <div class="padding-4">
                      <div class="col s7 m7">
                        <i class="material-icons background-round mt-5">storage </i>
                        <p>Total de clientes</p>
                      </div>
                      <div class="col s5 m5 right-align">
                        <h5 class="mb-0 white-text">40</h5>
                        <p class="no-margin"></p>
                        <p></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


              <div class="row">
                <div class="col s12 m6 l3">
                  <div class="card padding-4 animate fadeLeft">
                     <div class="col s5 m5">
                        <h5 class="mb-0">+{{$tot_usuarios}}</h5>
                        <p class="no-margin">Usuarios</p>
                        <p class="mb-0 pt-8"></p>
                     </div>
                     <div class="col s7 m7 right-align">
                        <i class="material-icons background-round mt-5 mb-5 gradient-45deg-green-teal gradient-shadow white-text">perm_identity</i>
                        <p class="mb-0">Total Asignados</p>
                     </div>
                  </div>
                </div>
                <div class="col s12 m6 l3">
                  <div class="card padding-4 animate fadeLeft">
                     <div class="col s5 m5">
                        <h5 class="mb-0" id="conexiones">{{$tot_conexion}}</h5>
                        <p class="no-margin">Total</p>
                        <p class="mb-0 pt-8"></p>
                     </div>
                     <div class="col s7 m7 right-align">
                        <i class="material-icons background-round mt-5 mb-5 gradient-45deg-indigo-light-blue gradient-shadow white-text">cast_connected</i>
                        <p class="mb-0">Vendidos</p>
                     </div>
                  </div>
                </div>
                <div class="col s12 m6 l3">
                  <div class="card padding-4 animate fadeLeft">
                     <div class="col s5 m5">
                        <h5 class="mb-0" id="cpu">{{$load_cpu}}%</h5>
                        <p class="no-margin"></p>
                        <p class="mb-0 pt-8"></p>
                     </div>
                     <div class="col s7 m7 right-align">
                        <i class="material-icons background-round mt-5 mb-5 purple lighten-1 gradient-shadow white-text">select_all</i>
                        <p class="mb-0">Carga del CPU</p>
                     </div>
                  </div>
                </div>
                <div class="col s12 m6 l3">
                  <div class="card padding-4 animate fadeRight">
                     <div class="col s5 m5" style="padding-top: 11px">
                        <h6 class="mb-0" style="font-size: 16px" id="trafico2">- / -</h6>
                        <p class="no-margin">down/up</p>
                        <p class="mb-0 pt-8"></p>
                     </div>
                     <div class="col s7 m7 right-align">
                        <i class="material-icons background-round mt-5 mb-5 gradient-45deg-purple-deep-purple gradient-shadow white-text">import_export</i>
                        <p class="mb-0">Tráfico</p>
                     </div>
                  </div>
                </div>
              </div>
            </div>
            <!--card stats end-->
      
        </div>