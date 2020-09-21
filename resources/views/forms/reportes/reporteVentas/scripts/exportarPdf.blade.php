<script src="{{ asset('dist/jspdf.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.12/jspdf.plugin.autotable.min.js" integrity="sha512-LbuBII6okEnUBAlReVukUVcO73H/Fna8DGcFsCI9mKvoRHVpAdbc2ahE9SEkMcjIplETjaUA4sAMPGiy08MEvg==" crossorigin="anonymous"></script>
<script>  
 $(document).on('click','#exportReportPdf', function(){  

        let materiales = [];

            document.querySelectorAll('.tablaFiltro tbody tr').forEach(function(e){ 
              materiales.push(new Array(  e.querySelector('.idTabla').innerText,
                        e.querySelector('.usuarioTabla').innerText,
                        e.querySelector('.Cod_Alterno').innerText,
                        e.querySelector('.zonaTabla').innerText,
                        e.querySelector('.Ticket').innerText, 
                         e.querySelector('.perfilTabla').innerText,
                         e.querySelector('.precioTabla').innerText,
                         e.querySelector('.Total_Asignados').innerText,
                         e.querySelector('.Total_Vendidos').innerText,
                         e.querySelector('.Saldo_Total').innerText,



                         e.querySelector('.cantidadTabla').innerText, 
                         e.querySelector('.subtotalTabla').innerText,
                         e.querySelector('.fechaTabla').innerText, 
                         e.querySelector('.estadoTable').innerText ));
            }); 
        materiales.push(new Array(" "," "," "," "," "," "," "," "," "," ","Total :",document.querySelector('.total').innerText ," "," "  ));

        // console.log(materiales);
        var text=$('#total').val();
        // var doc = new jsPDF();
        var doc = new jsPDF({
          orientation: "landscape"
          // unit: "in",
          // format: [4, 3]
        });
        
        // doc.text("REPORTE DE VENTAS", 4.5, 0.5);
        // doc.text("___________________",4.5,0.7); 
        var bandera =$('#Cabecera_color').val();
        var tipo=null;
        console.log(bandera);
        if(bandera=='SI'){
           tipo ='striped'; 
        }else{
           tipo ='grid'; 
        } 
        doc.text(110,20,"REPORTE DE VENTAS");  
        doc.text(110,24,"___________________"); 

       /*   var logo = new Image(); 
        logo.src = " {{asset('images/img8.jpg') }} ";  
        doc.addImage(logo, 'JPG', 10, 10, 50, 70); */
        
         var columns = ["Id", "Vendedor","Cod.Alterno", "Punto de Venta","Paquete","Plan", "Precio","Total Asignados","Total Vendidos","Saldo Total","Cantidad Venta", "Subtotal", "Fecha de venta"];   
        doc.autoTable(columns,materiales,{
          margin:{ top: 30},content: 'Text',theme:tipo,styles: { halign: 'center' } 
        } ,materiales
        ); 

 

        doc.save('Reporte ventas.pdf');  
        // temas :  ->grid,plain,striped
 }); 
</script>