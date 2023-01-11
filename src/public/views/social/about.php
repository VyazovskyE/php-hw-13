<h1>This is about page</h1>

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">About</li>
	</ol>
</nav>

<div class="my-4">
	<a class="btn btn-primary" href="/about/clients-list" role="button">Go to Client List page</a>
</div>

<?php foreach ($pageData['posts'] as $post): ?>
	<div class="card my-4">
		<div class="card-body">
			<h5 class="card-title">
				<?= $post['title'] ?>
			</h5>
			<p class="card-text"><?= $post['text'] ?></p>
		</div>
	</div>
<?php endforeach; ?>
