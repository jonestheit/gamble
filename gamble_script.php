<?php 

//This script is copyright 2003-2006-2016 Brian Jones
//Contact via www.newsway.co.uk
//Good luck

function PlayYear () {
//initialise
	$roll = 0;

	$count1=0;
	$count2=0;
	$count3=0;
	$count4=0;
	$count5=0;
	$count6=0;

	$CurrentLosingStreak=0;
	$CurrentWinningStreak=0;

	$MaxLosingStreak=0;
	$MaxWinningStreak=0;

	$tank4=0;
	$tank5=0;
	$tank6=0;

	$MinTank4=0;
	$MinTank5=0;
	$MinTank6=0;

	$MaxTank4=0;
	$MaxTank5=0;
	$MaxTank6=0;

	$tank4v=0;
	$tank5v=0;
	$tank6v=0;

	$Pocket4v=0;
	$Pocket5v=0;
	$Pocket6v=0;

	$MinTank4v=0;
	$MinTank5v=0;
	$MinTank6v=0;

	$MaxTank4v=0;
	$MaxTank5v=0;
	$MaxTank6v=0;

	$WorstOutlay4v=0;
	$WorstOutlay5v=0;
	$WorstOutlay6v=0;

	$NumberOfBets=($_SESSION["BetsPerWeek"] * $_SESSION["WeeksPerYear"]);
	$Bet=(round(($_SESSION["AnnualTarget"]/$NumberOfBets)) * 6/5);
	
	// if ($Bet > $_SESSION["LimitBet"]) {
		// echo "<script type='text/javascript'>alert('Cannot proceed because your level bet £" ,number_format($Bet), " would exceed your maximum bet of £" , number_format($_SESSION["LimitBet"])  , "');</script>";
	// }

	$AimToWin=(round(($_SESSION["AnnualTarget"]/$NumberOfBets)) * 6);
?>
<!--  ??????????????????????????????? Content of hidden page 2 ??????????????????????????????? -->
<div id="Page2" style="display:none;">
<div align="center">
<?php	
	
	If ($_SESSION["ShowAll"] == TRUE) {

	echo "<TABLE class='normaltable'>";
	echo "<TR><TH colspan='8'>This year, buying at odds of ", $_SESSION["ChosenOdds"], "</TH></TR>";
	echo "<TR><TH colspan='2'>Roll</TH><TH colspan='2'>Level bets</TH><TH style='border:none;'>&nbsp;</TH><TH colspan='3'>Variable bets</TH></TR>";
	echo "<TR><TH>count</TH><TH>dice</TH><TH>Level bet</TH><TH>Tank</TH><TH style='border:none;'>&nbsp;</TH><TH>Variable bet</TH><TH>Tank</TH><TH>Pocket</TH></TR>";
	}

//roll
	while ($roll < $NumberOfBets) {

		$dice = rand (1, 6);
		if ($_SESSION["LevelVariable"]=="Level") {
			if ($Bet > $_SESSION["LimitBet"]) {
				If (!isset($_SESSION["GoneBust"])) {
					$_SESSION["GoneBust"] = "Your fixed bet of &pound;". number_format($Bet) . " would exceed your maximum bet of &pound" . number_format($_SESSION["LimitBet"]) . ".<br>You cannot continue&#33;";
				}
			}
		}
		
	//Calculate variable bets for each roll
		$Bet4v=round(($AimToWin - $tank4v) / 4);
		$Bet5v=round(($AimToWin - $tank5v) / 5);
		$Bet6v=round(($AimToWin - $tank6v) / 6);
		
		if ($_SESSION["LevelVariable"]=="Variable") {
			switch ($_SESSION["ChosenOdds"]) {
				case "4/1":
					if ($Bet4v > $_SESSION["LimitBet"]) {
						If (!isset($_SESSION["GoneBust"])) {
							$_SESSION["GoneBust"] = "Your bet of &pound;" . number_format($Bet4v) . " at odds of ". $_SESSION["ChosenOdds"] . " would exceed your maximum bet of &pound" . number_format($_SESSION["LimitBet"]) . ".<br>You cannot continue&#33;";
						}
					}			
					break;
					
				case "5/1":
					if ($Bet5v > $_SESSION["LimitBet"]) {
						If (!isset($_SESSION["GoneBust"])) {
							$_SESSION["GoneBust"] = "Your bet of &pound;" . number_format($Bet5v) . " at odds of ". $_SESSION["ChosenOdds"] . " would exceed your maximum bet of &pound" . number_format($_SESSION["LimitBet"]) . ".<br>You cannot continue&#33;";
						}
					}			
					break;
				
				case "6/1":
					if ($Bet6v > $_SESSION["LimitBet"]) {
						If (!isset($_SESSION["GoneBust"])) {
							$_SESSION["GoneBust"] = "Your bet of &pound;" . number_format($Bet6v) . " at odds of ". $_SESSION["ChosenOdds"] . " would exceed your maximum bet of &pound" . number_format($_SESSION["LimitBet"]) . ".<br>You cannot continue&#33;";
						}
					}			
					break;
			}
		}
		
	//WorstOutlays - working on minus numbers
		$Outlay=$tank4v - $Bet4v;
		if ($Outlay<$WorstOutlay4v) {
			$WorstOutlay4v=$Outlay;
		}
		//Consider 4/1 as worst odds a punter might get on a 5/1 chance. Could be considerably worse!
		If ($WorstOutlay4v<$_SESSION["WorstOutlay4"]) {
			$_SESSION["WorstOutlay4"] = $WorstOutlay4v;
		}

		
		$Outlay=$tank5v - $Bet5v;
		if ($Outlay<$WorstOutlay5v) {
			$WorstOutlay5v=$Outlay;
		}		
		
		If ($WorstOutlay5v<$_SESSION["WorstOutlay5"]) {
			$_SESSION["WorstOutlay5"] = $WorstOutlay5v;
		}

		
		$Outlay=$tank6v - $Bet6v;
		if ($Outlay<$WorstOutlay6v) {
			$WorstOutlay6v=$Outlay;
		}		
		
		If ($WorstOutlay6v<$_SESSION["WorstOutlay6"]) {
			$_SESSION["WorstOutlay6"] = $WorstOutlay6v;
		}

		
		
		if ($_SESSION["LevelVariable"]=="Variable") {
			switch ($_SESSION["ChosenOdds"]) {
				case "4/1":
					if ($_SESSION["WorstOutlay4"] > $_SESSION["LimitOutlay"]) {
						If (!isset($_SESSION["GoneBust"])) {
							$_SESSION["GoneBust"] = "At odds of " . $_SESSION["ChosenOdds"] . " your outlay of " . number_format($_SESSION["WorstOutlay4"]) . " exceeds your limit of " . number_format($_SESSION["LimitOutlay"]) . "<br>You cannot continue&#33;";
						}
					}			
					break;
					
				case "5/1":
					if ($Bet5v > $_SESSION["LimitBet"]) {
						If (!isset($_SESSION["GoneBust"])) {
							$_SESSION["GoneBust"] = "At odds of " . $_SESSION["ChosenOdds"] . " your outlay of " . number_format($_SESSION["WorstOutlay5"]) . " exceeds your limit of " . number_format($_SESSION["LimitOutlay"]) . "<br>You cannot continue&#33;";
						}
					}			
					break;
				
				case "6/1":
					if ($Bet6v > $_SESSION["LimitBet"]) {
						If (!isset($_SESSION["GoneBust"])) {
							$_SESSION["GoneBust"] = "At odds of " . $_SESSION["ChosenOdds"] . " your outlay of " . number_format($_SESSION["WorstOutlay6"]) . " exceeds your limit of " . number_format($_SESSION["LimitOutlay"]) . "<br>You cannot continue&#33;";
						}
					}			
					break;
			}
		}
		


		switch ($dice) {
			case 1:
				$count1++;
				break;
			case 2:
				$count2++;
				break;
			case 3:
				$count3++;
				break;
			case 4:
				$count4++;
				break;
			case 5:
				$count5++;
				break;
			case 6:
				$count6++;
				break;
		}

		if ($dice==$_SESSION["MyNumber"]) {
			
			$CurrentWinningStreak++;
			$CurrentLosingStreak=0;

			//keep running total for quality control
			$_SESSION["Roll6"] = @$_SESSION["Roll6"] + 1;

			$_SESSION["Running4"] = $_SESSION["Running4"] + (4 * $Bet);
			$_SESSION["Running5"] = $_SESSION["Running5"] + (5 * $Bet);
			$_SESSION["Running6"] = $_SESSION["Running6"] + (6 * $Bet);

			$tank4=$tank4 + (4 * $Bet);
			$tank5=$tank5 + (5 * $Bet);
			$tank6=$tank6 + (6 * $Bet);

			$tank4v=$tank4v + (4 * $Bet4v);
			$tank5v=$tank5v + (5 * $Bet5v);
			$tank6v=$tank6v + (6 * $Bet6v);

			//Empty the tank into your pocket for variable bets
			$Pocket4v=$Pocket4v + $tank4v;
			$Pocket5v=$Pocket5v + $tank5v;
			$Pocket6v=$Pocket6v + $tank6v;

			//and start again
			$tank4v=0;
			$tank5v=0;
			$tank6v=0;

		}
		else {
			$CurrentLosingStreak++;
			$CurrentWinningStreak=0;


		//keep running total on 5/1 for quality control
			$_SESSION["RollNot6"] = @$_SESSION["RollNot6"] + 1;

			$_SESSION["Running4"] = $_SESSION["Running4"] - $Bet;
			$_SESSION["Running5"] = $_SESSION["Running5"] - $Bet;
			$_SESSION["Running6"] = $_SESSION["Running6"] - $Bet;

			$tank4=$tank4 - $Bet;
			$tank5=$tank5 - $Bet;
			$tank6=$tank6 - $Bet;

			$tank4v=$tank4v - $Bet4v;
			$tank5v=$tank5v - $Bet5v;
			$tank6v=$tank6v - $Bet6v;
		}

// Losing / Winning streaks 
		if ($CurrentWinningStreak>$MaxWinningStreak) {
			$MaxWinningStreak=$CurrentWinningStreak;
		}

		if ($CurrentLosingStreak>$MaxLosingStreak) {
			$MaxLosingStreak=$CurrentLosingStreak;
		}


// Min and Max tanks 
		if ($tank4<$MinTank4) {
			$MinTank4=$tank4;
		}

		if ($tank4>$MaxTank4) {
			$MaxTank4=$tank4;
		}

		if ($tank5<$MinTank5) {
			$MinTank5=$tank5;
		}

		if ($tank5>$MaxTank5) {
			$MaxTank5=$tank5;
		}

		if ($tank6<$MinTank6) {
			$MinTank6=$tank6;
		}

		if ($tank6>$MaxTank6) {
			$MaxTank6=$tank6;
		}



		if ($tank4v<$MinTank4v) {
			$MinTank4v=$tank4v;
		}

		if ($tank4v>$MaxTank4v) {
			$MaxTank4v=$tank4v;
		}

		if ($tank5v<$MinTank5v) {
			$MinTank5v=$tank5v;
		}

		if ($tank5v>$MaxTank5v) {
			$MaxTank5v=$tank5v;
		}

		if ($tank6v<$MinTank6v) {
			$MinTank6v=$tank6v;
		}

		if ($tank6v>$MaxTank6v) {
			$MaxTank6v=$tank6v;
		}


//if ticked (whch is always from October 2016)
		If ($_SESSION["ShowAll"] == TRUE) {
		//row 2 level

		echo "<TR><TD style='text-align:right'>", $roll + 1, "</TD>\n";

		if ($dice==$_SESSION["MyNumber"]) {
			echo "<TD style='text-align:right; background-color:green'>";
		}
		Else {
			echo "<TD style='text-align:right'>";
		}

		echo $dice, "</TD>\n";
		echo "<TD class='moneybet'>", number_format($Bet), "</TD>\n";

		switch ($_SESSION["ChosenOdds"]) {
			case "4/1":
				if ($tank4>=0) {
					echo "<TD class='moneypos'>";
				}
				Else {
					echo "<TD class='moneyneg'>";
				}
				echo number_format($tank4), "</TD>\n";
				break;
			case "5/1":
				if ($tank5>=0) {
					echo "<TD class='moneypos'>";
				}
				Else {
					echo "<TD class='moneyneg'>";
				}
				echo number_format($tank5), "</TD>\n";
				break;
			case "6/1":
				if ($tank6>=0) {
					echo "<TD class='moneypos'>";
				}
				Else {
					echo "<TD class='moneyneg'>";
				}
				echo number_format($tank6), "</TD>\n";
				break;
		}
		
		//spacer
		echo "<TD style='border:none;'>&nbsp;</TD>\n";

		//row 2 variable
		switch ($_SESSION["ChosenOdds"]) {
			case "4/1":
				echo "<TD class='moneybet'>", number_format($Bet4v), "</TD>\n";
				break;
			case "5/1":
				echo "<TD class='moneybet'>", number_format($Bet5v), "</TD>\n";
				break;
			case "6/1":
				echo "<TD class='moneybet'>", number_format($Bet6v), "</TD>\n";
				break;
		}


		switch ($_SESSION["ChosenOdds"]) {
			case "4/1":
				if ($tank4v>=0) {
					echo "<TD class='moneypos'>";
				}
				Else {
					echo "<TD class='moneyneg'>";
				}
				echo number_format($tank4v), "</TD>\n";
				break;
			case "5/1":
				if ($tank5v>=0) {
					echo "<TD class='moneypos'>";
				}
				Else {
					echo "<TD class='moneyneg'>";
				}
				echo number_format($tank5v), "</TD>\n";
				break;
			case "6/1":
				if ($tank6v>=0) {
					echo "<TD class='moneypos'>";
				}
				Else {
					echo "<TD class='moneyneg'>";
				}
				echo number_format($tank6v), "</TD>\n";
				break;
		}		
		

		switch ($_SESSION["ChosenOdds"]) {
			case "4/1":
				if ($Pocket4v>=0) {
					echo "<TD class='moneypos'>";
				}
				Else {
					echo "<TD class='moneyneg'>";
				}
				echo number_format($Pocket4v), "</TD>\n";
				break;
			case "5/1":
				if ($Pocket5v>=0) {
					echo "<TD class='moneypos'>";
				}
				Else {
					echo "<TD class='moneyneg'>";
				}
				echo number_format($Pocket5v), "</TD>\n";
				break;
			case "6/1":
				if ($Pocket6v>=0) {
					echo "<TD class='moneypos'>";
				}
				Else {
					echo "<TD class='moneyneg'>";
				}
				echo number_format($Pocket6v), "</TD>\n";
				break;
		}	
		
		echo "</TR>\n";
		
		// //if worst outlay beats excessive bet, do it here
			// switch ($_SESSION["ChosenOdds"]) {
				// case "4/1":
					// if (0-$_SESSION["WorstOutlay4"] > $_SESSION["LimitOutlay"]) {
						// If (!isset($_SESSION["GoneBust"])) {
							// $_SESSION["GoneBust"] = "Your outlay of &pound;" . number_format(0-$_SESSION["WorstOutlay4"]) . " at odds of ". $_SESSION["ChosenOdds"] . " would exceed your limit of &pound" . number_format($_SESSION["LimitOutlay"]) . ".<br>You cannot continue&#33;";
						// }
					// }			
					// break;
					
				// case "5/1":
					// if (0-$_SESSION["WorstOutlay5"] > $_SESSION["LimitOutlay"]) {
						// If (!isset($_SESSION["GoneBust"])) {
							// $_SESSION["GoneBust"] = "Your outlay of &pound;" . number_format(0-$_SESSION["WorstOutlay5"]) . " at odds of ". $_SESSION["ChosenOdds"] . " would exceed your limit of &pound" . number_format($_SESSION["LimitOutlay"]) . ".<br>You cannot continue&#33;";
						// }
					// }				
					// break;
				
				// case "6/1":
					// if (0-$_SESSION["WorstOutlay6"] > $_SESSION["LimitOutlay"]) {
						// If (!isset($_SESSION["GoneBust"])) {
							// $_SESSION["GoneBust"] = "Your outlay of &pound;" . number_format(0-$_SESSION["WorstOutlay6"]) . " at odds of ". $_SESSION["ChosenOdds"] . " would exceed your limit of &pound" . number_format($_SESSION["LimitOutlay"]) . ".<br>You cannot continue&#33;";
						// }
					// }			
					// break;
			// }
		
		
			If (isset($_SESSION["GoneBust"])) {
				echo "<tr><td colspan='8' style='color: red;'>", $_SESSION["GoneBust"], "</td></tr>";
				break;
			}
		}

	$roll++;
	}
?>
</TABLE>
</div> <!-- end center -->
</div> <!-- xxxxxxxxxxxxxxxxxxxxxxxxxx end Page 2 xxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
<?php	

		$_SESSION["Years"] = $_SESSION["Years"] + 1;

		echo "</TD></tr><tr><td style='background-color:#CCFFCC'>";
		echo "<span class='bigbold'>This year</span><BR>Frequency of dice numbers:\n";
		echo "&nbsp;&nbsp; 1: <B>", ($count1), "</B>";
		echo "&nbsp;&nbsp; 2: <B>", ($count2), "</B>";
		echo "&nbsp;&nbsp; 3: <B>", ($count3), "</B>";
		echo "&nbsp;&nbsp; 4: <B>", ($count4), "</B>";
		echo "&nbsp;&nbsp; 5: <B>", ($count5), "</B>";
		echo "&nbsp;&nbsp; 6: <B>", ($count6), "</B>";
		echo "<BR>Total rolls: <b>", ($count1 + $count2 + $count3 + $count4 + $count5 + $count6), "</b>";
		echo " - Average frequency of each number: <B>", round(($count1 + $count2 + $count3 + $count4 + $count5 + $count6)/6), "</B>";
		echo "<BR>";
		echo "Level Bet: <b>&pound;", number_format($Bet), "</b> on rolling a <b>", $_SESSION["MyNumber"], "</b><BR>";
		echo "<BR>Max Losing Streak: ", $MaxLosingStreak;
		echo ",&nbsp;&nbsp;Max Winning Streak: ", $MaxWinningStreak;
?>

<BR><BR>

<TABLE class='innertable'>
<tr>
<td class='href';><a href="#openModalOdds">Odds</a></td>
<td style='border:none;'>&nbsp;</td>
<td colspan='3' <?php echo ($_SESSION["LevelVariable"]=="Level") ?  "class='hrefwhite'" : "class='href'"?>><a href="#openModalLevelBets">Level Bets</a></td>
<td style='border:none;'>&nbsp;</td>
<td colspan='2' <?php echo ($_SESSION["LevelVariable"]=="Level") ?  "class='href'" : "class='hrefwhite'"?>><a href="#openModalVariableBets">Variable Bets</a></td>
</tr>
		
<!--Buy At -->
<TR>
<TH><a href="#openModalBuyAt">Buy At</a></TH>
<TH style='border:none;'>&nbsp;</TH>

<!--Tank-->
<TH><a href="#openModalTank">Tank</a></TH>

<!--Worst-->
<TH><a href="#openModalWorst">Worst</a></TH>

<!--Best-->
<TH><a href="#openModalBest">Best</a></TH>

<TH style='border:none;'>&nbsp;</TH>

<!--Pocket-->
<TH><a href="#openModalPocket">Pocket</a></TH>

<!--Worst Outlay-->
<TH><a href="#openModalWorstOutlay">Worst Outlay</a></TH>


<TR>

<?php

//row 1 level
?>
		<TD <?php echo ($_SESSION["ChosenOdds"]=="4/1") ?  "class='oddsgreen'" : "class='oddsplain'" ?>>4/1</TD>
		<TD style='border:none;'>&nbsp;</TD>
<?php

		if ($tank4>=0) {
			echo "<TD class='moneypos'>";
		}
		Else {
			echo "<TD class='moneyneg'>";
		}
		echo number_format($tank4), "</TD>\n";
		
		if ($MinTank4-$Bet>=0) {
			echo "<TD class='moneypos'>";
		} else {
			echo "<TD class='moneyneg'>";		
		}
		echo number_format($MinTank4-$Bet), "</TD>\n";
		
		if ($MaxTank4>=0) {
			echo "<TD class='moneypos'>";
		} else {
			echo "<TD class='moneyneg'>";		
		}		
		echo number_format($MaxTank4), "</TD>\n";
		echo "<TD style='border:none;'>&nbsp;</TD>\n";

//row 1 variable
		if ($Pocket4v>=0) {
			echo "<TD class='moneypos'>";
		}
		Else {
			echo "<TD class='moneyneg'>";
		}
		echo number_format($Pocket4v), "</TD>\n";
		
		echo "<TD class='moneyneg'>", number_format($WorstOutlay4v), "</TD>\n";
?>
		</TR>
		
		<TR>
		<TD <?php echo ($_SESSION["ChosenOdds"]=="5/1") ?  "class='oddsgreen'" : "class='oddsplain'" ?>>5/1</TD>
		<TD style='border:none;'>&nbsp;</TD>	
<?php


//row 2 level
		if ($tank5>=0) {
			echo "<TD class='moneypos'>";
		}
		Else {
			echo "<TD class='moneyneg'>";
		}
		echo number_format($tank5), "</TD>\n";
		
		
		if ($MinTank5-$Bet>=0) {
			echo "<TD class='moneypos'>";
		}
		Else {
			echo "<TD class='moneyneg'>";
		}	
		echo number_format($MinTank5-$Bet), "</TD>\n";
		
		if ($MaxTank5>=0) {
			echo "<TD class='moneypos'>";
		}
		Else {
			echo "<TD class='moneyneg'>";
		}	
		echo number_format($MaxTank5), "</TD>\n";	

		echo "<TD style='border:none;'>&nbsp;</TD>\n";

//row 2 variable

		if ($Pocket5v>=0) {
			echo "<TD class='moneypos'>";
		}
		Else {
			echo "<TD class='moneyneg'>";
		}
		echo number_format($Pocket5v), "</TD>\n";
		
		echo "<TD class='moneyneg'>", number_format($WorstOutlay5v), "</TD>\n";

?>
		</TR>
		
		<TR>
		<TD <?php echo ($_SESSION["ChosenOdds"]=="6/1") ?  "class='oddsgreen'" : "class='oddsplain'" ?>>6/1</TD>
		<TD style='border:none;'>&nbsp;</TD>

<?php		
//row 3 level

		if ($tank6>=0) {
			echo "<TD class='moneypos'>";
		}
		Else {
			echo "<TD class='moneyneg'>";
		}
		echo number_format($tank6), "</TD>\n";
		

		if ($MinTank6-$Bet>=0) {
			echo "<TD class='moneypos'>";
		}
		Else {
			echo "<TD class='moneyneg'>";
		}
		echo number_format($MinTank6-$Bet), "</TD>\n";
		

		if ($MaxTank6>=0) {
			echo "<TD class='moneypos'>";
		}
		Else {
			echo "<TD class='moneyneg'>";
		}
		echo number_format($MaxTank6), "</TD>\n";		

		echo "<TD style='border:none;'>&nbsp;</TD>\n";

//row 3 variable
		if ($Pocket6v>=0) {
			echo "<TD class='moneypos'>";
		}
		Else {
			echo "<TD class='moneyneg'>";
		}
		echo number_format($Pocket6v), "</TD>\n";
		
		
		echo "<TD class='moneyneg'>", number_format($WorstOutlay6v), "</TD>\n";
?>
		</TR>
		
<?php		
		If (isset($_SESSION["GoneBust"])) {
			echo "<tr><td colspan='8' style='background-color:red; color: white; font-weight:bold;'>", $_SESSION["GoneBust"], "&nbsp;&nbsp;&nbsp;&nbsp; <span class='href'><a href='#' onclick=\"return showornot('Page2');\">show/hide all results for the last year</a></span></td></tr>";
		}
?>		

		</TABLE>
		<BR>
		</TD>
		</tr>
		
		<tr>
		<td style='background-color: #FFFFCC'>
<?php


// ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ Running totals ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
		echo "<span class='bigbold'>After ", $_SESSION["Years"];
		
		if ($_SESSION["Years"]==1) {
			echo " year";
		}
		else {
			echo " years";
		}
		
		echo "</span>&nbsp;&nbsp;&nbsp;&nbsp;You have rolled <b>", $_SESSION["MyNumber"], "</b>: &nbsp;<b>", number_format(@$_SESSION["Roll6"]), " times</b>, &nbsp;";
?>

<br><span class='href'><a href="#openModalAverage">averaging&nbsp;1/<?php echo ($_SESSION["RollNot6"]/$_SESSION["Roll6"]) ?></a></span>

<?php
	echo "<br><br>At odds of <b>", $_SESSION["ChosenOdds"],"</b> <span class='href'><a href='#openModalAfford'>you might need funds of: <span style='color:#FF0000'>&pound;";
		switch ($_SESSION["ChosenOdds"]) {
			case "4/1":
				echo number_format(-$_SESSION["WorstOutlay4"]);
				break;
			case "5/1":
				echo number_format(-$_SESSION["WorstOutlay5"]); 
				break;
			case "6/1":
				echo number_format(-$_SESSION["WorstOutlay6"]); 
				break;
		}
	echo "</a></span></span>.";
?>




<BR><BR><TABLE class='innertable'>

<tr><td style='text-align:center;'>Odds</td><td style='border:none;'>&nbsp;</td><td colspan='2' 
<?php echo ($_SESSION["LevelVariable"]=="Level") ?  "style='background-color:green; text-align:center;'" : "style='text-align:center;'"?>>Level Bets</td>
<td style='border:none;'>&nbsp;</td>
<td <?php echo ($_SESSION["LevelVariable"]=="Level") ?  "style='text-align:center;'" : "style='background-color:green; text-align:center;'"?>>Variable Bets</td></tr>
<TR><TH>Buy at</TH><TH style='border:none;'>&nbsp;</TH><TH>Tank</TH><TH>Average p/a</TH><TH style='border:none;'>&nbsp;</TH><TH>Worst Outlay</TH></TR>

<?php		
//4	
		echo "<TR><TD ", ($_SESSION["ChosenOdds"]=="4/1") ?  "class='oddsgreen'" : "class='oddsplain'", ">4/1</TD>\n<TD style='border:none;'>&nbsp;</TD>\n";

		if ($_SESSION["Running4"]>=0) {
			echo "<td class='moneypos'>";
		}
		Else {
			echo "<td class='moneyneg'>";
		}
		echo number_format($_SESSION["Running4"]), "</TD>\n";

		
		if ($_SESSION["Running4"]>=0) {
			echo "<td class='moneypos'>";
		}
		Else {
			echo "<td class='moneyneg'>";
		}
		echo number_format($_SESSION["Running4"]/$_SESSION["Years"]), "</TD>\n";
		echo "<TD style='border:none;'>&nbsp;</TD>\n<td class='moneyneg'>";
		echo number_format($_SESSION["WorstOutlay4"]), "</TD>\n</TR>";



//5
		echo "<TR><TD ", ($_SESSION["ChosenOdds"]=="5/1") ?  "class='oddsgreen'" : "class='oddsplain'", ">5/1</TD>\n<TD style='border:none;'>&nbsp;</TD>\n";

		if ($_SESSION["Running5"]>=0) {
			echo "<td class='moneypos'>";
		}
		Else {
			echo "<td class='moneyneg'>";
		}
		echo number_format($_SESSION["Running5"]), "</TD>\n";

		
		if ($_SESSION["Running5"]>=0) {
			echo "<td class='moneypos'>";
		}
		Else {
			echo "<td class='moneyneg'>";
		}
		echo number_format($_SESSION["Running5"]/$_SESSION["Years"]), "</TD>\n";
		echo "<TD  style='border:none;'>&nbsp;</TD>\n<td class='moneyneg'>";
		echo number_format($_SESSION["WorstOutlay5"]), "</TD>\n</TR>";




//6
	echo "<TR><TD ", ($_SESSION["ChosenOdds"]=="6/1") ?  "class='oddsgreen'" : "class='oddsplain'", ">6/1</TD>\n<TD style='border:none;'>&nbsp;</TD>\n";

	if ($_SESSION["Running6"]>=0) {
			echo "<td class='moneypos'>";
	}
	Else {
			echo "<td class='moneyneg'>";
	}
	echo number_format($_SESSION["Running6"]), "</TD>\n";

	
	if ($_SESSION["Running6"]>=0) {
			echo "<td class='moneypos'>";
	}
	Else {
			echo "<td class='moneyneg'>";
	}
	echo number_format($_SESSION["Running6"]/$_SESSION["Years"]), "</TD>\n";
	echo "<TD style='border:none;'>&nbsp;</TD>\n<td class='moneyneg'>";
	echo number_format($_SESSION["WorstOutlay6"]), "</TD>\n</TR>";

	echo "</TABLE>";
} //end of function ... I think

//********************************************** START HERE **************************************************

//$session_lifetime = 3600 * 24 * 2; // 2 days
$session_lifetime = 3600 * 24 * 1; // 1 day
session_set_cookie_params ($session_lifetime);
session_start();
?><!DOCTYPE HTML>
<HTML lang="en">
<HEAD>
<TITLE>Betting for a living</TITLE>
<meta charset="UTF-8">
<meta name="description" content="Winning Dice shows how easy it is to win a fortune by gambling. The trick is finding the right odds.">
<meta name=viewport content="width=device-width, initial-scale=1">
<meta name="apple-mobile-web-app-capable" content="yes" />

<script>
	function showornot(show) {
		var yesno = document.getElementById(show);
		yesno.style.display = yesno.style.display === 'none'  ? 'block' : 'none';
		return false;
	}
</script>

<style>

	@viewport{
		zoom: 1.0;
		width: extend-to-zoom;
	}

	@-ms-viewport{
		width: extend-to-zoom;
		zoom: 1.0;
	}

	html {
		overflow-y: scroll; 
	}

	th {
		font-family: arial, sans-serif;
		color: black;
		font-weight: bold;
		font-size: 16px;
		text-align: center;		
	}
	
	td {
		border: 1px solid gray;
		border-radius: 4px; 
	}
	
	.href {
		font-family: arial, sans-serif;
		color: black;
		font-weight: bold;
		font-size: 16px;
		text-align: center;			
	}
	
	.hrefwhite {
		font-family: arial, sans-serif;
		font-weight: bold;
		font-size: 16px;
		text-align: center;		

		color:#f3f3f3;
		background-color:#35b128;
	}
	
	.hrefwhite > a {
		color: white;
	}
	
	.moneypos {
		font-family: arial, sans-serif;
		color: black;
		font-weight: bold;
		font-size: 16px;
		text-align: right;
	}
	
	.moneyneg {
		font-family: arial, sans-serif;
		color: red;
		font-weight: bold;
		font-size: 16px;
		text-align: right;
	}
	
	.moneybet {
		font-family: arial, sans-serif;
		color: dimgray;
		font-weight: bold;
		font-size: 16px;
		text-align: right;
	}

	.headerbutton {
		background-color: #FFFFE6;
		width: 25%;
		text-align:center;	
		font-weight: bold;
	}
	
	.oddsgreen {
		color:#f3f3f3;
		background-color:#35b128;
		text-align:center;	
		font-weight: bold;		
	}
	
	.oddsplain {
		text-align:center;	
		font-weight: bold;		
	}	
	
	.bigbold {
		color: #494949;
		font-weight: bold;
		font-size: 20px;
	}
	
	.outertable { 
		margin-left: auto;
		margin-right: auto;
		border: 8px solid silver;
		border-radius: 17px; 
		border-style:ridge;
		border-spacing: 2px;
		font-family: arial, sans-serif;
	}

	.innertable { 
		margin-left: auto;
		margin-right: auto;
		border: 6px solid silver;
		border-radius: 9px; 
		border-style:ridge;
		cellspacing: 1px;
		padding: 1px;  
		font-family: arial, sans-serif;
	}

	.normaltable {
		border: 1px
	}

	input#gobutton1,input#gobutton2 {
		padding:2px;
		margin:5px 0 2px 1px;
		color:#f3f3f3;
		font-size:18px;
		background:#35b128;
		border:1px solid #33842a;
		-moz-border-radius: 4px; 
		-webkit-border-radius: 4px;
		border-radius: 4px;
		-webkit-box-shadow: 0 0 4px rgba(0,0,0, .75); 
		-moz-box-shadow: 0 0 4px rgba(0,0,0, .75); 
		box-shadow: 0 0 4px rgba(0,0,0, .75);
		cursor:pointer;
	}

/* and this October 2016 for modal boxes */
	.modalDialog {
		position: fixed;
		font-family: Arial, Helvetica, sans-serif;
		top: 0;
		right: 0;
		bottom: 0;
		left: 0;
		background: rgba(0,0,0,0.8);
		z-index: 99999;
		opacity:0;
		-webkit-transition: opacity 400ms ease-in;
		-moz-transition: opacity 400ms ease-in;
		transition: opacity 400ms ease-in;
		pointer-events: none;
	}

	.modalDialog:target {
		opacity:1;
		pointer-events: auto;
	}

	.modalDialog > div {
		width: 400px;
		position: relative;
		margin: 10% auto;
		padding: 5px 20px 13px 20px;
		border-radius: 10px;
		background: #fff;
		background: -moz-linear-gradient(#ffc, #ffb);
		background: -webkit-linear-gradient(#ffc, #ffb);
		background: -o-linear-gradient(#ffc, #ffb);
	}

	.close {
		background: #606061;
		color: #FFFFFF;
		line-height: 25px;
		position: absolute;
		right: -12px;
		text-align: center;
		top: -10px;
		width: 24px;
		text-decoration: none;
		font-weight: bold;
		-webkit-border-radius: 12px;
		-moz-border-radius: 12px;
		border-radius: 12px;
		-moz-box-shadow: 1px 1px 3px #000;
		-webkit-box-shadow: 1px 1px 3px #000;
		box-shadow: 1px 1px 3px #000;
	}

	.close:hover { background: #00d9ff; }

</style>


</HEAD>
<BODY>


<?php
	$_SESSION["AnnualTarget"] = @$_REQUEST["AnnualTarget"];
	If (!isset($_SESSION["AnnualTarget"])) {
		$_SESSION["AnnualTarget"] = "4500";
	}

	$_SESSION["BetsPerWeek"] = @$_REQUEST["BetsPerWeek"];
	If (!isset($_SESSION["BetsPerWeek"])) {
		$_SESSION["BetsPerWeek"] = "5";
	}

	$_SESSION["WeeksPerYear"] = @$_REQUEST["WeeksPerYear"];
	If (!isset($_SESSION["WeeksPerYear"])) {
		$_SESSION["WeeksPerYear"] = "45";
	}
	
	$_SESSION["ChosenOdds"] = @$_REQUEST["ChosenOdds"];
	If (!isset($_SESSION["ChosenOdds"])) {
		$_SESSION["ChosenOdds"] = "5/1";
	}

	$_SESSION["LimitOutlay"] = @$_REQUEST["LimitOutlay"];
	If (!isset($_SESSION["LimitOutlay"])) {
		$_SESSION["LimitOutlay"] = "100000";
	}
	
	$_SESSION["LimitBet"] = @$_REQUEST["LimitBet"];
	If (!isset($_SESSION["LimitBet"])) {
		$_SESSION["LimitBet"] = "10000";
	}
	
	$_SESSION["MyNumber"] = @$_REQUEST["MyNumber"];
	If (!isset($_SESSION["MyNumber"])) {
		$_SESSION["MyNumber"] = "5";
	}
	
	$_SESSION["LevelVariable"] = @$_REQUEST["LevelVariable"];
	If (!isset($_SESSION["LevelVariable"])) {
		$_SESSION["LevelVariable"] = "Level";
	}
	
	
	
	If (!isset($_SESSION["Running4"])) {
		$_SESSION["Running4"] = "0";
	}

	If (!isset($_SESSION["Running5"])) {
		$_SESSION["Running5"] = "0";
	}

	If (!isset($_SESSION["Running6"])) {
		$_SESSION["Running6"] = "0";
	}

	If (!isset($_SESSION["WorstOutlay4"])) {
		$_SESSION["WorstOutlay4"] = "0";
	}

	If (!isset($_SESSION["WorstOutlay5"])) {
		$_SESSION["WorstOutlay5"] = "0";
	}

	If (!isset($_SESSION["WorstOutlay6"])) {
		$_SESSION["WorstOutlay6"] = "0";
	}

	If (!isset($_SESSION["Years"])) {
		$_SESSION["Years"] = "0";
	}

	//$_SESSION["ShowAll"] = @$_REQUEST["ShowAll"];
	$_SESSION["ShowAll"] = TRUE;
?>

	<table class='outertable'>
		<tr>
			<td style="border: none";>
				<table class='innertable' style='width: 100%'>
					<TR>
					<TD class='headerbutton'><a href="#openModalExplain">Explain</a></TD>
					<TD class='headerbutton'><a href="#openModalRestart">Restart my life</a></TD>
					<TD class='headerbutton'><a href='feedbackgamble.htm' target='_blank'>How did you do?</a></TD>
					<TD class='headerbutton'><a href='#openModalAbout'>About this app</a></TD>					
					</TR>
				</table>
			</td>
		</tr>

	
		<tr>
			<td style='background-color: #CCFFFF'>
				<span class='bigbold'>Settings</span>

<?php	
	echo "&nbsp;&nbsp;&nbsp;&nbsp; You have gambled for <b>", $_SESSION["Years"] + 1, "";
	if (($_SESSION["Years"] + 1)==1) {
		echo " year";
	}
	else {
		echo " years";
	}
	echo "</b> on the chances of rolling a <b>", $_SESSION["MyNumber"], "</b>";

		echo "<br>Annual Target: <b>&pound;", number_format($_SESSION["AnnualTarget"]), "</b>&nbsp;&nbsp; Using <b>", $_SESSION["LevelVariable"], "</b> bets";
		echo "<br>Bets per Week: <b>", $_SESSION["BetsPerWeek"], "</b>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;Betting Weeks per Year: <b>", $_SESSION["WeeksPerYear"], "</b>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;Chosen odds: <b>", $_SESSION["ChosenOdds"], "</b>";
		echo "<br>Maximum outlay: <b>&pound;", number_format($_SESSION["LimitOutlay"]), "</b>";
		echo "&nbsp;&nbsp;Maximum Bet: <b>&pound;", number_format($_SESSION["LimitBet"]), "</b>";

?>
		<br><br><div style="text-align: center;"><span class='href'><a href="#" onclick="return showornot('Page2');">show/hide all results for the last year</a></span></div>
	</TD>
</tr>
<tr>
<td style='background-color:#FFFFCC'>
<?php
	if ($_SESSION["BetsPerWeek"]>50) {
		echo "You can't do this for more than 50 bets per week. It would be unlikely that you could find value on that number of opportunities.";
	}
	Else {
		if ($_SESSION["WeeksPerYear"]>52) {
			echo "There are only 52 weeks in a year.";
		}
		Else {
			PlayYear();			
		}
	}
?>
	<br>
<?php
	If (isset($_SESSION["GoneBust"])) {
		//echo "<script type='text/javascript'>alert('You cannot continue because your bet would exceed your limit. You must restart your life.');</script>";
		echo "<a href='#openModalGoneBust'><input id='gobutton2' value='Bet for another year'></a>";
	} else {
?> 	

	<form action='<?php echo $_SERVER['PHP_SELF'] ?>' method='post'>
		<input type='hidden' name='AnnualTarget' value='<?php echo $_SESSION["AnnualTarget"] ?>'>
		<input type='hidden' name='BetsPerWeek' value='<?php echo $_SESSION["BetsPerWeek"] ?>'>
		<input type='hidden' name='WeeksPerYear' value='<?php echo $_SESSION["WeeksPerYear"] ?>'>
		<input type='hidden' name='ChosenOdds' value='<?php echo $_SESSION["ChosenOdds"] ?>'>
		<input type='hidden' name='LimitTank' value='<?php echo $_SESSION["LimitOutlay"] ?>'>
		<input type='hidden' name='LimitBet' value='<?php echo $_SESSION["LimitBet"] ?>'>
		<input type='hidden' name='MyNumber' value='<?php echo $_SESSION["MyNumber"] ?>'>
		<input type='hidden' name='LevelVariable' value='<?php echo $_SESSION["LevelVariable"] ?>'>
		<input id='gobutton2' type='submit' name='cmdOK' value='Bet for another year'>
	</form>

<?php
	}
?>	
	
	
</TD>
</tr>
</table>

<!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx hidden divs xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->

	<div id="openModalExplain" class="modalDialog">
		<div>
			<a href="#close" title="Close" class="close">X</a>
			<H2>Betting for an income</H2>

			The idea behind this illustration is to show what could happen if you chose betting as a profession.<BR>
			You would set:
			<UL>
			<LI>Annual target income, between &pound;1,000 and &pound;100,000</LI>
			<LI>Bets per week - the number of bets you could expect to place after studying the probabilities and the prices.</LI>
			<LI>How many weeks you would work each year - the remainder being holiday and time to enjoy your winnings.</LI>
			<li>The odds you would accept. 4/1, 5/1 or 6/1</li>
			<li>How low you would allow your tank to go. Limited to &pound;100,000 for the pruposes of this app.</li>
			<li>What would be your maximum bet. Limited to &pound;10,000 as this is commonly the limit at most bookmakers.</li>
			</UL>

			<p>The figures in the boxes are just suggestions. Change them as you wish.</p>
			<p>If you exceed any of your safety limits you will need to restart your life.</p>
		</div>
	</div>

	
	
	<div id="openModalRestart" class="modalDialog">
		<div>
			<a href="#close" title="Close" class="close">X</a>
			<H2>Restart my life</H2>

			<h3>If you need to restart you might admit that gambling is not for you.</h3>
			<p><a href='http://www.gamblersanonymous.org.uk' target='_blank'>Please take me to Gamblers Anonymous (UK)</a></p>
			<p>The only way to start again is to <a href="resetlife.php">start again</a>.</p>			
		</div>
	</div>
	
	
	<div id="openModalGoneBust" class="modalDialog">
		<div>
			<a href="#close" title="Close" class="close">X</a>
			<H2>You have gone bust</H2>
			
			<p>You cannot continue with the current settings. You might like to try a different scenario.</p>
			<p>If you just close this message you can review what happened.</p>
			<p>The only way to start again is to <a href="resetlife.php">start again</a>.</p>			
		</div>
	</div>
	
	
	<div id="openModalAbout" class="modalDialog">
		<div>
			<a href="#close" title="Close" class="close">X</a>
			<H2>About this app</H2>
			<p>This was inspired by my attempts to see how computers could beat the bookies. </p>
			<p>I wish you luck - you&apos;ll need it.</p>
			<p>Brian</p>
		</div>
	</div>
	

	<div id="openModalOdds" class="modalDialog">
		<div>
			<a href="#close" title="Close" class="close">X</a>
			<H2>Odds</H2>

			<p>You&apos;re buying at the odds offered by the bookmaker. A couple of usesful guides to how odds are set can be found at these links - <a href='https://en.wikipedia.org/wiki/Mathematics_of_bookmaking' target='_blank'>Wikipedia</a> and <a href='http://www.allaboutbetting.co.uk/bettingbasics/howbookswork.html' target='_blank'>All About Betting</a>
			</p>
		</div>
	</div>


	<div id="openModalLevelBets" class="modalDialog">
		<div>
			<a href="#close" title="Close" class="close">X</a>
			<H2>Level Bets</H2>

			<p>Level bets are calculated to make the target income using the number of bets and winning once in every 6 rolls.<br><br>So if you aim to make &pound;6,000 in a year placing 60 bets at 5/1, you expect to win one in six rolls, i.e. win on 60/6 times = 10 wins in the year. You need to win &pound;600 on each of these 10 wins.<br><br>You need to place bets of &pound;120 so that you win 5*120 on each of your wins.
			<br><br>Unfortunately, at 5/1 you will lose as much as you win and after many years should have broken even.</p>
		</div>
	</div>


	<div id="openModalVariableBets" class="modalDialog">
		<div>
			<a href="#close" title="Close" class="close">X</a>
			<H2>Variable Bets</H2>

			<p>Variable bets are intended to make you a guaranteed income by winning a known amount and clearing all previous losses. So if you aim to make &pound;10,000 in a year placing 1,000 bets at 4/1, you expect to win one in six rolls, i.e. win on 1000/6 times = 166.67 wins in the year at an average of 10000/166.67 each win = £60, PLUS you need to recover previous losses, so you aim to win £60 + the deficit in your tank.<br><br>So if your tank shows -&pound;1,000 you need to place a bet to win &pound;1060 at 4/1, which would be £265</p>
		</div>
	</div>


	<div id="openModalBuyAt" class="modalDialog">
		<div>
			<a href="#close" title="Close" class="close">X</a>
			<H2>Buy At</H2>

			<p>You&apos;re buying at the odds offered by the bookmaker on the chance of rolling a 6. In most gambling - especially on sporting events - it is not possible to be so precise about the real probability of success. Nevertheless, the possibility exists for any horse/person/team to win. The skill comes in finding the probability of a win and buying at odds better than that probability.</p>
			<p>Buying at 5/1 means you&apos;ll place 6 bets of &pound;1 and on the last bet you will win &pound;5 plus your stake of &pound;1 and thus, over 6 bets, you have won nothing and lost nothing. After 300 years of placing bets every day that&apos;s exactly where you&apos;ll be - NOT richer but NOT poorer.</p>
			<p>Buying at 6/1 would find you in profit overall but you will need to manage long streaks of losing. If you&apos;re using variable bets, you could find the size of bet impossible when you need to recover a run of losses. If you&apos;re using level bets you&apos;re much safer but still could find problems after a long losing streak.</p>
			<p>Buying at 4/1 - which any bookmaker still in business might be offering - you are definitely a LOSER&#33;</p>
		</div>
	</div>

	
	<div id="openModalTank" class="modalDialog">
		<div>
			<a href="#close" title="Close" class="close">X</a>
			<H2>Tank</H2>

			<p>The tank is what you would have at the end of the year if you started on empty and placed the same bet every time. The level bet is calculated to produce the annual income if the dice rolls a 6 every 6th roll.</p>
		</div>
	</div>

	<div id="openModalWorst" class="modalDialog">
		<div>
			<a href="#close" title="Close" class="close">X</a>
			<H2>Worst</H2>

			<p>On level bets this is the most you would be in debt. This is the most empty your tank would be during the year, together with the bet you would still need to place.</p>
		</div>
	</div>



	<div id="openModalBest" class="modalDialog">
		<div>
			<a href="#close" title="Close" class="close">X</a>
			<H2>Best</H2>

			<p>On level bets this is the most you would be in profit. The most full your tank would be during the year.</p>
		</div>
	</div>


	<div id="openModalPocket" class="modalDialog">
		<div>
			<a href="#close" title="Close" class="close">X</a>
			<H2>Pocket</H2>

			<p>On variable bets this is the amount you would have in your betting account at the end of the year. Note that no matter what the odds, you will get the same income from the same number of 6s. However, you may need a substantial resource to cover your debts at any odds - as you might see in the next column. I have called this &quot;Pocket&quot; to reflect your profit taken during the year.</p>
		</div>
	</div>


	<div id="openModalWorstOutlay" class="modalDialog">
		<div>
			<a href="#close" title="Close" class="close">X</a>
			<H2>Worst Outlay</H2>

			<p>This figure shows maximum losses in the year, together with the outlay you&apos;d need to recover your losses and make the next win. Many times, this figure is far beyond possibility and serves to illustrate the inherent flaw of this approach to betting as a source of income. Equals the deficit in your tank plus the money you would need to bet to restore you tank to zero and make a small profit.</p>
		</div>
	</div>

	
	<div id="openModalAverage" class="modalDialog">
		<div>
			<a href="#close" title="Close" class="close">X</a>
			<H2>Average occurence of a number</H2>

			<p>The number of occurrences of any number on a dice will, after enough rolls, tend towards once in every six rolls. That is, on average, in six rolls, 6 will occur once and a number between 1 and 5 will occur on the other five rolls. The number shown here is the actual ratio occuring in this illustration. It is as true to life as you could expect. After many years this should tend to exactly 1/5. It may take over 40,000 rolls for this to stabilise - about <?php echo 100*ceil(40000/($_SESSION["BetsPerWeek"]*$_SESSION["WeeksPerYear"]*1000)) ?> years at your number of bets!</p>
		</div>
	</div>
	
	
	<div id="openModalAfford" class="modalDialog">
		<div>
			<a href="#close" title="Close" class="close">X</a>
			<H2>Could you afford it?</H2>

			<p>Using variable bets to recover previous losses and make a small profit cannot work unless you have many millions available and your target profit is comparatively small.</p>
			<p>Buying at your chosen odds of <?php echo $_SESSION["ChosenOdds"]; ?> using variable bets you would have needed funds of: &pound;
			<?php 
				switch ($_SESSION["ChosenOdds"]) {
					case "4/1":
						echo number_format(-$_SESSION["WorstOutlay4"]);
						break;
					case "5/1":
						echo number_format(-$_SESSION["WorstOutlay5"]); 
						break;
					case "6/1":
						echo number_format(-$_SESSION["WorstOutlay6"]); 
						break;
				}
			?> 
			</p>
			<p>This is the bet you need to place to recover previous losses and make your small profit. If you watch this figure after each year&apos;s betting, you will soon realise the impossibility of this method. If you were rich enough to be betting this way, the annual income would not be sufficient to pay your domestic bills. Sooner or later you will need to place a bet that no one will accept&#33;</p>
		</div>
	</div>
	
</BODY>
</HTML>
