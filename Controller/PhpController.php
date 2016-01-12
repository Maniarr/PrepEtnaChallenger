<?php

class PhpController extends Controller
{
  function compile()
  {
    $file_name = $this->get_file_name();

    $file = fopen($file_name, 'c+');
    fwrite($file, $_POST['code']);
    fclose($file);

    $time = microtime(true);
    exec('php '.$file_name.' > '.$file_name.'out', $tmp, $errno);
    $time_exec = (microtime(true) - $time);

    $file_out = fopen($file_name.'out', 'c+');
    $output = fread($file_out, filesize($file_name.'out') + 1);
    fclose($file_out);

    echo json_encode(array('output' => $output, 'time' => $time_exec, 'status' => $errno == 0 ? 'success' : 'error'));

    unlink($file_name);
    unlink($file_name.'out');
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
}
