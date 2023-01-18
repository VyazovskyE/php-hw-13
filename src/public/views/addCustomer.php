<h1>Add customer</h1>

<hr>

<?php if (!empty($pageData['errors'])): ?>
	<div class="alert alert-danger">
		<?php foreach ($pageData['errors'] as $error): ?>
			<p><?php echo $error; ?></p>
		<?php endforeach; ?>
	</div>
<?php endif; ?>

<?php if ($pageData['success']): ?>
	<div class="alert alert-success">
		<p>Employee added successfully</p>
	</div>
<?php endif; ?>

<form action="/add-employee" method="post">
	<div class="mb-3">
		<label for="customerNumber">Number</label>
		<input type="text" name="customerNumber" id="customerNumber" class="form-control">
	</div>
	<div class="mb-3">
		<label for="customerName">Name</label>
		<input type="text" name="customerName" id="customerName" class="form-control">
	</div>
	<div class="mb-3">
		<label for="contactFirstName">Contact First Name</label>
		<input type="text" name="contactFirstName" id="contactFirstName" class="form-control">
	</div>
	<div class="mb-3">
		<label for="contactLastName">Contact Last Name</label>
		<input type="text" name="contactLastName" id="contactLastName" class="form-control">
	</div>
	<div class="mb-3">
		<label for="phone">Phone</label>
		<input type="text" name="phone" id="phone" class="form-control">
	</div>
	<div class="mb-3">
		<label for="addressLine1">Address Line 1</label>
		<input type="text" name="addressLine1" id="addressLine1" class="form-control">
	</div>
	<div class="mb-3">
		<label for="addressLine2">Address Line 2</label>
		<input type="text" name="addressLine2" id="addressLine2" class="form-control">
	</div>
	<div class="mb-3">
		<label for="city">City</label>
		<input type="text" name="city" id="city" class="form-control">
	</div>
	<div class="mb-3">
		<label for="state">State</label>
		<input type="text" name="state" id="state" class="form-control">
	</div>
	<div class="mb-3">
		<label for="postalCode">Postal code</label>
		<input type="text" name="postalCode" id="postalCode" class="form-control">
	</div>
	<div class="mb-3">
		<label for="country">Country</label>
		<input type="text" name="country" id="country" class="form-control">
	</div>
	<div class="mb-3">
		<label for="salesRepEmployeeNumber">Sales Rep Employee Number</label>
		<select name="salesRepEmployeeNumber" id="salesRepEmployeeNumber" class="form-control">
			<option value="">Select</option>
			<?php foreach ($pageData['employees'] as $employee): ?>
				<option value="<?php echo $employee['employeeNumber']; ?>"><?php echo $employee['firstName'] . ' ' . $employee['lastName']; ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<div class="mb-3">
		<label for="creditLimit">Credit Limit</label>
		<input type="text" name="creditLimit" id="creditLimit" class="form-control">
	</div>
	<div class="mb-3">
		<button type="submit" class="btn btn-primary">Add</button>
	</div>
</form>
