<?php
// We'll be outputting an excel file
header('Content-type: application/vnd.ms-excel');

// It will be called file.xls
header('Content-Disposition: attachment; filename="proyecto-' . date("Y-m-d_H_i_s") . '.xls"');

?>
<table border="1">
<thead>
 	<tr>
 		<th>CODIGO</th>
 		<th>NOMBRE</th>

 		<th>PRECIO 01</th>
 		<th>PRECIO 02</th>
 		<th>PRECIO 03</th>
 		<th>PRECIO 04</th>
 		<th>PRECIO 05</th>

 		<th>PRECIO 01 Actualizado </th>
 		<th>PRECIO 02  Actualizado </th>
 		<th>PRECIO 03  Actualizado </th>
 		<th>PRECIO 04  Actualizado </th>
 		<th>PRECIO 05  Actualizado </th>


 		<th>NOMBRE 01</th>
 		<th>NOMBRE 02</th>
 		<th>NOMBRE 03</th>
 		<th>NOMBRE 04</th>
 		<th>NOMBRE 05</th>

 		<th>URL 01</th>
 		<th>URL 02</th>
 		<th>URL 03</th>
 		<th>URL 04</th>
 		<th>URL 05</th>
 	</tr>
 </thead>
 <tbody>
 <?php foreach ($rows as $k => $v): ?>

 	<tr>
 		<td><?php echo $v['codigo']; ?></td>
 		<td><?php echo $v['nombre']; ?></td>

 		<td><?php echo $v['site1_precio']; ?></td>
 		<td><?php echo $v['site2_precio']; ?></td>
 		<td><?php echo $v['site3_precio']; ?></td>
 		<td><?php echo $v['site4_precio']; ?></td>
 		<td><?php echo $v['site5_precio']; ?></td>

 		<td><?php echo $v['site1_modified']; ?></td>
 		<td><?php echo $v['site2_modified']; ?></td>
 		<td><?php echo $v['site3_modified']; ?></td>
 		<td><?php echo $v['site4_modified']; ?></td>
 		<td><?php echo $v['site5_modified']; ?></td>

 		<td><?php echo $v['site1_nombre']; ?></td>
 		<td><?php echo $v['site2_nombre']; ?></td>
 		<td><?php echo $v['site3_nombre']; ?></td>
 		<td><?php echo $v['site4_nombre']; ?></td>
 		<td><?php echo $v['site5_nombre']; ?></td>

 		<td><?php echo $v['site1_url']; ?></td>
 		<td><?php echo $v['site2_url']; ?></td>
 		<td><?php echo $v['site3_url']; ?></td>
 		<td><?php echo $v['site4_url']; ?></td>
 		<td><?php echo $v['site5_url']; ?></td>



 	</tr>
 <?php endforeach?>
 </tbody>
 </table>