<?php

namespace App\View\Components\AppPlugin\Crm\Ticket;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TechFollowUpBox extends Component
{

    public $row;
    public $collapsed;
    public $collapsed_style;
    public $open;
    public $open_style;
    public $isactive;
    public $bg;
    public $option_2;
    public $option_3;
    public $option_4;
    public $option_5;
    public $option_6;
    public $option_7;

    public function __construct(
        $row = array(),
        $collapsed = true,
        $open = true,
        $isactive = true,
        $bg = "bg-success",
        $option_2 = null,
        $option_3 = null,
        $option_4 = null,
        $option_5 = null,
        $option_6 = null,
        $option_7 = null,
    )
    {
        $this->row = $row;
        $this->collapsed = $collapsed;

        if($row->follow_state == 1 or $row->follow_state == '2' ){
            $this->bg = $bg;
        }elseif ($row->follow_state == 3){
            $this->bg = 'bg-dark';
        }elseif ($row->follow_state == 4){
            $this->bg = 'bg-warning';
        }elseif ($row->follow_state == 5 or $row->follow_state == 6 ){
            $this->bg = 'bg-danger';
        }



        if ($collapsed) {
            if ($open) {
                $this->collapsed_style = "";
            } else {
                $this->collapsed_style = "collapsed-card";
            }
        } else {
            $this->collapsed_style = "";
        }
        $this->open = $open;

        if ($this->open) {
            $this->open_style = "fas fa-minus";
        } else {
            $this->open_style = "fas fa-plus";
        }


        $this->isactive = $isactive;

        $this->option_2 = $option_2;
        $this->option_3 = $option_3;
        $this->option_4 = $option_4;
        $this->option_5 = $option_5;
        $this->option_6 = $option_6;
        $this->option_7 = $option_7;
    }

    public function render(): View|Closure|string
    {
        return view('components.app-plugin.crm.ticket.tech-follow-up-box');
    }
}
