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
        <style>
            .dropdown-content {
                display: none;
                position: absolute;
                background-color: #f9f9f9;
                min-width: 160px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                z-index: 1;
            }
            .dropdown-content a, .dropdown-content button {
                color: black;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
                width: 100%;
                text-align: left;
                border: none;
                background: none;
                cursor: pointer;
            }
            .dropdown-content a:hover, .dropdown-content button:hover {
                background-color: #f1f1f1;
            }
        </style>
    </head>

<body>
@include('admin.navbar')

    <div class="p-4 sm:ml-64">
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <h2 class="text-xl font-semibold text-gray-900 sm:text-2xl m-5">Activity Log</h2>
            <input type="date" id="dateFilter" class="ml-2 mb-4 px-4 py-2 border rounded" onchange="applyFilters()">
            <button id="resetFilterButton" onclick="resetFilters()" class="ml-2 mb-4 px-4 py-2 bg-red-500 text-white rounded" style="display: none;">Reset Filter</button>
            <table class="w-full text-sm text-left mt-5">
                <thead class="uppercase">
                    <tr class="border-2">
                        <th scope="col" class="px-6 py-3 dropdown" onclick="toggleDropdown(this)" onkeypress="toggleDropdown(this)" onkeydown="toggleDropdown(this)" onkeyup="toggleDropdown(this)">
                            Log ID
                            <div class="dropdown-content">
                                <button onclick="sortTable(0, 'asc')">Ascending</button>
                                <button onclick="sortTable(0, 'desc')">Descending</button>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 dropdown" onclick="toggleDropdown(this)" onkeypress="toggleDropdown(this)" onkeydown="toggleDropdown(this)" onkeyup="toggleDropdown(this)">
                            Updated by
                            <div class="dropdown-content">
                                <button onclick="applyFilters('user')">User</button>
                                <button onclick="applyFilters('seller')">Seller</button>
                                <button onclick="applyFilters('admin')">Admin</button>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 dropdown" onclick="toggleDropdown(this)">
                            Action Performed
                            <div class="dropdown-content">
                                <button onclick="applyFilters('', 'insert')">Insert</button>
                                <button onclick="applyFilters('', 'delete')">Delete</button>
                                <button onclick="applyFilters('', 'update')">Update</button>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">Table Name</th>
                        <th scope="col" class="px-6 py-3">Column Data</th>
                        <th scope="col" class="px-6 py-3">Date & Time</th>
                    </tr>
                </thead>
                <tbody id="activityLogTable">
                    @foreach ($activityLogs as $log)
                    <tr class="border-b text-black">
                        <td class="px-6 py-4">{{ $log->log_id }}</td>
                        <td class="px-6 py-4">{{ $log->usertype }}</td>
                        <td class="px-6 py-4">{{ $log->action_performed }}</td>
                        <td class="px-6 py-4">{{ $log->table_name }}</td>
                        <td class="px-6 py-4">{{ $log->column_data }}</td>
                        <td class="px-6 py-4">{{ $log->updated_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        var usertypeFilter = '';
        var actionPerformedFilter = '';
        var dateFilter = '';

        function toggleDropdown(element) {
            var dropdownContent = element.querySelector('.dropdown-content');
            dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
        }

        function sortTable(columnIndex, order) {
            var table = document.getElementById("activityLogTable");
            var rows = Array.from(table.rows);
            rows.sort(function(a, b) {
                var cellA = a.cells[columnIndex].innerText;
                var cellB = b.cells[columnIndex].innerText;
                if (order === 'asc') {
                    return cellA.localeCompare(cellB, undefined, {numeric: true});
                } else {
                    return cellB.localeCompare(cellA, undefined, {numeric: true});
                }
            });
            rows.forEach(function(row) {
                table.appendChild(row);
            });
        }

        function applyFilters(usertype = '', actionPerformed = '', date = document.getElementById('dateFilter').value) {
            if (usertype) usertypeFilter = usertype;
            if (actionPerformed) actionPerformedFilter = actionPerformed;
            if (date) dateFilter = date;

            var table = document.getElementById("activityLogTable");
            var rows = table.rows;
            var isFilterActive = false;
            for (var i = 0; i < rows.length; i++) {
                var usertypeCell = rows[i].cells[1];
                var actionPerformedCell = rows[i].cells[2];
                var dateCell = rows[i].cells[5];
                if (usertypeCell && actionPerformedCell && dateCell) {
                    if ((usertypeCell.innerText.trim().toLowerCase() === usertypeFilter.toLowerCase() || usertypeFilter === '') &&
                        (actionPerformedCell.innerText.trim().toLowerCase() === actionPerformedFilter.toLowerCase() || actionPerformedFilter === '') &&
                        (dateCell.innerText.trim().substring(0, 10) === dateFilter || dateFilter === '')) {
                        rows[i].style.display = '';
                    } else {
                        rows[i].style.display = 'none';
                        isFilterActive = true;
                    }
                }
            }
            document.getElementById('resetFilterButton').style.display = isFilterActive ? 'inline-block' : 'none';
        }

        function resetFilters() {
            actionPerformedFilter = '';
            dateFilter = '';
            usertypeFilter = '';
            actionPerformedFilter = '';
            dateFilter = '';
            applyFilters();
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.dropdown')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.style.display === 'block') {
                        openDropdown.style.display = 'none';
                    }
                }
            }
        }
    </script>
</body>
</html>
