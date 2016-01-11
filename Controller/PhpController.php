<?php

class PhpController extends Controller
{
  function compile()
  {
    $file_name = get_file_name();

    $file = fopen

  }

  private function get_file_name()
  {
    $file_name = '';
    $finded = false;

    for ($i = 0; !$finded ; $i++)
    {
      $file_name = 'compile_php'.$i.'.php';

      if (!file_exists($file_name))
        $finded = true;
    }

    return ($file_name);
  }
}
