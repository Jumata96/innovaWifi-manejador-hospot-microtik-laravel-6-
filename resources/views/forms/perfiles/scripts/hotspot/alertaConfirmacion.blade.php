<div id="h_confirmacion{{$valor->idperfil}}" class="modal" style="width: 500px">
   <div class="modal-content red darken-3 white-text">
      <p>Está seguro que desea eliminar este registro?</p>
   </div>
   <div class="modal-footer ed lighten-3 lighten-4">
      <a href="#" class="waves-effectwaves-light btn-flat modal-action modal-close">Cancelar</a>
      <a class="waves-effect waves-light btn-flat modal-action modal-close" id="he{{$valor->idperfil}}" data-ideliminar="{{$valor->idperfil}}">Aceptar</a>
   </div>
</div>