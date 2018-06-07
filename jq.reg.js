jQuery(document).ready(function($){
	$('input[name^="educator"]').change(function() {
		$educator = $('input[name^="educator"]:checked').val();

		if($educator == "County Administrator") {
			$("#districtselectdiv").css("display", "none");
			$("#schoolselectdiv").css("display", "none");
		} // if county admin, remove district/school requirement

		else if($educator == "District Administrator") {
			$("#districtselectdiv").css("display", "inline");
			$("#schoolselectdiv").css("display", "none");
		} // if county admin, remove school requirement
		else {
			$("#districtselectdiv").css("display", "inline");
			$("#schoolselectdiv").css("display", "inline");
		}
	});
});
jQuery(document).ready(function($){
	$('#subjectsNA').change(function() {
		if($('#subjectsNA').is(":checked")) {
			$('#subjects').val("");
			$('#subjects').attr("disabled", true);
		}
		else
			$('#subjects').removeAttr("disabled");
	});
});
jQuery(document).ready(function($){
	$('#schooltype').change(function(){
		var $schooltype=$('#schooltype').val();
		var $stateselect=$('#school_state').val();
		var $county_select=$('#countyselect2').val();
		// call ajax		
		if($schooltype == "Private"){
			$("#districtselect2").find('option').remove().end().append("<option value=0 >-- Select District --</option>").prop('disabled', true);		
		}
		else if($schooltype == "Charter"){
			$("#districtselect2").find('option').remove().end().append("<option value=0 >-- Select District --</option>").prop('disabled', true);		
		}
		else if($schooltype == "Public" && $stateselect!="0" && $county_select != "0"){
			$("#districtselect2").empty();		
			$("#districtselect2").removeAttr("disabled");
			$.ajax({
			url:"/wp-admin/admin-ajax.php",
			data:{
			'action':'school_actions',
			'countyid':$county_select
			},
			success:function(results)
			{
			//  alert(results);
				$("#districtselect2").removeAttr("disabled");
				$("#districtselect2").append(results);
			}
		});			
		}
	});
});
jQuery(document).ready(function($){
	$('#school_state').change(function(){
		var $stateselect=$('#school_state').val();
		// call ajax
		$("#countyselect").empty();
		$("#countyselect2").empty();		
		$.ajax({
			url:"/wp-admin/admin-ajax.php",
			data:{
			'action':'school_actions',
			'stateid':$stateselect
			},
			success:function(results)
			{
			//  alert(results);
			if($stateselect != "0"){			
				$("#countyselect").removeAttr("disabled");
				$("#countyselect").append(results);
				$("#countyselect2").removeAttr("disabled");
				$("#countyselect2").append(results);

				$("#addschool").removeAttr("disabled");
				$("#schooltype").removeAttr("disabled");
				$("#county").prop('disabled', true);
				$("#district").prop('disabled', true);
				$("#school").prop('disabled', true);				
			}
			else{
				$("#county").removeAttr("disabled");
				$("#district").removeAttr("disabled");
				$("#school").removeAttr("disabled");			
				$("#countyselect").find('option').remove().end().append("<option value=0 >-- Select County --</option>").prop('disabled', true);
				$("#countyselect2").find('option').remove().end().append("<option value=0 >-- Select County --</option>").prop('disabled', true);				
				$("#addschool").prop('disabled', true);
				$("#schooltype").prop('disabled', true);				
			}			
			$("#districtselect").find('option').remove().end().append("<option value=0 >-- Select District --</option>").prop('disabled', true);
			$("#districtselect2").find('option').remove().end().append("<option value=0 >-- Select District --</option>").prop('disabled', true);			
			$("#schoolselect").find('option').remove().end().append("<option value=0 >-- Select School --</option>").prop('disabled', true);
			}
		});
	});
});
jQuery(document).ready(function($){
	$('#school_state').change(function(){
		var $stateselect=$('#school_state').val();
		// call ajax

		$.ajax({
			url:"/wp-admin/admin-ajax.php",
			data:{
			'action':'school_actions',
			'stateid':$stateselect
			},
			success:function(results)
			{
			//  alert(results);
			if($stateselect == "CA"){

			}
			else{
			}
			}
		});
	});
});

/***** JC/Universities stuff *****/
jQuery(document).ready(function($){
	$('#college_state').change(function(){
		var $cstateselect=$('#college_state').val();
		$("#cityselect").empty();
		$("#cityselect2").empty();

		$.ajax({
			url:"/wp-admin/admin-ajax.php",
			data:{
			'action':'college_actions',
			'stateid':$cstateselect
			},
			success:function(results)
			{
			//  alert(results);
			if($cstateselect != "0"){			
				$("#cityselect").removeAttr("disabled");
				$("#cityselect").append(results);
				$("#cityselect2").removeAttr("disabled");
				$("#cityselect2").append(results);

				$("#addcollege").removeAttr("disabled");			
			}
			else{			
				$("#cityselect").find('option').remove().end().append("<option value=0 >-- Select City --</option>").prop('disabled', true);
				$("#cityselect2").find('option').remove().end().append("<option value=0 >-- Select City --</option>").prop('disabled', true);				
				$("#addschool").prop('disabled', true);			
			}					
			$("#collegeselect").find('option').remove().end().append("<option value=0 >-- Select College / University --</option>").prop('disabled', true);
			}
		});
	});
});

jQuery(document).ready(function($){
	$('#cityselect').change(function(){
		var $cityselect=$('#cityselect').val();
		$("#collegeselect").empty();

		$.ajax({
			url:"/wp-admin/admin-ajax.php",
			data:{
			'action':'college_actions',
			'cityid':$cityselect
			},
			success:function(results)
			{		
			$("#collegeselect").removeAttr("disabled");
			$("#collegeselect").append(results);
			}
		});
	});
});
/***** END JC/Universities stuff *****/

jQuery(document).ready(function($){
	$('#countyselect').change(function(){
		var $county_select=$('#countyselect').val();
		// call ajax
		$("#districtselect").empty();
		$.ajax({
			url:"/wp-admin/admin-ajax.php",
			data:{
			'action':'school_actions',
			'countyid':$county_select
			},
			success:function(results)
			{
			//  alert(results);
			$("#districtselect").removeAttr("disabled");
			$("#districtselect").append(results);
			$("#schoolselect").find('option').remove().end().append("<option value=0 >-- Select School --</option>").prop('disabled', true);
			}
		});
	});
});
jQuery(document).ready(function($){
	$('#countyselect2').change(function(){
		var $county_select=$('#countyselect2').val();	
		var $schooltype=$('#schooltype').val();
		// call ajax
		$.ajax({
			url:"/wp-admin/admin-ajax.php",
			data:{
			'action':'school_actions',
			'countyid':$county_select
			},
			success:function(results)
			{
			//  alert(results);
			if( $schooltype == "Public"){
				$("#districtselect2").empty();
				$("#districtselect2").removeAttr("disabled");
				$("#districtselect2").append(results);
			}
			}
		});
	});
});
jQuery(document).ready(function($){
	$('#districtselect').change(function(){
		var $district_select=$('#districtselect').val();
		// call ajax
		$("#schoolselect").empty();
		$.ajax({
			url:"/wp-admin/admin-ajax.php",
			data:{
			'action':'school_actions',
			'districtid':$district_select
			},
			success:function(results)
			{
			//  alert(results);
			$("#schoolselect").removeAttr("disabled");
			$("#schoolselect").append(results);
			}
		});
	});
});
