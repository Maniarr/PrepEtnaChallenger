<?php

class PhpController extends Controller
{
  function compile()
  {
    $file_name = $this->get_file_name();

    $file = fopen($file_name, 'c+');
    fwrite($file, $_POST['code']);
    fclose($file);

    $dp_mp = $this->get_average_execute($file_name, 'script/php_file/message script/php_file/dico', 1);
    $dp_mg = $this->get_average_execute($file_name, 'script/php_file/message2 script/php_file/dico', 2);
    $dg_mp = $this->get_average_execute($file_name, 'script/php_file/message script/php_file/dico2', 3);
    $dg_mg = $this->get_average_execute($file_name, 'script/php_file/message2 script/php_file/dico2', 4);

    if (!$dp_mp || !$dp_mg || !$dg_mp || !$dg_mg)
    {
        echo json_encode('false');
        return;
    }

    $score = ($dp_mp + $dp_mg + $dg_mp + $dg_mg) / 4;

    $req = $this->db->prepare('INSERT INTO projet_nox(name, dp_mp, dp_mg, dg_mp, dg_mg, score) VALUES (:name, :dp_mp, :dp_mg, :dg_mp, :dg_mg, :score)');
    $req->execute(array(
        ':name' => htmlspecialchars($_POST['name']),
        ':dp_mp' => $dp_mp,
        ':dp_mg' => $dp_mg,
        ':dg_mp' => $dg_mp,
        ':dg_mg' => $dg_mg,
        ':score' => $score
    ));

    echo json_encode(array('average' => $score));

    unlink($file_name);
    unlink($file_name.'out');
  }

  private function get_average_execute($file_name, $params, $step)
  {
    $nb_loop = 20;
    $time_exec = 0;
    $error = false;

    for ($i = 0; $i < $nb_loop && !$error; $i++)
    {
      $time = microtime(true);
      exec('php '.$file_name.' '.$params.' > '.$file_name.'out', $tmp);
      $time_exec += (microtime(true) - $time);

      $file_out = fopen($file_name.'out', 'r');
      $output = fread($file_out, filesize($file_name.'out') + 1);
      fclose($file_out);

      $verif = shell_exec('cat '.$file_name.'out | wc -l');

      if ($step == 1 && intval($verif) != 6)
        $error = true;
      if ($step == 2 && intval($verif) != 74)
        $error = true;
      if ($step == 3 && intval($verif) != 9)
        $error = true;
      if ($step == 4 && intval($verif) < 37000 || intval($verif) > 41000)
        $error = true;

    }
    if ($error)
      return (false);
    else
      return ($time_exec / $nb_loop);
  }

  private function get_file_name()
  {
    $file_name = '';
    $finded = false;
    $pwd = 'script/php/';

    for ($i = 0; !$finded ; $i++)
    {
      $file_name = $pwd.'compile_php'.$i.'.php';

      if (!file_exists($file_name))
        $finded = true;
    }

    return ($file_name);
  }

  function top($number) {
	  if (intval($number) <= 0 && intval($number) > 30)
		  return (false);
	  $number = intval($number);
	  $top = $this->db->prepare('SELECT name, dp_mp, dp_mg, dg_mp, dg_mg, score, created_at FROM projet_nox ORDER BY score ASC LIMIT :num');
	  $top->bindParam(':num', $number, PDO::PARAM_INT);
	  $top->execute();
	  $json = json_encode($top->fetchAll());
	  echo $json;
  }

  function search($name) {
	  if (strlen($name) > 20)
		  return (false);

	  $player = $this->db->prepare('SELECT name, dp_mp, dp_mg, dg_mp, dg_mg, score, created_at FROM projet_nox WHERE name = :name');
	  $player->bindParam(':name', $name, PDO::PARAM_STR, 30);
	  $player->execute();
	  $player = $player->fetch();

	  $hight = $this->db->prepare('SELECT name, dp_mp, dp_mg, dg_mp, dg_mg, score, created_at FROM projet_nox WHERE :player_score > score ORDER BY score DESC LIMIT 4');
	  $hight->bindParam(':player_score', $player["score"]);
	  $hight->execute();
	  $hight = $hight->fetchAll();

	  $lower = $this->db->prepare('SELECT name, dp_mp, dp_mg, dg_mp, dg_mg, score, created_at FROM projet_nox WHERE :player_score < score ORDER BY score ASC LIMIT 4');
	  $lower->bindParam(':player_score', $player["score"]);
	  $lower->execute();
	  $lower = $lower->fetchAll();

	  $position = $this->db->prepare('SELECT COUNT(score) FROM projet_nox WHERE :player_score >= score');
	  $position->bindParam(':player_score', $player["score"]);
	  $position->execute();
	  $position = intval($position->fetch()[0]);

	  $output = array(
		  "player" => $player,
		  "hight" => $hight,
		  "lower" => $lower,
		  "position" => $position);
	  echo json_encode($output);
  }
}
