<!DOCTYPE html>
<html>
<head>
    <title>Agent Document Upload</title>
</head>
<body>

    <h2>Agent Document Upload</h2>

    <p>
        <strong>Agent:</strong>
        {{ $agent->name }}
    </p>

    <p>
        <strong>Email:</strong>
        {{ $agent->email }}
    </p>

    <hr>

    <h3>KYC Information</h3>

    <p>
        <strong>PAN Number:</strong>
        {{ $agent->kyc->pan_number }}
    </p>

    <p>
        <strong>Aadhaar Number:</strong>
        {{ $agent->kyc->aadhar_number }}
    </p>

    <hr>

    <h3>Upload Documents</h3>

    <form
        action="{{ route('agents.documents.store', $agent) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf

        <div>
            <label>PAN Document</label>
            <input type="file" name="pan">
        </div>

        <br>

        <div>
            <label>Aadhaar Document</label>
            <input type="file" name="aadhar">
        </div>

        <br>

        <div>
            <label>Certificate</label>
            <input type="file" name="certificate">
        </div>

        <br>

        <div>
            <label>License</label>
            <input type="file" name="license">
        </div>

        <br>

        <button type="submit">
            Upload Documents
        </button>

    </form>

</body>
</html>