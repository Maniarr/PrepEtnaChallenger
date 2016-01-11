<?php

class PageController extends Controller
{
	function code()
	{
		$this->view('code');
	}

	function score() {
		$this->view('score');
	}

	function route_404()
	{
		$this->redirect('/');
	}
}
