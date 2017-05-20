function Load() {
	LoadListOfTables();
	//Load_Table($('#left p:eq(1)'));
	Load_Table("test (4)"); 
	$('.Form').hide();
	$('.Row_Form').hide();

	$('#NewRow').click(function() {
		$('.Row_Form').show();
		$('#NewRowData').html("");
		DrawDataFields();
	})
}

function LoadListOfTables() {
	$.ajax({
		type: "POST",
		url: 'load_list_of_tables.php', 
		dataType: "json",
		data: {}, 
		success: function(json){
			for (var i = 0; i <= json.length; i++) {
				if (i < json.length) {
					var one_table = $("<p class='link'></p>").text(json[i].name + " (" + json[i].field_count + ")");
					$("#left").append(one_table);
				}
				else{
					var one_table = $("<button id='NewTable'></button>").text("New table");
					$("#left").append(one_table);
				}
			}	

			$('.link').click(function() {
				Load_Table($(this).text());
				$('#NewRow').show();
				$('.Form').hide();
				$('.Row_Form').hide();
			});	

			$('#NewTable').click(function() {
				$('#table_name').html("Add new table");
				$('#table').html("");
				$('#NewRow').hide();
				$('.Form').show();
				$('.Row_Form').hide();
			});			
		},
	});
}

function Load_Table(table_name) {
	var name = table_name.split(' (')[0];
	var count = table_name.split(' (')[1];
	count = count.slice(0, count.length - 1);
	$("#table_name").html(name);

	$.ajax({
		type: "POST",
		url: 'load_table.php', 
		dataType: "json",
		data: {table_name: name, field_count: count}, 
		success: function(json){
			$("#table").html(json);			
		},
	});
}

function DrawDataFields() {	
	for (var i = 0; i < document.getElementsByTagName("th").length; i++) {
		var text = document.getElementsByTagName("th")[i].innerHTML;
		$("#NewRowData").append(text + ": ");
		text = '<input type="text" name="param' + i + '" required>';
		var field = $(text);		
		$('#NewRowData').append(field);
		$('#NewRowData').append("</br></br>");
	}


}

$(document).ready(function(){
	Load();	
	var count = 2;
	$('#NewField').click(function() {
		if(count == 10) return;

		var str = '<input type="text" name="header' + ++count + '" required>';
		var field = $(str);
		$('.inputTable').append(field);
		$('.inputTable').append(" ");

		str = '<select name="TYPE' + count + '">';
		field = $(str);

		str = '<option value="INT"></option>';
		var type_val = $(str).text("INT");
		field.append(type_val);

		str = '<option value="DOUBLE"></option>';
		var type_val = $(str).text("DOUBLE");
		field.append(type_val);

		str = '<option value="VARCHAR"></option>';
		var type_val = $(str).text("VARCHAR");
		field.append(type_val);
		$('.inputTable').append(field);	
		$('.inputTable').append("</br></br>");	
		$('#number').val(count);
	});

	$('#SubtractField').click(function() {
		if(count == 1) return;
		var c = --count;
		count = 0;
		$('.inputTable').html("");	
		for (var i = 0; i < c; i++) {
			$('#NewField').click();
		}
	});
});