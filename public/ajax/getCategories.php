<?php
$Action = $_GET['Action'];

$connectionID = mysqli_connect('localhost', 'www',null, 'siyaleader_dbnports_live') or die ("Unable to connect to database.");
//$connectionID = mysqli_connect('localhost', 'root','elie', 'port') or die ("Unable to connect to database.");


if($Action == "getSubCats")
	{
		$Category = $_GET['Category'];
		$sql = "
					SELECT
					    `id`,
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
				$subCats[$row[0]]=array($row[1]);
			}
		print json_encode($subCats);
	}

if($Action == "getSubSubCats")
	{
		$subCategory = $_GET['subCategory'];
		$sql         = "
							SELECT
							    `id`,
								`name`
							FROM
								`sub-sub-categories`
							WHERE
								`sub_category` = '{$subCategory}'

							ORDER by `name` ASC
						";
		$result      = mysqli_query($connectionID, $sql) or die ("Couldn't query sub sub categories ... ...");
		$subSubCats  = array();
		while($row = mysqli_fetch_row($result))
		{
			$subSubCats[$row[0]]=array($row[1]);
		}
		print json_encode($subSubCats);
	}


?>
