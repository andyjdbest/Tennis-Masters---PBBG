<?php

//FILE THAT CONTAINS Commentary LIST FOR NOW
$errC[0] = array('P1 mistimes his shot and the ball hits the net', 'P2 watches in delight as P1 makes a mess out of an easy return', 
	'He smashed it into the net. P1 is distraught', 'Thats a blunder from P1 as he hits the ball wide', 'P1 smashes it into the net. Disappointing',
	'An angry P1 smashes the racquet as he hit the ball wide off court', 'Mis-hit shot from P1, gives the point to P2', 
	'P1 lunges for the ball, but it hits the net. Point for P2.', 'P2 provides P1 with an easy shot, but P1 gets too cocky and hits it out.',
	'P2 rallies it back, but P1 messes up his footwork and barely hits the ball, resulting in hitting the net.');
$errC[1] = array('P2 mistimes his shot and the ball hits the net', 'P1 watches in delight as P2 makes a mess out of an easy return', 
	'He smashed it into the net. P2 is distraught', 'Thats a blunder from P2 as he hits the ball wide', 'P2 smashes it into the net. Disappointing',
	'An angry P2 smashes the racquet as he hit the ball wide off court', 'Mis-hit shot from P2, gives the point to P1',
	'P2 lunges for the ball, but it hits the net. Point for P1.', 'P1 provides P2 with an easy shot, but P2 gets too cocky and hits it out.',
	'P1 rallies it back, but P2 messes up his footwork and barely hits the ball, resulting in hitting the net.');

$aceC[0] = array('P1 serves an ace down the line', 'P2 could not reach the serve', 'Ace wide across the court from P1. P2 is speechless', 
  'P1 serves at a blistering speed with no response from P2', 'WOW. P1 makes that serve bolt past P2, who still thinks the serve has not been hit.',
  'P1 serves a quick ace.');
$aceC[1] = array('P2 serves an ace down the line', 'P1 could not reach the serve', 'Ace wide across the court from P2. P1 is speechless', 
  'P2 serves at a blistering speed with no response from P2', 'WOW! P2 makes that serve bolt past P1, who still thinks the serve has not been hit.',
  'P2 serves a quick ace.' );
  
$dfC[0] = array('P1 is tense after his first serve, it shows. That serve was terribly wide! DOUBLE FAULT', 
 'Nerves have gotten the better of P1, that was a miserable serve. DOUBLE FAULT', 'A weak second serve from P1 leads to a double fault.',
 'Does not look like P1 learned his lesson the first time as he nets the serve two times in a row. Double Fault.', 
 'And P1 has served a double fault! That could be really costly. Point to P2', 
 'P1 tried too hard on that 2nd serve and has served it over the baseline! Looks like P1 has the yips.', 
 'Heartbreak for P1! That 2nd serve has clipped the net and gone out by millimetres. Point to P2');
$dfC[1] = array('P2 is tense after his first serve, it shows. That serve was terribly wide! DOUBLE FAULT', 
 'Nerves have gotten the better of P2, that was a miserable serve. DOUBLE FAULT', 'A weak second serve from P2 leads to a double fault.',
 'Does not look like P2 learned his lesson the first time as he nets the serve two times in a row. Double Fault.', 
 'And P2 has served a double fault! That could be really costly. Point to P1', 
 'P2 tried too hard on that 2nd serve and has served it over the baseline! Looks like P2 has the yips.', 
 'Heartbreak for P2! That 2nd serve has clipped the net and gone out by millimetres. Point to P1');
 
$rsC[0] = array('That is a cracking drop shot from P1. P2 just stands back and applauds.', 'Even P2 had a smile on his face as he saw that ball whizz past him.',
  'A lot of air on that lob, P2 decides to leave it. That was certainly the wrong decision and has cost him the point.', 
  'We finally have a winner of this lengthy point as P1 hits a fantastic shot that is too well placed for P2 to return.', 
   'Clinical tennis by P1. That ball sat up for P1 and he blasted that down the forehand line for a winner.', 
  'P1 gives this backhand a little bit extra, and it has beaten P2 for pure pace. Super shot that by P1.',
  'I am in love! This has to be one of the shots of the match by P1, he has just blasted that forehand on the run and in doing so beat
   P2 who had cut down the angle considerably. Brilliant tennis this. Point to P1.');
$rsC[1] = array('That is a cracking drop shot from P2. P1 just stands back and applauds.', 'Even P1 had a smile on his face as he saw that ball whizz past him.',
  'A lot of air on that lob, P1 decides to leave it. That was certainly the wrong decision and has cost him the point.',
  'We finally have a winner of this lengthy point as P2 hits a fantastic shot that is too well placed for P1 to return.', 
   'Clinical tennis by P2. That ball sat up for P2 and he blasted that down the forehand line for a winner.', 
  'P2 gives this backhand a little bit extra, and it has beaten P1 for pure pace. Super shot that by P2.',
  'I am in love! This has to be one of the shots of the match by P2, he has just blasted that forehand on the run and in doing so beat
   P1 who had cut down the angle considerably. Brilliant tennis this. Point to P2.');
// [ERH]
// Due to the commentary being expanded based on the home player, the RECEIVER logic needs to be reverse of the SERVER logic
// (P2 needs to be the primary player, not P1 as the RECEIVER is the point winner)
$rrC[0] = array('P2 places it well.', 'Nice smash from P2',
  'P2 makes no mess of the easy lob and smashes it wide of P1', 'Hello there, thats an awesome return from P2',
  'We finally have a winner of this lengthy point as P2 hits a fantastic shot that is too well placed for P1 to return.', 
  'Clinical tennis by P2. That ball sat up for P2 and he blasted that down the forehand line for a winner.', 
  'P2 gives this backhand a little bit extra, and it has beaten P1 for pure pace. Super shot that by P2.',
  'I am in love! This has to be one of the shots of the match by P2, he has just blasted that forehand on the run and in doing so beat
   P1 who had cut down the angle considerably. Brilliant tennis this. Point to P2.' );
$rrC[1] = array('P1 places it well.', 'Nice smash from P1',
  'P1 makes no mess of the easy lob and smashes it wide of P2', 'Hello there, thats an awesome return from P1',
  'We finally have a winner of this lengthy point as P1 hits a fantastic shot that is too well placed for P2 to return.',
   'Clinical tennis by P1. That ball sat up for P1 and he blasted that down the forehand line for a winner.', 
  'P1 gives this backhand a little bit extra, and it has beaten P2 for pure pace. Super shot that by P1.',
  'I am in love! This has to be one of the shots of the match by P1, he has just blasted that forehand on the run and in doing so beat
   P2 who had cut down the angle considerably. Brilliant tennis this. Point to P1.');
  
function getCommentary($type, $sID, $hID){
 global $aceC, $dfC, $rsC, $rrC, $errC;
 $var = 1;
 
 if ($sID == $hID)
 {
  $var = 0;
 }
 else {
  $var = 1;
 }
 echo "<BR /> $sID, $hID $var <br />";
 switch ($type) {
   case 'ace':
    $num = random_number('INTEGER', 0, count($aceC[0]) - 1);
    return "A_" . $var . "_" . $num;
    //return $aceC[$num];
   case 'doubleFault':
    $num = random_number('INTEGER', 0, count($dfC[0]) - 1);
    return "D_" . $var . "_" . $num;
    //return $dfC[$num];
   case 'rallyS':
    $num = random_number('INTEGER', 0, count($rsC[0]) - 1);
    return "S_" . $var . "_" . $num;  
    //return $rwC[$num];
   case 'rallyR':
    $num = random_number('INTEGER', 0, count($rrC[0]) - 1);
    return "R_" . $var . "_" . $num;
   case 'errorR':
  	 if ($var == 0) $var = 1;
   	else $var = 0;
  	 $num = random_number('INTEGER', 0, count($errC[0]) - 1);
  	 return "E_" . $var . "_" . $num;
   case 'errorS':
  	 $num = random_number('INTEGER', 0, count($errC[0]) - 1);
  	 return "E_" . $var . "_" . $num;
  } 
 
}

function showCommentaryReplace($matches){
//print_r($matches);
 global $aceC, $dfC, $rsC, $rrC, $errC;
foreach($matches as $type)
{
 $comment = explode('_', $type);
 $num = $comment[2];
 $arr = $comment[1];
 switch ($comment[0]){
  case 'A':
   return $aceC[$arr][$num];
  case 'D':
   return $dfC[$arr][$num];
  case 'S':
   return $rsC[$arr][$num];
  case 'R':
   return $rrC[$arr][$num];
  case 'E':
   return $errC[$arr][$num];
 }
}
}
function showCommentaryReplaceTest($type){
//print_r($matches);
 global $aceC, $dfC, $rsC, $rrC;
 
 $comment = explode('_', $type);
 $num = $comment[2];
 $arr = $comment[1];
 
 switch ($comment[0]){
  case 'A':
   return $aceC[$arr][$num];
  case 'D':
   return $dfC[$arr][$num];
  case 'S':
   return $rsC[$arr][$num];
  case 'R':
   return $rrC[$arr][$num];
 }
}
?>
