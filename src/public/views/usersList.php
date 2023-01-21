<div class="d-flex align-items-baseline justify-content-between">
	<h1>Users</h1>
	<a href="/create-user" class="">Create User</a>
</div>

<hr>

<form method="get" action="/users">
	<div class="mb-3">
		<label for="age_from">Age from</label>
		<input type="range" class="form-control" id="age_from" name="age_from" min="0" max="100"
			value="<?php echo $pageData['ageFrom']; ?>">
	</div>
	<div class="mb-3">
		<label for="age_to">Age to</label>
		<input type="range" class="form-control" id="age_to" name="age_to" min="0" max="100"
			value="<?php echo $pageData['ageTo']; ?>">
	</div>
	<div class="mb-3">
		<button type="submit" class="btn btn-primary">Filter</button>
	</div>
</form>

<table class="table table-hover">
	<thead>
		<th>#</th>
		<th>Name</th>
		<th>Email</th>
		<th>Age</th>
		<th>Registered</th>
	</thead>
	<tbody>
		<?php foreach ($pageData['users'] as $user): ?>
			<tr>
				<td><?php echo $user['id']; ?></td>
				<td>
					<?php echo $user['name']; ?>
				</td>
				<td><?php echo $user['email']; ?></td>
				<td>
					<?php echo $user['age']; ?>
				</td>
				<td><?php echo $user['registered_at']; ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
