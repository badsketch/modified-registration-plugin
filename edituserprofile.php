<?php 
add_action( 'show_user_profile', 'custom_profile_fields' );
add_action( 'edit_user_profile', 'custom_profile_fields' );
add_action( 'user_new_form', 'custom_profile_fields' );
add_filter('user_profile_update_errors', 'check_fields', 9, 3);
//add_action( 'personal_options_update', 'save_custom_profile_fields' );
//add_action( 'edit_user_profile_update', 'save_custom_profile_fields' );
add_action( 'admin_head', 'my_action_javascripts' );
add_action('admin_enqueue_scripts', 'my_scripts_methods');

function my_scripts_methods() {
//if ( !is_admin() ) {
wp_enqueue_script('custom-scripts',get_template_directory_uri() . '/js/tabs.js',array('jquery'));
wp_enqueue_script('jquery-ui-tabs');
//}
}
function my_action_javascripts() {
//if ( !is_admin() ) {
wp_enqueue_script( 'profilejs', plugins_url('/jq.profile.js', __FILE__));
//}
}
function check_fields($errors, $update, $user) {
	global $wpdb;
	update_user_meta( $user->ID, 'wp_title', $_POST['wp_title'] );
	update_user_meta( $user->ID, 'wp_state', $_POST['wp_state'] );
	update_user_meta( $user->ID, 'wp_school_state', $_POST['wp_school_state'] );	
	$customuser = new WP_User($user->ID);
	if(isset($_POST["wp_phone_number"])){
        if(!preg_match("/^\+?(\(?[0-9]{3}\)?|[0-9]{3})[-\.\s]?[0-9]{3}[-\.\s]?[0-9]{4}$/", $_POST["wp_phone_number"], $matches)){
            $errors->add("phone_empty",__('Phone must be 10 digits.'));
        }
		else{
			update_user_meta( $user->ID, 'wp_phone_number', $_POST['wp_phone_number'] );
		}
    }
	else{
        $errors->add("phone_not_passed",__('Phone not passed'));
    }
	if(isset($_POST["wp_address"])){
        $address = trim($_POST["wp_address"]);
        if(empty($address)){
            $errors->add("address_empty",__('Address must not be empty.'));
        }
		else{
			update_user_meta( $user->ID, 'wp_address', $_POST['wp_address'] );
		}
    }
	else{
        $errors->add("address_not_passed",__('Address not passed'));
    }
	if(isset($_POST["wp_city"])){
        $address = trim($_POST["wp_city"]);
        if(empty($address)){
            $errors->add("city_empty",__('City must not be empty.'));
        }
		else{
			update_user_meta( $user->ID, 'wp_city', $_POST['wp_city'] );
		}
    }
	else{
        $errors->add("city_not_passed",__('City not passed'));
    }
	if(isset($_POST["wp_zipcode"])){
        if(!preg_match("/^([0-9]{5})(-[0-9]{4})?$/i", $_POST["wp_zipcode"], $matches)){            
			$errors->add("zipcode_empty",__('Zip code must be in 12345 or 12345-6789 format.'));
        }
		else{
			update_user_meta( $user->ID, 'wp_zipcode', $_POST['wp_zipcode'] );
		}
    }
	else{
        $errors->add("zipcode_not_passed",__('Zip code not passed'));
    }

	$userrole = "0";
	if ( !empty( $customuser->roles ) && is_array( $customuser->roles ) ) {
		foreach ( $customuser->roles as $role ){
			if($role == 'teachers' || $role == 'fellows' || $role =='cstemteachers'|| $role =='roboticsteachers'){
				$userrole = "1";
			}
			if($role == 'itstaff'){
				$userrole = "2";
			}			
			if($role == 'jcuniversities') {
				$userrole = "3";
			}
		}
	}

	if ($userrole != "1") {
		if(isset($_POST["wp_subjects"])){
	        $subjects = trim($_POST["wp_subjects"]);
	        if(empty($subjects)){
	        	$errors->add("subjects_empty",__('subjects must not be empty.'));
	        }
			else{
				update_user_meta( $user->ID, 'wp_subjects', $_POST['wp_subjects'] );
			}
	    }
		else{
	    	$errors->add("subjects_not_passed",__('Subjects not passed'));
	    }
	}

	if ($userrole == "0") {
		if(isset($_POST["wp_orgschoolname"])){
	        $org_name = trim($_POST["wp_orgschoolname"]);
	        if(empty($org_name)){
	            $errors->add("org_empty",__('Organization/School Name must not be empty.'));
	        }
			else{
				update_user_meta( $user->ID, 'wp_orgschoolname', $_POST['wp_orgschoolname'] );
			}
	    }
		else{
	        $errors->add("org_not_passed",__('Organization/School Name not passed'));
	    }
	}

	//if teacher do the following
	if($userrole == "1"){
		if(isset($_POST["wp_grades"])){
			$gradelevel = implode(",", $_POST["wp_grades"]);
			update_user_meta( $user->ID, 'wp_gradesteach', $gradelevel);
	    }
		else{
	    	$errors->add("grade_level_type_not_passed",__('Grade Level not passed'));
	    }


		if(isset($_POST["wp_educator"])){
			update_user_meta( $user->ID, 'wp_educator', $_POST['wp_educator'] );
	    }
		else{
	    	$errors->add("educator_type_not_passed",__('Type of Educator not passed'));
	    }


	    if(isset($_POST["wp_subjects_na"])) {
			update_user_meta( $user->ID, 'wp_subjects', "" );
			update_user_meta( $user->ID, 'wp_subjects_na', $_POST['wp_subjects_na']);
	    } // if N/A boxed checked

	    elseif (isset($_POST["wp_subjects"]) && !empty($_POST["wp_subjects"])) {
	    	$subjects = trim($_POST["wp_subjects"]);
			update_user_meta( $user->ID, 'wp_subjects', $subjects );
			update_user_meta( $user->ID, 'wp_subjects_na', $_POST['wp_subjects_na']);
	    } // elseif N/A not checked and subjects filled

	    else {
			$errors->add("subjects_empty",__('subjects must not be empty.'));
	    } // else subjects needs to be filled


		if(isset($_POST["wp_school_phone_number"])){
			if(!preg_match("/^\+?(\(?[0-9]{3}\)?|[0-9]{3})[-\.\s]?[0-9]{3}[-\.\s]?[0-9]{4}$/", $_POST["wp_school_phone_number"], $matches)){
				$errors->add("school_phone_empty",__('School phone must be 10 digits.'));
			}
			else{
				update_user_meta( $user->ID, 'wp_school_phone_number', $_POST['wp_school_phone_number'] );
			}
		}
		else{
			$errors->add("school_phone_not_passed",__('School phone not passed'));
		}
		if(isset($_POST["wp_school_address"])){
			$address = trim($_POST["wp_school_address"]);
			if(empty($address)){
				$errors->add("school_address_empty",__('School address must not be empty.'));
			}
			else{
				update_user_meta( $user->ID, 'wp_school_address', $_POST['wp_school_address'] );
			}
		}
		else{
			$errors->add("school_address_not_passed",__('School address not passed'));
		}
		if(isset($_POST["wp_school_city"])){
			$address = trim($_POST["wp_school_city"]);
			if(empty($address)){
				$errors->add("school_city_empty",__('School city must not be empty.'));
			}
			else{
				update_user_meta( $user->ID, 'wp_school_city', $_POST['wp_school_city'] );
			}
		}
		else{
			$errors->add("school_city_not_passed",__('School city not passed'));
		}
		if(isset($_POST["wp_school_zipcode"])){
			if(!preg_match("/^([0-9]{5})(-[0-9]{4})?$/i", $_POST["wp_school_zipcode"], $matches)){            
				$errors->add("school_zipcode_empty",__('School zip code must be in 12345 or 12345-6789 format.'));
			}
			else{
				update_user_meta( $user->ID, 'wp_school_zipcode', $_POST['wp_school_zipcode'] );
			}
		}
		else{
			$errors->add("school_zipcode_not_passed",__('School zip code not passed'));
		}
		$user_id1 = get_current_user_id(); 
		$user_id = $_GET['user_id']; 
		if(!$user_id){$user_id = $user_id1; } 
		$key = 'wp_state'; 
		$single = true; 
		$state=get_user_meta( $user->ID, $key, $single );
		$addschool=$_POST["addschool"];
		if($addschool != ''){//Teacher is adding a school
			$county=$_POST["countyselect2"];
			if($county == '0'){
				$errors->add("countynameadd_empty",__('If adding a school, county must not be empty.'));				
			}
			$schooltype=$_POST["schooltype"];
			$district=$_POST["districtselect2"];
			//no matter public, private, or charter, must be part of a county so...
			$cresults=$wpdb->get_var($wpdb->prepare("SELECT name FROM `wp_sdd_county` WHERE county_id = %d;", $county));
			if($schooltype =='Public'){//must have a district if public
				if($district == '0'){
					$errors->add("districtnamecustom_empty",__('If adding a public school, district must not be empty.'));				
				}
				else{
				$dresults=$wpdb->get_var($wpdb->prepare("SELECT name FROM `wp_sdd_district` WHERE district_id = %d;", $district));
				//add school to district
				//wp_sdd_school has a school_id, district_id, name
				$sql = $wpdb->prepare( "INSERT INTO `wp_sdd_school` (`school_id`,`district_id`, `name`, `custom`) VALUES (NULL,%d,%s,TRUE);", $district, $addschool);
				$wpdb->query($sql);					
				//retrieve school id
				$school = $wpdb->get_var($wpdb->prepare("SELECT school_id FROM `wp_sdd_school` WHERE district_id = %d AND name = %s;", $district, $addschool));
				$sresults=$wpdb->get_var($wpdb->prepare("SELECT name FROM `wp_sdd_school` WHERE school_id = %d;", $school));
				}										
			}
			else{
				//check to see if the selected county has a "Private School" or "Charter School" district
				//wp_sdd_district has district_id, county_id, did, name; did is CA's numbering of districts
				if($schooltype =='Private'){//If school is private then...
				//check if there is a private school entry in the district table for the county
					$dname = "Private School";
					$district = $wpdb->get_var($wpdb->prepare("SELECT district_id FROM `wp_sdd_district` WHERE county_id = %d AND name = %s;", $county, $dname));
					if(!$district){
						//Private School district does not exist in the county so add district before adding school
						$sql = $wpdb->prepare( "INSERT INTO `wp_sdd_district` (`district_id`, `county_id`,`did`,`name`) VALUES (NULL,%d,'',%s);", $county, $dname);
						$wpdb->query($sql);					
						//get the district id
						$district = $wpdb->get_var($wpdb->prepare("SELECT district_id FROM `wp_sdd_district` WHERE county_id = %d AND name = %s;", $county, $dname));
					}
				}
				else if($schooltype =='Charter'){//If school is charter then...
					//check if there is a charter school entry in the district table for the county
					$dname = "Charter School";
					$district = $wpdb->get_var($wpdb->prepare("SELECT district_id FROM `wp_sdd_district` WHERE county_id = %d AND name = %s;", $county, $dname));
					if($district != 'Charter School'){
						//Charter School district does not exist in the county so add district before adding school
						$sql = $wpdb->prepare( "INSERT INTO `wp_sdd_district` (`district_id`, `county_id`,`did`,`name`) VALUES (NULL,%d,'',%s);", $county, $dname);
						$wpdb->query($sql);												
						//get the district id
						$district = $wpdb->get_var($wpdb->prepare("SELECT district_id FROM `wp_sdd_district` WHERE county_id = %d AND name = %s;", $county, $dname));													
					}
				}
				else{
					$dname = "Community College";
					$district = $wpdb->get_var($wpdb->prepare("SELECT district_id FROM `wp_sdd_district` WHERE county_id = %d AND name = %s;", $county, $dname));
					if($district != 'Community College'){
						//Community College district does not exist in the county so add district before adding school
						$sql = $wpdb->prepare( "INSERT INTO `wp_sdd_district` (`district_id`, `county_id`,`did`,`name`) VALUES (NULL,%d,'',%s);", $county, $dname);
						$wpdb->query($sql);												
						//get the district id
						$district = $wpdb->get_var($wpdb->prepare("SELECT district_id FROM `wp_sdd_district` WHERE county_id = %d AND name = %s;", $county, $dname));					
					}
				}
				//add school into database
				$dresults=$wpdb->get_var($wpdb->prepare("SELECT name FROM `wp_sdd_district` WHERE district_id = %d;", $district));
				$sql = $wpdb->prepare( "INSERT INTO `wp_sdd_school` (`school_id`,`district_id`, `name`, `custom`) VALUES (NULL,%d,%s,TRUE);", $district, $addschool);
				$wpdb->query($sql);	
				$school = $wpdb->get_var($wpdb->prepare("SELECT school_id FROM `wp_sdd_school` WHERE district_id = %d AND name = %s;", $district, $addschool));
				$sresults=$wpdb->get_var($wpdb->prepare("SELECT name FROM `wp_sdd_school` WHERE school_id = %d;", $school));
			}
				update_user_meta( $user->ID, 'wp_county_id', $county );
				update_user_meta( $user->ID, 'wp_district_id', $district );
				update_user_meta( $user->ID, 'wp_school_id', $school);
				update_user_meta( $user->ID, 'wp_county', $cresults );
				update_user_meta( $user->ID, 'wp_district', $dresults );
				update_user_meta( $user->ID, 'wp_school', $sresults );					
		}		
		else{
			if(empty($_POST["countyselect"])){
				$errors->add("countyname_empty",__('After school state change, county must not be empty.'));					
			}
			elseif(empty($_POST["districtselect"]) && $_POST["wp_educator"] != "County Administrator") {
					$errors->add("districtname_empty",__('After school state change, district must not be empty.'));				
			}
			elseif(empty($_POST["schoolselect"]) && $_POST["wp_educator"] != "County Administrator" && $_POST["wp_educator"] != "District Administrator") {
					$errors->add("schoolname_empty",__('After school state change, school must not be empty.'));				
			}
			else { //no errors so update	
				$county=$_POST['countyselect'];	
				$district=$_POST['districtselect'];
				$school=$_POST['schoolselect'];
				//got the county, district, school ids, so query for the name
			
				$cresults=$wpdb->get_var($wpdb->prepare("SELECT name FROM `wp_sdd_county` WHERE county_id = %d;", $county));
				$sresults=$wpdb->get_var($wpdb->prepare("SELECT name FROM `wp_sdd_school` WHERE school_id = %d;", $school));
				$dresults=$wpdb->get_var($wpdb->prepare("SELECT name FROM `wp_sdd_district` WHERE district_id = %d;", $district));
				
				update_user_meta( $user->ID, 'wp_county_id', $_POST['countyselect'] );
				update_user_meta( $user->ID, 'wp_county', $cresults );

				if ($_POST["wp_educator"] == "County Administrator") {
					update_user_meta( $user->ID, 'wp_district_id', "" );
					update_user_meta( $user->ID, 'wp_district', "" );
					update_user_meta( $user->ID, 'wp_school_id', "" );
					update_user_meta( $user->ID, 'wp_school', "" );
				}

				elseif ($_POST["wp_educator"] == "District Administrator") {
					update_user_meta( $user->ID, 'wp_district_id', $_POST['districtselect'] );
					update_user_meta( $user->ID, 'wp_district', $dresults );
					update_user_meta( $user->ID, 'wp_school_id', "" );
					update_user_meta( $user->ID, 'wp_school', "" );
				}

				else {
					update_user_meta( $user->ID, 'wp_district_id', $_POST['districtselect'] );
					update_user_meta( $user->ID, 'wp_district', $dresults );
					update_user_meta( $user->ID, 'wp_school_id', $_POST['schoolselect'] );
					update_user_meta( $user->ID, 'wp_school', $sresults );
				}

			}
		}	
	}

	/* JC / University Teacher */
	if($userrole == "3") {
		update_user_meta( $user->ID, 'wp_school_state', $_POST['wp_college_state'] );

		if(isset($_POST["wp_school_phone_number"])){
			if(!preg_match("/^\+?(\(?[0-9]{3}\)?|[0-9]{3})[-\.\s]?[0-9]{3}[-\.\s]?[0-9]{4}$/", $_POST["wp_school_phone_number"], $matches)){
				$errors->add("school_phone_empty",__('School phone must be 10 digits.'));
			}
			else{
				update_user_meta( $user->ID, 'wp_school_phone_number', $_POST['wp_school_phone_number'] );
			}
		}
		else{
			$errors->add("school_phone_not_passed",__('School phone not passed'));
		}
		if(isset($_POST["wp_school_address"])){
			$address = trim($_POST["wp_school_address"]);
			if(empty($address)){
				$errors->add("school_address_empty",__('School address must not be empty.'));
			}
			else{
				update_user_meta( $user->ID, 'wp_school_address', $_POST['wp_school_address'] );
			}
		}
		else{
			$errors->add("school_address_not_passed",__('School address not passed'));
		}
		if(isset($_POST["wp_school_zipcode"])){
			if(!preg_match("/^([0-9]{5})(-[0-9]{4})?$/i", $_POST["wp_school_zipcode"], $matches)){            
				$errors->add("school_zipcode_empty",__('School zip code must be in 12345 or 12345-6789 format.'));
			}
			else{
				update_user_meta( $user->ID, 'wp_school_zipcode', $_POST['wp_school_zipcode'] );
			}
		}
		else{
			$errors->add("school_zipcode_not_passed",__('School zip code not passed'));
		}

		$user_id1 = get_current_user_id(); 
		$user_id = $_GET['user_id']; 
		if(!$user_id){$user_id = $user_id1; } 

		$addcollege=$_POST["addcollege"];

		if($addcollege != '') {
			$city=$_POST["cityselect2"];
			if($city == '0'){
				$errors->add("citynameadd_empty",__('If adding a school, city must not be empty.'));				
			}
			$cityresults=$wpdb->get_var($wpdb->prepare("SELECT city FROM `wp_cities` WHERE cityID = %d;", $city));

            // add college to DB
            // wp_colleges has fields: institutionID_DB, institutionID_gov, institution_name, institution_cityID, custom
            $sql = $wpdb->prepare( "INSERT INTO `wp_colleges` (`institutionID_DB`,`institutionID_gov`, `institution_name`, `institution_cityID`, `custom`) VALUES (NULL, 0, %s, %d, TRUE);", $addcollege, $city);
            $wpdb->query($sql);

            // Now that DB updated institutionID_DB, get the ID, name
            $collegeID = $wpdb->get_var($wpdb->prepare("SELECT institutionID_DB FROM `wp_colleges` WHERE institution_name = %s and institution_cityID = %d;", $addcollege, $city));
            $collegeresults=$wpdb->get_var($wpdb->prepare("SELECT institution_name FROM `wp_colleges` WHERE institutionID_DB = %d;", $collegeID));		

			update_user_meta( $user->ID, 'wp_city_id', $city );
			update_user_meta( $user->ID, 'wp_school_id', $collegeID );
            update_user_meta( $user->ID, 'wp_school_city', $cityresults );
			update_user_meta( $user->ID, 'wp_school', $collegeresults );	
		}

		else{
			if(empty($_POST["cityselect"])){
				$errors->add("cityname_empty",__('After school state change, city must not be empty.'));					
			}
			elseif(empty($_POST["collegeselect"])){
				$errors->add("collegename_empty",__('After school state change, college must not be empty.'));				
			}
			else{//no errors so update	
				update_user_meta( $user->ID, 'wp_city_id', $_POST['cityselect'] );
				update_user_meta( $user->ID, 'wp_school_id', $_POST['collegeselect'] );

				$city=$_POST['cityselect'];	
				$college=$_POST['collegeselect'];
				//got the county, district, school ids, so query for the name
			
				$cityresults=$wpdb->get_var($wpdb->prepare("SELECT city FROM `wp_cities` WHERE cityID = %d;", $city));
				$collegeresults=$wpdb->get_var($wpdb->prepare("SELECT institution_name FROM `wp_colleges` WHERE institutionID_DB = %d;", $college));
				
				update_user_meta( $user->ID, 'wp_school_city', $cityresults );
				update_user_meta( $user->ID, 'wp_school', $collegeresults );
			}
		}	
	}
}
 

function custom_profile_fields( $user )
 { 
//$user = new WP_User( $user_id );
$userrole = "0";
if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
    foreach ( $user->roles as $role ){
    	if($role == 'teachers' || $role == 'fellows' || $role =='cstemteachers'|| $role =='roboticsteachers' ||$role == 'intl'){
			$userrole = "1";
		}
		if($role == 'itstaff'){
			$userrole = "2";
		}
		if($role == 'jcuniversities'){
			$userrole = "3";
		}
	}
}
 ?>
 <h3>Personal Information</h3>
 <table class="form-table">
 <tr>
 <th><label for="wp_phone_number">Home/Cell Phone Number</label></th>
 <td>
 <input type="text" id="wp_phone_number" name="wp_phone_number" size="20" value="<?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_phone_number'; $single = true; echo get_user_meta( $user_id, $key, $single ); ?>">
 <span class="description">Enter your phone number.</span>
 </td>
 </tr>
 
 <tr>
 <th><label for="wp_address">Home Address</label></th>
 <td>
 <input type="text" id="wp_address" name="wp_address" size="20" value="<?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_address'; $single = true; echo get_user_meta( $user_id, $key, $single ); ?>">
 <span class="description">Enter your address</span>
 </td>
 </tr>
 
 <tr>
 <th><label for="wp_city">City</label></th>
 <td>
 <input type="text" id="wp_city" name="wp_city" size="20" value="<?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_city'; $single = true; echo get_user_meta( $user_id, $key, $single ); ?>">
 <span class="description">Enter your city.</span>
 </td>
 </tr>
 
 <tr>
 <th><label for="wp_state">State</label></th>
 <td>
 <select id="wp_state" name="wp_state" class="state" method="post">
    <option value="AL" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='AL'){ echo "selected";}?>>Alabama</option>
    <option value="AK" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='AK'){ echo "selected";}?>>Alaska</option>
    <option value="AZ" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='AZ'){ echo "selected";}?>>Arizona</option>
    <option value="AR" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='AR'){ echo "selected";}?>>Arkansas</option>
    <option value="CA" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='CA'){ echo "selected";}?>>California</option>
    <option value="CO" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='CO'){ echo "selected";}?>>Colorado</option>
    <option value="CT" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='CT'){ echo "selected";}?>>Connecticut</option>
    <option value="DE" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='DE'){ echo "selected";}?>>Delaware</option>
    <option value="DC" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='DC'){ echo "selected";}?>>District of Columbia</option>
    <option value="FL" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='FL'){ echo "selected";}?>>Florida</option>
    <option value="GA" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='GA'){ echo "selected";}?>>Georgia</option>
    <option value="HI" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='HI'){ echo "selected";}?>>Hawaii</option>
    <option value="ID" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='ID'){ echo "selected";}?>>Idaho</option>
    <option value="IL" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='IL'){ echo "selected";}?>>Illinois</option>
    <option value="IN" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='IN'){ echo "selected";}?>>Indiana</option>
    <option value="IA" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='IA'){ echo "selected";}?>>Iowa</option>
    <option value="KS" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='KS'){ echo "selected";}?>>Kansas</option>
    <option value="KY" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='KY'){ echo "selected";}?>>Kentucky</option>
    <option value="LA" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='LA'){ echo "selected";}?>>Louisiana</option>
    <option value="ME" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='ME'){ echo "selected";}?>>Maine</option>
    <option value="MD" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='MD'){ echo "selected";}?>>Maryland</option>
    <option value="MA" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='MA'){ echo "selected";}?>>Massachusetts</option>
    <option value="MI" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='MI'){ echo "selected";}?>>Michigan</option>
    <option value="MN" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='MN'){ echo "selected";}?>>Minnesota</option>
    <option value="MS" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='MS'){ echo "selected";}?>>Mississippi</option>
    <option value="MO" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='MO'){ echo "selected";}?>>Missouri</option>
    <option value="MT" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='MT'){ echo "selected";}?>>Montana</option>
    <option value="NE" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='NE'){ echo "selected";}?>>Nebraska</option>
    <option value="NV" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='NV'){ echo "selected";}?>>Nevada</option>
    <option value="NH" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='NH'){ echo "selected";}?>>New Hampshire</option>
    <option value="NJ" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='NJ'){ echo "selected";}?>>New Jersey</option>
    <option value="NM" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='NM'){ echo "selected";}?>>New Mexico</option>
    <option value="NY" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='NY'){ echo "selected";}?>>New York</option>
    <option value="NC" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='NC'){ echo "selected";}?>>North Carolina</option>
    <option value="ND" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='ND'){ echo "selected";}?>>North Dakota</option>
    <option value="OH" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='OH'){ echo "selected";}?>>Ohio</option>
    <option value="OK" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='OK'){ echo "selected";}?>>Oklahoma</option>
    <option value="OR" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='OR'){ echo "selected";}?>>Oregon</option>
    <option value="PA" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='PA'){ echo "selected";}?>>Pennsylvania</option>
    <option value="RI" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='RI'){ echo "selected";}?>>Rhode Island</option>
    <option value="SC" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='SC'){ echo "selected";}?>>South Carolina</option>
    <option value="SD" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='SD'){ echo "selected";}?>>South Dakota</option>
    <option value="TN" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='TN'){ echo "selected";}?>>Tennessee</option>
    <option value="TX" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='TX'){ echo "selected";}?>>Texas</option>
    <option value="UT" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='UT'){ echo "selected";}?>>Utah</option>
    <option value="VT" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='VT'){ echo "selected";}?>>Vermont</option>
    <option value="VA" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='VA'){ echo "selected";}?>>Virginia</option>
    <option value="WA" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='WA'){ echo "selected";}?>>Washington</option>
    <option value="WV" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='WV'){ echo "selected";}?>>West Virginia</option>
    <option value="WI" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='WI'){ echo "selected";}?>>Wisconsin</option>
    <option value="WY" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='WY'){ echo "selected";}?>>Wyoming</option>
    <option value="AE" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='AE'){ echo "selected";}?>>Armed Forces AF, CA, EU, ME<</option>
    <option value="AP" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='AP'){ echo "selected";}?>>Armed Forces Pacific</option>
    <option value="AS" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='AS'){ echo "selected";}?>>American Samoa</option>
    <option value="GU" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='GU'){ echo "selected";}?>>Guam</option>
    <option value="MP" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='MP'){ echo "selected";}?>>Northern Mariana Islands</option>
    <option value="PR" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='PR'){ echo "selected";}?>>Puerto Rico</option>
    <option value="VI" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='VI'){ echo "selected";}?>>Virgin Islands</option>	
</select>
 <span class="description">Enter your state.</span>
 </td>
 </tr>
 
  
 <tr>
 <th><label for="wp_zipcode">Zip Code</label></th>
 <td>
 <input type="text" id="wp_zipcode" name="wp_zipcode" size="20" value="<?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_zipcode'; $single = true; echo get_user_meta( $user_id, $key, $single ); ?>">
 <span class="description">Enter your zip code.</span>
 </td>
 </tr>
 
 <tr>
 <th><label for="wp_title">Title(optional but preferred)</label></th>
 <td>
 <input type="text" id="wp_title" name="wp_title" size="20" value="<?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_title'; $single = true; echo get_user_meta( $user_id, $key, $single ); ?>">
 <span class="description">Enter your title.</span>
 </td>
 </tr>
 
 <?php if($userrole == "1"): // teacher ?>
<tr>
<th><label for="wp_educator">Type of Educator:</label></th>
<td>
<select id="wp_educator" name="wp_educator" class="educator" method="post">
	<option value="Classroom Teacher" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_educator'; $single = true; $educator=get_user_meta( $user_id, $key, $single );if($educator=='Classroom Teacher'){ echo "selected";}?>>Classroom Teacher</option>
    <option value="School Administrator" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_educator'; $single = true; $educator=get_user_meta( $user_id, $key, $single );if($educator=='School Administrator'){ echo "selected";}?>>School Administrator/Staff</option>
    <option value="District Administrator" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_educator'; $single = true; $educator=get_user_meta( $user_id, $key, $single );if($educator=='District Administrator'){ echo "selected";}?>>District Administrator/Staff</option>
    <option value="County Administrator" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_educator'; $single = true; $educator=get_user_meta( $user_id, $key, $single );if($educator=='County Administrator'){ echo "selected";}?>>County Administrator/Staff</option>
    <option value="Paraeducator" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_educator'; $single = true; $educator=get_user_meta( $user_id, $key, $single );if($educator=='Paraeducator'){ echo "selected";}?>>Paraeducator</option>
    <option value="Academic Counselor" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_educator'; $single = true; $educator=get_user_meta( $user_id, $key, $single );if($educator=='Academic Counselor'){ echo "selected";}?>>Academic Counselor</option>
</select>    
</td>
</tr>
<?php endif; ?>

<?php if($userrole == "1"): // teacher ?>
	<tr>
	<th><label for="wp_grades">Grade Level:</label></th>
	<td>
		<?php 
		$user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_gradesteach'; $single = true; 
		$grades=get_user_meta( $user_id, $key, $single );
		$grades_array = explode(",", $grades);
		?>

		<input type="checkbox" id ="ElementarySchool" name = "wp_grades[]" value="ElementarySchool" <?php if(in_array('ElementarySchool',$grades_array)) echo 'checked'; ?>/>Elementary School<br>
		<input type="checkbox" id ="MiddleSchool" name = "wp_grades[]" value="MiddleSchool" <?php if(in_array('MiddleSchool',$grades_array)) echo 'checked'; ?>/>Middle School<br>
		<input type="checkbox" id ="HighSchool" name = "wp_grades[]" value="HighSchool" <?php if(in_array('HighSchool',$grades_array)) echo 'checked'; ?>/>High School<br>
	</td>
	</tr>
<?php endif; ?>

 <tr>
 <th><label for="wp_subjects">Subjects teaching or learning </label></th>
 <td>
 <input type="text" id="wp_subjects" name="wp_subjects" size="20" value="<?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_subjects'; $single = true; echo get_user_meta( $user_id, $key, $single ); ?>">
 <span class="description">Enter the subjects you are teaching or learning.</span>
 </td>
</tr>
<?php if($userrole != "0"): // subscripber ?>
<tr>
 <td>
 <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_subjects_na'; $single = true; ?>
<input type="checkbox" id ="wp_subjects_na" name = "wp_subjects_na" value="wp_subjects_na" <?php if(get_user_meta( $user_id, $key, $single ) != "") echo 'checked'; ?>/>Subjects teaching N/A<br>
 </td>
 </tr>
<?php endif; ?>

<?php if($userrole == "0"): // subscripber ?>
<tr>
	<th><label for="wp_orgschoolname">Organization/School Name</label></th>
	<td>
		<input type="text" id="wp_orgschoolname" name="wp_orgschoolname" size="20" value="<?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_orgschoolname'; $single = true; echo get_user_meta( $user_id, $key, $single ); ?>">
		<span class="description">Enter your Organization/School Name</span>
	</td>
</tr>
<?php endif; ?>

 </table>

<?php if($userrole == "1" || $userrole == "2"): ?>
 <h3>School Information</h3>
 <table class="form-table">
<tr>
 <th><label for="wp_school_phone_number">School Phone Number</label></th>
 <td>
 <input type="text" id="wp_school_phone_number" name="wp_school_phone_number" size="20" value="<?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_phone_number'; $single = true; echo get_user_meta( $user_id, $key, $single ); ?>">
 <span class="description">Enter your school phone number.</span>
 </td>
 </tr>
 
 <tr>
 <th><label for="wp_school_address">School Address</label></th>
 <td>
 <input type="text" id="wp_school_address" name="wp_school_address" size="20" value="<?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_address'; $single = true; echo get_user_meta( $user_id, $key, $single ); ?>">
 <span class="description">Enter your school address</span>
 </td>
 </tr>
 
 <tr>
 <th><label for="wp_school_city">City</label></th>
 <td>
 <input type="text" id="wp_school_city" name="wp_school_city" size="20" value="<?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_city'; $single = true; echo get_user_meta( $user_id, $key, $single ); ?>">
 <span class="description">Enter your school city.</span>
 </td>
 </tr>
 
 <tr>
 <th><label for="wp_school_state">School State</label></th>
 <td>
 <select id="wp_school_state" name="wp_school_state" class="state" method="post">
    <option value="AL" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='AL'){ echo "selected";}?>>Alabama</option>
    <option value="AK" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='AK'){ echo "selected";}?>>Alaska</option>
    <option value="AZ" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='AZ'){ echo "selected";}?>>Arizona</option>
    <option value="AR" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='AR'){ echo "selected";}?>>Arkansas</option>
    <option value="CA" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='CA'){ echo "selected";}?>>California</option>
    <option value="CO" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='CO'){ echo "selected";}?>>Colorado</option>
    <option value="CT" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='CT'){ echo "selected";}?>>Connecticut</option>
    <option value="DE" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='DE'){ echo "selected";}?>>Delaware</option>
    <option value="DC" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='DC'){ echo "selected";}?>>District of Columbia</option>
    <option value="FL" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='FL'){ echo "selected";}?>>Florida</option>
    <option value="GA" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='GA'){ echo "selected";}?>>Georgia</option>
    <option value="HI" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='HI'){ echo "selected";}?>>Hawaii</option>
    <option value="ID" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='ID'){ echo "selected";}?>>Idaho</option>
    <option value="IL" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='IL'){ echo "selected";}?>>Illinois</option>
    <option value="IN" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='IN'){ echo "selected";}?>>Indiana</option>
    <option value="IA" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='IA'){ echo "selected";}?>>Iowa</option>
    <option value="KS" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='KS'){ echo "selected";}?>>Kansas</option>
    <option value="KY" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='KY'){ echo "selected";}?>>Kentucky</option>
    <option value="LA" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='LA'){ echo "selected";}?>>Louisiana</option>
    <option value="ME" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='ME'){ echo "selected";}?>>Maine</option>
    <option value="MD" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='MD'){ echo "selected";}?>>Maryland</option>
    <option value="MA" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='MA'){ echo "selected";}?>>Massachusetts</option>
    <option value="MI" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='MI'){ echo "selected";}?>>Michigan</option>
    <option value="MN" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='MN'){ echo "selected";}?>>Minnesota</option>
    <option value="MS" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='MS'){ echo "selected";}?>>Mississippi</option>
    <option value="MO" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='MO'){ echo "selected";}?>>Missouri</option>
    <option value="MT" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='MT'){ echo "selected";}?>>Montana</option>
    <option value="NE" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='NE'){ echo "selected";}?>>Nebraska</option>
    <option value="NV" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='NV'){ echo "selected";}?>>Nevada</option>
    <option value="NH" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='NH'){ echo "selected";}?>>New Hampshire</option>
    <option value="NJ" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='NJ'){ echo "selected";}?>>New Jersey</option>
    <option value="NM" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='NM'){ echo "selected";}?>>New Mexico</option>
    <option value="NY" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='NY'){ echo "selected";}?>>New York</option>
    <option value="NC" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='NC'){ echo "selected";}?>>North Carolina</option>
    <option value="ND" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='ND'){ echo "selected";}?>>North Dakota</option>
    <option value="OH" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='OH'){ echo "selected";}?>>Ohio</option>
    <option value="OK" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='OK'){ echo "selected";}?>>Oklahoma</option>
    <option value="OR" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='OR'){ echo "selected";}?>>Oregon</option>
    <option value="PA" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='PA'){ echo "selected";}?>>Pennsylvania</option>
    <option value="RI" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='RI'){ echo "selected";}?>>Rhode Island</option>
    <option value="SC" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='SC'){ echo "selected";}?>>South Carolina</option>
    <option value="SD" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='SD'){ echo "selected";}?>>South Dakota</option>
    <option value="TN" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='TN'){ echo "selected";}?>>Tennessee</option>
    <option value="TX" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='TX'){ echo "selected";}?>>Texas</option>
    <option value="UT" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='UT'){ echo "selected";}?>>Utah</option>
    <option value="VT" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='VT'){ echo "selected";}?>>Vermont</option>
    <option value="VA" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='VA'){ echo "selected";}?>>Virginia</option>
    <option value="WA" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='WA'){ echo "selected";}?>>Washington</option>
    <option value="WV" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='WV'){ echo "selected";}?>>West Virginia</option>
    <option value="WI" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='WI'){ echo "selected";}?>>Wisconsin</option>
    <option value="WY" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='WY'){ echo "selected";}?>>Wyoming</option>
    <option value="AE" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='AE'){ echo "selected";}?>>Armed Forces AF, CA, EU, ME<</option>
    <option value="AP" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='AP'){ echo "selected";}?>>Armed Forces Pacific</option>
    <option value="AS" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='AS'){ echo "selected";}?>>American Samoa</option>
    <option value="GU" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='GU'){ echo "selected";}?>>Guam</option>
    <option value="MP" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='MP'){ echo "selected";}?>>Northern Mariana Islands</option>
    <option value="PR" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='PR'){ echo "selected";}?>>Puerto Rico</option>
    <option value="VI" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='VI'){ echo "selected";}?>>Virgin Islands</option>
</select>
 <span class="description">Enter your school state.</span>
 </td>
 </tr>
 
  
 <tr>
 <th><label for="wp_school_zipcode">School Zip Code</label></th>
 <td>
 <input type="text" id="wp_school_zipcode" name="wp_school_zipcode" size="20" value="<?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_zipcode'; $single = true; echo get_user_meta( $user_id, $key, $single ); ?>">
 <span class="description">Enter your school zip code.</span>
 </td>
 </tr>
 </table>

 <h3> Update School Information<h3>
<input type="hidden" name="cid" value="">
 <div id="tabs">
<ul>
	<li><a href="#tabs-1">Choose School</a></li>
	<li><a href="#tabs-2">Add School</a></li>
</ul>
<div id="tabs-1">
	<div id="countyselectdiv">
	County:<br>    
	<select name="countyselect" id="countyselect" disabled="disabled">
	<option value="0" class="static">-- Select County --</option>
	</select>
	</div>

	<br>

	<div id="districtselectdiv" style="<?php 
    if(in_array('County Administrator',$_POST['wp_educator']))
        echo "display:none"; 
    else
        echo "display:inline";

    ?>">
	District:<br> 	   
	<select name="districtselect" id="districtselect" disabled="disabled">
	<option value="0" class="static">-- Select District --</option>
	</select>
	</div>

	<br>

	<div id="schoolselectdiv" style="<?php 
    if(in_array('County Administrator',$_POST['wp_educator']) || in_array('District Administrator',$_POST['wp_educator']))
        echo "display:none"; 
    else
        echo "display:inline";

    ?>">
	School:<br>
	<select name="schoolselect" id="schoolselect" disabled="disabled">
	<option value="0" class="static">-- Select School --</option>
	</select>
	</div>
	<br>
</div>
<div id="tabs-2">
   School Type: <br>	
	<select id = "schooltype" name="schooltype" class="schooltype" disabled="disabled">
		<option value="Public">Public</option>
		<option value="Private">Private</option>
		<option value="Charter">Charter</option>
		<option value="CommunityCollege">Community College</option>		
	</select>
   <br>
   County:<br>    
   <select name="countyselect2" id="countyselect2" disabled="disabled">
   <option value="0" class="static">-- Select County --</option>
   </select>
   <br>
   District:<br> 	   
   <select name="districtselect2" id="districtselect2" disabled="disabled">
   <option value="0" class="static">-- Select District --</option>
   </select>
   <br>
   School Name:<br>
   <input name="addschool" id="addschool" type ="text" disabled="disabled" ></input>
</div>
</div>
<br>    
<?php /* JC UNIVERSITY STUFF *************** */ elseif($userrole == "3"): ?>
 <h3>School Information</h3>
 <table class="form-table">
<tr>
 <th><label for="wp_school_phone_number">School Phone Number</label></th>
 <td>
 <input type="text" id="wp_school_phone_number" name="wp_school_phone_number" size="20" value="<?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_phone_number'; $single = true; echo get_user_meta( $user_id, $key, $single ); ?>">
 <span class="description">Enter your school phone number.</span>
 </td>
 </tr>
 
 <tr>
 <th><label for="wp_school_address">School Address</label></th>
 <td>
 <input type="text" id="wp_school_address" name="wp_school_address" size="20" value="<?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_address'; $single = true; echo get_user_meta( $user_id, $key, $single ); ?>">
 <span class="description">Enter your school address</span>
 </td>
 </tr>
 
 <tr>
 <th><label for="wp_college_state">School State</label></th>
 <td>
 <select id="wp_college_state" name="wp_college_state" class="state" method="post">
    <option value="AL" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='AL'){ echo "selected";}?>>Alabama</option>
    <option value="AK" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='AK'){ echo "selected";}?>>Alaska</option>
    <option value="AZ" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='AZ'){ echo "selected";}?>>Arizona</option>
    <option value="AR" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='AR'){ echo "selected";}?>>Arkansas</option>
    <option value="CA" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='CA'){ echo "selected";}?>>California</option>
    <option value="CO" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='CO'){ echo "selected";}?>>Colorado</option>
    <option value="CT" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='CT'){ echo "selected";}?>>Connecticut</option>
    <option value="DE" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='DE'){ echo "selected";}?>>Delaware</option>
    <option value="DC" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='DC'){ echo "selected";}?>>District of Columbia</option>
    <option value="FL" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='FL'){ echo "selected";}?>>Florida</option>
    <option value="GA" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='GA'){ echo "selected";}?>>Georgia</option>
    <option value="HI" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='HI'){ echo "selected";}?>>Hawaii</option>
    <option value="ID" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='ID'){ echo "selected";}?>>Idaho</option>
    <option value="IL" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='IL'){ echo "selected";}?>>Illinois</option>
    <option value="IN" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='IN'){ echo "selected";}?>>Indiana</option>
    <option value="IA" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='IA'){ echo "selected";}?>>Iowa</option>
    <option value="KS" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='KS'){ echo "selected";}?>>Kansas</option>
    <option value="KY" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='KY'){ echo "selected";}?>>Kentucky</option>
    <option value="LA" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='LA'){ echo "selected";}?>>Louisiana</option>
    <option value="ME" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='ME'){ echo "selected";}?>>Maine</option>
    <option value="MD" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='MD'){ echo "selected";}?>>Maryland</option>
    <option value="MA" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='MA'){ echo "selected";}?>>Massachusetts</option>
    <option value="MI" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='MI'){ echo "selected";}?>>Michigan</option>
    <option value="MN" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='MN'){ echo "selected";}?>>Minnesota</option>
    <option value="MS" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='MS'){ echo "selected";}?>>Mississippi</option>
    <option value="MO" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='MO'){ echo "selected";}?>>Missouri</option>
    <option value="MT" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='MT'){ echo "selected";}?>>Montana</option>
    <option value="NE" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='NE'){ echo "selected";}?>>Nebraska</option>
    <option value="NV" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='NV'){ echo "selected";}?>>Nevada</option>
    <option value="NH" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='NH'){ echo "selected";}?>>New Hampshire</option>
    <option value="NJ" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='NJ'){ echo "selected";}?>>New Jersey</option>
    <option value="NM" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='NM'){ echo "selected";}?>>New Mexico</option>
    <option value="NY" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='NY'){ echo "selected";}?>>New York</option>
    <option value="NC" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='NC'){ echo "selected";}?>>North Carolina</option>
    <option value="ND" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='ND'){ echo "selected";}?>>North Dakota</option>
    <option value="OH" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='OH'){ echo "selected";}?>>Ohio</option>
    <option value="OK" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='OK'){ echo "selected";}?>>Oklahoma</option>
    <option value="OR" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='OR'){ echo "selected";}?>>Oregon</option>
    <option value="PA" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='PA'){ echo "selected";}?>>Pennsylvania</option>
    <option value="RI" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='RI'){ echo "selected";}?>>Rhode Island</option>
    <option value="SC" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='SC'){ echo "selected";}?>>South Carolina</option>
    <option value="SD" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='SD'){ echo "selected";}?>>South Dakota</option>
    <option value="TN" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='TN'){ echo "selected";}?>>Tennessee</option>
    <option value="TX" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='TX'){ echo "selected";}?>>Texas</option>
    <option value="UT" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='UT'){ echo "selected";}?>>Utah</option>
    <option value="VT" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='VT'){ echo "selected";}?>>Vermont</option>
    <option value="VA" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='VA'){ echo "selected";}?>>Virginia</option>
    <option value="WA" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='WA'){ echo "selected";}?>>Washington</option>
    <option value="WV" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='WV'){ echo "selected";}?>>West Virginia</option>
    <option value="WI" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='WI'){ echo "selected";}?>>Wisconsin</option>
    <option value="WY" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='WY'){ echo "selected";}?>>Wyoming</option>
    <option value="AE" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='AE'){ echo "selected";}?>>Armed Forces AF, CA, EU, ME<</option>
    <option value="AP" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='AP'){ echo "selected";}?>>Armed Forces Pacific</option>
    <option value="AS" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='AS'){ echo "selected";}?>>American Samoa</option>
    <option value="GU" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='GU'){ echo "selected";}?>>Guam</option>
    <option value="MP" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='MP'){ echo "selected";}?>>Northern Mariana Islands</option>
    <option value="PR" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='PR'){ echo "selected";}?>>Puerto Rico</option>
    <option value="VI" <?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_state'; $single = true; $state=get_user_meta( $user_id, $key, $single );if($state=='VI'){ echo "selected";}?>>Virgin Islands</option>
</select>
 <span class="description">Enter your school state.</span>
 </td>
 </tr>
 
  
 <tr>
 <th><label for="wp_school_zipcode">School Zip Code</label></th>
 <td>
 <input type="text" id="wp_school_zipcode" name="wp_school_zipcode" size="20" value="<?php $user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; if(!$user_id){$user_id = $user_id1; } $key = 'wp_school_zipcode'; $single = true; echo get_user_meta( $user_id, $key, $single ); ?>">
 <span class="description">Enter your school zip code.</span>
 </td>
 </tr>
 </table>

 <h3> Update School Information<h3>
<input type="hidden" name="cid" value="">
 <div id="tabs">
<ul>
	<li><a href="#tabs-1">Choose School</a></li>
	<li><a href="#tabs-2">Add School</a></li>
</ul>
<div id="tabs-1">
   City:<br>    
   <select name="cityselect" id="cityselect" disabled="disabled">
   <option value="0" class="static">-- Select City --</option>
   </select>
   <br>
   School:<br>
   <select name="collegeselect" id="collegeselect" disabled="disabled">
   <option value="0" class="static">-- Select School --</option>
   </select>
	<br>
</div>
<div id="tabs-2">
   City:<br>    
   <select name="cityselect2" id="cityselect2" disabled="disabled">
   <option value="0" class="static">-- Select City --</option>
   </select>
   <br>
   School Name:<br>
   <input name="addcollege" id="addcollege" type ="text" disabled="disabled" ></input>
</div>
</div>
<br>    
<?php /* END JC UNIVERSITY STUFF *****************/ ?>

<?php else: ?>

<?php endif; ?>
<?php  if($userrole == "1"): ?>

<?php elseif($userrole == "2"): ?>

<?php elseif($userrole == "3"): ?>

<?php endif; ?>
<?php }


add_action('wp_ajax_bschool_actions', 'bschool_actions'); 
add_action('wp_ajax_nopriv_bschool_actions', 'bschool_actions');//for users that are not logged in. 
function bschool_actions() { 
	global $wpdb; 
	if(isset($_REQUEST['stateid'])){ //State Dropdown Actions
		$stateid = $_REQUEST['stateid']; 
		$user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; 
		if(!$user_id){$user_id = $user_id1; }
		if(is_admin()){$user_id = $_REQUEST['userid'];} 
		$key = 'wp_county_id'; 
		$single = true; 
	 	$countyid=get_user_meta( $user_id, $key, $single ); 
		
		// Always display default option 
		$option = '<option value="0" class="static">-- Select County --</option>'; 
		// Create list of district options 
		$results2 = $wpdb->get_results($wpdb->prepare("SELECT * FROM `wp_sdd_county` WHERE state = %s ORDER BY name", $stateid)); 
		foreach($results2 as $row2) {
		if( $row2->county_id == $countyid){
			$selected = 'selected';
		}
		else{
			$selected = '';
		}
		$option .= '<option value="' . $row2->county_id . '" class="sub_' . $row2->county_id .'"' . $selected . '>' . $row2->name . '</option>'; 
		} 
		// Output 
		echo $option; 
		die(); 
	} // end if 
	else if(isset($_REQUEST['countyid'])){ //County Dropdown Actions
		$countyid = $_REQUEST['countyid'];
		$user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; 
		if(!$user_id){$user_id = $user_id1; } 
		if(is_admin()){$user_id = $_REQUEST['userid'];} 
		$key = 'wp_district_id'; 
		$single = true; 
	 	$districtid=get_user_meta( $user_id, $key, $single ); 

 
		// Always display default option 
		$option = '<option value="0" class="static">-- Select District --</option>'; 
		// Create list of district options 
		$results2 = $wpdb->get_results($wpdb->prepare("SELECT * FROM `wp_sdd_district` WHERE county_id = %d ORDER BY name", $countyid)); 
		foreach($results2 as $row2) {
		if( $row2->district_id == $districtid){
			$selected = 'selected';
		}
		else{
			$selected = '';
		} 
		$option .= '<option value="' . $row2->district_id . '" class="sub_' . $row2->county_id .'"' . $selected . '>' . $row2->name . '</option>'; 
		} 
		// Output 
		echo $option; 
		die(); 
	} // end if 
	else if(isset($_REQUEST['districtid'])){ //District Dropdown Actions
		$districtid = $_REQUEST['districtid'];
 		$user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; 
		if(!$user_id){$user_id = $user_id1; } 
		if(is_admin()){$user_id = $_REQUEST['userid'];} 
		$key = 'wp_school_id'; 
		$single = true; 
	 	$schoolid=get_user_meta( $user_id, $key, $single ); 

		// Always display default option 
		$option = '<option value="0" class="static">-- Select School --</option>'; 
		// Create list of district options 
		$results2 = $wpdb->get_results($wpdb->prepare("SELECT * FROM `wp_sdd_school` WHERE district_id = %d ORDER BY name", $districtid)); 
		foreach($results2 as $row2) {
		if( $row2->school_id == $schoolid){
			$selected = 'selected';
		}
		else{
			$selected = '';
		} 
		$option .= '<option value="' . $row2->school_id . '" class="sub_' . $row2->district_id .'"' . $selected . '>' . $row2->name . '</option>'; 
		} 
		// Output 
		echo $option; 
		die(); 
	} // end if 	
}


add_action('wp_ajax_bcollege_actions', 'bcollege_actions'); 
add_action('wp_ajax_nopriv_bcollege_actions', 'bcollege_actions');//for users that are not logged in. 
function bcollege_actions() { 
	global $wpdb; 

	if(isset($_REQUEST['stateid'])){ //State Dropdown Actions
		$stateid = $_REQUEST['stateid']; 
		$user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; 
		if(!$user_id){$user_id = $user_id1; }
		if(is_admin()){$user_id = $_REQUEST['userid'];} 
		$key = 'wp_city_id'; 
		$single = true; 
	 	$city_id=get_user_meta( $user_id, $key, $single ); 
		
		// Always display default option 
		$option = '<option value="0" class="static">-- Select City --</option>'; 
		// Create list of district options 
		$results2 = $wpdb->get_results($wpdb->prepare("SELECT * FROM `wp_cities` WHERE state = %s ORDER BY city", $stateid)); 
		foreach($results2 as $row2) {
		if( $row2->cityID == $city_id){
			$selected = 'selected';
		}
		else{
			$selected = '';
		}
		$option .= '<option value="' . $row2->cityID . '" class="sub_' . $row2->cityID .'"' . $selected . '>' . $row2->city . '</option>'; 
		} 
		// Output 
		echo $option; 
		die(); 
	} // end if 

	else if(isset($_REQUEST['cityid'])){ //City Dropdown Actions
		$cityid = $_REQUEST['cityid']; 
		$user_id1 = get_current_user_id(); $user_id = $_GET['user_id']; 
		if(!$user_id){$user_id = $user_id1; }
		if(is_admin()){$user_id = $_REQUEST['userid'];} 
		$key = 'wp_school_id'; 
		$single = true; 
	 	$schoolid=get_user_meta( $user_id, $key, $single ); 
		
		// Always display default option 
		$option = '<option value="0" class="static">-- Select School --</option>'; 
		// Create list of district options 
		$results2 = $wpdb->get_results($wpdb->prepare("SELECT * FROM `wp_colleges` WHERE institution_cityID = %s ORDER BY institution_name", $cityid)); 
		foreach($results2 as $row2) {
		if( $row2->institutionID_DB == $schoolid){
			$selected = 'selected';
		}
		else{
			$selected = '';
		}
		$option .= '<option value="' . $row2->institutionID_DB . '" class="sub_' . $row2->institutionID_DB .'"' . $selected . '>' . $row2->institution_name . '</option>'; 
		} 
		// Output 
		echo $option; 
		die();
	} // end if 	
}

?>