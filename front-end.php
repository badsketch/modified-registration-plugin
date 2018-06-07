<?php
load_plugin_textdomain( 'modreg', 'false', dirname( plugin_basename( ___FILE___ ) ) . '/lang/' );
function modreg_register_form_add_field()
{
	global $wpdb;
	// Get existing county/district/school from POST
//	$county   = array_key_exists('countyselect', $_POST) ? $_POST['countyselect'] : '';
//    $district = array_key_exists('districtselect', $_POST) ? $_POST["districtselect"] : '';
//    $school   = array_key_exists('schoolselect',$_POST) ? $_POST['schoolselect'] : '';

  //$publickey = "6LcVs-wSAAAAABmYKVlo4_21h6CWnMg5PNBoSiVu"; // you got this from the signup page
?>


<br>
<input type="hidden" name="roleset" id = "roleset" value="<?php if(isset($_POST['role'])){echo $_POST['role'];} else{echo $_POST["roleset"];} ?>"></input>
<?php if(($_GET['role']=='teachers')|($_POST['role']=='teachers')|($_POST["roleset"]=='teachers')): ?>
<div id="modregplugin" style="position: relative; /*margin-top: -10px;*/">
<?php else: ?>
<div id="modregplugin" style="position: relative; /*margin-top: -140px;*/">
<?php endif; ?>
<div id = "fn">
First Name <br>
<input type = "text" name= "firstname" id = "firstname" value="<?php echo $_POST["firstname"]; ?>"> </input><br>
</div>
<div id = "ln" style="position: relative; margin-top: -77px; margin-left: 300px;">
Last Name <br>
<input type = "text" name= "lastname" id = "lastname" value="<?php echo $_POST["lastname"]; ?>"> </input><br>
</div>
<?php if(($_GET['role']=='intl')|($_POST['role']=='intl')|($_POST["roleset"]=='intl')): ?>
<div id = "pn" style="position: relative; margin-top: -77px; margin-left: 600px;">
Cell or Home Phone Number asdf(XXX-XXX-XXXX)<br>
<input type = "text" name= "phonenumber" id = "phonenumber" placeholder="123-456-7890000" value="<?php echo $_POST["phonenumber"]; ?>" > </input><br>
</div>
<?php else: ?>
<div id = "pn" style="position: relative; margin-top: -77px; margin-left: 600px;">
Cell or Home Phone Number (XXX-XXX-XXXX)<br>
<input type = "text" name= "phonenumber" id = "phonenumber" placeholder="123-456-7890" value="<?php echo $_POST["phonenumber"]; ?>" > </input><br>
</div>
<?php endif; ?>
<div id = "addr">
Address <br>
<input type = "text" name= "address" id = "address" style="width:500px" value="<?php echo $_POST["address"]; ?>"> </input><br>
</div>
<div id = "cty">
City <br>
<input type = "text" name= "city" id = "city" value="<?php echo $_POST["city"]; ?>"> </input><br>
</div>
<div id = "st" style="position:relative; margin-top:-67px; margin-left:300px;">
State, US Territory, or Military State <br>
<select name="state" class="state" method="post">
    <option value="0">- Select State -</option>
    <option value="AL" <?php if($_POST["school_state"]=='AL'){ echo "selected";}?>>Alabama</option>
    <option value="AK" <?php if($_POST["school_state"]=='AK'){ echo "selected";}?>>Alaska</option>
    <option value="AZ" <?php if($_POST["school_state"]=='AZ'){ echo "selected";}?>>Arizona</option>
    <option value="AR" <?php if($_POST["school_state"]=='AR'){ echo "selected";}?>>Arkansas</option>
    <option value="CA" <?php if($_POST["school_state"]=='CA'){ echo "selected";}?>>California</option>
    <option value="CO" <?php if($_POST["school_state"]=='CO'){ echo "selected";}?>>Colorado</option>
    <option value="CT" <?php if($_POST["school_state"]=='CT'){ echo "selected";}?>>Connecticut</option>
    <option value="DE" <?php if($_POST["school_state"]=='DE'){ echo "selected";}?>>Delaware</option>
    <option value="DC" <?php if($_POST["school_state"]=='DC'){ echo "selected";}?>>District of Columbia</option>
    <option value="FL" <?php if($_POST["school_state"]=='FL'){ echo "selected";}?>>Florida</option>
    <option value="GA" <?php if($_POST["school_state"]=='GA'){ echo "selected";}?>>Georgia</option>
    <option value="HI" <?php if($_POST["school_state"]=='HI'){ echo "selected";}?>>Hawaii</option>
    <option value="ID" <?php if($_POST["school_state"]=='ID'){ echo "selected";}?>>Idaho</option>
    <option value="IL" <?php if($_POST["school_state"]=='IL'){ echo "selected";}?>>Illinois</option>
    <option value="IN" <?php if($_POST["school_state"]=='IN'){ echo "selected";}?>>Indiana</option>
    <option value="IA" <?php if($_POST["school_state"]=='IA'){ echo "selected";}?>>Iowa</option>
    <option value="KS" <?php if($_POST["school_state"]=='KS'){ echo "selected";}?>>Kansas</option>
    <option value="KY" <?php if($_POST["school_state"]=='KY'){ echo "selected";}?>>Kentucky</option>
    <option value="LA" <?php if($_POST["school_state"]=='LA'){ echo "selected";}?>>Louisiana</option>
    <option value="ME" <?php if($_POST["school_state"]=='ME'){ echo "selected";}?>>Maine</option>
    <option value="MD" <?php if($_POST["school_state"]=='MD'){ echo "selected";}?>>Maryland</option>
    <option value="MA" <?php if($_POST["school_state"]=='MA'){ echo "selected";}?>>Massachusetts</option>
    <option value="MI" <?php if($_POST["school_state"]=='MI'){ echo "selected";}?>>Michigan</option>
    <option value="MN" <?php if($_POST["school_state"]=='MN'){ echo "selected";}?>>Minnesota</option>
    <option value="MS" <?php if($_POST["school_state"]=='MS'){ echo "selected";}?>>Mississippi</option>
    <option value="MO" <?php if($_POST["school_state"]=='MO'){ echo "selected";}?>>Missouri</option>
    <option value="MT" <?php if($_POST["school_state"]=='MT'){ echo "selected";}?>>Montana</option>
    <option value="NE" <?php if($_POST["school_state"]=='NE'){ echo "selected";}?>>Nebraska</option>
    <option value="NV" <?php if($_POST["school_state"]=='NV'){ echo "selected";}?>>Nevada</option>
    <option value="NH" <?php if($_POST["school_state"]=='NH'){ echo "selected";}?>>New Hampshire</option>
    <option value="NJ" <?php if($_POST["school_state"]=='NJ'){ echo "selected";}?>>New Jersey</option>
    <option value="NM" <?php if($_POST["school_state"]=='NM'){ echo "selected";}?>>New Mexico</option>
    <option value="NY" <?php if($_POST["school_state"]=='NY'){ echo "selected";}?>>New York</option>
    <option value="NC" <?php if($_POST["school_state"]=='NC'){ echo "selected";}?>>North Carolina</option>
    <option value="ND" <?php if($_POST["school_state"]=='ND'){ echo "selected";}?>>North Dakota</option>
    <option value="OH" <?php if($_POST["school_state"]=='OH'){ echo "selected";}?>>Ohio</option>
    <option value="OK" <?php if($_POST["school_state"]=='OK'){ echo "selected";}?>>Oklahoma</option>
    <option value="OR" <?php if($_POST["school_state"]=='OR'){ echo "selected";}?>>Oregon</option>
    <option value="PA" <?php if($_POST["school_state"]=='PA'){ echo "selected";}?>>Pennsylvania</option>
    <option value="RI" <?php if($_POST["school_state"]=='RI'){ echo "selected";}?>>Rhode Island</option>
    <option value="SC" <?php if($_POST["school_state"]=='SC'){ echo "selected";}?>>South Carolina</option>
    <option value="SD" <?php if($_POST["school_state"]=='SD'){ echo "selected";}?>>South Dakota</option>
    <option value="TN" <?php if($_POST["school_state"]=='TN'){ echo "selected";}?>>Tennessee</option>
    <option value="TX" <?php if($_POST["school_state"]=='TX'){ echo "selected";}?>>Texas</option>
    <option value="UT" <?php if($_POST["school_state"]=='UT'){ echo "selected";}?>>Utah</option>
    <option value="VT" <?php if($_POST["school_state"]=='VT'){ echo "selected";}?>>Vermont</option>
    <option value="VA" <?php if($_POST["school_state"]=='VA'){ echo "selected";}?>>Virginia</option>
    <option value="WA" <?php if($_POST["school_state"]=='WA'){ echo "selected";}?>>Washington</option>
    <option value="WV" <?php if($_POST["school_state"]=='WV'){ echo "selected";}?>>West Virginia</option>
    <option value="WI" <?php if($_POST["school_state"]=='WI'){ echo "selected";}?>>Wisconsin</option>
	<option value="WY" <?php if($_POST["school_state"]=='WY'){ echo "selected";}?>>Wyoming</option>
    <option value="AE" <?php if($_POST["school_state"]=='AE'){ echo "selected";}?>>Armed Forces AF, CA, EU, ME</option>
    <option value="AP" <?php if($_POST["school_state"]=='AP'){ echo "selected";}?>>Armed Forces Pacific</option>
    <option value="AS" <?php if($_POST["school_state"]=='AS'){ echo "selected";}?>>American Samoa</option>
    <option value="GU" <?php if($_POST["school_state"]=='GU'){ echo "selected";}?>>Guam</option>
    <option value="MP" <?php if($_POST["school_state"]=='MP'){ echo "selected";}?>>Northern Mariana Islands</option>
    <option value="PR" <?php if($_POST["school_state"]=='PR'){ echo "selected";}?>>Puerto Rico</option>
    <option value="VI" <?php if($_POST["school_state"]=='VI'){ echo "selected";}?>>Virgin Islands</option>
</select>
<br>
</div>
<div id="zc" style = "position: relative; margin-top: -51px; margin-left: 600px;">
Zip Code <br>
<input type = "text" name= "zipcode" id = "zipcode" placeholder="12345" value="<?php echo $_POST["zipcode"]; ?>"> </input><br>
</div>
<!--*****************************************************************************************************
*********************************************************************************************************
*********************************************************************************************************
***************************************Set Teacher Fields************************************************
*********************************************************************************************************
*********************************************************************************************************
*********************************************************************************************************-->
<?php if(($_GET['role']=='teachers')|($_POST['role']=='teachers')|($_POST["roleset"]=='teachers')): ?>
<div id="ptitle">
Title (optional but preferred) <br>
<input type = "text" name = "title" id = "title" value="<?php echo $_POST["title"]; ?>"> </input><br>
</div>

Type of Educator:<br/>
<input type="radio" id ="SchoolAdmin" name = "educator[]" value="School Administrator" <?php if(in_array('School Administrator',$_POST['educator'])) echo 'checked'; ?>/>School Administrator/Staff<br>
<input type="radio" id ="DistrictAdmin" name = "educator[]" value="District Administrator" <?php if(in_array('District Administrator',$_POST['educator'])) echo 'checked'; ?>/>District Administrator/Staff<br>
<input type="radio" id ="CountyAdmin" name = "educator[]" value="County Administrator" <?php if(in_array('County Administrator',$_POST['educator'])) echo 'checked'; ?>/>County Administrator/Staff<br>
<input type="radio" id ="classTeacher" name = "educator[]" value="Classroom Teacher" <?php if(in_array('Classroom Teacher',$_POST['educator'])) echo 'checked'; ?>/>Classroom Teacher<br>
<input type="radio" id ="paraEducator" name = "educator[]" value="Paraeducator" <?php if(in_array('Paraeducator',$_POST['educator'])) echo 'checked'; ?>/>Paraeducator<br>
<input type="radio" id ="counselor" name = "educator[]" value="Academic Counselor" <?php if(in_array('Academic Counselor',$_POST['educator'])) echo 'checked'; ?>/>Academic Counselor<br><br/>

Grade Level<br>
<input type="checkbox" id ="ElementarySchool" name = "grades[]" value="ElementarySchool" <?php if(in_array('ElementarySchool',$_POST['grades'])) echo 'checked'; ?>/>Elementary School<br>
<input type="checkbox" id ="MiddleSchool" name = "grades[]" value="MiddleSchool" <?php if(in_array('MiddleSchool',$_POST['grades'])) echo 'checked'; ?>/>Middle School<br>
<input type="checkbox" id ="HighSchool" name = "grades[]" value="HighSchool" <?php if(in_array('HighSchool',$_POST['grades'])) echo 'checked'; ?>/>High School<br>
If you are a junior college or university professor, click <a href="/wp-login.php?action=register&role=jcuniversities">here</a> to register<br><br/>

Subjects teaching<br>
<input type = "text" name= "subjects" id = "subjects" style="width:400px;" value="<?php echo $_POST["subjects"]; ?>"> </input>
<input style="margin-left: 20px" type="checkbox" id ="subjectsNA" name = "subjectsNA" value="subjects_NA" <?php if(isset($_POST['subjectsNA'])) echo 'checked'; ?>/>Subjects teaching N/A<br>
<br>

<br>
<hr>
<br>

<?php elseif( ($_GET['role']=='jcuniversities')|($_POST['role']=='jcuniversities')|($_POST["roleset"]=='jcuniversities') ): ?>
<div id="ptitle">
Title (optional but preferred) <br>
<input type = "text" name = "title" id = "title" value="<?php echo $_POST["title"]; ?>"> </input><br>
</div>

Subjects teaching<br>
<input type = "text" name= "subjects" id = "subjects" style="width:400px;" value="<?php echo $_POST["subjects"]; ?>"> </input><br>

<br />
<hr />
<br />

<?php elseif(($_GET['role']=='itstaff')|($_POST['role']=='itstaff')|($_POST["roleset"]=='itstaff')): ?>
<div id="ptitle">
Title (optional but preferred) <br>
<input type = "text" name = "title" id = "title" value="<?php echo $_POST["title"]; ?>"> </input><br>
</div>
<div id="ctl">
Number of Computers in Labs<br>
<input type = "text" name= "numcomputers" id = "numcomputers" value="<?php echo $_POST["numcomputers"]; ?>"> </input><br>
OS Versions of Lab Computers<br>
<input type="checkbox" id ="XP" name = "osv[]" value="XP" <?php if(in_array('XP',$_POST['osv'])) echo 'checked'; ?>/>XP<br>
<input type="checkbox" id ="7" name = "osv[]" value="7" <?php if(in_array('7',$_POST['osv'])) echo 'checked'; ?>/>7<br>
<input type="checkbox" id ="8" name = "osv[]" value="8" <?php if(in_array('8',$_POST['osv'])) echo 'checked'; ?>/>8<br>
<input type="checkbox" id ="OSX" name = "osv[]" value="OSX" <?php if(in_array('OSX',$_POST['osv'])) echo 'checked'; ?>/>OSX<br>
<input type="checkbox" id ="Linux" name = "osv[]" value="Linux" <?php if(in_array('Linux',$_POST['osv'])) echo 'checked'; ?>/>Linux<br>
</div>
<br>
<hr>
<br>

<?php elseif(($_GET['role']=='judges')|($_POST['role']=='judges')|($_POST["roleset"]=='judges')): ?>
<div id="ptitle">
Title (optional but preferred) <br>
<input type = "text" name = "title" id = "title" value="<?php echo $_POST["title"]; ?>"> </input><br>
</div>
<div id="osn">
Organization Name <br>
<input type = "text" name= "orgschoolname" id = "orgschoolname" style="width:400px;" value="<?php echo $_POST["orgschoolname"]; ?>"> </input><br>
</div>
<?php elseif(($_GET['role']=='students')|($_POST['role']=='students')|($_POST["roleset"]=='students')): ?>
<div id="ptitle">
Title (optional but preferred) <br>
<input type = "text" name = "title" id = "title" value="<?php echo $_POST["title"]; ?>"> </input><br>
</div>
<div id="ctl">
Subjects learning <br>
<input type = "text" name= "subjects" id = "subjects" style="width:400px;" value="<?php echo $_POST["subjects"]; ?>"> </input><br>
</div>
<div id="osn">
Organization/School Name <br>
<input type = "text" name= "orgschoolname" id = "orgschoolname" style="width:400px;" value="<?php echo $_POST["orgschoolname"]; ?>"> </input><br>
</div>
<?php else: ?>
<div id="ptitle">
Title (optional but preferred) <br>
<input type = "text" name = "title" id = "title" value="<?php echo $_POST["title"]; ?>"> </input><br>
</div>
<div id="ctl">
Subjects teaching or learning <br>
<input type = "text" name= "subjects" id = "subjects" style="width:400px;" value="<?php echo $_POST["subjects"]; ?>"> </input><br>
</div>
<div id="osn">
Organization/School Name <br>
<input type = "text" name= "orgschoolname" id = "orgschoolname" style="width:400px;" value="<?php echo $_POST["orgschoolname"]; ?>"> </input><br>
</div>
<?php endif; ?>
<?php if(($_GET['role']=='itstaff')|($_POST['role']=='itstaff')|($_POST["roleset"]=='itstaff')|($_GET['role']=='teachers')|($_POST['role']=='teachers')|($_POST["roleset"]=='teachers')): ?>
<h2 id="modregschoolinfo" style="color:#222; font-size: 1.5em; font-weight: 400;"> School Information </h2>
<br>
<div id = "school_pn" >
School Phone Number (XXX-XXX-XXXX)<br>
<input type = "text" name= "school_phonenumber" id = "school_phonenumber" placeholder="123-456-7890" value="<?php echo $_POST["school_phonenumber"]; ?>" > </input><br>
</div>
<div id = "school_addr">
School Address <br>
<input type = "text" name= "school_address" id = "school_address" style="width:500px" value="<?php echo $_POST["school_address"]; ?>"> </input><br>
</div>
<div id = "school_cty">
City <br>
<input type = "text" name= "school_city" id = "school_city" value="<?php echo $_POST["school_city"]; ?>"> </input><br>
</div>
<div id = "school_st" style="position:relative; margin-top:-67px; margin-left:300px;">
State, US Territory, or Military State<br>
<select id = "school_state" name="school_state" class="school_state" method="post">
    <option value="0">- Select State -</option>
    <option value="AL" <?php //if($_POST["school_state"]=='AL'){ echo "selected";}?>>Alabama</option>
    <option value="AK" <?php //if($_POST["school_state"]=='AK'){ echo "selected";}?>>Alaska</option>
    <option value="AZ" <?php //if($_POST["school_state"]=='AZ'){ echo "selected";}?>>Arizona</option>
    <option value="AR" <?php //if($_POST["school_state"]=='AR'){ echo "selected";}?>>Arkansas</option>
    <option value="CA" <?php //if($_POST["school_state"]=='CA'){ echo "selected";}?>>California</option>
    <option value="CO" <?php //if($_POST["school_state"]=='CO'){ echo "selected";}?>>Colorado</option>
    <option value="CT" <?php //if($_POST["school_state"]=='CT'){ echo "selected";}?>>Connecticut</option>
    <option value="DE" <?php //if($_POST["school_state"]=='DE'){ echo "selected";}?>>Delaware</option>
    <option value="DC" <?php //if($_POST["school_state"]=='DC'){ echo "selected";}?>>District of Columbia</option>
    <option value="FL" <?php //if($_POST["school_state"]=='FL'){ echo "selected";}?>>Florida</option>
    <option value="GA" <?php //if($_POST["school_state"]=='GA'){ echo "selected";}?>>Georgia</option>
    <option value="HI" <?php //if($_POST["school_state"]=='HI'){ echo "selected";}?>>Hawaii</option>
    <option value="ID" <?php //if($_POST["school_state"]=='ID'){ echo "selected";}?>>Idaho</option>
    <option value="IL" <?php //if($_POST["school_state"]=='IL'){ echo "selected";}?>>Illinois</option>
    <option value="IN" <?php //if($_POST["school_state"]=='IN'){ echo "selected";}?>>Indiana</option>
    <option value="IA" <?php //if($_POST["school_state"]=='IA'){ echo "selected";}?>>Iowa</option>
    <option value="KS" <?php //if($_POST["school_state"]=='KS'){ echo "selected";}?>>Kansas</option>
    <option value="KY" <?php //if($_POST["school_state"]=='KY'){ echo "selected";}?>>Kentucky</option>
    <option value="LA" <?php //if($_POST["school_state"]=='LA'){ echo "selected";}?>>Louisiana</option>
    <option value="ME" <?php //if($_POST["school_state"]=='ME'){ echo "selected";}?>>Maine</option>
    <option value="MD" <?php //if($_POST["school_state"]=='MD'){ echo "selected";}?>>Maryland</option>
    <option value="MA" <?php //if($_POST["school_state"]=='MA'){ echo "selected";}?>>Massachusetts</option>
    <option value="MI" <?php //if($_POST["school_state"]=='MI'){ echo "selected";}?>>Michigan</option>
    <option value="MN" <?php //if($_POST["school_state"]=='MN'){ echo "selected";}?>>Minnesota</option>
    <option value="MS" <?php //if($_POST["school_state"]=='MS'){ echo "selected";}?>>Mississippi</option>
    <option value="MO" <?php //if($_POST["school_state"]=='MO'){ echo "selected";}?>>Missouri</option>
    <option value="MT" <?php //if($_POST["school_state"]=='MT'){ echo "selected";}?>>Montana</option>
    <option value="NE" <?php //if($_POST["school_state"]=='NE'){ echo "selected";}?>>Nebraska</option>
    <option value="NV" <?php //if($_POST["school_state"]=='NV'){ echo "selected";}?>>Nevada</option>
    <option value="NH" <?php //if($_POST["school_state"]=='NH'){ echo "selected";}?>>New Hampshire</option>
    <option value="NJ" <?php //if($_POST["school_state"]=='NJ'){ echo "selected";}?>>New Jersey</option>
    <option value="NM" <?php //if($_POST["school_state"]=='NM'){ echo "selected";}?>>New Mexico</option>
    <option value="NY" <?php //if($_POST["school_state"]=='NY'){ echo "selected";}?>>New York</option>
    <option value="NC" <?php //if($_POST["school_state"]=='NC'){ echo "selected";}?>>North Carolina</option>
    <option value="ND" <?php //if($_POST["school_state"]=='ND'){ echo "selected";}?>>North Dakota</option>
    <option value="OH" <?php //if($_POST["school_state"]=='OH'){ echo "selected";}?>>Ohio</option>
    <option value="OK" <?php //if($_POST["school_state"]=='OK'){ echo "selected";}?>>Oklahoma</option>
    <option value="OR" <?php //if($_POST["school_state"]=='OR'){ echo "selected";}?>>Oregon</option>
    <option value="PA" <?php //if($_POST["school_state"]=='PA'){ echo "selected";}?>>Pennsylvania</option>
    <option value="RI" <?php //if($_POST["school_state"]=='RI'){ echo "selected";}?>>Rhode Island</option>
    <option value="SC" <?php //if($_POST["school_state"]=='SC'){ echo "selected";}?>>South Carolina</option>
    <option value="SD" <?php //if($_POST["school_state"]=='SD'){ echo "selected";}?>>South Dakota</option>
    <option value="TN" <?php //if($_POST["school_state"]=='TN'){ echo "selected";}?>>Tennessee</option>
    <option value="TX" <?php //if($_POST["school_state"]=='TX'){ echo "selected";}?>>Texas</option>
    <option value="UT" <?php //if($_POST["school_state"]=='UT'){ echo "selected";}?>>Utah</option>
    <option value="VT" <?php //if($_POST["school_state"]=='VT'){ echo "selected";}?>>Vermont</option>
    <option value="VA" <?php //if($_POST["school_state"]=='VA'){ echo "selected";}?>>Virginia</option>
    <option value="WA" <?php //if($_POST["school_state"]=='WA'){ echo "selected";}?>>Washington</option>
    <option value="WV" <?php //if($_POST["school_state"]=='WV'){ echo "selected";}?>>West Virginia</option>
    <option value="WI" <?php //if($_POST["school_state"]=='WI'){ echo "selected";}?>>Wisconsin</option>
	<option value="WY" <?php //if($_POST["school_state"]=='WY'){ echo "selected";}?>>Wyoming</option>
    <option value="AE" <?php //if($_POST["school_state"]=='AE'){ echo "selected";}?>>Armed Forces AF, CA, EU, ME</option>
    <option value="AP" <?php //if($_POST["school_state"]=='AP'){ echo "selected";}?>>Armed Forces Pacific</option>
    <option value="AS" <?php //if($_POST["school_state"]=='AS'){ echo "selected";}?>>American Samoa</option>
    <option value="GU" <?php //if($_POST["school_state"]=='GU'){ echo "selected";}?>>Guam</option>
    <option value="MP" <?php //if($_POST["school_state"]=='MP'){ echo "selected";}?>>Northern Mariana Islands</option>
    <option value="PR" <?php //if($_POST["school_state"]=='PR'){ echo "selected";}?>>Puerto Rico</option>
    <option value="VI" <?php //if($_POST["school_state"]=='VI'){ echo "selected";}?>>Virgin Islands</option>
</select>
<br>
</div>
<div id="school_zc" style = "position: relative; margin-top: -51px; margin-left: 600px;">
Zip Code <br>
<input type = "text" name= "school_zipcode" id = "school_zipcode" placeholder="12345" value="<?php echo $_POST["school_zipcode"]; ?>"> </input><br>
</div>
<!--*************************************************************************************************************************
*****************************************************************************************************************************
******************************************** AJAX School Dropdowns **********************************************************
*****************************************************************************************************************************
*****************************************************************************************************************************-->
<h2 id="modregschoolinfo" style="color:#222; font-size: 1.5em; font-weight: 400;"> Select Your School (First, select the state your school is in under "State, US Territory, or Military State" above.)</h2>
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
    if(in_array('County Administrator',$_POST['educator']))
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
    if(in_array('County Administrator',$_POST['educator']) || in_array('District Administrator',$_POST['educator']))
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
<hr>
<br>
</div>
<?php endif; ?>


<!-- ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ BEGIN JC / UNIVERSITY DROPDOWN CODE ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ -->

<?php if(($_GET['role']=='jcuniversities')|($_POST['role']=='jcuniversities')|($_POST["roleset"]=='jcuniversities')): ?>
<h2 id="modregcollegeinfo" style="color:#222; font-size: 1.5em; font-weight: 400;"> JC / University Information </h2>
<br>
<div id = "college_pn" >
College Phone Number <br>
<input type = "text" name= "college_phonenumber" id = "college_phonenumber" placeholder="123-456-7890" value="<?php echo $_POST["college_phonenumber"]; ?>" > </input><br>
</div>
<div id = "college_pn">
College Address <br>
<input type = "text" name= "college_address" id = "college_address" style="width:500px" value="<?php echo $_POST["college_address"]; ?>"> </input><br>
</div>
<br/>
<!-- <div id = "school_cty">
City <br>
<input type = "text" name= "school_city" id = "school_city" value="<?php /*echo $_POST["school_city"];*/ ?>"> </input><br>
</div> -->
<div id = "college_st" style="position:relative; margin-top:0px; margin-left:0px;">
State, US Territory, or Military State<br>
<select id = "college_state" name="college_state" class="college_state" method="post">
    <option value="0">- Select State -</option>
    <option value="AL" <?php //if($_POST["school_state"]=='AL'){ echo "selected";}?>>ALABAMA</option>
    <option value="AK" <?php //if($_POST["school_state"]=='AK'){ echo "selected";}?>>Alaska</option>
    <option value="AZ" <?php //if($_POST["school_state"]=='AZ'){ echo "selected";}?>>Arizona</option>
    <option value="AR" <?php //if($_POST["school_state"]=='AR'){ echo "selected";}?>>Arkansas</option>
    <option value="CA" <?php //if($_POST["school_state"]=='CA'){ echo "selected";}?>>California</option>
    <option value="CO" <?php //if($_POST["school_state"]=='CO'){ echo "selected";}?>>Colorado</option>
    <option value="CT" <?php //if($_POST["school_state"]=='CT'){ echo "selected";}?>>Connecticut</option>
    <option value="DE" <?php //if($_POST["school_state"]=='DE'){ echo "selected";}?>>Delaware</option>
    <option value="DC" <?php //if($_POST["school_state"]=='DC'){ echo "selected";}?>>District of Columbia</option>
    <option value="FL" <?php //if($_POST["school_state"]=='FL'){ echo "selected";}?>>Florida</option>
    <option value="GA" <?php //if($_POST["school_state"]=='GA'){ echo "selected";}?>>Georgia</option>
    <option value="HI" <?php //if($_POST["school_state"]=='HI'){ echo "selected";}?>>Hawaii</option>
    <option value="ID" <?php //if($_POST["school_state"]=='ID'){ echo "selected";}?>>Idaho</option>
    <option value="IL" <?php //if($_POST["school_state"]=='IL'){ echo "selected";}?>>Illinois</option>
    <option value="IN" <?php //if($_POST["school_state"]=='IN'){ echo "selected";}?>>Indiana</option>
    <option value="IA" <?php //if($_POST["school_state"]=='IA'){ echo "selected";}?>>Iowa</option>
    <option value="KS" <?php //if($_POST["school_state"]=='KS'){ echo "selected";}?>>Kansas</option>
    <option value="KY" <?php //if($_POST["school_state"]=='KY'){ echo "selected";}?>>Kentucky</option>
    <option value="LA" <?php //if($_POST["school_state"]=='LA'){ echo "selected";}?>>Louisiana</option>
    <option value="ME" <?php //if($_POST["school_state"]=='ME'){ echo "selected";}?>>Maine</option>
    <option value="MD" <?php //if($_POST["school_state"]=='MD'){ echo "selected";}?>>Maryland</option>
    <option value="MA" <?php //if($_POST["school_state"]=='MA'){ echo "selected";}?>>Massachusetts</option>
    <option value="MI" <?php //if($_POST["school_state"]=='MI'){ echo "selected";}?>>Michigan</option>
    <option value="MN" <?php //if($_POST["school_state"]=='MN'){ echo "selected";}?>>Minnesota</option>
    <option value="MS" <?php //if($_POST["school_state"]=='MS'){ echo "selected";}?>>Mississippi</option>
    <option value="MO" <?php //if($_POST["school_state"]=='MO'){ echo "selected";}?>>Missouri</option>
    <option value="MT" <?php //if($_POST["school_state"]=='MT'){ echo "selected";}?>>Montana</option>
    <option value="NE" <?php //if($_POST["school_state"]=='NE'){ echo "selected";}?>>Nebraska</option>
    <option value="NV" <?php //if($_POST["school_state"]=='NV'){ echo "selected";}?>>Nevada</option>
    <option value="NH" <?php //if($_POST["school_state"]=='NH'){ echo "selected";}?>>New Hampshire</option>
    <option value="NJ" <?php //if($_POST["school_state"]=='NJ'){ echo "selected";}?>>New Jersey</option>
    <option value="NM" <?php //if($_POST["school_state"]=='NM'){ echo "selected";}?>>New Mexico</option>
    <option value="NY" <?php //if($_POST["school_state"]=='NY'){ echo "selected";}?>>New York</option>
    <option value="NC" <?php //if($_POST["school_state"]=='NC'){ echo "selected";}?>>North Carolina</option>
    <option value="ND" <?php //if($_POST["school_state"]=='ND'){ echo "selected";}?>>North Dakota</option>
    <option value="OH" <?php //if($_POST["school_state"]=='OH'){ echo "selected";}?>>Ohio</option>
    <option value="OK" <?php //if($_POST["school_state"]=='OK'){ echo "selected";}?>>Oklahoma</option>
    <option value="OR" <?php //if($_POST["school_state"]=='OR'){ echo "selected";}?>>Oregon</option>
    <option value="PA" <?php //if($_POST["school_state"]=='PA'){ echo "selected";}?>>Pennsylvania</option>
    <option value="RI" <?php //if($_POST["school_state"]=='RI'){ echo "selected";}?>>Rhode Island</option>
    <option value="SC" <?php //if($_POST["school_state"]=='SC'){ echo "selected";}?>>South Carolina</option>
    <option value="SD" <?php //if($_POST["school_state"]=='SD'){ echo "selected";}?>>South Dakota</option>
    <option value="TN" <?php //if($_POST["school_state"]=='TN'){ echo "selected";}?>>Tennessee</option>
    <option value="TX" <?php //if($_POST["school_state"]=='TX'){ echo "selected";}?>>Texas</option>
    <option value="UT" <?php //if($_POST["school_state"]=='UT'){ echo "selected";}?>>Utah</option>
    <option value="VT" <?php //if($_POST["school_state"]=='VT'){ echo "selected";}?>>Vermont</option>
    <option value="VA" <?php //if($_POST["school_state"]=='VA'){ echo "selected";}?>>Virginia</option>
    <option value="WA" <?php //if($_POST["school_state"]=='WA'){ echo "selected";}?>>Washington</option>
    <option value="WV" <?php //if($_POST["school_state"]=='WV'){ echo "selected";}?>>West Virginia</option>
    <option value="WI" <?php //if($_POST["school_state"]=='WI'){ echo "selected";}?>>Wisconsin</option>
    <option value="WY" <?php //if($_POST["school_state"]=='WY'){ echo "selected";}?>>Wyoming</option>
    <option value="AE" <?php //if($_POST["school_state"]=='AE'){ echo "selected";}?>>Armed Forces AF, CA, EU, ME</option>
    <option value="AP" <?php //if($_POST["school_state"]=='AP'){ echo "selected";}?>>Armed Forces Pacific</option>
    <option value="AS" <?php //if($_POST["school_state"]=='AS'){ echo "selected";}?>>American Samoa</option>
    <option value="GU" <?php //if($_POST["school_state"]=='GU'){ echo "selected";}?>>Guam</option>
    <option value="MP" <?php //if($_POST["school_state"]=='MP'){ echo "selected";}?>>Northern Mariana Islands</option>
    <option value="PR" <?php //if($_POST["school_state"]=='PR'){ echo "selected";}?>>Puerto Rico</option>
    <option value="VI" <?php //if($_POST["school_state"]=='VI'){ echo "selected";}?>>Virgin Islands</option>
</select>
<br>
</div>
<div id="college_zc" style = "position: relative; margin-top: -51px; margin-left: 300px;">
Zip Code <br>
<input type = "text" name= "college_zipcode" id = "college_zipcode" placeholder="12345" value="<?php echo $_POST["college_zipcode"]; ?>"> </input><br>
</div>
<!--*************************************************************************************************************************
*****************************************************************************************************************************
******************************************** AJAX School Dropdowns **********************************************************
*****************************************************************************************************************************
*****************************************************************************************************************************-->
<h2 id="modregcollegeinfo" style="color:#222; font-size: 1.5em; font-weight: 400;"> Select Your College or University (First, select the state your your College or University is in under "State, US Territory, or Military State" above.)</h2>
 <div id="tabs">
<ul>
    <li><a href="#tabs-1">Choose College or University</a></li>
    <li><a href="#tabs-2">Add College or University</a></li>
</ul>
<div id="tabs-1">
   City:<br>
   <select name="cityselect" id="cityselect" disabled="disabled">
   <option value="0" class="static">-- Select City --</option>
   </select>
   <br>
   School:<br>
   <select name="collegeselect" id="collegeselect" disabled="disabled">
   <option value="0" class="static">-- Select College / University --</option>
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
<hr>
<br>
</div>
<?php endif; ?>

<!-- ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ END JC / UNIVERSITY DROPDOWN CODE ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ -->

<?php
}
add_action( 'register_form', 'modreg_register_form_add_field' );

function modreg_login_head()
{
?>
<!--Adding login.min.css  -->
<link rel="stylesheet" type="text/css" href="http://c-stem.ucdavis.edu/wp-admin/css/login.min.css">
<link rel="stylesheet" type="text/css" href="http://c-stem.ucdavis.edu/wp-admin/css/login.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
<script type="text/javascript" >
 var continue_button = document.getElementById('continue');
 continue_button.style.visibility = 'hidden';
</script>
</script>
   <?php
}
add_action( 'login_head', 'modreg_login_head' );
/*********************************************************************************************************************
**********************************************************************************************************************
***********************************************AJAX DROPDOWN FUNCTION*************************************************
**********************************************************************************************************************
**********************************************************************************************************************/
add_action('wp_ajax_college_actions', 'college_actions');
add_action('wp_ajax_nopriv_college_actions', 'college_actions');//for users that are not logged in.
function college_actions() {
    global $wpdb;

    if(isset($_REQUEST['stateid'])) {
        $stateid = $_REQUEST['stateid'];
        // Always display default option
        $option = '<option value="0" class="static">-- Select City --</option>';
        // Create list of school options
        $results2 = $wpdb->get_results($wpdb->prepare("SELECT * FROM `wp_cities` WHERE state = %s ORDER BY city", $stateid));
        foreach($results2 as $row2) {
        //echo '<option value="0">' . $row2 . '</option>';
        $option .= '<option value="' . $row2->cityID . '" class="sub_' . $row2->cityID .'"' . $selected . '>' . $row2->city . '</option>';
        }
        // Output
        echo $option;
        die();
    } // if: clicked on state option

    elseif (isset($_REQUEST['cityid'])) {
        $cityid = $_REQUEST['cityid'];
        // Always display default option
        $option = '<option value="0" class="static">-- Select College / University --</option>';
        // Create list of district options
        //$institution_cityID_query = $wpdb->get_results($wpdb->prepare("SELECT `cityID` FROM `wp_cities` WHERE cityID = %d", $cityid));
        //$institution_cityID = $institution_cityID_query[0]->cityID;

        $results2 = $wpdb->get_results($wpdb->prepare("SELECT * FROM `wp_colleges` WHERE institution_cityID = %d ORDER BY institution_name", $cityid));
        foreach($results2 as $row2) {
        $option .= '<option value="' . $row2->institutionID_DB . '" class="sub_' . $row2->institutionID_DB .'"' . $selected . '>' . $row2->institution_name . '</option>';
        }
        // Output
        echo $option;
        die();
    } // if: clicked on city dropdown
} // college_actions()

add_action('wp_ajax_school_actions', 'school_actions');
add_action('wp_ajax_nopriv_school_actions', 'school_actions');//for users that are not logged in.
function school_actions() {
	global $wpdb;
	if(isset($_REQUEST['stateid'])){ //State Dropdown Actions
		$stateid = $_REQUEST['stateid'];

		// Always display default option
		$option = '<option value="0" class="static">-- Select County --</option>';
		// Create list of district options
		$results2 = $wpdb->get_results($wpdb->prepare("SELECT * FROM `wp_sdd_county` WHERE state = %s ORDER BY name", $stateid));
		foreach($results2 as $row2) {
		$option .= '<option value="' . $row2->county_id . '" class="sub_' . $row2->county_id .'"' . $selected . '>' . $row2->name . '</option>';
		}
		// Output
		echo $option;
		die();
	} // end if
	else if(isset($_REQUEST['countyid'])){ //County Dropdown Actions
		$countyid = $_REQUEST['countyid'];
		// Always display default option
		$option = '<option value="0" class="static">-- Select District --</option>';
		// Create list of district options
		$results2 = $wpdb->get_results($wpdb->prepare("SELECT * FROM `wp_sdd_district` WHERE county_id = %d ORDER BY name", $countyid));
		foreach($results2 as $row2) {
		$option .= '<option value="' . $row2->district_id . '" class="sub_' . $row2->county_id .'"' . $selected . '>' . $row2->name . '</option>';
		}
		// Output
		echo $option;
		die();
	} // end if
	else if(isset($_REQUEST['districtid'])){ //District Dropdown Actions
		$districtid = $_REQUEST['districtid'];
		// Always display default option
		$option = '<option value="0" class="static">-- Select School --</option>';
		// Create list of district options
		$results2 = $wpdb->get_results($wpdb->prepare("SELECT * FROM `wp_sdd_school` WHERE district_id = %d ORDER BY name", $districtid));
		foreach($results2 as $row2) {
		$option .= '<option value="' . $row2->school_id . '" class="sub_' . $row2->district_id .'"' . $selected . '>' . $row2->name . '</option>';
		}
		// Output
		echo $option;
		die();
	} // end if
}

function modreg_registration_errors( $errors, $sanitized_user_login, $user_email ){
	if( count( $errors->errors )>0 )
		return $errors;
	//Prevent users from trying to register as administrator
    if((isset($_POST['role']) and $_POST['role']=='administrator')|$_POST["roleset"]=='administrator'){
        add_action( 'login_head', 'wp_shake_js', 12 );
        return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: Unable to register based on current role' , 'baweic' ) );
    }
	//Prevent users from trying to register as fellows
    if((isset($_POST['role']) and $_POST['role']=='fellows')|$_POST["roleset"]=='fellows'){
        add_action( 'login_head', 'wp_shake_js', 12 );
        return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: Unable to register based on current role' , 'baweic' ) );
    }
	//Check user phone number has valid format
    if(!preg_match("/^([1]-)?[0-9]{3}-[0-9]{3}-[0-9]{4}$/i", $_POST["phonenumber"], $matches)){
        add_action( 'login_head', 'wp_shake_js', 12 );
		return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: Phone number has letters or input format is incorrect' , 'baweic' ) );
    }
    else if(!preg_match("/^([0-9]{5})(-[0-9]{4})?$/i",$_POST["zipcode"])){//check if zipcode has valid format
        add_action( 'login_head', 'wp_shake_js', 12 );
		return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: Zip code has letters or format is incorrect' , 'baweic' ) );
    }
    else if($_POST["firstname"] == ''){ //make sure first name is not blank
        add_action( 'login_head', 'wp_shake_js', 12 );
		return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: Please enter your first name.' , 'baweic' ) );
    }
    else if($_POST["lastname"] == ''){// make sure last name is not blank
        add_action( 'login_head', 'wp_shake_js', 12 );
		return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: Please enter your last name.' , 'baweic' ) );
    }
    else if($_POST["address"] == ''){// make sure address is not blank
        add_action( 'login_head', 'wp_shake_js', 12 );
		return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: Please enter your address.' , 'baweic' ) );
    }
    else if($_POST["city"] == ''){// make sure city is not blank
        add_action( 'login_head', 'wp_shake_js', 12 );
		return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: Please enter your city.' , 'baweic' ) );
    }
    else if($_POST["state"] == '0'){// make sure a state is selected
        add_action( 'login_head', 'wp_shake_js', 12 );
		return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: Please select a state.' , 'baweic' ) );
    }
	//do the following checks if someone is registering as a teacher
    else if($_GET['role']=='teachers'|$_POST['role']=='teachers'|$_POST["roleset"]=='teachers'){
/*    	if(!isset($_POST["grades"])){
        	add_action( 'login_head', 'wp_shake_js', 12 );
			return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: Please check grade levels you are teaching.' , 'baweic' ) );
    	}*/
    	if($_POST["subjects"] == '' && !isset($_POST["subjectsNA"])){
        	add_action( 'login_head', 'wp_shake_js', 12 );
			return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: Please enter subjects you are teaching.' , 'baweic' ) );
    	}
    	else if(!preg_match("/^([1]-)?[0-9]{3}-[0-9]{3}-[0-9]{4}$/i", $_POST["school_phonenumber"], $matches)){
        	add_action( 'login_head', 'wp_shake_js', 12 );
			return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: School phone number has letters or input format is incorrect or is blank' , 'baweic' ) );
    	}
    	else if(!preg_match("/^([0-9]{5})(-[0-9]{4})?$/i",$_POST["school_zipcode"])){
        	add_action( 'login_head', 'wp_shake_js', 12 );
			return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: School zip code has letters or format is incorrect or is blank' , 'baweic' ) );
    	}
    	else if($_POST["school_address"] == ''){
        	add_action( 'login_head', 'wp_shake_js', 12 );
			return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: Please enter your schools\' address.' , 'baweic' ) );
    	}
    	else if($_POST["school_city"] == ''){
        	add_action( 'login_head', 'wp_shake_js', 12 );
			return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: Please enter your schools\' city.' , 'baweic' ) );
    	}
    	else if($_POST["school_state"] == '0'){
        	add_action( 'login_head', 'wp_shake_js', 12 );
			return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: Please select a schools\' state.' , 'baweic' ) );
    	}
		//if school state is California, make the following checks
		else if($_POST["school_state"] != '0'){
			//check to see if addschool is filled in
			if($_POST["addschool"] != ''){
				if($_POST["countyselect2"] == '0'){ //
					add_action( 'login_head', 'wp_shake_js', 12 );
					return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: Please select a county from the Add School dropdown.' , 'baweic' ) );
				}
				else if($_POST["schooltype"] == ''){//if school type is not selected return error
					add_action( 'login_head', 'wp_shake_js', 12 );
					return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: Please select a school type.' , 'baweic' ) );
				}
				else if($_POST["schooltype"] == 'Public'){//if school type is public make sure district is selected
					if($_POST["districtselect2"] == '0'){
						add_action( 'login_head', 'wp_shake_js', 12 );
						return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: Please select a district from the Add School dropdown.' , 'baweic' ) );
					}
				}
			}
		}
		else{
    	}
    }
    else if($_GET['role']=='itstaff'|$_POST['role']=='itstaff'|$_POST["roleset"]=='itstaff'){
		if($_POST["numcomputers"] == ''){
			add_action( 'login_head', 'wp_shake_js', 12 );
			return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: Please enter the total number of computers in the labs.' , 'baweic' ) );
		}
    	if(!isset($_POST["osv"])){
        	add_action( 'login_head', 'wp_shake_js', 12 );
			return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: Please check OS versions in your labs.' , 'baweic' ) );
    	}
    	else if(!preg_match("/^([1]-)?[0-9]{3}-[0-9]{3}-[0-9]{4}$/i", $_POST["school_phonenumber"], $matches)){
        	add_action( 'login_head', 'wp_shake_js', 12 );
			return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: Phone number has letters or input format is incorrect' , 'baweic' ) );
    	}
    	else if(!preg_match("/^([0-9]{5})(-[0-9]{4})?$/i",$_POST["school_zipcode"])){
        	add_action( 'login_head', 'wp_shake_js', 12 );
			return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: Zip code has letters or format is incorrect' , 'baweic' ) );
    	}
    	else if($_POST["school_address"] == ''){
        	add_action( 'login_head', 'wp_shake_js', 12 );
			return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: Please enter your address.' , 'baweic' ) );
    	}
    	else if($_POST["school_city"] == ''){
        	add_action( 'login_head', 'wp_shake_js', 12 );
			return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: Please enter your city.' , 'baweic' ) );
    	}
    	else if($_POST["school_state"] == '0'){
        	add_action( 'login_head', 'wp_shake_js', 12 );
			return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: Please select a state.' , 'baweic' ) );
    	}
		//if school state is California, make the following checks
		else if($_POST["school_state"] == 'CA'){
			//check to see if addschool is filled in
			if($_POST["addschool"] != ''){
				if($_POST["countyselect2"] == '0'){ //
					add_action( 'login_head', 'wp_shake_js', 12 );
					return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: Please select a county from the Add School dropdown.' , 'baweic' ) );
				}
				else if($_POST["schooltype"] == ''){//if school type is not selected return error
					add_action( 'login_head', 'wp_shake_js', 12 );
					return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: Please select a school type.' , 'baweic' ) );
				}
				else if($_POST["schooltype"] == 'Public'){//if school type is public make sure district is selected
					if($_POST["districtselect2"] == '0'){
						add_action( 'login_head', 'wp_shake_js', 12 );
						return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: Please select a district from the Add School dropdown.' , 'baweic' ) );
					}
				}
			}
			//addschool is not filled in so check the three dropdowns, county, district, school
			else{
				if($_POST["countyselect"] == '0'){
					add_action( 'login_head', 'wp_shake_js', 12 );
					return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: Please select a county from the dropdown.' , 'baweic' ) );
				}
				else if($_POST["districtselect"] == '0'){
					add_action( 'login_head', 'wp_shake_js', 12 );
					return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: Please select a district from the dropdown.' , 'baweic' ) );
				}
			}
		}
		else if($_POST["school_state"] != 'CA'){
    		if($_POST["county"] == ''){
     			add_action( 'login_head', 'wp_shake_js', 12 );
				return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: Please enter your county.' , 'baweic' ) );
    		}
			else if($_POST["district"] == ''){
        		add_action( 'login_head', 'wp_shake_js', 12 );
				return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: Please enter your district.' , 'baweic' ) );
    		}
			else{
			}
		}
		else{
    	}
    }
    else if(($_GET['role']=='students')|($_POST['role']=='students')|($_POST["roleset"]=='students')){
		if($_POST["orgschoolname"] == ''){
				add_action( 'login_head', 'wp_shake_js', 12 );
			return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: Please enter your organization or school name.' , 'baweic' ) );
		 }
		else if($_POST["subjects"] == ''){
				add_action( 'login_head', 'wp_shake_js', 12 );
			return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: Please enter subjects you are learning.' , 'baweic' ) );
			}
		}
		else if(($_GET['role']=='judges')|($_POST['role']=='judges')|($_POST["roleset"]=='judges')){
		if($_POST["orgschoolname"] == ''){
				add_action( 'login_head', 'wp_shake_js', 12 );
			return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: Please enter your organization or school name.' , 'baweic' ) );
		 }
    }
    else if( ($_GET['role']=='jcuniversities') | ($_POST['role']=='jcuniversities') | ($_POST["roleset"]=='jcuniversities') ) {
        if($_POST["subjects"] == ''){
            add_action( 'login_head', 'wp_shake_js', 12 );
            return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: Please enter subjects you are teaching.' , 'baweic' ) );
        }
        else if(!preg_match("/^([1]-)?[0-9]{3}-[0-9]{3}-[0-9]{4}$/i", $_POST["college_phonenumber"], $matches)){
            add_action( 'login_head', 'wp_shake_js', 12 );
            return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: College University phone number has letters or input format is incorrect' , 'baweic' ) );
        }
        else if($_POST["college_address"] == ''){
            add_action( 'login_head', 'wp_shake_js', 12 );
            return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: Please enter your college/university\'s address.' , 'baweic' ) );
        }
        else if(!preg_match("/^([0-9]{5})(-[0-9]{4})?$/i",$_POST["college_zipcode"])){
            add_action( 'login_head', 'wp_shake_js', 12 );
            return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: College/University zip code has letters or format is incorrect' , 'baweic' ) );
        }

        else if($_POST["college_state"] == '0'){
            add_action( 'login_head', 'wp_shake_js', 12 );
            return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: Please select your college/university\'s state.' , 'baweic' ) );
        }

        if($_POST["addcollege"] != ''){
            if($_POST["cityselect2"] == '0'){ //
                add_action( 'login_head', 'wp_shake_js', 12 );
                return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: Please select your college/university\'s city from the Add College or University dropdown.' , 'baweic' ) );
            }
        }
        //addschool is not filled in so check the three dropdowns, county, district, school
        else{
            if($_POST["cityselect"] == '0'){
                add_action( 'login_head', 'wp_shake_js', 12 );
                return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: Please select your college/university\'s city from the dropdown.' , 'baweic' ) );
            }
            if($_POST["collegeselect"] == '0'){ //
                add_action( 'login_head', 'wp_shake_js', 12 );
                return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: Please select a college from the dropdown.' , 'baweic' ) );
            }
        }
    } // if: jc/university teacher

    else{
    	if($_POST["subjects"] == ''){
        	add_action( 'login_head', 'wp_shake_js', 12 );
		return new WP_Error( 'authentication_failed', __('<strong>ERROR</strong>: Please enter subjects you are learning or teaching.' , 'baweic' ) );
    	}
    }
	return $errors;

}
add_filter( 'registration_errors', 'modreg_registration_errors', 999, 3 );


function modreg_register($user_id){
    global $wpdb;
    if($_POST["roleset"]!=""){
    	$urole = $_POST["roleset"];
    } else {
    	$urole = $_POST['role'];
    }
    $fname = $_POST["firstname"];
    $lname = $_POST["lastname"];
    $unumber = $_POST["phonenumber"];
    $uaddress = $_POST["address"];
    $ucity = $_POST["city"];
    $ustate = $_POST["state"];
    $uzip = $_POST["zipcode"];
    $usub = $_POST["subjects"];
    $usub_NA = $_POST["subjectsNA"];
    $ugradesteach = $_POST["grades"];
	$gradesteach = $ugradesteach[0];
	for ($i = 1; $i <= 2; $i++) {
		if(!empty($ugradesteach[$i])){
			$gradesteach = $gradesteach. "," . $ugradesteach[$i] ;
		}
	}
    $educator = implode($_POST["educator"]);
    $uorgschoolname = $_POST["orgschoolname"];
    $utitle = $_POST["title"];
    $usnumber = $_POST["school_phonenumber"];
    $usaddress = $_POST["school_address"];
    $uscity = $_POST["school_city"];
    $usstate = $_POST["school_state"];
    $uszip = $_POST["school_zipcode"];
    $ncomp = $_POST["numcomputers"];
    $uosv = $_POST["osv"];
	$osv = $uosv[0];
	for ($i = 1; $i <= 3; $i++) {
		if(!empty($uosv[$i])){
			$osv = $osv. "," . $uosv[$i] ;
		}
	}
	$addschool = $_POST["addschool"];

    /* JC / University Fields */
    $ucnumber = $_POST["college_phonenumber"];
    $ucaddress = $_POST["college_address"];
    $ucstate = $_POST["college_state"];
    $uczip = $_POST["college_zipcode"];
    $addcollege = $_POST["addcollege"];

    wp_update_user( array ('ID' => $user_id, 'role' => $urole,'first_name' => $fname, 'last_name' =>$lname) );
    add_user_meta( $user_id, 'wp_phone_number', $unumber);
    add_user_meta( $user_id, 'wp_address', $uaddress);
    add_user_meta( $user_id, 'wp_city', $ucity);
    add_user_meta( $user_id, 'wp_state', $ustate);
    add_user_meta( $user_id, 'wp_zipcode', $uzip);
    add_user_meta( $user_id, 'wp_title', $utitle);
    if (!$usub_NA)
        add_user_meta( $user_id, 'wp_subjects', $usub);
    add_user_meta( $user_id, 'wp_subjects_na', $usub_NA);

    // Save Teacher Specific Fields
    if($urole == 'teachers'|$urole == 'itstaff'){
			if($addschool != ''){//Teacher is adding a school
				$county=$_POST["countyselect2"];
				$schooltype=$_POST["schooltype"];
				$district=$_POST["districtselect2"];
				//no matter public, private, or charter, must be part of a county so...
				$cresults=$wpdb->get_var($wpdb->prepare("SELECT name FROM `wp_sdd_county` WHERE county_id = %d;", $county));
				if($schooltype =='Public'){//must have a district if public
					$dresults=$wpdb->get_var($wpdb->prepare("SELECT name FROM `wp_sdd_district` WHERE district_id = %d;", $district));
					//add school to district
					//wp_sdd_school has a school_id, district_id, name
					$sql = $wpdb->prepare( "INSERT INTO `wp_sdd_school` (`school_id`,`district_id`, `name`, `custom`) VALUES (NULL,%d,%s,TRUE);", $district, $addschool);
					$wpdb->query($sql);
					//retrieve school id
					$school = $wpdb->get_var($wpdb->prepare("SELECT school_id FROM `wp_sdd_school` WHERE district_id = %d AND name = %s;", $district, $addschool));
					$sresults=$wpdb->get_var($wpdb->prepare("SELECT name FROM `wp_sdd_school` WHERE school_id = %d;", $school));
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
			}
			else{//School is already in database
				$county=$_POST['countyselect'];
				$district=$_POST['districtselect'];
				$school=$_POST['schoolselect'];
				//got the county, district, school ids, so query for the name
				$cresults=$wpdb->get_var($wpdb->prepare("SELECT name FROM `wp_sdd_county` WHERE county_id = %d;", $county));
				$dresults=$wpdb->get_var($wpdb->prepare("SELECT name FROM `wp_sdd_district` WHERE district_id = %d;", $district));
				$sresults=$wpdb->get_var($wpdb->prepare("SELECT name FROM `wp_sdd_school` WHERE school_id = %d;", $school));
			}
		if ($educator != "County Administrator" && $educator != "District Administrator")
            add_user_meta( $user_id, 'wp_school_id', $school);//add school id to user meta
		if ($educator != "County Administrator")
            add_user_meta( $user_id, 'wp_district_id', $district);//add district id to user meta
		add_user_meta( $user_id, 'wp_county_id', $county);//add county id to user meta
		if ($educator != "County Administrator" && $educator != "District Administrator")
            add_user_meta( $user_id, 'wp_school', $sresults);//add school name to user meta
		if ($educator != "County Administrator")
            add_user_meta( $user_id, 'wp_district', $dresults);//add school district name to user meta
        add_user_meta( $user_id, 'wp_county', $cresults);//add school county name to user meta

		add_user_meta( $user_id, 'wp_school_phone_number', $usnumber);//add school phone number to user meta
		add_user_meta( $user_id, 'wp_school_address', $usaddress);//add school address to user meta
		add_user_meta( $user_id, 'wp_school_city', $uscity);//add school city to user meta
		add_user_meta( $user_id, 'wp_school_state', $usstate);//add school state to user meta
		add_user_meta( $user_id, 'wp_school_zipcode', $uszip);//add school zipcode to user meta
	}
    else if($urole == 'jcuniversities') {
        /* JC University fields */
        if($addcollege != '') {//Teacher is adding a school
            $cityID=$_POST['cityselect2'];
            $cityresults=$wpdb->get_var($wpdb->prepare("SELECT city FROM `wp_cities` WHERE cityID = %d;", $cityID));

            // add college to DB
            // wp_colleges has fields: institutionID_DB, institutionID_gov, institution_name, institution_cityID, custom
            $sql = $wpdb->prepare( "INSERT INTO `wp_colleges` (`institutionID_DB`,`institutionID_gov`, `institution_name`, `institution_cityID`, `custom`) VALUES (NULL, 0, %s, %d, TRUE);", $addcollege, $cityID);
            $wpdb->query($sql);

            // Now that DB updated institutionID_DB, get the ID, name
            $collegeID = $wpdb->get_var($wpdb->prepare("SELECT institutionID_DB FROM `wp_colleges` WHERE institution_name = %s and institution_cityID = %d;", $addcollege, $cityID));
            $collegeresults=$wpdb->get_var($wpdb->prepare("SELECT institution_name FROM `wp_colleges` WHERE institutionID_DB = %d;", $collegeID));
        }

        else {//School is already in database
            $collegeID=$_POST['collegeselect'];
            $cityID=$_POST['cityselect'];

            // Get names from ids
            $collegeresults=$wpdb->get_var($wpdb->prepare("SELECT institution_name FROM `wp_colleges` WHERE institutionID_DB = %d;", $collegeID));
            $cityresults=$wpdb->get_var($wpdb->prepare("SELECT city FROM `wp_cities` WHERE cityID = %d;", $cityID));

        }

        add_user_meta( $user_id, 'wp_school_id', $collegeID );
        add_user_meta( $user_id, 'wp_city_id', $cityID );
        add_user_meta( $user_id, 'wp_school', $collegeresults );
        add_user_meta( $user_id, 'wp_school_phone_number', $ucnumber);//add school phone number to user meta
        add_user_meta( $user_id, 'wp_school_address', $ucaddress);//add school address to user meta
        add_user_meta( $user_id, 'wp_school_city', $cityresults);//add school city to user meta
        add_user_meta( $user_id, 'wp_school_state', $ucstate);//add school state to user meta
        add_user_meta( $user_id, 'wp_school_zipcode', $uczip);//add school zipcode to user meta
    }
	else {
		add_user_meta( $user_id, 'wp_orgschoolname', $uorgschoolname);
    }
   	if($urole == 'itstaff'){
    	add_user_meta( $user_id, 'wp_numcomputers', $ncomp);
    	add_user_meta( $user_id, 'wp_osversions', $osv);
	}
   	if($urole == 'teachers'){
		add_user_meta( $user_id, 'wp_gradesteach', $gradesteach);
        add_user_meta( $user_id, 'wp_educator', $educator);
	}
}
add_action( 'user_register', 'modreg_register');


function my_scripts_method() {
    if ( !is_admin() ) {

        wp_enqueue_script(
            'custom-script',
            get_template_directory_uri() . '/js/tabs.js',
            array('jquery')
        );

        wp_enqueue_script('jquery-ui-tabs');
    }
}
add_action('wp_enqueue_scripts', 'my_scripts_method');
//AJAX Javascript for dropdowns
add_action( 'login_enqueue_scripts', 'my_action_javascript' );

function my_action_javascript() {
    if ( !is_admin() ) {
        wp_enqueue_script( 'regjs', plugins_url('/jq.reg.js', __FILE__));
    }
}
