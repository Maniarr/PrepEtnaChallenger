<?php

class PageController extends Controller
{
  function code()
  {
    $this->view('code');
  }

  function route_404()
  {
    $this->redirect('/');
  }
}
