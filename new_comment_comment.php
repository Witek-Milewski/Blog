<?php
if ($rezultatt = $connectt->query("SELECT*FROM `comments` WHERE `post_id` = '$post_id' AND `if_comment_comment` = 'False' ORDER BY `id` DESC "))
					{
						$ilu_userowt = $rezultatt->num_rows;
						if($ilu_userowt>0)
						{	
							echo '<div class = "comments"/>';
								while ($rowt = $rezultatt->fetch_assoc())
								{
									$_SESSION['id_kolejnosc'] = $rowt['id'];
									$id = $_SESSION['id_kolejnosc'];
									$_SESSION["odpowiedz_na_komentarz.'$id'"] = $rowt['tresc'];
								}
						}
					}

?>