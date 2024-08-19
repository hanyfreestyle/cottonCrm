<?php

namespace App\Http\Livewire\Site;


use App\AppPlugin\Leads\NewsLetter\NewsLetter;
use Livewire\Component;

class NewsLetterForm extends Component {

    public $email;

    public function render() {
        return view('livewire.site.news-letter-form');
    }

    public function addNew() {

        $validatedData = $this->validate(
            ['email' => 'required|email|unique:leads_news_letters'],
            [
                'email.required' => __('web/newsletter.err_email'),
                'email.email' => __('web/newsletter.err_email'),
                'email.unique' => __('web/newsletter.err_email_unique'),
            ],
        );

        NewsLetter::create($validatedData);
        session()->flash('SaveToNewsLetter', __('web/newsletter.err_confirm'));
    }
}
