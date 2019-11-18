<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Grade Store</title>
		<link href="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/labResources/gradestore.css" type="text/css" rel="stylesheet" />
	</head>

	<body>

		<?php
		# Ex 4 :
		# Check the existence of each parameter using the PHP function 'isset'.
		# Check the blankness of an element in $_POST by comparing it to the empty string.
		# (can also use the element itself as a Boolean test!)

		$parm = array("name", "id", "grade", "card", "kindOfcard");

		if(!empty($_POST['cbox'])){
			$array = $_POST['cbox'];
			$courses = processCheckbox($array);
		}

		$fillOutCheck = true;
		foreach ($parm as $value) {
			if(empty($_POST['cbox']) || !isset($_POST[$value]) || $_POST[$value] == "")
			$fillOutCheck = false;
		}
			if(!$fillOutCheck){
		?>

		<!-- Ex 4 :
			Display the below error message :-->

			<h1>Sorry</h1>
			<p>You didn't fill out the form completely. <a href="./gradestore.html">Try again?</a></p>


		<?php
		# Ex 5 :
		# Check if the name is composed of alphabets, dash(-), ora single white space.

	} elseif (!preg_match("/^[a-zA-z]+[ \-]*[a-zA-z]+$/", $_POST['name'])) {
		?>

		<!-- Ex 5 :
			Display the below error message :-->
			<h1>Sorry</h1>
			<p>You didn't provide a valid name. <a href="./gradestore.html">Try again?</a></p>


		<?php
		# Ex 5 :
		# Check if the credit card number is composed of exactly 16 digits.
		# Check if the Visa card starts with 4 and MasterCard starts with 5.
	} elseif (!(strlen($_POST['card']) == 16 && ($_POST['kindOfcard'] == "Visa" && preg_match("/^4/",$_POST['card'])) || ($_POST['kindOfcard'] == "MasterCard" && preg_match("/^5/",$_POST['card'])))) {

		?>

		<!-- Ex 5 :
			Display the below error message :-->
			<h1>Sorry</h1>
			<p>You didn't provide a valid credit card number. <a href="./gradestore.html">Try again?</a></p>


		<?php
		 #if all the validation and check are passed
	 		}else {

		?>
		<?php
			$name = $_POST['name'];
			$id = $_POST['id'];
			$card = $_POST['card'];
			$kindOfcard = $_POST['kindOfcard'];
		 ?>
		<h1>Thanks, looser!</h1>
		<p>Your information has been recorded.</p>

		<!-- Ex 2: display submitted data -->
		<ul>
			<li>Name: <?= $name?> </li>
			<li>ID: <?= $id?></li>
			<!-- use the 'processCheckbox' function to display selected courses -->
			<li>Course: <?= $courses ?>	</li>
			<li>Grade: <?= $_POST['grade']?></li>
			<li>Credit <?= $card ?>  (<?= $kindOfcard ?>)</li>
		</ul>

		<!-- Ex 3 :
			<p>Here are all the loosers who have submitted here:</p> -->
		<?php
			$filename = "loosers.txt";
			file_put_contents($filename, $name.";", FILE_APPEND);
			file_put_contents($filename, $id.";", FILE_APPEND);
			file_put_contents($filename, $card.";", FILE_APPEND);
			file_put_contents($filename, $kindOfcard.";\n", FILE_APPEND);
			/* Ex 3:
			 * Save the submitted data to the file 'loosers.txt' in the format of : "name;id;cardnumber;cardtype".
			 * For example, "Scott Lee;20110115238;4300523877775238;visa"
			 */
		?>

		<!-- Ex 3: Show the complete contents of "loosers.txt".
			 Place the file contents into an HTML <pre> element to preserve whitespace -->
		<pre><?= file_get_contents($filename) ?></pre>

		<?php
		 }
		?>

		<?php
			/* Ex 2:
			 * Assume that the argument to this function is array of names for the checkboxes ("cse326", "cse107", "cse603", "cin870")
			 *
			 * The function checks whether the checkbox is selected or not and
			 * collects all the selected checkboxes into a single string with comma separation.
			 * For example, "cse326, cse603, cin870"
			 */

			function processCheckbox($names){
				$last_index = count($names);
				$answer = "";
				foreach ($names as $keys => $value) {
					if(!($keys == $last_index-1)){
						$answer .= $value.", ";
					}else{
						$answer .= $value;
					}
				}
				return $answer;
			}

		?>

	</body>
</html>
