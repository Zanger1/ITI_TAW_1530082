
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Unidad</th>
						<th title="Cantidad">Qty</th>
						<th>Cliente</th>
						<th>Ubicación</th>
						<th>Periodo</th>
					</tr>
				</thead>
				<tbody>
				<?php
					foreach($inventario as $item){
						echo '<tr><td>'.$item["DesUnidad"].' - '.$item["DescTipoUnidad"].' <!--'.$item["Descripcion"].'--></td><td>'.$item["cantidad"].'</td><td>'.ClientesModel::getOnlyName($item["IdCliente"]).'</td><td>'.EstadosModel::getOnlyName($item["cve_ent"]).', '.$item["nom_mun"].', CP. '.$item["CodigoPostalEntrega"].', '.$item["ColoniaEntrega"].', '.$item["CalleEntrega"].'</td><td>'.$item["FechaInicio"].' - '.$item["FechaTermino"].'</td></tr>';
					}
				?>
				</tbody>
			</table>
