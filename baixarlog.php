
<?php
	// Tela que baixa o pdf com os logo do bd //
include_once("dompdf/autoload.inc.php");
include_once("config.php");


$html = '<table border=1';
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th>ID do Registro</th>';
$html .= '<th>Hora de Acesso</th>';
$html .= '<th>Método de Acesso</th>';
$html .= '<th>Status do Acesso</th>';
$html .= '<th>ID do Usuário</th>';


$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';
										
$result_transacoes = "SELECT r.*,u.* FROM registro as r, usuarios as u   where u.ID_USU=r.ID_USU order by ID_REG DESC";
$resultado_trasacoes = mysqli_query($conexao, $result_transacoes); 
while ($row_transacoes = mysqli_fetch_assoc($resultado_trasacoes)) {
	$html .= '<tr><td>' . $row_transacoes['ID_REG'] . "</td>";
	$html .= '<td>' . $row_transacoes['hora_ac'] . "</td>";		
	$html .= '<td>' . $row_transacoes['metodo_ac' ] . "</td>";
	$html .= '<td>' . $row_transacoes['status_ac'] . "</td>";
	$html .= '<td>' . $row_transacoes['ID_USU'] . "</td></tr>";
			
}

$html .= '</tbody>';
$html .= '</table';


//referenciar o DomPDF com namespace
use Dompdf\Dompdf;

// include autoloader


//Criando a Instancia
$dompdf = new DOMPDF();

// Carrega seu HTML
$dompdf->load_html('
			<h1 style="text-align: center;">Telecall Registros de Acesso</h1>
			' . $html . '
		');

//renderizar o html
$dompdf->render();

//exibir a página
$dompdf->stream(
	"logs_telecall.pdf",
	array(
		"Attachment" => false //Para realizar o download somente alterar para true
	)
);
?>