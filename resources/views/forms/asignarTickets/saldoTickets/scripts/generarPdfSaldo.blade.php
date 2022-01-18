 
    <script src="{{ asset('dist/jspdf.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.12/jspdf.plugin.autotable.min.js" integrity="sha512-LbuBII6okEnUBAlReVukUVcO73H/Fna8DGcFsCI9mKvoRHVpAdbc2ahE9SEkMcjIplETjaUA4sAMPGiy08MEvg==" crossorigin="anonymous"></script>
<script>  
 $(document).on('click','#exportReportPdf', function(){  
           
        var doc = new jsPDF({
          orientation: "landscape" 
        });
        
      
        tipo ='striped';
        doc.text(110,20,"REPORTE DE SALDO");  
        doc.text(110,24,"___________________");  

         var columns = ["#","NOMBRE","CODIGO ALTERNO","PAQUETE","PERFIL","TICKETS ASIGNADOS", "SALDO DETICKETS", "DIFERENCIA"];


             

        doc.autoTable(columns,datos_Filtrado,{
          margin:{ top: 30},content: 'Text',theme:tipo,styles: { halign: 'center' } 
        } 
        ); 

 

        doc.save('Reporte saldo.pdf');  
        // temas :  ->grid,plain,striped
 }); 
</script>


 