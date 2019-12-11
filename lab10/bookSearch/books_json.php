<?php
$BOOKS_FILE = "books.txt";

function filter_chars($str) {
	return preg_replace("/[^A-Za-z0-9_]*/", "", $str);
}

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "GET") {
	header("HTTP/1.1 400 Invalid Request");
	die("ERROR 400: Invalid request - This service accepts only GET requests.");
}

$category = "";
$delay = 0;

if (isset($_REQUEST["category"])) {
	$category = filter_chars($_REQUEST["category"]);
}
if (isset($_REQUEST["delay"])) {
	$delay = max(0, min(60, (int) filter_chars($_REQUEST["delay"])));
}

if ($delay > 0) {
	sleep($delay);
}

if (!file_exists($BOOKS_FILE)) {
	header("HTTP/1.1 500 Server Error");
	die("ERROR 500: Server error - Unable to read input file: $BOOKS_FILE");
}

header("Content-type: application/json");

print "{\n  \"books\": [\n";

// write a code to :
// 1. read the "books.txt"
// 2. search all the books that matches the given category
// 3. generate the result in JSON data format

$lines = file($BOOKS_FILE); // array 로 변환됨
$arr = array();
for($i = 0; $i < count($lines); $i++){
	list($title, $author, $book_category, $year, $price) = explode("|", trim($lines[$i])); // trim : 앞뒤 여백 제거
	// file의 한 줄을 읽어와서 "|"로 나누어주고 배열값을 각각의 변수로 반환해준다.
	if ($book_category === $category){
		array_push($arr, "\t{\"category\": \"$book_category\", \"title\": \"$title\", \"author\": \"$author\", \"year\": \"$year\", \"price\": \"$price\"}");
	}


	// if ($book_category === $category) {
	// 	print "\t{\"category\": \"$book_category\", ";
	// 	print "\"title\": \"$title\", ";
	// 	print "\"author\": \"$author\", ";
	// 	print "\"year\": \"$year\", ";
	// 	if($i == count($lines)-1){
	// 			print "\"price\": \"$price\"}\n";
	// 	}else{
	// 			print "\"price\": \"$price\"},\n";
	// 	}

}
print implode(",\n", $arr);
print "\n";

print "  ]\n}\n";

?>
