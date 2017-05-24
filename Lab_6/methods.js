function Load() {
	$.ajax({
		type: "POST",
		url: 'load_list_of_tables.php', 
		dataType: "json",
		data: {}, 
		success: function(json){
			for (var i = 0; i < json.length; i++) {
					var one_table = $("<p class='link'></p>").text(json[i].name + " (" + json[i].field_count + ")");
					$("#left").append(one_table);				
			}	
			one_table = $("<button id='NewTable'></button>").text("New table");
			$("#left").append(one_table);
			$("#left").append("</br>"); $("#left").append("</br>"); 

			one_table = $("<button id='LoadTable'></button>").text("Load table");
			$("#left").append(one_table);

			one_table = $('<input type="file" name="file_for_hash" id="file" hidden>');
			$("#left").append(one_table);			

			var start_table = document.getElementsByTagName("p")[0].innerHTML;

			$('.link').click(function() {
				Load_Table($(this).text());
				$('#NewRow').show();
				$('#SubtractRow').show();
				$('#Load_in_file').show();
				$('.Form').hide();
				$('.Row_Form').hide();
			});	

			$('#NewTable').click(function() {
				$('#table_name').html("Add new table");
				$('#table').html("");
				$('#NewRow').hide();
				$('#SubtractRow').hide();
				$('#Load_in_file').hide();
				$('.Form').show();
				$('.Row_Form').hide();
			});	

			$('#LoadTable').click(function() {
				$('#file').click();				
			});

			$('#file').change(function() {
				var $input = $("#file");
			    var fd = new FormData;
			    
			    fd.append('file', $input.prop('files')[0]);

			    $.ajax({
			        url: 'table_from_file.php',
			        data: fd,
			        processData: false,
			        contentType: false,
			        type: 'POST',
			        success: function (json) {
			        	location.reload();
			        }
			    });
			});

			Load_Table(start_table); 
			$('.Form').hide();
			$('.Row_Form').hide();

			$('#NewRow').click(function() {
				$('.Row_Form').show();
				$('#NewRowData').html("");
				DrawDataFields();
			});	

			$('#SubtractRow').click(function() {
				var id = prompt("Choose row number", 1);
				if( !isNumeric(id) || id < 1 || id > document.getElementsByTagName("tr").length - 1){
					alert("Wrong number!");
					return;
				}

				var headers = document.getElementsByTagName("th")[0].innerHTML;	
				var params = document.getElementsByTagName("tr")[id].childNodes[0].innerHTML;
				var table_name = $("#table_name").html();

				for (var i = 1; i < document.getElementsByTagName("th").length; i++) {
					headers += " " + document.getElementsByTagName("th")[i].innerHTML;
					params += " " + document.getElementsByTagName("tr")[id].childNodes[i].innerHTML;
				}
				
				$.ajax({
					type: "POST",
					url: 'subtract_row.php', 
					dataType: "json",
					data: {
						headers: headers, 
						params: params, 
						table_name: table_name
					}, 
					success: function(json){
						if(json)
							location.reload();
						else
							alert("error");
					},
				});
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
		text = '<input type="text" name="param' + i + '">';
		var field = $(text);		
		$('#NewRowData').append(field);
		$('#NewRowData').append("</br></br>");
	}
}

function SetOtherParams() {
	var count = document.getElementsByTagName("th").length;
	$('#Other_Params').val($('#table_name').html() + " " + count);

	for (var i = 0; i < count; i++) {
		var text = document.getElementsByTagName("th")[i].innerHTML;
		$('#Other_Params').val($('#Other_Params').val() + " " + text);
	}
}

function isNumeric(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
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

	$('#Load_in_file').click(function() {
		$('#file2').click();
	});	

	$('#file2').change(function() {
		var headers = document.getElementsByTagName("th")[0].innerHTML;
		for (var i = 1; i < document.getElementsByTagName("th").length; i++) {
			headers += " " + document.getElementsByTagName("th")[i].innerHTML;			
		}

		var $input = $("#file2");
	    var fd = new FormData;	     
			    
	    fd.append('file', $input.prop('files')[0]);
	    fd.append('table_name', $('#table_name').html());
	    fd.append('headers', headers);

	    $.ajax({
	        url: 'table_in_file.php',
	        data: fd,
	        processData: false,
	        contentType: false,
	        type: 'POST',
	        success: function (json) {
	        	//location.reload();
	        }
	    });
	});
});