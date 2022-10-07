<?php
$nome = $_POST["Nome"];
$genero = $_POST["Genero"];
$datanasc = $_POST["Data-de-Nascimento"];
$telefone = $_POST["Telefone"];
$email = $_POST["Email"];

// FILTROS 

// Cria uma variável que terá os dados do erro
$erro = false;

// Verifica se o POST tem algum valor
if (!isset($_POST) || empty($_POST)) {
	informaErro('Nada foi postado.');
	$erro = true;
}

// Cria as variáveis dinamicamente
foreach ($_POST as $chave => $valor) {
	// Remove todas as tags HTML
	// Remove os espaços em branco do valor
	$$chave = trim(strip_tags($valor));
}

// Verifica se $email realmente existe e se é um email. 
// Também verifica se não existe nenhum erro anterior
if ((!isset($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) && !$erro) {
	informaErro('Envie um email válido.');
	$erro = true;
}

if (filter_var($nome, FILTER_SANITIZE_NUMBER_INT)) {
	informaErro('O nome deve conter apenas letras');
	$erro = true;
}
if (!filter_var($telefone, FILTER_VALIDATE_INT)) {
	informaErro('O telefone deve conter apenas numeros');
	$erro = true;
}


// Se existir algum erro, mostra o erro
if (!$erro) {
	// Se a variável erro continuar com valor falso
	// Você pode fazer o que preferir aqui, por exemplo, 
	// enviar para a base de dados, ou enviar um email
	// Tanto faz. Vou apenas exibir os dados na tela.
	echo "<h1> Veja os dados enviados</h1>";

	// MANIPULANDO O ARQUIVO

	$salvando = "\n Nome: $nome \n Gênero: $genero \n Data de Nascimeno: $datanasc \n Telefone: $telefone \n E-mail: $email \n";
	$arquivo = fopen('../registro/dados.txt', 'a');
	if ($arquivo == false)
		die('Não foi possível enviar seu arquivo.');
	fwrite($arquivo, $salvando);
	fclose($arquivo);

	foreach ($_POST as $chave => $valor) {
		echo '<b>' . $chave . '</b>: ' . $valor . '<br><br>';
	}
}
?>
<button><a href="../../index.html">Voltar ao formulario</a></button>
<?php

function informaErro($mensagem)
{
?>
	<p><?php echo $mensagem ?></p>
<?php
}
