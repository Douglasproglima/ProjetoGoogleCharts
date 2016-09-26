
function pagesVisitas(){
	
	//Função para remover o select mostrado na tabela <tr>
	$(".formataPagesTr").remove();
	
	var periodo = $("#idPagesSelect").val();

	$.getJSON("relatorios/trafegoPagina/" + periodo, function(resposta){
		
		var i = 1;
		$.each(resposta, function(key, val){
			var container = '<tr class="formataPagesTr">';
			container += 		'<td>'+i+'</td>';
			container += 		'<td>'+key+'</td>';
			container += 		'<td>'+val+'</td>';
			container += 	'</tr>';
			
			i++;
			
			$("#idPages").append(container);
		});
		
	});	
}

//Inicia a função, pois se iniciar direto não vai mostrar nenhum valor nos gráficos
pagesVisitas();

//Quando o usuário selecionar uma opção do select do html carrega novamente a listagem dos dados na pág. Admin
$("#idPagesSelect").change(function(){
	pagesVisitas();
});