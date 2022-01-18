@extends('layouts2.app')
@section('titulo','Bandeja de Correo')
@section('main-content')
<div id="app"> 
            <div id="mail-app" class="section">
              <div class="row">
                <div class="col s12">
                  <nav class="gradient-45deg-blue-grey-blue-grey">
                    <div class="nav-wrapper">
                      <div class="left col s12 m5 l5">
                        <ul>
                          <li>
                            <a href="#!" class="email-menu">
                              <i class="material-icons">menu</i>
                            </a>
                          </li>
                          <li><a href="#!" class="email-type">Bandeja de Correo</a>
                          </li>                      
                        </ul>
                      </div>
                      <div class="col s12 m7 l7 hide-on-med-and-down">
                        <ul class="right">                  
                          <li>
                           <a class="btn-floating waves-effect waves-light light-blue lighten-1 tooltipped "data-position="top" data-delay="500" data-tooltip="Enviar Nuevo Mensaje" v-on:click.prevent="redactarMensaje">
                            <i class="material-icons">email</i>
                            </a>                        
                          </li>                 
                        </ul>
                      </div>
                    </div>
                  </nav>
                </div>
                <div class="col s12">
                  <div id="email-sidebar" class="col s2 m1 s1 card-panel">
                    <ul>                                               
                      <li>
                        <a href="#!">
                          <i v-bind:class="{'material-icons':true, 'active':(bandeja === '2')}" v-on:click.prevent="showOutbox">next_week</i>
                        </a>
                      </li>       
                    </ul>
                  </div>
                  <div id="email-list" class="col s10 m4 l4 card-panel z-depth-1" v-if="(bandeja == 2)">
                    <ul class="collection">
                      <li class="collection-item avatar email-unread">
                        <i class="material-icons blue-text">group</i>
                        <span class="email-title">Bandeja de Salida</span>
                        <p class="truncate grey-text ultra-small">@{{contador_salida}} mensajes.</p>                       
                      </li> 
                      <li class="collection-item avatar" v-for="msjsa in mensajes_salida" v-on:click.prevent="viewOutbox(msjsa)">
                        <span class="circle red lighten-1">S</span>
                        <span class="email-title">Para @{{msjsa.email_destino}}</span>
                        <p class="truncate grey-text ultra-small">Mensaje enviado por @{{msjsa.enviado_por}}</p>
                        <a href="#!" class="secondary-content email-time">
                          <span class="blue-text ultra-small"> @{{msjsa.fecha}}</span>
                        </a>
                      </li>                                       
                               
                    </ul>
                  </div>            
        
      <div id="email-details" class="col s12 m11 l11 card-panel" v-if="(bandeja == 1)">
      
  <div class="card">
    <div class="card-header">                    
      <i class="fa fa-table fa-lg material-icons">receipt</i>
      <h2>Redactar Mensaje</h2>
    </div>  
    <div class="row card-header sub-header">
          <div class="col s12 m12">                         
          <button class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" v-on:click.prevent="enviarMensaje" data-position="top" data-delay="500" title="Enviar Mensaje" v-if="enviando == 1">
          <i class="material-icons blue-text text-darken-2">send</i></button> 
          <button class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" disabled data-position="top" data-delay="500" title="Enviar Mensaje" v-else>
          <i class="material-icons blue-text text-darken-2">send</i></button>    
          </div>                         
    </div>    
    <div class="card-content">
      <div class="row">
      <form class="col s12">
        <div class="row">         
          <div class="col s12 m12">
            <label for="destino">Seleccione los Destinatarios</label>
            <multiselect v-model="correos" :options="destinatarios" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Seleccione destinatarios" label="email" track-by="codigo" :preselect-first="true">        
            </multiselect>
            <div style="color: red; font-size: 12px; font-style: italic;" v-text="errors.listaDeCorreos"></div>   
          </div>
        </div>              
        <div class="row">
          <div class="input-field col s12">
            <input id="asunto" type="text" class="validate" v-model="asunto">
            <label for="asunto">Asunto</label>
            <div style="color: red; font-size: 12px; font-style: italic;" v-text="errors.asunto"></div> 
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <textarea name="contenido" id="contenido" class="materialize-textarea" v-model="contenido" ></textarea>
            <label for="contenido">Mensaje</label>
            <div style="color: red; font-size: 12px; font-style: italic;" v-text="errors.contenido"></div>
          </div>
        </div>
      </form>     
    </div>  
    </div>
  </div>
  
      </div>

      <div id="email-details" class="col s12 m7 l7 card-panel" v-if="(cabecera == 2)">
        <p class="email-subject truncate" v-text="'Asunto: '+detalle_salida.asunto">
        </p>
        <hr class="grey-text text-lighten-2">                
        <div class="email-content-wrap">
          <div class="row">
            <div class="col s10 m10 l10">
              <ul class="collection">
                <li class="collection-item avatar">
                  <span class="circle light-blue" >D</span>
                  <span class="email-title" v-text="'Para: '+detalle_salida.email_destino"></span>
                  <p class="truncate grey-text ultra-small" v-text="'De: '+detalle_salida.enviado_por"></p>           
                  <p class="grey-text ultra-small" v-text="detalle_salida.fecha"></p>
                </li>
              </ul>
            </div>
          </div>
          <div class="email-content">
            <p v-text="detalle_salida.mensaje"></p>          
          </div>
        </div>
      </div> 


<div id="newMessage" class="modal modal-fixed-footer">
  <div class="modal-content">
  <div id="mail-app" class="section">
  <form action="{{ url('/mails/store') }}" method="POST">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="row">
  <div class="col s12">
      <nav class="gradient-45deg-blue-grey-blue-grey">
        <div class="nav-wrapper">
          <div class="left col s12 m5 l5">
            <ul>
              <li>
                <a href="#!" class="email-menu">
                  <i class="material-icons">menu</i>
                </a>
              </li>
              <li><a href="#!" class="email-type">Nuevo Mensaje</a>
              </li>                    
            </ul>
          </div>               
        </div>
      </nav>
    </div>
  <div class="col s12">
    <div class="row">
    @if (count($errors)>0)
      <div id="card-alert" class="card red lighten-5">
        <div class="card-content red-text">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
          </ul>  
        </div>
        <button type="button" class="close red-text" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">×</span>
        </button>
      </div>
    @endif
    </div>
  </div>
  <div class="col s12">
  <div class="row">
  <div class="input-field col s12">
  <i class="material-icons prefix">email</i>
  <input id="to" name="to" value="{{old('to')}}" type="text" class="validate">
  <label for="to">Destinatario</label>
  </div>    
  </div>
  <div class="row">
  <div class="input-field col s12">
  <i class="material-icons prefix">bookmark_border</i>
  <input id="subject" name="subject" value="{{old('subject')}}" type="text" class="validate">
  <label for="subject">Asunto</label>
  </div>
  </div>  
  <div class="row">
  <div class="input-field col s12">
  <i class="material-icons prefix">question_answer</i>
  <textarea id="message" name="message" value="{{old('message')}}" class="materialize-textarea"></textarea>
  <label for="message">Mensaje</label>
  </div>
  <button class="btn gradient-45deg-indigo-light-blue right" type="submit">Enviar
  <i class="material-icons right">send</i>
  </button>
  </div>
  </div>    
  </div>
  </form>
  </div>
  </div>  
  <div class="modal-footer">                
    <a id="cierra" href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Regresar</a>
  </div>
</div>
</div> 
@endsection

@section('script')
<script type="text/javascript" src="{{asset('js/vue-multiselect.min.js')}}"></script>

<script type="text/javascript" >
  Vue.component('multiselect', window.VueMultiselect.default) 
 
    var app = new Vue({      
      el: '#app',
      data: {       
        contador: '',
        contador_salida: '',   
        cabecera: '',
        enviando: '1',
        encabezado : '',      
        mensajes_salida: [],   
        detalle_salida: [],
        errors: [],
        bandeja: '2',
        asunto: '',
        correos: [],              
        destinatarios: [],
        contenido: '',
        errors: '',
        listaDeCorreos: [],
      },
      created: function () {
        this.outbox();        
      },
      methods: {    
        listEmails: function(){
            var urlCorreos= 'selectEmails';
            axios.get(urlCorreos).then(response => {
                this.destinatarios = response.data;             
            });
        },    
        outbox: function(){
        var urlOutbox = 'outbox';
          axios.get(urlOutbox).then(response => {
              this.mensajes_salida = response.data.mensajes; 
              this.contador_salida = response.data.contador;
          });
        },
        viewOutbox: function(msjsa){            
          var urlOutboxDetail = 'outbox/' + msjsa.id;
          axios.get(urlOutboxDetail).then(response => {
              this.detalle_salida = response.data.detalle_salida;
              this.cabecera='2';
          });
        },  
        redactarMensaje: function(){
            this.listEmails(); 
            this.bandeja= '1'; 
            this.cabecera= '';             
        },
        showOutbox: function(){
            this.bandeja= '2';
            this.cabecera= '';            
            this.outbox();
        },
        enviarMensaje: function() {        
          for (x=0;x<this.correos.length;x++){
            this.listaDeCorreos.push(this.correos[x]['email']);
          } 
            setTimeout(function() {
                  Materialize.toast('<span>Espere... Enviando Mensaje</span>', 2500);
            }, 100);       
            this.enviando = 0;           
            var url = 'correo/enviarMensaje';
            axios.post(url, {  
                asunto: this.asunto,
                listaDeCorreos: this.listaDeCorreos,
                contenido: this.contenido,                                            
            }).then(response => {             
                setTimeout(function() {
                  Materialize.toast('<span>Mensaje Enviado</span>', 1500);
                }, 100);
                this.outbox(); 
                this.bandeja= '2';
                this.cabecera= ''; 
                this.enviando = 1; 
                this.asunto= '',
                this.correos= [];              
                this.destinatarios= [];
                this.contenido= '';
                this.errors= '';
                this.listaDeCorreos= [];           
            }).catch(error => {
                this.enviando = 1;        
                setTimeout(function() {
                  Materialize.toast('<span>Se produjo un error</span>', 1500);
                }, 100);                
                this.errors = error.response.data.errors;                
            });
        }
      }
})
</script>
@endsection
