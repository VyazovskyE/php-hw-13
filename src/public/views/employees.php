<table class="table table-hover">
	<thead>
		<th>#</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Extension</th>
		<th>Email</th>
		<th>OfficeCode</th>
		<th>Reports To</th>
		<th>Job Title</th>
	</thead>
	<tbody>
		<?php foreach ($employees as $employee): ?>
			<tr>
				<td><?php echo $employee['employeeNumber']; ?></td>
				<td><?php echo $employee['firstName']; ?></td>
				<td><?php echo $employee['lastName']; ?></td>
				<td><?php echo $employee['extension']; ?></td>
				<td><?php echo $employee['email']; ?></td>
				<td><?php echo $employee['officeCode']; ?></td>
				<td><?php echo $employee['reportsTo']; ?></td>
				<td><?php echo $employee['jobTitle']; ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
