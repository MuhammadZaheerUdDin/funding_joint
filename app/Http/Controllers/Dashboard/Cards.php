<?php
/**
 * Created by PhpStorm.
 * User: sizdrail
 * Date: 11/1/2018
 * Time: 10:18 AM
 */

namespace App\Http\Controllers\Dashboard;


class Cards
{

    public $width;

    public $title;

    public $model;

    public $link;



    /**
     * Cards constructor.
     * @param $title
     * @param $value
     * @param $width
     * @param $link
     */
    public function __construct($title, $value , $width, $link = '')
    {




        $this->title = $title;

        $this->model = $value;

        $this->width = $width;

        $this->value = $this->model;

        $this->link = $link;

    }

    /**
     * @method render
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render()
    {

        $title = $this->title;

        $content = $this->model;
        $link = $this->link;
        return view('components.dashboardCard', compact('title', 'content', 'value','link'));
    }
}