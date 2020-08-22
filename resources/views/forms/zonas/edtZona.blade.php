@extends('layouts2.app')
@section('titulo','Editar  Punto de Venta')

@section('main-content')
<br>
<div class="row">
  <div class="col s12 m12 l10 offset-l1">
                <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>PUNTO DE VENTA</h2>
                  </div>
                  <form  id="myForm" accept-charset="UTF-8" enctype="multipart/form-data">
                  <div class="row card-header sub-header">
                        <div class="col s12 m12 herramienta">                         
                          <a id="add" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Guardar">
                            <i class="material-icons blue-text text-darken-2">check</i></a>
                          <a style="margin-left: 6px"></a>   
                          
                          <a href="{{url('/zonas')}}" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" href="#!" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                            <i class="material-icons" style="color: #424242">keyboard_tab</i></a>            
                        </div>  

                             
                        
                  </div>
                                    
                  
                  <div class="row cuerpo">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="col col s12 m8 l8 offset-l2">
                      <div class="card white">
                        <div class="card-content">
                            <span class="card-title">Datos Generales</span>
                            @foreach ($zonas as $data)
                                
                            

                            <div class="row">
                              <div class="input-field col s12 m6 l6 ">
                                <i class="material-icons prefix active">label_outline</i>
                                <input id="codigo" name="codigo" type="text" value=" {{ $data->id }}" data-error=".errorTxt1" maxlength="3" onkeyup="mayus(this);">
                                <label for="codigo">Cod.PuntoVenta</label>
                                <div class="errorTxt1"></div>
                              </div>   
                              <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">assignment</i>
                                <input id="nombre" value=" {{ $data->nombre }}" name="nombre" type="text" data-error=".errorTxt2" maxlength="50" >
                                <label for="nombre"> Nombre  </label>
                                <div class="errorTxt2"></div>
                              </div>       
                              <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">description</i>
                                <input id="descripcion" name="descripcion"  value=" {{ $data->descripcion }}"type="text" data-error=".errorTxt3" minlength="9" maxlength="20" onkeyup="mayus(this);">
                                <label for="descripcion">Descripción</label>
                                <div class="errorTxt3"></div>
                              </div>

                              <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">assignment</i>
                                <input id="dsCorta" name="dsCorta" value=" {{ $data->dsc_corta }}" type="text"maxlength="4" data-error=".errorTxt4" >
                                <label for="dsCorta">Ds.Corta</label>
                                <div class="errorTxt4"></div>
                              </div>   
                              <div class=" input-field col s12 m6 l6"   >
                                <i id="iconColor"  style="color:#{{$data->color}};" class="material-icons prefix" >color_lens</i>
                                <label  for="color">Color</label>
                                <input id="color" value="{{ $data->color }}" style="text-align: center;color:#{{$data->color}};" name="color" type="text" readonly="readonly">
                              </div>  
                              <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">comment</i>
                                <label for="glosa">GLOSA</label> 
                                <textarea class="materialize-textarea" name="glosa" rows="1" cols="20"> {{ $data->glosa }}
                                </textarea>
                                 
                              </div>                         
                            </div>
                            @endforeach 
                        </div>
                      </div>
                    </div>
                    
                   
                  </div>
                  </form>
              </div>
  </div>
</div>
<br><br><br>
@endsection

@section('script')
  @include('forms.zonas.scripts.updZona')
  @include('forms.zonas.scripts.modalColoresEdit')
  @include('forms.zonas.modalColoresEdit')
	


  

  
@endsection