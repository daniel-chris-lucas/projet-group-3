<h2>Dictionnaire des Données</h2>

<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<?php foreach( $csv['headers'] as $header ) : ?>
				<th><?= $header ?></th>
			<?php endforeach; ?>
		</tr>
	</thead>
	<tbody>			
		<?php foreach( $csv['content'] as $cell ) : ?>
			<tr>
				<th><?= $cell[0] ?></th>
				<td><?= $cell[1] ?></td>
				<td><?= $cell[2] ?></td>
				<td style="width: 140px;"><?= $cell[3] ?></td>
				<td><?= $cell[4] ?></td>
			</tr>
		<?php endforeach; ?>			
	</tbody>
</table>