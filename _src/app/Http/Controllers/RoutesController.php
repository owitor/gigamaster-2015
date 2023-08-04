<?php

/**
 * Description of TesteController
 *
 * @author Witor
 */

namespace Controllers;

use Controller\Controller;
use View\View;

class RoutesController extends Controller {

    public function index() {
        View::run('home');
    }

    public function produtos() {
        View::run('produtos');
    }

    public function produto() {
        View::run('produto');
    }

}
