<h1>Customers</h1>

<hr>

<table class="table table-hover">
	<thead>
		<th>#</th>
		<th>Name</th>
		<th>Contact</th>
		<th>Phone</th>
		<th>Address</th>
		<th>City</th>
		<th>State</th>
		<th>Postal Code</th>
		<th>Country</th>
		<th>Sales Rep</th>
		<th>Credit Limit</th>
	</thead>
	<tbody>
		<?php foreach ($customers as $customer): ?>
			<tr>
				<td><?php echo $customer['customerNumber']; ?></td>
				<td>
					<?php echo $customer['customerName']; ?>
				</td>
				<td><?php echo $customer['contactLastName'] . ', ' . $customer['contactFirstName']; ?></td>
				<td>
					<?php echo $customer['phone']; ?>
				</td>
				<td><?php echo $customer['addressLine1']; ?></td>
				<td>
					<?php echo $customer['city']; ?>
				</td>
				<td><?php echo $customer['state']; ?></td>
				<td>
					<?php echo $customer['postalCode']; ?>
				</td>
				<td><?php echo $customer['country']; ?></td>
				<td>
					<?php echo $customer['salesRepEmployeeNumber']; ?>
				</td>
				<td><?php echo $customer['creditLimit']; ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<?php if ($pageData['totalPages']): ?>
	<nav aria-label="Page navigation example">
		<ul class="pagination">
			<?php for ($i = 1; $i <= $pageData['totalPages']; $i++): ?>
				<li class="page-item <?= $pageData['currentPage'] === strval($i) ? 'active' : '' ?>">
					<a class="page-link" href="/customers?page=<?php echo $i; ?>">
						<?php echo $i; ?>
					</a>
				</li>
			<?php endfor; ?>
		</ul>
	</nav>
<?php endif; ?>
