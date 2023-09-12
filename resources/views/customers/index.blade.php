<!DOCTYPE html>
<html>

<head>
    <title>Customer List</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<style>
    .mt-2,
    .my-2 {
        margin-top: -0.2rem !important;
    }
</style>
@if ($message = Session::get('success'))
    <div class="alert alert-success" style='background-color: #d4edda'>
        <p style='font-weight: bolder;'>{{ $message }}</p>
    </div>
@endif

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Customer List</h1>

        <form action="{{ route('customers.index') }}" method="GET" class="mb-3">
            <div class="form-row">
                <div class="col-md-4">
                    <label for="filter_date">Filter by Date:</label>
                </div>
                <div class="col-md-4">
                    <input type="date" class="form-control" id="filter_date" name="filter_date"
                        value="{{ request('filter_date') }}">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary mt-2">Filter</button>
                </div>
            </div>
        </form><br> 
        <div class='cre' style='margin-left:980px'>
           <a href="{{ route('customers.create') }}" class="btn btn-sm btn-primary">create customer</a>
        </div>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Date of Birth</th>
                    <th>Points</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->phonenumber }}</td>
                        <td>{{ $customer->date_of_birth }}</td>
                        <td>{{ number_format($customer->points, 2, '.', '') }}</td>
                        <td>
                            <a href="{{ route('customers.edit', $customer) }}" class="btn btn-sm btn-primary">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Add Bootstrap JS and jQuery scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
