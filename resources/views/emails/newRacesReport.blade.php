@component('mail::message')
# New Races

*{{\Carbon\Carbon::now()->toFormattedDateString()}}*

@component('mail::table')
    @if($races->count())
        | Title         | Youtube_id            | Link     |
        |:------------- |:--------------------- |:-------- |
        @foreach($races as $race)
            | {{$race->title}}  | {{$race->youtube_id}} |  [Watch](https://www.youtube.com/watch?v={{$race->youtube_id}}) |
        @endforeach
    @else
        No new races today
    @endif
@endcomponent

@component('mail::button', ['url' => '/nova/resources/potential-races', 'color' => 'green'])
View Details
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
