<?
ini_set("display_errors",1);

function destacaTexto($highlite,$string){
	return str_ireplace($highlite,"<b>".$highlite."</b>",$string);
}

//Criar documento XML atraves de DOM
//Create XML Doc through DOM
$xmlDoc = new DOMDocument('1.0', 'utf-8');
$xmlDoc->formatOutput = true;

//Criar elementos Raíz do XML
//Create root XML element
$root = $xmlDoc->createElement('root');
$root = $xmlDoc->appendChild($root);

//Abrir conexão com BD
try {
	$dbh = db_connect();

	//Preparar Query
	
	$results = $dbh->query("SELECT username, fname, lname FROM add_book
                     		WHERE
                         		fname LIKE '%".$_POST['string']."%'
                         	OR
                         		lname LIKE '%".$_POST['string']."%'
                         	AND
                         		username = '".$_SESSION['valid_user']."'");
	while ($row = $results->fetch(PDO::FETCH_ASSOC)){
		//Cadastrar na lista
		//Add to list
		$item = $xmlDoc->createElement('item');
		$item = $root->appendChild($item);
		$item->setAttribute('id',$row['username']);
		$texto = $row['fname']."(".$row['lname'].") "."<".$row['email'].">";
		$label = destacaTexto($_POST['string'],$texto);
		$item->setAttribute('label',rawurlencode($label));
		$item->setAttribute('flabel',rawurlencode($texto));
		
		//Problema: o texto que volta para o cmapo vai com tags doidas.. e deveria ir apenas o texto, precisamos de um label e um 
		// campo "show" opcional
		
		//rawurlencode evita problemas de charset
		//rawurlencode avoids charset problems
	}


	$dbh = null;
} catch (PDOException $e) {
	$item = $xmlDoc->createElement('item');
	$item = $root->appendChild($item);
	$item->setAttribute('id','0');
	$label = $e->getMessage();
	$item->setAttribute('label',rawurlencode($label));
}

//Retornar XML de resultado para AJAX
//Return XML code for AJAX Request
header("Content-type:application/xml; charset=utf-8");
echo $xmlDoc->saveXML();

?>