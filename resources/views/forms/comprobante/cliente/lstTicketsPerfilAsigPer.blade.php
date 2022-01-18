<html lang="es">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      {{-- 
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      --}}
 


      <title>LISTA DE TICKETS</title>
      <style>
        *  {
          box-sizing: border-box;
          margin: 0;
          padding: 0;
      }
 
  
          body {
            margin: 1cm 1cm 1cm 1cm;
          }

          header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #2a0927;
            color: white;
            text-align: center;
            line-height: 30px;
          }

          footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #2a0927;
            color: white;
            text-align: center;
            line-height: 35px;
          }

          .voucher {
            /* display: inline-block;  */
            /* background-image: url(urlimagen); */
            background-position: center center;
            background-repeat: no-repeat;
            color: #000;
            background-attachment: relative;
            background-size: cover;
            border-radius: 6px;
            width: 245px;
            min-width: 240px;
            max-width: 245px;
            height: auto;
            border: 1px solid #000000;
            background-color: RGBA(252, 7, 3, 0.6);
            margin-left: 10PX;
            margin-right: 10px;
            margin-bottom: 2px;
            margin-top: 2px;
          }

          text {
            margin: auto;
            text-align: center;
            font-size: 35px;
            color: #FFFFFF;
            background-color: rgba(125, 26, 182, 1);
            margin-top: -1px;
            width: 100%;
            height: 80px;
          }

          .users {
            Color: #000000;
            background-color: rgba(255, 255, 255, 1);
            text-align: left;
            font-family: "Times New Roman", Times, serif;
            font-size: 13px;
            border: 1px solid #000;
            width: 97%; 
            padding: 1px;
          }

          .indicadores {
            background-color: rgba(3, 138, 52, 0.8);
            Color: #FFFFFF;
            font-size: 15px;
            text-align: right;
            font-family: "Times New Roman", Times, serif;
            width: 100%;
            padding: 2px;
          }

          .precios {
            background-color: rgba(3, 48, 252, 0.8);
            Color: #FFFFFF;
            font-size: 15px;
            text-align: right;
            font-family: "Times New Roman", Times, serif;
            width: 100%;
            padding: 2px;
          }

          hr {
            page-break-after: always;
            border: 0;
            margin: 0;
            padding: 0;
          }  
          .precios2 {
            background-color: rgba(255, 255, 255, 1);
            Color: #000000;
            text-align: center;
            font-family: "Times New Roman", Times, serif;
            font-size: 15px;
            border: 1px solid #000;
            width: 98%;
          }  
          /* .greed{
            display: grid;
          } */

 
</style>


			



						
   </head>
  <body> 
        @foreach ($tickets_asignados_det as $item) 
        
        <div >
          <?php     $i=0;     ?> 
          @foreach ($ARRAY as $ticket)    
          @php
               $i+=1; 
          @endphp

          
              <table class="default"> 

                <tr > 
                  <td > 
                    <table class="voucher  table-sm" style="background-color:#{{$ticket[0]['color']}}" >
                        <tbody>
                          <tr>
                              <td colspan="2">
                                
                                <center>
                                  <p class="text"> Conéctate a Zona Wi-Fi</p> 
                                <img src="{{ public_path('logo.png') }}" width="100" height="40"    > </center>  
                              </td>
                          </tr>
                          <tr>
                              <td>
                                <legend class="precios">Tiempo:</legend>
                              </td>
                              <td>
                                <legend class="precios2">{{$ticket[0]['time_pin_hospot']}}</legend>
                              </td>
                          </tr>
                          <tr>
                              <td>
                                <legend class="precios">Precio:</legend>
                              </td>
                              <td>
                                <legend class="precios2"> $ {{$ticket[0]['precio']}}</legend>
                              </td>
                          </tr>
                          <tr>
                              <td>
                                <legend class="indicadores">Usuario:</legend>
                              </td>
                              <td>
                                <legend class="users">{{$ticket[0]['id_pin_hospot']}}</legend>
                              </td>
                          </tr>
                          <tr>
                              <td>
                                <legend class="indicadores">Estado:</legend>
                              </td>
                              <td>
                                @if ($ticket[0]['estado']==0) 
                                <legend class="users"> DISPONIBLE</legend>
                                @else 
                                <legend class="users"> CONECTADO</legend>
                                    
                                @endif
                              </td>
                          </tr>
                          <tr>
                              <td colspan="2">   
                              </td>
                          </tr>
                        </tbody>
                    </table>  
                  </td>  
                  <td> 
                    <table class="voucher  table-sm" style="background-color:#{{$ticket[1]['color']}}" >
                        <tbody>
                          <tr>
                              <td colspan="2">
                                
                                <center>
                                  <p class="text"> Conéctate a Zona Wi-Fi</p> 
                                <img src="{{ public_path('logo.png') }}" width="100" height="40"    > </center>  
                              </td>
                          </tr>
                          <tr>
                              <td>
                                <legend class="precios">Tiempo:</legend>
                              </td>
                              <td>
                                <legend class="precios2">{{$ticket[1]['time_pin_hospot']}}</legend>
                              </td>
                          </tr>
                          <tr>
                              <td>
                                <legend class="precios">Precio:</legend>
                              </td>
                              <td>
                                <legend class="precios2"> $ {{$ticket[1]['precio']}}</legend>
                              </td>
                          </tr>
                          <tr>
                              <td>
                                <legend class="indicadores">Usuario:</legend>
                              </td>
                              <td>
                                <legend class="users">{{$ticket[1]['id_pin_hospot']}}</legend>
                              </td>
                          </tr>
                          <tr>
                              <td>
                                <legend class="indicadores">Estado:</legend>
                              </td>
                              <td>
                                @if ($ticket[1]['estado']==0) 
                                <legend class="users"> DISPONIBLE</legend>
                                @else 
                                <legend class="users"> CONECTADO</legend>
                                    
                                @endif
                              </td>
                          </tr>
                          <tr>
                              <td colspan="2">   
                              </td>
                          </tr>
                        </tbody>
                    </table>  
                  </td>  
                  <td> 
                    <table class="voucher  table-sm" style="background-color:#{{$ticket[2]['color']}}" >
                        <tbody>
                          <tr>
                              <td colspan="2">
                                
                                <center>
                                  <p class="text"> Conéctate a Zona Wi-Fi</p> 
                                <img src="{{ public_path('logo.png') }}" width="100" height="40"    > </center>  
                              </td>
                          </tr>
                          <tr>
                              <td>
                                <legend class="precios">Tiempo:</legend>
                              </td>
                              <td>
                                <legend class="precios2">{{$ticket[2]['time_pin_hospot']}}</legend>
                              </td>
                          </tr>
                          <tr>
                              <td>
                                <legend class="precios">Precio:</legend>
                              </td>
                              <td>
                                <legend class="precios2"> $ {{$ticket[2]['precio']}}</legend>
                              </td>
                          </tr>
                          <tr>
                              <td>
                                <legend class="indicadores">Usuario:</legend>
                              </td>
                              <td>
                                <legend class="users">{{$ticket[2]['id_pin_hospot']}}</legend>
                              </td>
                          </tr>
                          <tr>
                              <td>
                                <legend class="indicadores">Estado:</legend>
                              </td>
                              <td>
                                @if ($ticket[2]['estado']==0) 
                                <legend class="users"> DISPONIBLE</legend>
                                @else 
                                <legend class="users"> CONECTADO</legend>
                                    
                                @endif
                              </td>
                          </tr>
                          <tr>
                              <td colspan="2">   
                              </td>
                          </tr>
                        </tbody>
                    </table>  
                  </td>  
                  <td> 
                    <table class="voucher  table-sm" style="background-color:#{{$ticket[3]['color']}}" >
                        <tbody>
                          <tr>
                              <td colspan="2">
                                
                                <center>
                                  <p class="text"> Conéctate a Zona Wi-Fi</p> 
                                <img src="{{ public_path('logo.png') }}" width="100" height="40"    > </center>  
                              </td>
                          </tr>
                          <tr>
                              <td>
                                <legend class="precios">Tiempo:</legend>
                              </td>
                              <td>
                                <legend class="precios2">{{$ticket[3]['time_pin_hospot']}}</legend>
                              </td>
                          </tr>
                          <tr>
                              <td>
                                <legend class="precios">Precio:</legend>
                              </td>
                              <td>
                                <legend class="precios2"> $ {{$ticket[3]['precio']}}</legend>
                              </td>
                          </tr>
                          <tr>
                              <td>
                                <legend class="indicadores">Usuario:</legend>
                              </td>
                              <td>
                                <legend class="users">{{$ticket[3]['id_pin_hospot']}}</legend>
                              </td>
                          </tr>
                          <tr>
                              <td>
                                <legend class="indicadores">Estado:</legend>
                              </td>
                              <td>
                                @if ($ticket[3]['estado']==0) 
                                <legend class="users"> DISPONIBLE</legend>
                                @else 
                                <legend class="users"> CONECTADO</legend>
                                    
                                @endif
                              </td>
                          </tr>
                          <tr>
                              <td colspan="2">   
                              </td>
                          </tr>
                        </tbody>
                    </table>  
                  </td>  
                  <td> 
                    <table class="voucher  table-sm" style="background-color:#{{$ticket[4]['color']}}" >
                        <tbody>
                          <tr>
                              <td colspan="2">
                                
                                <center>
                                  <p class="text"> Conéctate a Zona Wi-Fi</p> 
                                <img src="{{ public_path('logo.png') }}" width="100" height="40"    > </center>  
                              </td>
                          </tr>
                          <tr>
                              <td>
                                <legend class="precios">Tiempo:</legend>
                              </td>
                              <td>
                                <legend class="precios2">{{$ticket[4]['time_pin_hospot']}}</legend>
                              </td>
                          </tr>
                          <tr>
                              <td>
                                <legend class="precios">Precio:</legend>
                              </td>
                              <td>
                                <legend class="precios2"> $ {{$ticket[4]['precio']}}</legend>
                              </td>
                          </tr>
                          <tr>
                              <td>
                                <legend class="indicadores">Usuario:</legend>
                              </td>
                              <td>
                                <legend class="users">{{$ticket[4]['id_pin_hospot']}}</legend>
                              </td>
                          </tr>
                          <tr>
                              <td>
                                <legend class="indicadores">Estado:</legend>
                              </td>
                              <td>
                                @if ($ticket[4]['estado']==0) 
                                <legend class="users"> DISPONIBLE</legend>
                                @else 
                                <legend class="users"> CONECTADO</legend>
                                    
                                @endif
                              </td>
                          </tr>
                          <tr>
                              <td colspan="2">   
                              </td>
                          </tr>
                        </tbody>
                    </table>  
                  </td>  
                  
                </tr>

              </table>

               
                {{-- <h3>{{ $ticket[0]['perfil'] }}</h3>
                <h3>{{ $ticket[1]['perfil'] }}</h3>
                <h3>{{ $ticket[2]['perfil'] }}</h3>
                <h3>{{ $ticket[3]['perfil'] }}</h3> --}}
                @if ( $i==20 )
                      @php
                          $i==0;
                      @endphp
                      <hr>
                    
                @endif
      
          @endforeach  
        </div>
        @endforeach  
  </body>

</html>

    {{-- 
    <footer>
        <h1>MAXCOM</h1>
    </footer>
    --}}


       {{-- @if ($i%2==0)

              <div  style="margin-left:10pt;right:0pt;  " >
               <table class="voucher  table-sm" style="red;margin: 1px" >
                    <tbody>
                      <tr>
                          <td colspan="2"> 
                            <center>
                              <p class="text"> Conéctate a Zona Wi-Fi</p>
                            <br>
                            <img src="{{ public_path('logo.png') }}" width="240" height="60"  > </center> 
                            <br> 
                          </td>
                      </tr>
                      <tr>
                          <td>
                            <legend class="precios">Tiempo:</legend>
                          </td>
                          <td>
                            <legend class="precios2">{{$ticket->time_pin_hospot}}</legend>
                          </td>
                      </tr>
                      <tr>
                          <td>
                            <legend class="precios">Precio:</legend>
                          </td>
                          <td>
                            <legend class="precios2"> $ {{$ticket->precio}}</legend>
                          </td>
                      </tr>
                      <tr>
                          <td>
                            <legend class="indicadores">Usuario:</legend>
                          </td>
                          <td>
                            <legend class="users">{{$ticket->id_pin_hospot}}</legend>
                          </td>
                      </tr>
                      <tr>
                          <td>
                            <legend class="indicadores">Estado:</legend>
                          </td>
                          <td>
                            @if ($ticket->estado==0) 
                            <legend class="users"> DISPONIBLE</legend>
                            @else 
                            <legend class="users"> CONECTADO</legend>
                                
                            @endif
                          </td>
                      </tr>
                      <tr>
                          <td colspan="2">   
                          </td>
                      </tr>
                    </tbody>
                </table>
              </div>
              
              @else 
              <div  style="position:absolute; left:0pt; width:0pt;" > 
                <table class="voucher  table-sm" style="red;margin: 1px" >
                    <tbody>
                      <tr>
                          <td colspan="2">
                            
                            <center>
                              <p class="text"> Conéctate a Zona Wi-Fi</p>
                            <br>
                            <img src="{{ public_path('logo.png') }}" width="100" height="40"    > </center>  
                          </td>
                      </tr>
                      <tr>
                          <td>
                            <legend class="precios">Tiempo:</legend>
                          </td>
                          <td>
                            <legend class="precios2">{{$ticket->time_pin_hospot}}</legend>
                          </td>
                      </tr>
                      <tr>
                          <td>
                            <legend class="precios">Precio:</legend>
                          </td>
                          <td>
                            <legend class="precios2"> $ {{$ticket->precio}}</legend>
                          </td>
                      </tr>
                      <tr>
                          <td>
                            <legend class="indicadores">Usuario:</legend>
                          </td>
                          <td>
                            <legend class="users">{{$ticket->id_pin_hospot}}</legend>
                          </td>
                      </tr>
                      <tr>
                          <td>
                            <legend class="indicadores">Estado:</legend>
                          </td>
                          <td>
                            @if ($ticket->estado==0) 
                            <legend class="users"> DISPONIBLE</legend>
                            @else 
                            <legend class="users"> CONECTADO</legend>
                                
                            @endif
                          </td>
                      </tr>
                      <tr>
                          <td colspan="2">   
                          </td>
                      </tr>
                    </tbody>
                </table>
                 
              </div>  
              @endif

              @if ($i%10==0) 
    <hr>    --}} 



     {{-- <table class="voucher  table-sm" >
                    <tbody>
                      <tr>
                          <td colspan="2">
                            
                            <center>
                              <p class="text"> Conéctate a Zona Wi-Fi</p> 
                            <img src="{{ public_path('logo.png') }}" width="100" height="40"    > </center>  
                          </td>
                      </tr>
                      <tr>
                          <td>
                            <legend class="precios">Tiempo:</legend>
                          </td>
                          <td>
                            <legend class="precios2">{{$ticket->time_pin_hospot}}</legend>
                          </td>
                      </tr>
                      <tr>
                          <td>
                            <legend class="precios">Precio:</legend>
                          </td>
                          <td>
                            <legend class="precios2"> $ {{$ticket->precio}}</legend>
                          </td>
                      </tr>
                      <tr>
                          <td>
                            <legend class="indicadores">Usuario:</legend>
                          </td>
                          <td>
                            <legend class="users">{{$ticket->id_pin_hospot}}</legend>
                          </td>
                      </tr>
                      <tr>
                          <td>
                            <legend class="indicadores">Estado:</legend>
                          </td>
                          <td>
                            @if ($ticket->estado==0) 
                            <legend class="users"> DISPONIBLE</legend>
                            @else 
                            <legend class="users"> CONECTADO</legend>
                                
                            @endif
                          </td>
                      </tr>
                      <tr>
                          <td colspan="2">   
                          </td>
                      </tr>
                    </tbody>
    </table>  --}}


           {{--   @elseif($i==2)
                  @php $i=3; @endphp
              <div  style="float: left;margin-left:166pt;"  > 
                <table class="voucher  table-sm" >
                    <tbody>
                      <tr>
                          <td colspan="2">
                            
                            <center>
                              <p class="text"> Conéctate a Zona Wi-Fi</p> 
                            <img src="{{ public_path('logo.png') }}" width="100" height="40"    > </center>  
                          </td>
                      </tr>
                      <tr>
                          <td>
                            <legend class="precios">Tiempo:</legend>
                          </td>
                          <td>
                            <legend class="precios2">{{$ticket->time_pin_hospot}}</legend>
                          </td>
                      </tr>
                      <tr>
                          <td>
                            <legend class="precios">Precio:</legend>
                          </td>
                          <td>
                            <legend class="precios2"> $ {{$ticket->precio}}</legend>
                          </td>
                      </tr>
                      <tr>
                          <td>
                            <legend class="indicadores">Usuario:</legend>
                          </td>
                          <td>
                            <legend class="users">{{$ticket->id_pin_hospot}}</legend>
                          </td>
                      </tr>
                      <tr>
                          <td>
                            <legend class="indicadores">Estado:</legend>
                          </td>
                          <td>
                            @if ($ticket->estado==0) 
                            <legend class="users"> DISPONIBLE</legend>
                            @else 
                            <legend class="users"> CONECTADO</legend>
                                
                            @endif
                          </td>
                      </tr>
                      <tr>
                          <td colspan="2">   
                          </td>
                      </tr>
                    </tbody>
                </table> 
              </div> 
          @elseif($i==3)
                  @php $i=4; @endphp
              <div  style="float: left;"  > 
                <table class="voucher  table-sm" >
                    <tbody>
                      <tr>
                          <td colspan="2">
                            
                            <center>
                              <p class="text"> Conéctate a Zona Wi-Fi</p> 
                            <img src="{{ public_path('logo.png') }}" width="100" height="40"    > </center>  
                          </td>
                      </tr>
                      <tr>
                          <td>
                            <legend class="precios">Tiempo:</legend>
                          </td>
                          <td>
                            <legend class="precios2">{{$ticket->time_pin_hospot}}</legend>
                          </td>
                      </tr>
                      <tr>
                          <td>
                            <legend class="precios">Precio:</legend>
                          </td>
                          <td>
                            <legend class="precios2"> $ {{$ticket->precio}}</legend>
                          </td>
                      </tr>
                      <tr>
                          <td>
                            <legend class="indicadores">Usuario:</legend>
                          </td>
                          <td>
                            <legend class="users">{{$ticket->id_pin_hospot}}</legend>
                          </td>
                      </tr>
                      <tr>
                          <td>
                            <legend class="indicadores">Estado:</legend>
                          </td>
                          <td>
                            @if ($ticket->estado==0) 
                            <legend class="users"> DISPONIBLE</legend>
                            @else 
                            <legend class="users"> CONECTADO</legend>
                                
                            @endif
                          </td>
                      </tr>
                      <tr>
                          <td colspan="2">   
                          </td>
                      </tr>
                    </tbody>
                </table> 
              </div> 

                
          @elseif($i==4)
                 @php $i=5; @endphp
                 <div  style="float: left;max-width:200pt ;"  > 
                <table class="voucher  table-sm" >
                    <tbody>
                      <tr>
                          <td colspan="2">
                            
                            <center>
                              <p class="text"> Conéctate a Zona Wi-Fi</p> 
                            <img src="{{ public_path('logo.png') }}" width="100" height="40"    > </center>  
                          </td>
                      </tr>
                      <tr>
                          <td>
                            <legend class="precios">Tiempo:</legend>
                          </td>
                          <td>
                            <legend class="precios2">{{$ticket->time_pin_hospot}}</legend>
                          </td>
                      </tr>
                      <tr>
                          <td>
                            <legend class="precios">Precio:</legend>
                          </td>
                          <td>
                            <legend class="precios2"> $ {{$ticket->precio}}</legend>
                          </td>
                      </tr>
                      <tr>
                          <td>
                            <legend class="indicadores">Usuario:</legend>
                          </td>
                          <td>
                            <legend class="users">{{$ticket->id_pin_hospot}}</legend>
                          </td>
                      </tr>
                      <tr>
                          <td>
                            <legend class="indicadores">Estado:</legend>
                          </td>
                          <td>
                            @if ($ticket->estado==0) 
                            <legend class="users"> DISPONIBLE</legend>
                            @else 
                            <legend class="users"> CONECTADO</legend>
                                
                            @endif
                          </td>
                      </tr>
                      <tr>
                          <td colspan="2">   
                          </td>
                      </tr>
                    </tbody>
                </table> 
              </div> 
     
          @elseif($i==5)
                 @php $i=6; @endphp 
                 <div  style="max-width:200pt;max-height: 220pt ;float:left;"  > 
                <table class="voucher  table-sm" >
                    <tbody>
                      <tr>
                          <td colspan="2">
                            
                            <center>
                              <p class="text"> Conéctate a Zona Wi-Fi</p> 
                            <img src="{{ public_path('logo.png') }}" width="100" height="40"    > </center>  
                          </td>
                      </tr>
                      <tr>
                          <td>
                            <legend class="precios">Tiempo:</legend>
                          </td>
                          <td>
                            <legend class="precios2">{{$ticket->time_pin_hospot}}</legend>
                          </td>
                      </tr>
                      <tr>
                          <td>
                            <legend class="precios">Precio:</legend>
                          </td>
                          <td>
                            <legend class="precios2"> $ {{$ticket->precio}}</legend>
                          </td>
                      </tr>
                      <tr>
                          <td>
                            <legend class="indicadores">Usuario:</legend>
                          </td>
                          <td>
                            <legend class="users">{{$ticket->id_pin_hospot}}</legend>
                          </td>
                      </tr>
                      <tr>
                          <td>
                            <legend class="indicadores">Estado:</legend>
                          </td>
                          <td>
                            @if ($ticket->estado==0) 
                            <legend class="users"> DISPONIBLE</legend>
                            @else 
                            <legend class="users"> CONECTADO</legend>
                                
                            @endif
                          </td>
                      </tr>
                      <tr>
                          <td colspan="2">   
                          </td>
                      </tr>
                    </tbody>
                </table> 
              </div>  
          @elseif($i==6)
                 @php $i=7; @endphp  
              <div  style="background-color: red;max-width:165pt;position:initial;"  > 
                <table class="voucher  table-sm" >
                    <tbody>
                      <tr>
                          <td colspan="2">
                            
                            <center>
                              <p class="text"> Conéctate a Zona Wi-Fi</p> 
                            <img src="{{ public_path('logo.png') }}" width="100" height="40"    > </center>  
                          </td>
                      </tr>
                      <tr>
                          <td>
                            <legend class="precios">Tiempo:</legend>
                          </td>
                          <td>
                            <legend class="precios2">{{$ticket->time_pin_hospot}}</legend>
                          </td>
                      </tr>
                      <tr>
                          <td>
                            <legend class="precios">Precio:</legend>
                          </td>
                          <td>
                            <legend class="precios2"> $ {{$ticket->precio}}</legend>
                          </td>
                      </tr>
                      <tr>
                          <td>
                            <legend class="indicadores">Usuario:</legend>
                          </td>
                          <td>
                            <legend class="users">{{$ticket->id_pin_hospot}}</legend>
                          </td>
                      </tr>
                      <tr>
                          <td>
                            <legend class="indicadores">Estado:</legend>
                          </td>
                          <td>
                            @if ($ticket->estado==0) 
                            <legend class="users"> DISPONIBLE</legend>
                            @else 
                            <legend class="users"> CONECTADO</legend>
                                
                            @endif
                          </td>
                      </tr>
                      <tr>
                          <td colspan="2">   
                          </td>
                      </tr>
                    </tbody>
                </table> 
              </div> 
          @elseif($i==7)
                 @php $i=1; @endphp 
                <div  style="background-color: red;max-width:165pt;float: left; margin-top: 150pt;"  > 
                <table class="voucher  table-sm" >
                    <tbody>
                      <tr>
                          <td colspan="2">
                            
                            <center>
                              <p class="text"> Conéctate a Zona Wi-Fi</p> 
                            <img src="{{ public_path('logo.png') }}" width="100" height="40"    > </center>  
                          </td>
                      </tr>
                      <tr>
                          <td>
                            <legend class="precios">Tiempo:</legend>
                          </td>
                          <td>
                            <legend class="precios2">{{$ticket->time_pin_hospot}}</legend>
                          </td>
                      </tr>
                      <tr>
                          <td>
                            <legend class="precios">Precio:</legend>
                          </td>
                          <td>
                            <legend class="precios2"> $ {{$ticket->precio}}</legend>
                          </td>
                      </tr>
                      <tr>
                          <td>
                            <legend class="indicadores">Usuario:</legend>
                          </td>
                          <td>
                            <legend class="users">{{$ticket->id_pin_hospot}}</legend>
                          </td>
                      </tr>
                      <tr>
                          <td>
                            <legend class="indicadores">Estado:</legend>
                          </td>
                          <td>
                            @if ($ticket->estado==0) 
                            <legend class="users"> DISPONIBLE</legend>
                            @else 
                            <legend class="users"> CONECTADO</legend>
                                
                            @endif
                          </td>
                      </tr>
                      <tr>
                          <td colspan="2">   
                          </td>
                      </tr>
                    </tbody>
                </table> 
              </div> 
          @endif --}}  

   