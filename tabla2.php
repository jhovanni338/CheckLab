<?php
	include "Database.php";
	include "config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <?php
		$db = new Database();
		$query="SELECT * FROM users";
		$read=$db->select($query);
	?>
		<table class="table table-hover">
			<thead class="thead-dark">
				<tr>
						
			        <th scope="col">N°</th>
			        <th scope="col">ENLACE</th>
			        <th scope="col">FECHA DE SCRAPEADO</th>
			        <th scope="col">DESCARGAR ARCHIVO TXT</th>

				</tr>
			</thead>

			<?php 
			    if($read){
			?>

		    <?php
				$i=1;
				while($row=$read->fetch_assoc())
				{
		    ?>
				<tbody>
				    <tr>
				   			
				   		<td><?php echo $row['id']; ?></td>
				   		<td><?php echo $row['enlaces']; ?></td>
				   		<td><?php echo $row['fecha_de_scrapeado']; ?></td>	
                        <td><a href="exportar.php?id=<?php echo urlencode($row ['id']); ?>" class="btn btn-primary btn-sm">txt</a></td>	

				    </tr>
				</tbody>
		

	<?php } ?>
                <?php } else { ?>
                               <p>Los datos no son validos!!</p> 
                       <?php }?> 

        </table>
</body>
</html>