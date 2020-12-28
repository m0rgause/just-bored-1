<?php
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$query = isset($_GET['s']) ? $_GET['s'] : null;

$home = "https://api.akie.tech/anoboy/?param=home&page={$page}";
$search = "https://api.akie.tech/anoboy/?param=search&page={$page}&q={$query}";
$api = isset($query) ? $search : $home;
$api = json_decode(file_get_contents($api), true);
if ($api['response_code'] == 404) {
	die($api['result']);
}
$c = count($api['result']);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="/assets/css/custom.css">
		<!-- Bootstrap CSS -->
		<link href="/assets/css/bootstrap.min.css" rel="stylesheet" >
		<!-- Custom CSS -->
		
		<title>Akie | Fanshare</title>
	</head>
	<body>
		
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="container-fluid container">
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav me-auto">
						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href="#">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">On-Going</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Genres</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Jadwal Rilis</a>
						</li>
					</ul>
					<form action="/" class="d-flex">
						<input name="s" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
					</form>
				</div>
			</div>
		</nav>
		<div class="container mt-5">
			<center>
			<a href="/">
				<img width="200" src="https://static.nhentai.net/img/logo.090da3be7b51.svg">
			</a>
			</center>
			<div class="card mt-4 mb-3">
				<div class="card-body">
					<div class="box px-4 py-2 mb-2 d-flex d-inline">
						<div class="d-flex align-items-center me-auto">
							<?= (isset($_GET['s']) ? 'Result for : '. $_GET['s'] : 'New Release') ?>
						</div>
						<div class="theme-switch-wrapper">
							    <label class="theme-switch" for="checkbox">
							        <input type="checkbox" id="checkbox" />
							        <div class="slider round"></div>
							  	</label>
						</div>
					</div>
					<div class="row">
						<?php foreach ($api['result'] as $r): ?>
						
						<div class="col-6 col-md-3 mb-2 mt-2">
							<form action="/anime/<?= $r['link'] ?>" method="post" id="<?= $r['link'] ?>">
								<a class="postlink" onclick="document.getElementById('<?= $r['link'] ?>').submit()" style="text-decoration: none !important;color: #333;display: grid;justify-content: center;">
									<div class="card list" style="width: 15rem;background-color: #f0f0f3">
										<img src="<?= $r['image'] ?>" class="card-img-top" style="max-height: 124px !important;"  alt="Image">
										<div class="card-body">
											<h7 class="card-title"><?= $r['title'] ?></h7>
											<p class="card-text"><small class="text-muted">Updated at <?= $r['created_at'] ?></small></p>
											
										</div>
									</div>
								</a>
							</form>
						</div>
						<?php endforeach ?>
					</div>
				</div>
			</div>
			
			<nav aria-label="page navigation">
				<ul class="pagination justify-content-center">
					<?php if ($query != null): ?>
						<?php if ($page > 1): ?>
						<li class="page-item">
							<a class="page-link" href="/page/<?= $page - 1 . "/{$query}" ?>">&laquo;</a>
						</li>	
						<?php endif ?>
						<li class="page-item disabled active"><a class="page-link" aria-disabled="true" href="#"><?= $page  ?></a></li>
						<?php for ($i=1; $i < 5; $i++) : ?>
						<li class="page-item"><a class="page-link" href="/page/<?= $page + $i . "/{$query}" ?>"><?= $page + $i  ?></a></li>
						
						<?php endfor; ?>
						<li class="page-item">
							<a class="page-link" href="/page/<?= $page + 1 . "/{$query}" ?>">&raquo;</a>
						</li>
					<?php else: ?>
						<?php if ($page > 1): ?>
						<li class="page-item">
							<a class="page-link" href="/page/<?= $page - 1 ?>">&laquo;</a>
						</li>	
						<?php endif ?>
						<li class="page-item disabled active"><a class="page-link" aria-disabled="true" href="#"><?= $page  ?></a></li>
						<?php for ($i=1; $i < 5; $i++) : ?>
						<li class="page-item"><a class="page-link" href="/page/<?= $page + $i  ?>"><?= $page + $i  ?></a></li>
						
						<?php endfor; ?>
						<li class="page-item">
							<a class="page-link" href="/page/<?= $page + 1 ?>">&raquo;</a>
						</li>
					<?php endif ?>
				</ul>
			</nav>
		</div>

		<footer class="bg-dark text-center text-lg-start text-light">
		  <!-- Copyright -->
		  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
		    © 2020 Copyright:
		    <a class="text-light" href="#">Akie.Tech</a>
		  </div>
		  <!-- Copyright -->
		</footer>
		<!-- Optional JavaScript; choose one of the two! -->
		<!-- Option 1: Bootstrap Bundle with Popper -->
		<script src="/assets/js/bootstrap.bundle.min.js"></script>
		<script src="/assets/js/jquery.min.js"></script>
		<script src="/assets/js/theme.js"></script>
	</body>
</html>