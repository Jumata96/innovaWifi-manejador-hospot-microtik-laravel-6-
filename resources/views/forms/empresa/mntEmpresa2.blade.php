<!DOCTYPE html>
<html lang="es">

<head>
  @include('hotspot.layouts.partials.htmlHead')
</head>

<body style="background: white" >
  @include('hotspot.layouts.partials.header')  

 
  
  <div class="contend">
   <div id="main" style="padding-left: 0px; padding-top: 1.2rem">
      <!-- START WRAPPER -->
      <div class="wrapper">
             <br>
         <section id="content center">
          <div class="row">
            <div class="col s12 m12 l8 offset-l2">
                <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>REGISTRAR EMPRESA</h2>
                  </div>
                  <form  id="myForm" accept-charset="UTF-8" enctype="multipart/form-data">
                  <div class="row card-header sub-header">
                        <div class="col s12 m12 herramienta">                         
                          <a id="add" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Guardar">
                            <i class="material-icons blue-text text-darken-2">check</i></a>
                          <a style="margin-left: 6px"></a>   
                                                  
                        </div>  

                        @include('forms.scripts.modalInformacion')              
                        
                  </div>
                                    
                  
                  <div class="row cuerpo">
                    
                    
                    <div class="col col s12 m8 l7">
                      <div class="card white">
                        <div class="card-content">
                            <span class="card-title">Datos Generales</span>

                            <div class="row">
                              <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix active">label_outline</i>
                                <input id="idempresa" name="idempresa" type="text" data-error=".errorTxt1" maxlength="3" onkeyup="mayus(this);">
                                <label for="idempresa">Cod. Empresa</label>
                                <div id="error1" style="color: red; font-size: 12px; font-style: italic;"></div>
                              </div>   
                              <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">clear_all</i>
                                <input id="razon_social" name="razon_social" type="text" data-error=".errorTxt2" maxlength="200" onkeyup="mayus(this);">
                                <label for="razon_social">Razón Social</label>
                                <div id="error2" style="color: red; font-size: 12px; font-style: italic;"></div>
                              </div>       
                              <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">sim_card</i>
                                <input id="RUC" name="RUC" type="text" data-error=".errorTxt3" minlength="9" maxlength="11">
                                <label for="RUC">RUC</label>
                                <div id="error3" style="color: red; font-size: 12px; font-style: italic;"></div>
                              </div>

                              <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">room</i>
                                <input id="direccion" name="direccion" type="text" data-error=".errorTxt4" onkeyup="mayus(this);">
                                <label for="direccion">Dirección</label>
                                <div id="error4" style="color: red; font-size: 12px; font-style: italic;"></div>
                              </div>   
                              <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">insert_link</i>
                                <input id="referencia" name="referencia" type="text">
                                <label for="referencia">Referencia</label>
                              </div>     
                              <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">call</i>
                                <input id="telefono" name="telefono" type="text">
                                <label for="telefono">Telefono</label>
                              </div>                          
                            </div>

                        </div>
                      </div>
                    </div>
                    
                    <div class="col col s12 m8 l5">
                      <div class="card grey lighten-5">
                        <div class="card-content">
                            <span class="card-title">Representante</span>

                            <div class="row"> 
                              <div class="col s12" style="padding-bottom: 14px">
                                <label for="iddocumento">Documento</label>
                                <select class="browser-default" id="iddocumento" name="iddocumento" required>
                                  <option value="" disabled selected="">Seleccione</option>
                                  @foreach($tipo_documento as $documento)
                                  <option value="{{$documento->iddocumento}}">{{$documento->dsc_corta}} - {{$documento->descripcion}}</option>
                                  @endforeach
                                </select>
                              </div>  
                              <div class="input-field col s12">
                                <i class="material-icons prefix">subtitles</i>
                                <input id="DNI1" name="DNI1" type="text">
                                <label for="DNI1">Nro. de Documento</label>
                              </div>      
                              <div class="input-field col s12">
                                <i class="material-icons prefix">perm_identity</i>
                                <input id="representante1" name="representante1" type="text" onkeyup="mayus(this);">
                                <label for="representante1">Nombre</label>
                              </div>   
                            </div>

                        </div>
                      </div>
                    </div>
                      
                  </div>
                  </form>
              </div>
  </div>
</div>
        </section>
        
        </div>
        <!-- END WRAPPER -->
    </div> 
  </div>

      @include('hotspot.layouts.partials.footer')
      @include('hotspot.layouts.partials.scripts')  
      @include('forms.empresa.scripts.validacion')
      @include('forms.empresa.scripts.addEmpresa2')  
      
</body>
</html>
