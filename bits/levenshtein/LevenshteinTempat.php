<?php 
									foreach ($queryArrayTempat as $tempat)
									{
											$kataTempat = $tempat['kata_tempat'];
											$lev = levenshtein($lower[$i], $kataTempat);
											if ($lev == 0) 
											{
												$closest[$i] = $kataTempat;
												$shortestTempat = 0;
												break;
											}
											if ($lev <= $shortestTempat || $shortestTempat < 0) 
											{	
												$closest[$i]  = $kataTempat;
												$mostClosest[$i] = rtrim($closest[$i]);
												$shortestTempat = $lev;
											}
									}
									if ($shortestTempat == 0) 
									{
											$results = $class->selectTokenKataTempat($closest[$i]);
											$htgTempat= mysql_num_rows($results);
											while ($row = mysql_fetch_array( $results ))
											{
													$idKataTempat = $row["idtempat"];
													$kt =  $row["kata_tempat"];
											}
											$mostClosest[$i] = rtrim($closest[$i]);
									} 
									else 
									{
											$count = strlen ($closest[$i]);
											$precentage = 30/100 * $count;
											if ($shortestTempat >$precentage)
											{
													//$htgTempat = $class->selectTokenKataTempat($lower[$i]);
													$results = $class->selectTokenKataTempat($lower[$i]);
													$htgTempat= mysql_num_rows($results);
													while ($row = mysql_fetch_array( $results ))
													{
															$idKataTempat = $row["idtempat"];
															$kt =  $row["kata_tempat"];
													}
													$mostLower[$i] = rtrim($lower[$i]);
											}
											else 
											{
													//$htgTempat = $class->selectTokenKataTempat($closest[$i]);
													$results = $class->selectTokenKataTempat($closest[$i]);
													$htgTempat= mysql_num_rows($results);
													while ($row = mysql_fetch_array( $results ))
													{
															$idKataTempat = $row["idtempat"];
															$kt =  $row["kata_tempat"];
													}
													$mostClosest[$i] = rtrim($closest[$i]);
											}
									}


?>