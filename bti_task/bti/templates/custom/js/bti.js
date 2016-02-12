/*bti.js 
*
*
*/
/* user regisration */
$("#regForm").submit(function(e){

		e.preventDefault();
	
		$("#prog").html("<p>Regisration In Progress...</p>");
		
		var reg = $(this).serializeArray();
		
		$.ajax({	
			url : "src/reg_d.php",
			type: "POST",
			data : reg			
		})
		.done(function(data){ 
			$("#prog").html(''+data+'');
		})
		.fail(function(data){
			$("#prog").html("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class= 'icon-remove'></i></button><i class='icon-ban-circle'></i><strong> Server Connection Failure </strong></div>");
		});	
	return false;
});

/* user login */
$("#loginForm").submit(function(e){

		e.preventDefault();
	
		$("#prog").html("<p>Logging In...</p>");
		
		var snt = $(this).serializeArray();
		
		$.ajax({	
			url : "src/login_d.php",
			type: "POST",
			data : snt			
		})
		.done(function(data){ 
			//$("#prog").html(''+data+'');
			location.href ="http://localhost/task_bti/countries.php?registration%20successfull";
		})
		.fail(function(data){
			$("#prog").html("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class= 'icon-remove'></i></button><i class='icon-ban-circle'></i><strong> Server Connection Failure </strong></div>");
		});	
	return false;
});

/* edit table */
$(".edittr").click(function ()
{
		//alert("WOW");
		
		//this hides the uneditable data and displays the input to edit 
		var id = $(this).attr('id');
		$("#c_id"+id).hide();
		$("#c_name"+id).hide();
		$("#c_capital"+id).hide();
		$("#c_code"+id).hide();
		$("#c_language"+id).hide();
		//$("#c_nlanguage"+id).hide();

		//This here triggers/shows the edit view of the table so as we can edit 
		//the content and save to the database
		$("#c_name1"+id).show();
		$("#c_capital1"+id).show();
		$("#c_code1"+id).show();
		$("#c_language1"+id).show();
		//$("#c_nlanguage1"+id).show();
}).change(function (){	//when the browser notices chang -- do the following

		//alert("Good");

		//let us capture the data the user has entered so to update our database
		var id   		=	$(this).attr('id');
		var c_name 		=	$("#c_name1"+id).val();
		var c_capital 	=	$("#c_capital1"+id).val();
		var c_code 		=	$("#c_code1"+id).val();
		var c_language 	=	$("#c_language1"+id).val();
		//var c_language 	=	$("#c_language1"+id).val();
		//var data =  'id='        +id+					'&first='	 +first+					'&last='+last;

		//alert(data);

		//alert the user update is in progress
		$("#update"+id).html('<p> Updating.. </p>');

		//check whether all the fieelds are entered if yes post else alert user
		if(c_name.length>0 && c_capital.length>0 && c_code.length>0 && c_language.length>0){
			//lets post using ajax
			$.ajax({
				url : "src/update.php", //our php file to update db
				type: "POST",
				//data : data
				data: { id:id, c_name:c_name, c_capital:c_capital, c_code:c_code, c_language:c_language }
					  
					  //console.log(data);
			
			})
			//if successfull - update table to entered data
			.done(function(data){
					$("#c_name"+id).html(c_name);
					$("#c_capital"+id).html(c_capital);
					$("#c_code"+id).html(c_code);
					$("#c_language"+id).html(c_language);
					//$("#c_nlanguage"+id).html(c_language);
					
				});			
		}
		else{alert("Can't Be Empty");}
	

		//outside click action gets user out of the editing view
		$(document).mouseup(function()
		{
			$(".editbox").hide();
			$(".text").show();
		});

});
    
   






								