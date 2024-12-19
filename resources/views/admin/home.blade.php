
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css'); }}">
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/bold/style.css"/>
        <script type="text/javascript" src="{{ URL::asset('js/main.js') }}"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <title>UP TREND</title>
    </head>

    <body>
    @include('admin.navbar')

    <div class="">

<div class="">
<div class="">


<div class="p-4 sm:ml-64">
<div class="overflow-x-auto relative shadow-md sm:rounded-lg">
    <h3 class="text-lg font-semibold text-gray-900 sm:text-2xl m-5">Latest Activity</h3>
    <table class="w-full text-sm text-left mt-5">
    <thead class="uppercase">
            <tr class="border-2">
                <th scope="col" class="px-6 py-3">Log ID</th>
                <th scope="col" class="px-6 py-3">Updated by</th>
                <th scope="col" class="px-6 py-3">Action Performed</th>
                <th scope="col" class="px-6 py-3">Table Name</th>
                <th scope="col" class="px-6 py-3">Column Data</th>
                <th scope="col" class="px-6 py-3">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($activityLogs as $log)
            <tr class="border-b text-black" data-usertype="{{ $log->usertype }}">
                <td class="px-6 py-4">{{ $log->log_id }}</td>
                <td class="px-6 py-4">{{ $log->usertype }}</td>
                <td class="px-6 py-4">{{ $log->action_performed }}</td>
                <td class="px-6 py-4">{{ $log->table_name }}</td>
                <td class="px-6 py-4">{{ $log->column_data }}</td>
                <td class="px-6 py-4">{{ $log->updated_at }}</td>
            @endforeach
            </tr>
        </tbody>
    </table>

    <!-- See More Button -->
    <div class="m-5 flex justify-center">
        <a href="{{ url('/activity-logs') }}" class="inline-block justify-center rounded-lg bg-black px-10 py-2.5 text-sm font-medium text-white">
            See More
        </a>
    </div>

    <h3 class="text-lg font-semibold text-gray-900 sm:text-2xl m-5">New Users</h3>
    <table class="w-full text-sm text-left mt-5">
        <thead class="uppercase">
            <tr class="border-2">
                <th scope="col" class="px-6 py-3">Username</th>
                <th scope="col" class="px-6 py-3">Email</th>
                <th scope="col" class="px-6 py-3">Role</th>
                <th scope="col" class="px-6 py-3">Join Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($topUsers as $user)
            <tr class="border-b text-black">
                <td class="px-6 py-4">{{ $user->name}}</td>
                <td class="px-6 py-4">{{ $user->email}}</td>
                <td class="px-6 py-4">{{ $user->usertype}}</td>
                <td class="px-6 py-4">{{ $user->created_at }}</td>
            @endforeach
            </tr>
        </tbody>
    </table>

    <!-- See More Button -->
    <div class="m-5 flex justify-center">
        <a href="{{ url('/show_users') }}" class="inline-block justify-center rounded-lg bg-black px-10 py-2.5 text-sm font-medium text-white">
            See More
        </a>
    </div>

</div>

</div>
</div>
</div>


    </body>
</html>
