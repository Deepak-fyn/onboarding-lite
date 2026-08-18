<!DOCTYPE html>
<html>
<head>
    <title>Agent Registration</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 40px;
        }

        .container {
            max-width: 700px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }

        button {
            padding: 10px 20px;
            cursor: pointer;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Agent Registration</h1>

    @if(session('success'))
        <p style="color: green;">
            {{ session('success') }}
        </p>
    @endif

    @if($errors->any())
        <div class="error">
            <strong>Please fix the following errors:</strong>

            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('agents.register') }}">

        @csrf

        <h2>Basic Information</h2>

        <div class="form-group">
            <label>Name</label>

            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
            >
        </div>
        <div class="form-group">
            <label>Email</label>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
            >
        </div>

        <div class="form-group">
            <label>Phone</label>

            <input
                type="text"
                name="phone"
                value="{{ old('phone') }}"
            >
        </div>

        <div class="form-group">
            <label>Date of Birth</label>

            <input
                type="date"
                name="date_of_birth"
                value="{{ old('date_of_birth') }}"
            >
        </div>


        <h2>KYC Information</h2>

        <div class="form-group">
            <label>PAN Number</label>

            <input
                type="text"
                name="pan_number"
                value="{{ old('pan_number') }}"
            >
        </div>

        <div class="form-group">
            <label>Aadhaar Number</label>

            <input
                type="text"
                name="aadhar_number"
                value="{{ old('aadhar_number') }}"
            >
        </div>


        <button type="submit">
            Register Agent
        </button>

    </form>

</div>

</body>
</html>