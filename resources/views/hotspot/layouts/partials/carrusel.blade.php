<div class="row">
  <div class="col s12 m12 l8 offset-l2" style="padding: 0 0">
    <div class="slider" style="position: relative; height: 300px">
      <ul class="slides" style="height: 500px">
        @foreach($carrusel as $datos)
        @if($datos->img_principal == 1)
        <li>         
            @if($datos->extension == 'mp4' || $datos->extension == 'mp4v' || $datos->extension == 'mpg4' || $datos->extension =='mpeg' || $datos->extension =='mpg')           
              <video src="{{asset('/')}}{{$datos->url_imagen}}" controls width="100%" height="100%" autoplay>
                Video
              </video>           
            @else        
              <img src="{{asset('/')}}{{$datos->url_imagen}}" style="background-size: 100% 100%">           
            @endif

          <!-- random image -->
          <div class="caption {{$datos->alineacion}}" style="padding-top: {{$datos->padding_top}}px">
     {{--        <h3>{{$datos->titulo}}</h3>
            <h5 class="light {{$datos->color}}">{{$datos->descripcion}}</h5> --}}
            @if($datos->btn_estado == 1)
            <p><a href="{{ (empty($datos->btn_idprod))? '#' : $datos->idprod }}" class="btn btn-large waves-effect waves-light {{ (empty($datos->btn_color))? 'gradient-45deg-purple-amber' : $datos->btn_color }}"><b>Ingresar</b></a></p>
            @endif
          </div>
        </li>
        @endif
        @endforeach        
        
        @foreach($carrusel as $datos)
        @if($datos->img_principal != 1)
        <li>
          {{-- <img src="{{asset('/')}}{{$datos->url_imagen}}" style="background-size: 100% 100%"> --}}
     @if($datos->extension == 'mp4' || $datos->extension == 'mp4v' || $datos->extension == 'mpg4' || $datos->extension =='mpeg' || $datos->extension =='mpg')      
              <video src="{{asset('/')}}{{$datos->url_imagen}}" controls width="100%" height="100%" autoplay>
                Video
              </video>           
            @else        
              <img src="{{asset('/')}}{{$datos->url_imagen}}" style="background-size: 100% 100%">           
            @endif
          <!-- random image -->
          <div class="caption {{$datos->alineacion}}" style="padding-top: {{$datos->padding_top}}px">
           {{--  <h3>{{$datos->titulo}}</h3>
            <h5 class="light grey-text text-lighten-3">{{$datos->descripcion}}</h5> --}}
            @if($datos->btn_estado == 1)
            @if(!empty($datos->btn_idprod) and $datos->btn_idprod !== '0000000000')
            <p><a href="{{url('/linea/mostrar')}}/{{$datos->btn_idprod}}" class="btn btn-large waves-effect waves-light {{ (empty($datos->btn_color))? 'gradient-45deg-purple-amber' : $datos->btn_color }}"><b>Ingresar</b></a></p>
            @else
            <p><a href="#" class="btn btn-large waves-effect waves-light {{ (empty($datos->btn_color))? 'gradient-45deg-purple-amber' : $datos->btn_color }}"><b>Ingresar</b></a></p>
            @endif
            @endif
          </div>
        </li>
        @endif
        @endforeach
       
      </ul>
    </div>

  </div>
</div>