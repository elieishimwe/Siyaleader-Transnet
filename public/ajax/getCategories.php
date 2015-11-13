<?php
$Action = $_GET['Action'];


//$connectionID = mysqli_connect('localhost', 'www',null, 'siyaleader_dbnports_live') or die ("Unable to connect to database.");
 $connectionID = mysqli_connect('localhost', 'root','elie', 'port') or die ("Unable to connect to database.");


if($Action == "getSubCats")
	{
		$Category = $_GET['Category'];
		$sql = "
					SELECT
						`name`
					FROM
						`sub-categories`
					WHERE
						`category` = '{$Category}'

					ORDER by `name` ASC
				";
		$result = mysqli_query($connectionID, $sql) or die ("Couldn't query sub categories ... ...");

		$subCats = array();
		while($row = mysqli_fetch_row($result))
			{
				$subCats[]=array($row[0]);
			}
		print json_encode($subCats);
	}

if($Action == "getSubSubCats")
	{
		$subCategory = $_GET['subCategory'];
		$sql         = "
							SELECT
								`name`
							FROM
								`sub-sub-categories`
							WHERE
								`sub_category` =
												(
													SELECT
															`id`
													FROM
															`sub-categories`
													WHERE
															`name` = '{$subCategory}'
												)

							ORDER by `name` ASC
						";
		$result      = mysqli_query($connectionID, $sql) or die ("Couldn't query sub sub categories ... ...");
		$subSubCats  = array();
		while($row = mysqli_fetch_row($result))
		{
			$subSubCats[]=array($row[0]);
		}
		print json_encode($subSubCats);
	}


?>
