<?php



$connectionID = mysqli_connect('localhost', 'www',null, 'siyaleader_dbnports_live') or die ("Unable to connect to database.");

 //$connectionID = mysqli_connect('localhost', 'root','elie', 'port') or die ("Unable to connect to database.");


if(isset($_POST['ACTION']))  {  $ACTION = $_POST['ACTION'];  }  else if(isset($_GET['ACTION']))  {  $ACTION = $_GET['ACTION'];  } else  {  $ACTION = "";  }


if(isset($_POST['name']))  {

	$name  = $_POST['name'];

}  else if(isset($_GET['name']))  {

	$name = $_GET['name'];

} else  {

	$name = "";

}

if(isset($_POST['surname']))  {

	$surname  = $_POST['surname'];

}  else if(isset($_GET['surname']))  {

	$surname = $_GET['surname'];

} else  {

	$surname = "";

}


if(isset($_POST['cell']))  {

	$cellphone  = $_POST['cell'];

}  else if(isset($_GET['cell']))  {

	$cellphone = $_GET['cell'];

} else  {

	$cellphone = "";

}

if(isset($_POST['addressbook']))  {

	$addressbook  = $_POST['addressbook'];

}  else if(isset($_GET['addressbook']))  {

	$addressbook = $_GET['addressbook'];

} else  {

	$addressbook = "";

}




$status = "Pending";

if(isset($_POST['userId']))  {

	$user = $_POST['userId'];

	$deptSql    = "
					SELECT
						`department`
					FROM
						`users`
					WHERE
						`id` = '{$user}'
				  ";
	$deptResult = mysqli_query($connectionID, $deptSql) or die ("Couldn't User DB ... ...");

	while($rowDepartment = mysqli_fetch_row($deptResult)) {

	  $department = $rowDepartment[0];

	}


}  else if(isset($_GET['userId']))  {

	$user = $_GET['userId'];

	$deptSql    = "
					SELECT
						`department`
					FROM
						`users`
					WHERE
						`id` = '{$user}'
				  ";
	$deptResult = mysqli_query($connectionID, $deptSql) or die ("Couldn't query department DB ... ...");

	while($rowDepartment = mysqli_fetch_row($deptResult)) {

	  $department = $rowDepartment[0];

	}

 } else  {

 	$user = "";

 }


if(isset($_POST['precinct']))  {

	$precinct = $_POST['precinct'];

}  else if(isset($_GET['precinct']))  {

		$precinct = $_GET['precinct'];
 } else  {
 		$precinct = "";

 }


if(isset($_POST['category']))  {

	$category = $_POST['category'];


	$catSql   = "
					SELECT
						`name`
					FROM
						`categories`
					WHERE
						`id` = '{$category}'
				  ";
	$catResult = mysqli_query($connectionID, $catSql) or die ("Couldn't query category DB ... ...");

	while($rowCategory = mysqli_fetch_row($catResult)) {

	  $categoryName = $rowCategory[0];

	}




}  else if(isset($_GET['category']))  {

	$category = $_GET['category'];

 } else  {

 	$category = "";
}



if(isset($_POST['sub_category']))  {

	$sub_category = $_POST['sub_category'];

}  else if(isset($_GET['sub_category']))  {

	$sub_category = $_GET['sub_category'];

} else  {

	$sub_category = "";
}


if(isset($_POST['sub_sub_category']))  {

	$sub_sub_category = $_POST['sub_sub_category'];

}  else if(isset($_GET['sub_sub_category']))  {

	$sub_sub_category = $_GET['sub_sub_category'];

} else  {

	$sub_sub_category = "";
}



if(isset($_POST['priority']))  {

	$priority = $_POST['priority'];

}  else if(isset($_GET['priority']))  {

	$priority = $_GET['priority'];

} else  {

	$priority = "";
}



if(isset($_POST['description']))  {

	$description = $_POST['description'];

}  else if(isset($_GET['description']))  {

	$description = $_GET['description'];

} else  {

	$description = "";

}


if(isset($_POST['GPS']))  {

	$GPS    = explode(',',$_POST['GPS']);
	$gps_lat = $GPS[0];
	$gps_lng = $GPS[1];

}  else if(isset($_GET['GPS']))  {

	$GPS    = explode(',',$_GET['GPS']);
	$gps_lat = $GPS[0];
	$gps_lng = $GPS[1];

} else  {

	$gps_lat = "";
	$gps_lng = "";

}



if($ACTION == "")
{

?>

<html>
<head>
<title>Siyaleader Ports Case Capture</title>
<meta charset="utf-8" / http-equiv="X-UA-Compatible" content="IE=edge" />
<link rel="stylesheet" type="text/css" href="incl/animate.css">
<link rel="stylesheet" type="text/css" href="css/token-input.css" >
<link rel="stylesheet" type="text/css" href="incl/siyaleader_ports.css">
<link rel="stylesheet" href="incl/font-awesome.min.css">
<script type="text/javascript" src="incl/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.tokeninput.js"></script>
<script type="text/javascript" src="incl/siyaleader_ports_functions.js"></script>
<script language=javascript>

$(document).ready(function(){
	var userID = $("#userID",window.parent.document).val();
	$("#userId").val(userID);

})

String.prototype.toTitleCase = function(){
var smallWords = /^(a|an|and|as|at|but|by|en|for|if|in|nor|of|on|or|per|the|to|vs?\.?|via)$/i;
return this.replace(/[A-Za-z0-9\u00C0-\u00FF]+[^\s-]*/g, function(match, index, title){
if (index > 0 && index + match.length !== title.length &&
  match.search(smallWords) > -1 && title.charAt(index - 2) !== ":" &&
  (title.charAt(index + match.length) !== '-' || title.charAt(index - 1) === '-') &&
  title.charAt(index - 1).search(/[^\s-]/) < 0) {
  return match.toLowerCase();
}

if (match.substr(1).search(/[A-Z]|\../) > -1) {
  return match;
}

return match.charAt(0).toUpperCase() + match.substr(1);
});
};

function checkInput(ob)
{
	var invalidChars = /[^0-9]/gi
		 if(invalidChars.test(ob.value))
						{
						ob.value = ob.value.replace(invalidChars,"");
					}
}

function toSentenceCase (val)
		{
					str = val;
					temp_arr = str.split('.');
					for (i = 0; i < temp_arr.length; i++)
							{
									temp_arr[i]=temp_arr[i].trim()
									temp_arr[i] = temp_arr[i].charAt(0).toUpperCase() + temp_arr[i].substr(1).toLowerCase();
							}
				str=temp_arr.join('. ') + '.';
				return str;
		}



</script>
</head>

<body ONLOAD="setCaptureBorder('#ffffff');document.getElementById('captureForm').reset();document.getElementById('ccg_nam').focus;" TEXT="#ffffff" LINK="#ffffff" VLINK="#ffffff" ALINK="#ffffff" style="margin:0;overflow:hidden;margin-bottom:0;margin-left:0;margin-right:0;margin-top:0">

<center>
<form id="captureForm" action="case_capture.php" method="post" style="margin:0px;padding:0px;">
<input type=hidden name=ACTION value="SUBMITCASE">
<input type="hidden" name="userId" id="userId">
<input type="hidden" name="repID" id="repID">
<input type="hidden" name="addressbook" id="addressbook">

<table id="captureContainer" border=0 cellpadding=4 cellspacing=0 style="font: 11pt 'Arial';color:#ffffff;border-collapse:collapse;border:1px solid #ffffff">
		<tr>
			<td valign=top align=center nowrap style="font: 11pt 'Arial';color:#FFFFFF">
				GPS COORDINATES<BR><input class="GPSField" type="text" id="GPS" name="GPS" title="GPS Coordinates" onfocus="this.blur()">
			</td>
		</tr>

		<tr style="font: 11pt 'Arial';color:#ffffff">

			<td valign=middle width="150px">
				<input type=text class="formField" id="cellphone" name="cellphone" style="text-align:center" placeholder="Reporter's Contact Number" onkeyup="checkInput(this)">
			</td>
		</tr>

		<tr style="font: 11pt 'Arial';color:#ffffff">

			<td valign=middle>
				<input type=text class="formField" id="cell" name="cell" style="text-align:center" placeholder="Reporter's Contact Number" onkeyup="checkInput(this)" disabled>
			</td>
		</tr>

		<tr style="font: 11pt 'Arial';color:#ffffff">

			<td valign=middle>
				<input type=text class="formField" id="name" name="name" style="text-align:center" placeholder="Reporter's First Name" onchange="this.value = this.value.toTitleCase()" disabled>
			</td>
		</tr><tr style="font: 11pt 'Arial';color:#ffffff">

			<td valign=middle>
				<input type=text class="formField" id="surname" name="surname" style="text-align:center" placeholder="Reporter's Surname" onchange="this.value = this.value.toTitleCase()" disabled>
			</td>
		</tr>

		<tr style="font: 11pt 'Arial';color:#ffffff">

			<td valign=middle>
				<select class="formField" id="precinct" name="precinct">
					<option id="#ffffff" value=""> Please select ...
<?php
					$precSql = "select id, name from municipalities order by name asc";
					$precResult = mysqli_query($connectionID, $precSql) or die ("Couldn't query precinct/municipalities DB ... ...");
					while($row = mysqli_fetch_row($precResult))
					{
					  echo "<option value='" .$row[0]. "'> " .$row[1];
					}
?>
				</select>
			</td>
		</tr><tr style="font: 11pt 'Arial';color:#ffffff">

			<td valign=middle>
				<select class="formField" id="category" name="category">
					<option id="#ffffff" value=""> Please select ...
<?php
					$catSql = "select * from categories order by name asc";
					$catResult = mysqli_query($connectionID, $catSql) or die ("Couldn't query categories DB ... ...");
					while($row = mysqli_fetch_row($catResult))
						{
							echo "<option id='" .$row[0]. "' value='" .$row[0]. "'> " .$row[2];
						}
?>
				</select>
			</td>
		</tr><tr style="font: 11pt 'Arial';color:#ffffff">

			<td valign=middle>
				<select class="formField" id="sub_category" name="sub_category">
				</select>
			</td>
		</tr><tr style="font: 11pt 'Arial';color:#ffffff">

			<td valign=middle>
				<select class="formField" id="sub_sub_category" name="sub_sub_category">
				</select>
			</td>
		</tr><tr style="font: 11pt 'Arial';color:#ffffff">
			<td valign=middle>
			 	<textarea name="description" class="formField" wrap="physical" style="resize:none;height:100px;text-align:left" placeholder="Case details ..." onchange="this.value=toSentenceCase(this.value)"></textarea>
			</td>
		</tr><tr style="font: 11pt 'Arial';color:#ffffff">
			<td valign=middle>
				Critical Emergency: &nbsp;<a href="#" onclick="switchPriority();this.blur()"><span id="prioritySpan" style="font-size:22px">&#9744;</span></a>
				&nbsp;
				<span id="severitySpan" style="display:none">
				<a href="#" onclick="setSeverity('4');this.blur()"><span id="severitySpan4" style="font-size:20px;color:#00FF00">&#9315;</span></a>
				<a href="#" onclick="setSeverity('3');this.blur()"><span id="severitySpan3" style="font-size:20px;color:#FFFF00">&#9314;</span></a>
				<a href="#" onclick="setSeverity('2');this.blur()"><span id="severitySpan2" style="font-size:20px;color:#ff7800">&#9313;</span></a>
				<a href="#" onclick="setSeverity('1');this.blur()"><span id="severitySpan1" style="font-size:20px;color:#FF0000">&#9312;</span></a>
				</span>
			</td>
		</tr>
	</table>

	<input type=hidden name="priority" id="priority" value="Normal">
	<input type=hidden name="severity" id="severity" value="5">
</form>

</body>
</html>

<?php
}
?>

<?php

if($ACTION == "SUBMITCASE")
{

	$repID  = $_POST['repID'];

if ($repID > 0) {


}
else {


	$addressbook = 1;
	$email       = $cellphone."@siyaleader.net";


	$sqlt = "
				INSERT
					INTO
						`addressbook`
								(
									`email`,
									`user`,
									`cellphone`,
									`FirstName`,
									`Surname`,
									`active`,
									`created_at`

								)  values (

									'$email',
									'$user',
									'$cellphone',
									'$name',
									'$surname',
									'1',
									 NOW()

								)
            ";

      var_dump($sqlt);

    $res       = mysqli_query($connectionID, $sqlt) or die ("Couldn't insert into Addressbook table ... ...");
	$repID     = mysqli_insert_id($connectionID);


}




	$sql = "
				INSERT
					INTO
						`cases`
								(

									`category`,
									`sub_category`,
									`sub_sub_category`,
									`priority`,
									`description`,
									`precinct`,
									`gps_lng`,
									`gps_lat`,
									`created_at`,
									`user`,
									`department`,
									`status`,
									`reporter`,
									`addressbook`

								)  values (

									'$category',
									'$sub_category',
									'$sub_sub_category',
									'$priority',
									'$description',
									'$precinct',
									'$gps_lng',
									'$gps_lat',
									 NOW(),
									 '$user',
									 '$department',
									 '$status',
									 '$repID',
									 '$addressbook'

								)
            ";

	$result    = mysqli_query($connectionID, $sql) or die ("Couldn't insert into problems table ... ...");
	$newCaseId = mysqli_insert_id($connectionID);

	// $sql = "select Position from siyaleader_dbnports_live.users where cellphone = '$ccg_mob'";

	//$pos_sql = "select name from `siyaleader_dbnports_live`.`positions` where `id` in (select position from `siyaleader_dbnports_live`.`users` where `cellphone` = '$ccg_mob')";
// echo $pos_sql;
	/*$pos_result = mysqli_query($connectionID, $pos_sql) or die ("Couldn't query users table ... ...");
	if($row = mysqli_fetch_row($pos_result))
			{
				$Position = $row[0];
			}
	 else 	{
				$Position = "Unregistered";
			}*/

	if($categoryName == "Maintenance (Civil)")  {  $imageCategory = "mc";   $infoBoxBorder = "#ffff00";   }
	if($categoryName == "Maintenance (Electrical)")  {  $imageCategory = "me";   $infoBoxBorder = "#ff33a6";  }
	if($categoryName == "Maintenance (Mechanical)")  {  $imageCategory = "ma";   $infoBoxBorder = "#fe940b";  }
	if($categoryName == "Maintenance (Marine)")  {  $imageCategory = "mm";   $infoBoxBorder = "#333dc7";  }
	if($categoryName == "House Keeping")  {  $imageCategory = "hk";   $infoBoxBorder = "#00ee00";  }
	if($categoryName == "Traffic Management")  {  $imageCategory = "tr";  $infoBoxBorder = "#0a0c28";  }
	if($categoryName == "Environment")  {  $imageCategory = "en";   $infoBoxBorder = "#009000";  }
	if($categoryName == "Health")  {  $imageCategory = "he";   $infoBoxBorder = "#0df1ff";  }
	if($categoryName == "Port Operations Centre")  {  $imageCategory = "po";   $infoBoxBorder = "#e1e1e1";  }
	if($categoryName == "Property")  {  $imageCategory = "pr";   $infoBoxBorder = "#999999";  }
	if($categoryName == "Safety-Risk-Fire")  {  $imageCategory = "sr";   $infoBoxBorder = "#ff0000";  }
	if($categoryName == "Security")  {  $imageCategory = "se";   $infoBoxBorder = "#8a1ec7";  }

	$newMarkerImage = "markers/" .$imageCategory. "_pen.png";
?>


<html>
<head>
<title>Case Capture Submission</title>
<script language=javascript>

var boxContent = "<div style='width:250px;height:200px;overflow-y:auto;overflow-x:hidden'>";
boxContent += "<table border=0 style='color:#ffd40e;width:235px' cellpadding=2 cellspacing=0>";
boxContent += "<tr><td align='left' valign='top' nowrap><B>Case No :</B></td><td align='left'><?php echo $newCaseId; ?></td></tr>";
boxContent += "<tr><td align='left' valign='top' nowrap><B>GPS :</B></td><td align='left'><?php echo $_POST['GPS']; ?></td></tr>"; // GPS coll
boxContent += "<tr><td align='left' valign='top' nowrap><B>Submitted :</B></td><td align='left'><?php echo date('Y-m-d H:i:s'); ?></td></tr>"; // submit_date coll
boxContent += "<tr><td align='left' valign='top' nowrap><B>Priority :</B></td><td align='left'><?php echo $priority; ?></td></tr>"; // prob_priority coll
boxContent += "<tr><td align='left' valign='top' nowrap><B>Category :</B></td><td align='left'><?php echo $category; ?></td></tr>"; // prob_category coll
boxContent += "<tr><td align='left' valign='top' nowrap><B>Status :</B></td><td align='left'>Pending</td></tr>"; // status coll
boxContent += "<tr><td align='left' valign='top' nowrap><B>Province :</B></td><td align='left'>KZN</td></tr>"; // Province coll
boxContent += "<tr><td align='left' valign='top' nowrap><B>Port :</B></td><td align='left'>Durban</td></tr>"; // District coll
boxContent += "<tr><td align='left' valign='top' nowrap><B>Precinct :</B></td><td align='left'><?php echo $precinct; ?></td></tr>";  // Municipality coll
boxContent += "<tr><td align='left' valign='top' nowrap><B>Reporter :</B></td><td align='left'><?php echo $ccg_nam. ' ' .$ccg_sur; ?></td></tr>";  // ccg_nam + ccg_sur
boxContent += "<tr><td align='left' valign='top' nowrap><B>Position :</B></td><td align='left'><?php echo $Position; ?></td></tr>";  // ccg_pos
boxContent += "<tr><td align='left' valign='top' nowrap><B>Contact No :</B></td><td align='left'><?php echo $ccg_mob; ?></td></tr>";  // ccg_mob
boxContent += "<tr><td align='left' valign='top' nowrap><B>Description :</B></td><td align='left'><?php echo $description; ?></td></tr>";  // prob_exp
boxContent += "<tr><td align='left' valign='top' nowrap><B>Last Activity :</B></td><td align='left'><?php echo date('Y-m-d H:i:s'); ?></td></tr>";  // Last person to have interacted on CMC
boxContent += "</table>";
boxContent += "</div>";
boxContent += "<table width=100% height=50 border=0 cellpadding=0 cellspacing=0><tr>";
boxContent += "<td align='center' valign='bottom'><a href='#' onclick='alert(\"Work in progress ... Watch this space ...\")'><img src='images/icon_trash.png' title='Remove Case' onmouseover='updateToolTip(\"Request for this case to be removed ...\")' onmouseout='updateToolTip(\"\")'></a></td>";
boxContent += "<td align='center' valign='bottom'><a href='#' onclick='alert(\"Work in progress ... Watch this space ...\")'><img src='images/icon_join.png' title='Combine Duplicate Case' onmouseover='updateToolTip(\"Combine this duplicated case with another ...\")' onmouseout='updateToolTip(\"\")'></a></td>";
boxContent += "<td align='center' valign='bottom'><a href='#' onclick='alert(\"Work in progress ... Watch this space ...\")'><img src='images/icon_weather.png' title='Weather Conditions' onmouseover='updateToolTip(\"View weather conditions for this case ...\")' onmouseout='updateToolTip(\"\")'></a></td>";
boxContent += "<td align='center' valign='bottom'><a href='#' onclick='alert(\"Work in progress ... Watch this space ...\")'><img src='images/icon_refer.png' title='Refer Case' onmouseover='updateToolTip(\"Refer this case to someone ...\")' onmouseout='updateToolTip(\"\")'></a></td>";
boxContent += "<td align='center' valign='bottom'><a href='#' onclick='showPhoto(\"\",\"<?php echo $infoBoxBorder; ?>\");killMenu();killLayerMenu()'><img id='photoIcon' src='images/icon_photo.png' title='View Photo' onmouseover='updateToolTip(\"View this case photo ...\")' onmouseout='updateToolTip(\"\")'></a></td>";
boxContent += "<td align='center' valign='bottom'><a href='#' onclick='killMenu();killLayerMenu();document.all.cmcFrame.src=\"http://www.siyaleader.co.za:8080/siyaleader-dbnports/live/CaseRequest/index.php?type=app&caller=&case=<?php echo $newCaseId; ?>&user=13&action=api&apiKey=52bd43d37ed62eb4c226e31841bc03dc\";showCMC()'><img src='images/icon_interact.png' title='Case Interaction' onmouseover='updateToolTip(\"Open this case in the Case Management Console ...\")' onmouseout='updateToolTip(\"\")'></a></td>";
boxContent += "</tr></table>";

</script>

</head>
<body ONLOAD="parent.captureSuccess('<?php echo $newCaseId; ?>','<?php echo $newMarkerImage; ?>','<?php echo $_POST['GPS']; ?>','<?php echo $infoBoxBorder; ?>','<?php echo $imageCategory; ?>',boxContent);location='case_capture.php';" TEXT="#ffffff" LINK="#ffffff" VLINK="#ffffff" ALINK="#ffffff" style="margin:0;overflow:hidden;margin-bottom:0;margin-left:0;margin-right:0;margin-top:0">

<!-- ONLOAD="location='case_capture.php'" -->

</body>

</html>


<?php
}
?>



