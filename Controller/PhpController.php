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
    $dp_mg = $this->get_average_execute($file_name, 'script/php_file/message script/php_file/dico', 5);
    $dg_mp = $this->get_average_execute($file_name, 'script/php_file/message script/php_file/dico', 5);
    $dg_mg = $this->get_average_execute($file_name, 'script/php_file/message script/php_file/dico', 5);

    $score = ($dp_mp + $dp_mg + $dg_mp + $dg_mg) / 4;

    $file_out = fopen($file_name.'out', 'c+');
    $output = fread($file_out, filesize($file_name.'out') + 1);
    fclose($file_out);

    print_r(array(
        ':name' => htmlspecialchars($_POST['name']),
        ':dp_mp' => $dp_mp,
        ':dp_mg' => $dp_mg,
        ':dg_mp' => $dg_mp,
        ':dg_mg' => $dg_mg,
        ':score' => $score
    ));

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

  private function get_average_execute($file_name, $params, $timeout, $nb_loop = 50)
  {
    $time_exec = 0;

    for ($i = 0; $i < $nb_loop; $i++)
    {
      $time = microtime(true);
      exec('timeout php '.$file_name.' '.$params.' > '.$file_name.'out', $tmp);
      $time_exec += (microtime(true) - $time);
    }

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
	  echo $name;
	  $score = $this->db->prepare('SELECT score FROM projet_nox WHERE name = :name');
	  $score->bindParam(':name', $name, PDO::PARAMSTR, 30);
	  $score->execute();
  }
}
