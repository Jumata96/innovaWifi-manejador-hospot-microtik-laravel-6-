<div class="container">
  <br>
            <!--card stats start-->
            <div id="card-stats">
              <div class="row">
                <div class="col s12 m6 l3">
                  <div class="card gradient-45deg-green-teal gradient-shadow min-height-100 white-text">
                    <div class="padding-4">
                      <div class="col s7 m7">
                        <i class="material-icons background-round mt-5">perm_identity</i>
                        <p>Nuevos registrados</p>
                      </div>
                      <div class="col s5 m5 right-align">
                        <h4 class="mb-0">+{{$tot_usuarios}}</h4>
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
                        <p>Conexiones en linea</p>
                      </div>
                      <div class="col s5 m5 right-align" style="padding-top: 0px; margin-top: 0px">
                        <h4 class="mb-0">{{$tot_conexion}}</h4>
                        <p class="no-margin">Total</p>
                        <p></p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col s12 m6 l3">
                  <div class="card gradient-45deg-amber-amber gradient-shadow min-height-100 white-text">
                    <div class="padding-4">
                      <div class="col s7 m7">
                        <i class="material-icons background-round mt-5">timeline</i>
                        <p>Carga del CPU</p>
                      </div>
                      <div class="col s5 m5 right-align">
                        <h4 class="mb-0">{{$load_cpu}}%</h4>
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
                        <p>Registro manual</p>
                      </div>
                      <div class="col s5 m5 right-align">
                        <h4 class="mb-0">40%</h4>
                        <p class="no-margin"></p>
                        <p></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--card stats end-->
        
        
        </div>