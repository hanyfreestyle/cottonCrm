<?php

namespace App\View\Components\Admin\Ajax;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TagSerach extends Component {

    public $row;
    public $id;
    public $length;
    public $newTags;
    public $tagsOnFly;

    public function __construct(
        $row = array(),
        $id = 'tag_id',
        $length = 2,
        $newTags = true,
        $tagsOnFly = false,

    ) {
        $this->row = $row;
        $this->id = $id;
        $this->length = $length;
        $this->newTags = $newTags;
        $this->tagsOnFly = $tagsOnFly;

    }

    public function render(): View|Closure|string {
        return view('components.admin.ajax.tag-serach');
    }
}
