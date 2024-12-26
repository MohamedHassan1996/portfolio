<?php

namespace App\Services\Event;

use App\Enums\Event\EventStatus;
use App\Filters\Event\EventSearchTranslatableFilter;
use App\Models\Event\Event;
use App\Services\Upload\UploadService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class EventService{

    private $event;
    private $uploadService;
    public function __construct(Event $event, UploadService $uploadService)
    {
        $this->event = $event;
        $this->uploadService = $uploadService;
    }

    public function allEvents()
    {
        $events = QueryBuilder::for(Event::class)
            ->allowedFilters([
                AllowedFilter::custom('search', new EventSearchTranslatableFilter()), // Add a custom search filter
            ])->get();

        return $events;

    }

    public function createEvent(array $eventData): Event
    {

        $path = null;
        if(isset($eventData['thumbnail']) && $eventData['thumbnail'] instanceof UploadedFile){
            $path =  $this->uploadService->uploadFile($eventData['thumbnail'], 'events');
        }

        $event = new  Event();

        $event->is_published = EventStatus::from($eventData['isPublished'])->value;
        $event->thumbnail = $path;
        $event->date = $eventData['date'];
        $event->time = $eventData['time'];
        $event->location = $eventData['location'];


        if (!empty($eventData['titleAr'])) {
            $event->translateOrNew('ar')->title = $eventData['titleAr'];
            $event->translateOrNew('ar')->slug = $eventData['slugAr'];
            $event->translateOrNew('ar')->description = $eventData['descriptionAr'];
            $event->translateOrNew('ar')->meta_data = $eventData['metaDataAr'];
        }

        if (!empty($eventData['titleEn'])) {
            $event->translateOrNew('en')->title = $eventData['titleEn'];
            $event->translateOrNew('en')->slug = $eventData['slugEn'];
            $event->translateOrNew('en')->description = $eventData['descriptionEn'];
            $event->translateOrNew('en')->meta_data = $eventData['metaDataEn'];
        }


        $event->save();


        return $event;

    }

    public function editEvent(int $eventId)
    {
        return Event::with('translations')->find($eventId);
    }

    public function updateEvent(array $eventData): Event
    {

        $event = Event::find($eventData['eventId']);

        $path = null;

        if(isset($eventData['thumbnail']) && $eventData['thumbnail'] instanceof UploadedFile){
            $path =  $this->uploadService->uploadFile($eventData['thumbnail'], 'events');
        }

        $event->is_published = EventStatus::from($eventData['isPublished'])->value;
        $event->thumbnail = $path;
        $event->date = $eventData['date'];
        $event->time = $eventData['time'];
        $event->location = $eventData['location'];

        if($path){
            $event->thumbnail = $path;
        }

        if (!empty($eventData['titleAr'])) {
            $event->translateOrNew('ar')->title = $eventData['titleAr'];
            $event->translateOrNew('ar')->slug = $eventData['slugAr'];
            $event->translateOrNew('ar')->description = $eventData['descriptionAr'];
            $event->translateOrNew('ar')->meta_data = $eventData['metaDataAr'];
        }

        if (!empty($eventData['titleEn'])) {
            $event->translateOrNew('en')->title = $eventData['titleEn'];
            $event->translateOrNew('en')->slug = $eventData['slugEn'];
            $event->translateOrNew('en')->description = $eventData['descriptionEn'];
            $event->translateOrNew('en')->meta_data = $eventData['metaDataEn'];
        }
        if($path){
            Storage::disk('public')->delete($path);
            $event->thumbnail = $path;
        }


        $event->save();

        return $event;


    }


    public function deleteEvent(int $eventId)
    {

        $event  = Event::find($eventId);

        if($event->thumbnail){
            Storage::disk('public')->delete($event->thumbnail);
        }

        $event->delete();

    }

    public function changeStatus(int $eventId, bool $isPublished)
    {
        $event = Event::find($eventId);
        $event->is_published = $isPublished;
        $event->save();
    }




}
