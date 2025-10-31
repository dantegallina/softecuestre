<html xmlns="http://www.w3.org/1999/xhtml" LANG="es">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">


<title></title>

</head>
<BODY>
<?PHP


 

      $sql_listado_camp = "select * from campeonato ORDER BY puntaje_acum ASC";
      $listado_camp = mysqli_query ($conexion, $sql_listado_camp) or die ("NO HAY INSCRIPTOS EN ESTE MOMENTO");
      $qfilas_listado_camp = mysqli_num_rows ($listado_camp);

      if ($qfilas_listado_camp > 0)
      {

         print ("<TABLE border='1' bgcolor='#A9E2F3' cellpadding='4' cellspacing='0'>\n");
         print ("<TR>\n");
         print ("<TD colspan='8'><b><center>CAMPEONATO</center></b></TD>\n");          
         print ("</TR>\n");    
         print ("<TR>\n");
         print ("<TD width='10'><b>Orden</b></TD>\n"); 
         print ("<TD width='150'><b>Jinete</b></TD>\n");
         print ("<TD width='150'><b>Caballo</b></TD>\n");
 	 print ("<TD width='50'><b>Club</b></TD>\n");
 	 print ("<TD width='50'><b>Dia 1</b></TD>\n"); 
  	 print ("<TD width='50'><b>Dia 2</b></TD>\n"); 
  	 print ("<TD width='50'><b>Dia 3</b></TD>\n");
  	 print ("<TD width='50'><b>Total</b></TD>\n");           
         print ("</TR>\n");

         for ($i=0; $i<5; $i++)
         {
            $resultado_listado_camp = mysqli_fetch_array ($listado_camp);
$colorfila=0;
	if ($colorfila==0){ 
       		$color= "#A9E2F3"; 
       		$colorfila=1; 
    	}else{ 
       		$color="#F0F0F0"; 
       		$colorfila=0; 
    	}
	$a=0;	
	$a=$a+1;
            print ("<TR>\n");
            print ("<TD width='10'  bgcolor='".$color."'  >" . $a  . "</TD>\n");
            print ("<TD width='150' bgcolor='".$color."'  >" . $resultado_listado_camp['Jinete'] . "</TD>\n");
            print ("<TD width='150' bgcolor='".$color."'  >" . $resultado_listado_camp['Caballo'] . "</TD>\n");
            print ("<TD width='50'  bgcolor='".$color."'  >" . $resultado_listado_camp['Club'] . "</TD>\n");
            print ("<TD width='50'  bgcolor='".$color."'  >" . $resultado_listado_camp['dia1'] . "</TD>\n"); 
            print ("<TD width='50'  bgcolor='".$color."'  >" . $resultado_listado_camp['dia2'] . "</TD>\n");
            print ("<TD width='50'  bgcolor='".$color."'  >" . $resultado_listado_camp['dia3'] . "</TD>\n");
            print ("<TD width='50'  bgcolor='".$color."'  >" . $resultado_listado_camp['puntaje_acum'] . "</TD>\n");                                               
            
             print ("</TR>\n");

		 }

         print ("</TABLE>\n");

      }


     

  

?>
</br>
</BODY>
</HTML>