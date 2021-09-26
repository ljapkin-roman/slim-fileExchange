<?php

namespace Summit\Core;

class View
{
    function generate($content_view, $template_view = '../template', $data = null)
    {
        include dirname(__DIR__) . '/Views/Template_View.php';
    }
}