<?php

namespace App\View\Components\Admin\Lang;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MetaTageSeo extends Component {


    public $keyLang;
    public $key;
    public $row;
    public $defName;
    public $des;
    public $defDes;
    public $seo;
    public $slug;
    public $viewtype;
    public $printType;

    public function __construct(
        $key = null,
        $row = array(),
        $defName = null,
        $des = true,
        $defDes = null,
        $seo = true,
        $slug = true,
        $viewtype = null,
        $printType = 'Des',
    ) {
        $this->key = $key;
        $this->row = $row;
        if ($defName == null) {
            $defName = __('admin/form.text_name');
        }
        $this->defName = $defName;

        $this->des = $des;
        if ($defDes == null) {
            $defDes = __('admin/form.text_content');
        }
        $this->defDes = $defDes;
        $this->seo = $seo;
        $this->slug = $slug;
        $this->viewtype = $viewtype;
        $this->printType = $printType;
        $this->keyLang = __('admin.multiple_lang_key_' . $this->key);
    }


    public function render(): View|Closure|string {
        return view('components.admin.lang.meta-tage-seo');
    }
}
