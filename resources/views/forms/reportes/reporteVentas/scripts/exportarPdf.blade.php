<script src="{{ asset('dist/jspdf.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.12/jspdf.plugin.autotable.min.js" integrity="sha512-LbuBII6okEnUBAlReVukUVcO73H/Fna8DGcFsCI9mKvoRHVpAdbc2ahE9SEkMcjIplETjaUA4sAMPGiy08MEvg==" crossorigin="anonymous"></script>
<script>  
 $(document).on('click','#exportReportPdf', function(){  

        let materiales = [];

            document.querySelectorAll('.tablaFiltro tbody tr').forEach(function(e){ 
              materiales.push(new Array(  e.querySelector('.idTabla').innerText,
                        e.querySelector('.usuarioTabla').innerText,
                        e.querySelector('.zonaTabla').innerText,
                         e.querySelector('.perfilTabla').innerText,
                         e.querySelector('.precioTabla').innerText,
                         e.querySelector('.cantidadTabla').innerText, 
                         e.querySelector('.subtotalTabla').innerText,
                         e.querySelector('.fechaTabla').innerText, 
                         e.querySelector('.estadoTable').innerText ));
            }); 
        materiales.push(new Array(" "," "," "," "," ","Total :",document.querySelector('.total').innerText ," "," "  ));
        var text=$('#total').val();
        var doc = new jsPDF();
        doc.text(75,20,"REPORTE DE VENTAS"); 
        // doc.text(75,24,"---------------------------------");
        doc.text(75,24,"___________________");

         var columns = ["Id", "Vendedor", "Punto de Venta","Plan", "Precio", "Cantidad", "Subtotal", "Fecha de venta"];  
  
        doc.autoTable(columns,materiales,
        { margin:{ top: 30 },content: 'Text',theme: 'striped', colSpan: 2, rowSpan: 2,styles: { halign: 'center' }}
        ); 
        doc.save('Reporte ventas.pdf');  
 }); 
</script>