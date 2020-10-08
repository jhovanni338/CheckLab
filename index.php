<?php
$conexion = mysqli_connect("localhost", "root","", "scraping2") or die ("Error ");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>web scraping</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body style="background-color: pink;" >

<div align="center">
  <nav   class="navbar navbar-expand-sm bg-light">
    <ul  class="navbar-nav">
      <li class="nav-item">
          <a  class="nav-link" href="url.php">HTML_DOM_Parser</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="tabla.php">PAGINAS SCRAPEADAS</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="#"></a>
      </li>
    </ul>
  </nav>
<br>


 <form method="POST" action="url.php">
   <div class="form-group"  >
      <label  >URL</label>
      <input style="margin: auto; width: 20%; text-align: center;" type="text" class="form-control" name="url" id="url" placeholder="ingrese el url a scrapear">
   </div>
  <button class="btn btn-primary" type="submit" name="insert">INGRESAR</button>
 </form>

<?php
  if(isset($_POST['insert']))
  {
    include "simple_html_dom.php"; 
    $link = $_POST['url'];
    $html = file_get_html($link);
    foreach($html->find('a') as $element)
    {
         header("Location:tabla2.php?msg=" .urlencode('datos registrados correctamente!!!!'));
         $link2=$element->href ;
         $texto=file_get_html($link2)->plaintext;   
         $consulta ="SELECT * FROM users";
         $ejecutar= mysqli_query($conexion, $consulta);
         $i= 0;
         while($fila= mysqli_fetch_array($ejecutar))
         {
            $enlace2 =$fila['enlaces'];
            $link3=$link2;
            if( $link3 != $enlace2)
             {
                $insertar ="INSERT INTO users(datos, enlaces) VALUES ('$texto', '$link2')";
                $ejecutar = mysqli_query($conexion , $insertar);
                if ($ejecutar) 
                {
                   echo "<h3> insertado correctamente";
                }
            
             }
            else
             {
                  echo "1 dato repetido";
             }
             
             $i++;
         }
    }
  }
?>
</body>
</html>
