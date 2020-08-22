<div id="confirmacion3{{$datos->codigo}}" class="modal" style="width: 500px">
                                    <div class="modal-content teal white-text">
                                      <p>Se habilitará este usuario en el Mikrotik. Está seguro que desea habilitar este usuario?</p>
                                    </div>
                                    <div class="modal-footer teal lighten-4">
                                      <a href="#" class="waves-effectwaves-light btn-flat modal-action modal-close">Cancelar</a>
                                      <a class="waves-effect waves-light btn-flat modal-action modal-close" id="h{{$datos->codigo}}" data-idcliente="{{$datos->codigo}}">Aceptar</a>
                                    </div>
                                  </div>