<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJv+M4bT5pbgj8k0L24bXOp1s7Lf6g97V6obmB9ph0hlK3WZj3gkH6RlrB9N" crossorigin="anonymous">
    
    
    <title>Ledger Data</title>

    <style>
    
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            width: 92%;
            margin: 0 auto;
           
        }

        h2 {
            color: #2b6cb0;
            font-size: 2rem;
            text-align: center;
            margin-bottom: 20px;
        }

        .table_container{
            width: 100%;
            margin: 0 auto;
            overflow-x: auto; 
            white-space: nowrap;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #2b6cb0;
            color: white;
            font-size: 1.1rem;
            
        }

        td {
            background-color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e0f7fa;
        }

        .custom-btn {
            background-color: #38b2ac;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            margin-top: 20px;
        }

        .custom-btn:hover {
            background-color: #319795;
        }

        .form-container .row {
            display: flex;
            width: 50%;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .form-container .col-md-3 {
            max-width: 23%; 
        }

        .form-container .col-md-12.mt-2 {
            display: flex;
            justify-content: center;
            gap: 10px; 
        }

        .form-container input {
            margin-bottom: 10px;
        }

        .form-container .btn {
            padding: 8px 15px;
            font-size: 14px;
        }

        .form-container .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .form-container .btn-secondary {
            background-color: #6c757d;
            border: none;
        }

        .form-container .btn:hover {
            opacity: 0.9;
        }

        a{
            text-decoration: none;
        }

        table th.fr_width,
        table td.fr_width {
            width: 150px; 
            text-overflow: ellipsis; 
            overflow: hidden;
            white-space: nowrap; 
        }

        table tbody tr:hover {
            background-color: #f8f9fa;
        }

        svg{
            display: flex;
            justify-content: center;
            width: 50px;
        }

</style>
</head>

<body>
    <div class="container mt-5">
        <h2>Ledger Data</h2>
       
        <form method="GET" action="{{ route('ledger.index') }}" class="form-container mb-4">
            <div class="row">
                <!-- Ledger Name Filter -->
                <div class="col-md-3 mb-3">
                    <input type="text" id="ledger_name" name="ledger_name" class="form-control" placeholder="Ledger Name" value="{{ request('ledger_name') }}">
                </div>
        
                <!-- Sub-Group Name Filter -->
                <div class="col-md-3 mb-3">
                    <input type="text" id="sub_group_name" name="sub_group_name" class="form-control" placeholder="Sub-Group Name" value="{{ request('sub_group_name') }}">
                </div>
        
                <!-- Group Name Filter -->
                <div class="col-md-3 mb-3">
                    <input type="text" id="group_name" name="group_name" class="form-control" placeholder="Group Name" value="{{ request('group_name') }}">
                </div>
        
                <!-- AP Version Filter -->
                <div class="col-md-3 mb-3">
                    <input type="text" id="ap_version" name="ap_version" class="form-control" placeholder="AP Version" value="{{ request('ap_version') }}">
                </div>
        
                <!-- Filter and Reset Buttons -->
                <div class="col-md-12 mt-2 text-center">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('ledger.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>

        <div class="table_container">
        <!-- Ledger Table -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Created Date</th>
                    <th>Group ID</th>
                    <th>Group Name</th>
                    <th>Sub Group ID</th>
                    <th>Sub Group Name</th>
                    <th>Is Active</th>
                    <th>Is Deleted</th>
                    <th>Updated Date</th>
                    <th>Version</th>
                    <th>Code</th>
                    <th>Is Group</th>
                    <th>Is Ledger</th>
                    <th>Is Sub Group</th>
                    <th>Ledger Name</th>
                    <th>Created By</th>
                    <th>Updated By</th>
                    <th>Ledger Type ID</th>
                    <th>Parent ID</th>
                    <th>TB Menu ID</th>
                    <th>Serial Number</th>
                    <th class="fr_width">Formula</th>
                    <th>Is Editable</th>
                    <th>Depreciation Ledger ID</th>
                    <th>Accumulated Depreciation ID</th>
                    <th>Is Optional</th>
                    <th>AP Version</th>
                    <th>FSA Area ID</th>
                    <th>Ledger Header</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ledgers as $ledger)
                    <tr>
                        <td>{{ $ledger->id }}</td>
                        <td>{{ $ledger->created_date }}</td>
                        <td>{{ $ledger->group_id ?? 'N/A' }}</td>
                        <td>{{ $ledger->group_name ?? 'N/A' }}</td>
                        <td>{{ $ledger->sub_group_id ?? 'N/A' }}</td>
                        <td>{{ $ledger->sub_group_name ?? 'N/A' }}</td>
                        {{-- <td>{{ $ledger->ledger_name }}</td> --}}
                        <td>{{ $ledger->is_active ? 'Yes' : 'No' }}</td>
                        <td>{{ $ledger->is_deleted ? 'Yes' : 'No' }}</td>
                        <td>{{ $ledger->updated_date }}</td>
                        <td>{{ $ledger->version }}</td>
                        <td>{{ $ledger->code }}</td>
                        <td>{{ $ledger->is_group ? 'Yes' : 'No' }}</td>
                        <td>{{ $ledger->is_ledger ? 'Yes' : 'No' }}</td>
                        <td>{{ $ledger->is_sub_group ? 'Yes' : 'No' }}</td>
                        <td>{{ $ledger->ledger_name }}</td>
                        <td>{{ $ledger->created_by }}</td>
                        <td>{{ $ledger->updated_by }}</td>
                        <td>{{ $ledger->ledger_type_id }}</td>
                        <td>{{ $ledger->parent_id }}</td>
                        <td>{{ $ledger->tb_menu_id }}</td>
                        <td>{{ $ledger->serialnumber }}</td>
                        <td class="fr_width">{{ $ledger->formula }}</td>
                        <td>{{ $ledger->is_editable ? 'Yes' : 'No' }}</td>
                        <td>{{ $ledger->depreciation_ledger_id }}</td>
                        <td>{{ $ledger->accumulated_depreciation_id }}</td>
                        <td>{{ $ledger->is_optional ? 'Yes' : 'No' }}</td>
                        <td>{{ $ledger->ap_version }}</td>
                        <td>{{ $ledger->fsa_area_id }}</td>
                        <td>{{ $ledger->ledger_header }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No Ledgers Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
        <div class="d-flex justify-content-center">
            {{ $ledgers->links() }}
        </div>    
    </div>

</body>

</html>