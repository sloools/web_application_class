<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Music Library</title>
		<meta charset="utf-8" />
		<link href="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/5/music.jpg" type="image/jpeg" rel="shortcut icon" />
		<link href="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/labResources/music.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		<h1>My Music Page</h1>

		<!-- Ex 1: Number of Songs (Variables) -->
		<p>
			I love music.
			I have
			<?php
			$song_count = 5678;
			echo $song_count;
			?>
			total songs,
			which is over
			<?php
			$song_time = $song_count / 10;
			echo (int)$song_time ?>
			 hours of music!
		</p>

		<!-- Ex 2: Top Music News (Loops) -->
		<!-- Ex 3: Query Variable -->
		<div class="section">
			<h2>Billboard News</h2>
			<ol>
			<?php
				if(isset($_GET["newspages"])){
					$news_pages = $_GET["newspages"];
				}else{
					$news_pages = 5;
				}

					for($i = 0; $i < $news_pages; $i++) {?>
						<li><a href="https://www.billboard.com/archive/article/2019<?= 11-$i ?>">2019-<?= 11-$i ?></a></li>
			<?php }	?>

 			</ol>

		</div>

		<!-- Ex 4: Favorite Artists (Arrays) -->
		<!-- Ex 5: Favorite Artists from a File (Files) -->
		<div class="section">
			<h2>My Favorite Artists</h2>

			<ol>
				<?php
					//$array = array("Guns N' Roses", "Green Day", "Blink 182");
					$array = file("./favorite.txt");
					for($j=0; $j<count($array); $j++){ ?>
						<li><a href="http://en.wikipedia.org/wiki/<?= $array[$j] ?>"><?= $array[$j]; ?></a></li>
				<?php } ?>
			</ol>
		</div>

		<!-- Ex 6: Music (Multiple Files) -->
		<!-- Ex 7: MP3 Formatting -->
		<div class="section">
			<h2>My Music and Playlists</h2>
			<?php $mp3 = glob("./lab5/musicPHP/songs/*.mp3");
			//print_r($mp3);
				foreach($mp3 as $mp3_song){
					$song_name = explode("/", $mp3_song)[4];
					$size_mp3 = filesize($mp3_song)/1024;
					$mp3_song_list[$song_name] = (int)$size_mp3; #연관배열 새로 만들어야함
				}
				arsort($mp3);
				//print_r($mp3);
			?>

			<ul id="musiclist">

					<?php foreach($mp3_song_list as $mp3_list => $size){
						$mp3_list_basename = basename($mp3_list);
						?>
						<li class="mp3item">
							<a href="href=lab5/musicPHP/songs/<?= $mp3_list_basename; ?>"><?= $mp3_list ?></a>(<?= $size ?> KB)
						</li>
					<?php } ?>
					<!-- <a href="lab5/musicPHP/songs/paradise-city.mp3">paradise-city.mp3</a> -->


				<!-- <li class="mp3item"> -->
					<!-- <a href="lab5/musicPHP/songs/basket-case.mp3">basket-case.mp3</a> -->
				<!-- </li> -->

				<!-- <li class="mp3item"> -->
					<!-- <a href="lab5/musicPHP/songs/all-the-small-things.mp3">all-the-small-things.mp3</a> -->
				<!-- </li> -->

				<!-- Exercise 8: Playlists (Files) -->

				<?php $m3u = glob("./lab5/musicPHP/songs/*.m3u");

					foreach($m3u as $m3u_files){
							$m3u_basename = basename($m3u_files);
							?>
				 			<li class="playlistitem"><?= $m3u_basename; ?> : </li>
				 					<?php $m3u_files_inside = file("./lab5/musicPHP/songs/$m3u_basename");
									sort($m3u_files_inside);
									shuffle($m3u_files_inside);?>

									<?php foreach($m3u_files_inside as $except_comment){
										$indexOfhash = strpos($except_comment, "#");
										 ?>
									<ul type="disc">

										<?php
										if($indexOfhash === false){ ?>
												<li><?= $except_comment ?></li>
										<?php }
										?>
									</ul>
						  <?php }
						} ?>

						<!-- <li>Basket Case.mp3</li>
						<li>All the Small Things.mp3</li>
						<li>Just the Way You Are.mp3</li>
						<li>Pradise City.mp3</li>
						<li>Dreams.mp3</li> -->

			</ul>
		</div>

		<div>
			<a href="https://validator.w3.org/check/referer">
				<img src="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/w3c-html.png" alt="Valid HTML5" />
			</a>
			<a href="https://jigsaw.w3.org/css-validator/check/referer">
				<img src="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/w3c-css.png" alt="Valid CSS" />
			</a>
		</div>
	</body>
</html>
