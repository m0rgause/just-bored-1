<?php 
// error_reporting(0);

$link = !empty($_GET['uri']) ? $_GET['uri'] : die();
$api = json_decode(file_get_contents("https://api.akie.tech/anoboy/?param=detail&link={$link}"),true);
if ($api['response_code'] == 404 || empty($api)) {
	die('Something was wrong');
}
$details = $api['result']['details'];
$download = $api['result']['download'];
$i = 0;
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
							<a class="nav-link active" aria-current="page" href="/">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="/ongoing">On-Going</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="/genres">Genres</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="/jadwalrealease">Jadwal Rilis</a>
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
						<?= $details['title'] ?>
						</div>
						<div class="theme-switch-wrapper">
							    <label class="theme-switch" for="checkbox">
							        <input type="checkbox" id="checkbox" />
							        <div class="slider round"></div>
							  	</label>
						</div>
					</div>
					<div class="container">
					<img src="<?= $details['thumb'] ?>" class="rounded mx-auto d-block mb-1" width="100%" alt="...">
					<div class="row ingfo mt-3">
						<div class="col-12 col-md-6 okoklh">
							<p><small ><b>Title : </b><?= $details['title'] ?></small></p>
						</div>
						<div class="col-12 col-md-6 okoklh">
							<p><small ><b>Studio : </b><?= $details['studio'] ?></small></p>
						</div>
						<div class="col-12 col-md-6 okoklh">
							<p><small ><b>Duration : </b><?= $details['duration'] ?></small></p>
						</div>
						<div class="col-12 col-md-6 okoklh">
							<p><small ><b>Rating : </b><?= $details['rating'] ?></small></p>
						</div>
						<div class="col-12 col-md-6 okoklh">
							<p><small ><b>All Episodes : </b><a href="/anime/<?= $details['more_episodes'] ?>">Click here</a></small></p>
						</div>
						<div class="col-12 col-md-6 okoklh">
							<p><small ><b>Genre : </b>
							<?php if ($details['genre'] != null): ?>
								<?php foreach ($details['genre'] as $g): ?>
							<?= $g.', ' ?>
							<?php endforeach ?></small></p>
							<?php endif ?>
							
						</div>
					</div>
					<p class="card-text">
						<?= $details['description'] ?>
					</p>
					<div class="card download">
						<?php if ($api['result']['type'] == 'tv'): ?>
						<div class="card-body">
							<div class="box1 px-4 py-2 mb-1 text-center">
								<b>Download <?= $details['title'] ?> 360p</b>
							</div>
							<div class="ser px-4 py-2 text-center ">
								<b><a href="<?= $download['360']['zippyshare'] ?>">Zippyshare</a> | <a href="<?= ($download['360']['googlevideo'] != '/uploads/404.mp4') ? "{$download['360']['googlevideo']}&title={$details['title']}" : '#' ?>">GoogleVideo</a></b>
							</div>
							<div class="box1 px-4 py-2 mb-1 text-center">
								<b>Download <?= $details['title'] ?> 480p</b>
							</div>
							<div class="ser px-4 py-2 text-center">
								<b><a href="<?= $download['480']['zippyshare'] ?>">Zippyshare</a> | <a href="<?= ($download['480']['googlevideo'] != null) ? "{$download['480']['googlevideo']}&title={$details['title']}" : '#' ?>">GoogleVideo</a></b>
							</div>
							<div class="box1 px-4 py-2 mb-1 text-center">
								<b>Download <?= $details['title'] ?> 720p</b>
							</div>
							<div class="ser px-4 py-2 text-center">
								<b><a href="<?= $download['720']['zippyshare'] ?>">Zippyshare</a> | <a href="<?= ($download['720']['googlevideo'] != '/uploads/404.mp4') ? "{$download['720']['googlevideo']}&title={$details['title']}" : '#' ?>">GoogleVideo</a></b>
							</div>
						</div>
						<?php elseif($api['result']['type'] == 'batch'): ?>
						<div class="card-body">
							<div class="box1 px-4 py-2 mb-1 text-center">
								<b>Download <?= $details['title'] ?> Batch</b>
							</div>
							<div class="ser px-4 py-2 text-center">
								<b>Mega : <a href="<?= $download['batch']['360'] ?>">360p</a> | <a href="<?= $download['480'] ?>">480p</a> | <a href="<?= $download['batch']['720'] ?>&title=<?= $details['title'] ?>">720p</a></b>
							</div>
						</div>
						<div class="card-body">
							<?php foreach ($download['single'] as $down): ?>
							<div class="box1 px-4 py-2 mb-1 text-center">
								<b>Download <?= $details['title'] ?> Eps <?= 1 + $i++ ?></b>
							</div>
							<div class="ser px-4 py-2 text-center">
								<b>Zippyshare : <a href="<?= $download['single'][$i]['360'] ?>">360p</a> | <a href="<?= $download['single'][$i]['480'] ?>">480p</a> | <a href="<?= $download['single'][$i]['720'] ?>">720p</a></b>
							</div>
							<?php endforeach ?>
						</div>
						<?php endif ?>
						
					</div>
				</div>
				</div>
			</div>
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