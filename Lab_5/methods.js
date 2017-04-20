function CheckAbility() {
	var count = 0;
	for (var i = 1; i < 4; ++i) {
		var kids = $( '.row' + i ).children();
		for (var j = 0; j < kids.length; ++j) 
			if (kids[j].innerText == "") 
				count++;		
	}

	if (count > 0) 
		return true;
	else 
		return false;
}

function CheckWinX() {
	var Win = false;
	for (var i = 1; i < 4; ++i) {
		var kids = $( '.row' + i ).children();
		var cnt = 0;

		for (var j = 0; j < kids.length; ++j) 
			if (kids[j].innerText == "X") 
				cnt++;

		if (cnt == 3) 
			Win = true;
	}

	var row1 = $( '.row1' ).children();
	var row2 = $( '.row2' ).children();
	var row3 = $( '.row3' ).children();

	for (var i = 0; i < row1.length; i++) {
		if (row1[i].innerText == "X" && row2[i].innerText == "X" && row3[i].innerText == "X") 
			Win = true;				
	}

	if (row1[0].innerText == "X" && row2[1].innerText == "X" && row3[2].innerText == "X") 
		Win = true;		

	if (row1[2].innerText == "X" && row2[1].innerText == "X" && row3[0].innerText == "X") 
		Win = true;		

	return Win;
}

function CheckWinO() {
	var Win = false;
	for (var i = 1; i < 4; ++i) {
		var kids = $( '.row' + i ).children();
		var cnt = 0;

		for (var j = 0; j < kids.length; ++j) 
			if (kids[j].innerText == "O") 
				cnt++;

		if (cnt == 3) 
			Win = true;
	}

	var row1 = $( '.row1' ).children();
	var row2 = $( '.row2' ).children();
	var row3 = $( '.row3' ).children();

	for (var i = 0; i < row1.length; i++) {
		if (row1[i].innerText == "O" && row2[i].innerText == "O" && row3[i].innerText == "O") 
			Win = true;				
	}

	if (row1[0].innerText == "O" && row2[1].innerText == "O" && row3[2].innerText == "O") 
		Win = true;		

	if (row1[2].innerText == "O" && row2[1].innerText == "O" && row3[0].innerText == "O") 
		Win = true;		

	return Win;
}

$(document).ready(function(){
	$('#Restart').hide();
	$.ajax({
 		type: "POST",
 		url: 'LoadData.php', 
 		dataType: "json",
 		data: {}, 
 		success: function(json){		
 			var img = "Images/";
 			img += json.photo;
 			$('.UserImg').attr("src", img);
 			var Info = "<h2>" + json.login + "</h2><br>" +
 			  			json.f_name + " " + json.l_name + "<br>" + 
 			  			json.e_mail;
 			$('.UserData').append(Info);
		},
	});	

	$('div').click(function(){
		if (this.className == "col1" || this.className == "col2" || this.className == "col3") {
			if (this.innerText == "" && !CheckWinO() && !CheckWinX()) {
				this.innerText = "X";
				while (true) {
					var row = (Math.floor(Math.random() * 3) + 1);
					var col = (Math.floor(Math.random() * 3));	
					var kids = $( '.row' + row ).children();
					var elem = kids[col];

					if (CheckAbility() && !CheckWinX()) {
 						if (elem.innerText == '') {
 							elem.innerText = "O";
 							break;
 						}	 			
 					}			
					else
						break;
				}	 					
	 					
				if (CheckWinX()) {
					alert("You win!");
					$('#Restart').show();
				}
				if (CheckWinO()) {
					alert("You lose!");
					$('#Restart').show();					
				}
				if (!CheckAbility()) 
					$('#Restart').show();
	 					
			}
		}
	})

	$('#Restart').click(function() {
		$('#Restart').hide();

		for (var i = 1; i < 4; ++i) {
			var kids = $( '.row' + i ).children();
			for (var j = 0; j < kids.length; ++j) 
				kids[j].innerText = "";	
		}
	})
});