<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>CRUD PHP</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
	

	<link href="https://cdn.datatables.net/v/bs5/dt-2.0.8/af-2.7.0/b-3.0.2/date-1.5.2/datatables.min.css" rel="stylesheet">

	<script src="https://cdn.datatables.net/v/bs5/dt-2.0.8/af-2.7.0/b-3.0.2/date-1.5.2/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



	<script src="../assets/js/main.js"></script>
</head>
<body>
<div class="container mt-4">
	<p class="h1 text-center">CRUD PHP</p>
    <button type="button" class="btn btn-info float-end m-2" id="btnSeed">Database seeder</button>
    <button type="button" class="btn btn-primary float-end m-2" id="btnAdd" data-bs-toggle="modal" data-bs-target="#modalPessoa">Adicionar pessoa</button>

	<?php include './list.php'; ?>
	<?php include './pessoa.php'; ?>
</div>
</body>
</html>
