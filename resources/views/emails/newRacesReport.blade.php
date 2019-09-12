@component('mail::message')
# New Races

*{{\Carbon\Carbon::now()->toFormattedDateString()}}*

@component('mail::table')
    @if($races->count())
        | Title         | Link     |
        |:------------- |:-------- |
        @foreach($races as $race)
            | {{ str_replace('|', '', $race->title) }} | [Watch](https://www.youtube.com/watch?v={{$race->youtube_id}}) |
        @endforeach
    @else
        No new races today
    @endif
@endcomponent

@component('mail::button', ['url' => config('app.url').'nova/resources/potential-races', 'color' => 'green'])
View Details
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
