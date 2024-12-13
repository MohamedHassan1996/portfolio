<?php

namespace App\Services\Faq;

use App\Enums\Faq\FaqStatus;
use App\Filters\Faq\FaqSearchTranslatableFilter;
use App\Models\Faq\Faq;
use Illuminate\Support\Facades\Storage;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class FaqService{

    private $faq;
    public function __construct(Faq $faq)
    {
        $this->faq = $faq;
    }

    public function allFaqs()
    {
        $faqs = QueryBuilder::for(Faq::class)
            ->withTranslation() // Fetch translations if applicable
            ->allowedFilters([
                AllowedFilter::custom('search', new FaqSearchTranslatableFilter() ), // Add a custom search filter
            ])->get();

        return $faqs;

    }

    public function createFaq(array $faqData): Faq
    {

        $faq = new Faq();

        $faq->order = $faqData['order'];
        $faq->is_published = FaqStatus::from($faqData['isPublished'])->value;

        if(!empty($faqData['questionAr'])){
            $faq->translateOrNew('ar')->question = $faqData['questionAr'];
            $faq->translateOrNew('ar')->answer = $faqData['answerAr'];
        }

        if(!empty($faqData['questionEn'])){
            $faq->translateOrNew('en')->question = $faqData['questionEn'];
            $faq->translateOrNew('en')->answer = $faqData['answerEn'];
        }

        $faq->save();

        return $faq;

    }

    public function editFaq(int $faqId)
    {
        return Faq::with('translations')->find($faqId);
    }

    public function updateFaq(array $faqData): Faq
    {

        $faq = Faq::find($faqData['faqId']);

        $faq->order = $faqData['order'];
        $faq->is_published = FaqStatus::from($faqData['isPublished'])->value;

        if(!empty($faqData['questionAr'])){
            $faq->translateOrNew('ar')->question = $faqData['questionAr'];
            $faq->translateOrNew('ar')->answer = $faqData['answerAr'];
        }

        if(!empty($faqData['questionEn'])){
            $faq->translateOrNew('en')->question = $faqData['questionEn'];
            $faq->translateOrNew('en')->answer = $faqData['answerEn'];
        }

        $faq->save();

        return $faq;


    }


    public function deleteFaq(int $faqId)
    {

        $faq  = Faq::find($faqId);

        $faq->delete();

    }

    public function changeStatus(int $faqId, bool $isPublished)
    {
        $faq = Faq::find($faqId);
        $faq->is_published = $isPublished;
        $faq->save();
    }




}
