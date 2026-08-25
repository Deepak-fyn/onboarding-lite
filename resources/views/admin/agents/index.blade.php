<!DOCTYPE html>
<html>
<head>
    <title>Agent Management</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            background: #f5f5f5;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            background: white;
            padding: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background: #eee;
        }

        .pending {
            color: orange;
            font-weight: bold;
        }

        .approved {
            color: green;
            font-weight: bold;
        }

        .rejected {
            color: red;
            font-weight: bold;
        }

        .filters {
            display: flex;
            gap: 10px;
        }

        input,
        select,
        button {
            padding: 8px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Agent Management</h1>

    <form method="GET" action="{{ route('admin.agents.index') }}">

        <div class="filters">

            <input
                type="text"
                name="search"
                placeholder="Search agent..."
                value="{{ request('search') }}"
            >

            <select name="status">

                <option value="">All Status</option>

                <option
                    value="pending"
                    {{ request('status') === 'pending' ? 'selected' : '' }}
                >
                    Pending
                </option>

                <option
                    value="approved"
                    {{ request('status') === 'approved' ? 'selected' : '' }}
                >
                    Approved
                </option>

                <option
                    value="rejected"
                    {{ request('status') === 'rejected' ? 'selected' : '' }}
                >
                    Rejected
                </option>

            </select>

            <button type="submit">
                Search
            </button>

            <a href="{{ route('admin.agents.index') }}">
                Clear
            </a>

        </div>

    </form>


    <table>

        <thead>

        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>PAN</th>
            <th>Aadhaar</th>
            <th>Status</th>
            <th>Registered</th>
            <th>Actions</th>
        </tr>

        </thead>

        <tbody>

        @forelse($agents as $agent)

            <tr>

                <td>
                    {{ $agent->id }}
                </td>

                <td>
                    {{ $agent->first_name }}
                    {{ $agent->last_name }}
                </td>

                <td>
                    {{ $agent->email }}
                </td>

                <td>
                    {{ $agent->phone }}
                </td>

                <td>
                    {{ $agent->kyc?->pan_number }}
                </td>

                <td>
                    {{ $agent->kyc?->aadhar_number }}
                </td>

                <td class="{{ $agent->status }}">
                    {{ ucfirst($agent->status) }}
                </td>

                <td>
                    {{ $agent->created_at->format('d-m-Y') }}
                </td>
                <td>

    @if($agent->status === 'pending')

        <form
            method="POST"
            action="{{ route('admin.agents.approve', $agent) }}"
            style="display:inline;"
        >
            @csrf

            <button type="submit">
                Approve
            </button>
        </form>

        <form
            method="POST"
            action="{{ route('admin.agents.reject', $agent) }}"
            style="display:inline;"
        >
            @csrf

            <button type="submit">
                Reject
            </button>
        </form>

    @else

        No actions

    @endif

</td>

            </tr>

        @empty

            <tr>
                <td colspan="8">
                    No agents found.
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>


    <div style="margin-top: 20px;">

        {{ $agents->links() }}

    </div>

</div>

</body>
</html>