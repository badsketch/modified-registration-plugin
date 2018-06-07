jQuery(document).ready(function($){
	$educator = $('select[name^="wp_educator"] option:selected').val();

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
		
	$('select[name^="wp_educator"]').change(function() {
		$educator = $('select[name^="wp_educator"] option:selected').val();

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
	if($('#wp_subjects_na').is(":checked")) {
		$('#wp_subjects').val("");
		$('#wp_subjects').attr("disabled", true);
	}
	else
		$('#wp_subjects').removeAttr("disabled");

	$('#wp_subjects_na').change(function() {
		if($('#wp_subjects_na').is(":checked")) {
			$('#wp_subjects').val("");
			$('#wp_subjects').attr("disabled", true);
		}
		else
			$('#wp_subjects').removeAttr("disabled");
	});
});


jQuery(document).ready(function($){
	var $stateselect=$('#wp_school_state').val();
	var $userid=$('#user_id').val();
	// call ajax		
	$.ajax({
		url:"/wp-admin/admin-ajax.php",
		data:{
		'action':'bschool_actions',
		'stateid':$stateselect,
		'userid' :$userid
		},
		success:function(results)
		{
		//  alert(results);
		if($stateselect != "0"){
			$("#countyselect").empty();
			$("#countyselect2").empty();			
			$("#countyselect").removeAttr("disabled");
			$("#countyselect").append(results);
			$("#countyselect2").removeAttr("disabled");
			$("#countyselect2").append(results);				
			$("#addschool").removeAttr("disabled");
			$("#schooltype").removeAttr("disabled");
			$("#county").prop('disabled', true);
			$("#district").prop('disabled', true);
			$("#school").prop('disabled', true);
			var $county_select=$('#countyselect').val();
			// call ajax
			$.ajax({
				url:"/wp-admin/admin-ajax.php",
				data:{
				'action':'bschool_actions',
				'countyid':$county_select,
				'userid' :$userid
				},
				success:function(results)
				{
				//  alert(results);
				$("#districtselect").removeAttr("disabled");
				$("#districtselect").empty();
				$("#districtselect").append(results);
				$("#schoolselect").find('option').remove().end().append("<option value=0 >-- Select School --</option>").prop('disabled', true);
				var $district_select=$('#districtselect').val();
				// call ajax
				$.ajax({
					url:"/wp-admin/admin-ajax.php",
					data:{
					'action':'bschool_actions',
					'districtid':$district_select,
					'userid' :$userid
					},
					success:function(results)
					{
					//  alert(results);
					$("#schoolselect").empty();
					$("#schoolselect").removeAttr("disabled");
					$("#schoolselect").append(results);
					}
				});
				}
			});				
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


jQuery(document).ready(function($){
	$('#wp_school_state').change(function(){
		var $stateselect=$('#wp_school_state').val();
		// call ajax		
		$.ajax({
			url:"/wp-admin/admin-ajax.php",
			data:{
			'action':'bschool_actions',
			'stateid':$stateselect
			},
			success:function(results)
			{
			//  alert(results);
			if($stateselect != "0"){	
				$("#countyselect").empty();
				$("#countyselect2").empty();		
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
	$('#schooltype').change(function(){
		var $schooltype=$('#schooltype').val();
		var $stateselect=$('#wp_school_state').val();
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
			'action':'bschool_actions',
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
	$('#countyselect').change(function(){
		var $county_select=$('#countyselect').val();
		// call ajax
		$("#districtselect").empty();
		$.ajax({
			url:"/wp-admin/admin-ajax.php",
			data:{
			'action':'bschool_actions',
			'countyid':$county_select
			},
			success:function(results)
			{
			//  alert(results);
			if($county_select == '0'){
				$("#districtselect").append(results);
				$("#districtselect").prop('disabled', true);
			}
			else{
				$("#districtselect").removeAttr("disabled");
				$("#districtselect").append(results);
				$("#schoolselect").find('option').remove().end().append("<option value=0 >-- Select School --</option>").prop('disabled', true);
			}
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
			'action':'bschool_actions',
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
			'action':'bschool_actions',
			'districtid':$district_select
			},
			success:function(results)
			{
			//  alert(results);
			if($district_select == '0'){
				$("#schoolselect").append(results);
				$("#schoolselect").prop('disabled', true);				
			}
			else{
				$("#schoolselect").removeAttr("disabled");
				$("#schoolselect").append(results);
			}
			}
		});
	});
});

/******************** JC Universities code ********************/

jQuery(document).ready(function($){
	var $stateselect=$('#wp_college_state').val();
	var $userid=$('#user_id').val();
	// call ajax		
	$.ajax({
		url:"/wp-admin/admin-ajax.php",
		data:{
		'action':'bcollege_actions',
		'stateid':$stateselect,
		'userid' :$userid
		},
		success:function(results)
		{
			if ($stateselect != "0") {
				$("#cityselect").empty();
				$("#cityselect2").empty();			
				$("#cityselect").removeAttr("disabled");
				$("#cityselect").append(results);
				$("#cityselect2").removeAttr("disabled");
				$("#cityselect2").append(results);				
				$("#addcollege").removeAttr("disabled");
				var $city_select=$('#cityselect').val();

				// call ajax
				$.ajax({
					url:"/wp-admin/admin-ajax.php",
					data:{
						'action':'bcollege_actions',
						'cityid':$city_select,
						'userid' :$userid
					},
					success:function(results)
					{
						$("#collegeselect").empty();
						$("#collegeselect").removeAttr("disabled");
						$("#collegeselect").append(results);
					}
				});				
			}

			else {	
				$("#cityselect").find('option').remove().end().append("<option value=0 >-- Select City --</option>").prop('disabled', true);
				$("#cityselect2").find('option').remove().end().append("<option value=0 >-- Select City --</option>").prop('disabled', true);
				$("#collegeselect").find('option').remove().end().append("<option value=0 >-- Select School --</option>").prop('disabled', true);				
				$("#addcollege").prop('disabled', true);			
			}					
		}
	});
});


jQuery(document).ready(function($){
	$('#wp_college_state').change(function(){
		var $stateselect=$('#wp_college_state').val();
		// call ajax		
		$.ajax({
			url:"/wp-admin/admin-ajax.php",
			data:{
			'action':'bcollege_actions',
			'stateid':$stateselect
			},
			success:function(results)
			{
			//  alert(results);
			if($stateselect != "0"){	
				$("#cityselect").empty();
				$("#cityselect2").empty();		
				$("#cityselect").removeAttr("disabled");
				$("#cityselect").append(results);
				$("#cityselect2").removeAttr("disabled");
				$("#cityselect2").append(results);				
				$("#addcollege").removeAttr("disabled");
/*				$("#city").prop('disabled', true);
				$("#district").prop('disabled', true);
				$("#college").prop('disabled', true);			*/	
			}
			else{
/*				$("#county").removeAttr("disabled");
				$("#district").removeAttr("disabled");
				$("#school").removeAttr("disabled");	*/		
				$("#cityselect").find('option').remove().end().append("<option value=0 >-- Select City --</option>").prop('disabled', true);
				$("#cityselect2").find('option').remove().end().append("<option value=0 >-- Select City --</option>").prop('disabled', true);				
				$("#addcollege").prop('disabled', true);				
			}		
			$("#collegeselect").find('option').remove().end().append("<option value=0 >-- Select School --</option>").prop('disabled', true);
			}
		});
	});
});


jQuery(document).ready(function($){
	$('#cityselect').change(function(){
		var $city_select=$('#cityselect').val();
		// call ajax
		$("#collegeselect").empty();
		$.ajax({
			url:"/wp-admin/admin-ajax.php",
			data:{
			'action':'bcollege_actions',
			'cityid':$city_select
			},
			success:function(results)
			{
			//  alert(results);
			if($city_select == '0'){
				$("#collegeselect").append(results);
				$("#collegeselect").prop('disabled', true);
			}
			else{
				$("#collegeselect").removeAttr("disabled");
				$("#collegeselect").append(results);
			}
			}
		});
	});
});