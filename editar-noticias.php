<?php
session_start();
include 'bd/conexao.php'
?>

<?php


$categoria=addslashes($_POST['categoria']);
$titulo=addslashes($_POST['titulo']);
$subtitulo=addslashes($_POST['subtitulo']);
$file_path= addslashes($_FILES['file']['tmp_name']);
$texto=addslashes($_POST['texto']);
$id = isset($_POST['id']) ? $_POST['id'] : null;

$file = file_get_contents($file_path);

if($file == false){

	$sql = ("UPDATE TB_NOTICIAS SET CATEGORIA = ?, TITULO = ?, SUBTITULO = ?, TEXTO = ? WHERE ID_NOT = ?");



	$stmt = $conn->prepare($sql);

	$stmt->bindParam(1, $categoria);
	$stmt->bindParam(2, $titulo);
	$stmt->bindParam(3, $subtitulo);
	$stmt->bindParam(4, $texto);
	$stmt->bindParam(5, $id);

	$result = $stmt->execute();


		if ( ! $result ){
			var_dump( $stmt->errorInfo() );
			exit;
		}

		header('location:index-assoc.php');
}else{

	$sql = ("UPDATE TB_NOTICIAS SET CATEGORIA = ?, TITULO = ?, SUBTITULO = ?, TEXTO = ? WHERE ID_NOT = ?");

	$stmt = $conn->prepare($sql);

	$stmt->bindParam(1, $categoria);
	$stmt->bindParam(2, $titulo);
	$stmt->bindParam(3, $subtitulo);
	$stmt->bindParam(4, $texto);
	$stmt->bindParam(5, $id);

	$result = $stmt->execute();

	$query = ("UPDATE TB_NOTICIAS SET ARQUIVO  = ? WHERE ID_NOT = ?");

		$stmt = $conn->prepare($query);
		
		$stmt->bindParam(1, $file);
		$stmt->bindParam(2, $id);

		$result2 = $stmt->execute();



		if ( ! $result && ! $result2 ){
			var_dump( $stmt->errorInfo() );
			exit;
		}

		header('location:index-assoc.php');
}


?>

