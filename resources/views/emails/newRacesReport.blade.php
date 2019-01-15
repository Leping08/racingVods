@component('mail::message')
# New Races

*{{\Carbon\Carbon::now()->toFormattedDateString()}}*

@component('mail::table')
    | Title         | Youtube_id            | Link     |
    |:------------- |:--------------------- |:-------- |
    @foreach($races as $race)
        | {{$race->title}}  | {{$race->youtube_id}} |  [Watch](https://www.youtube.com/watch?v={{$race->youtube_id}}) |
    @endforeach
@endcomponent

@component('mail::button', ['url' => '/create-potential-races', 'color' => 'green'])
View Details
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
