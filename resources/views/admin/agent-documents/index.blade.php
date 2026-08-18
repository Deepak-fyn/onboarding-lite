<h2>Agent Documents</h2>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10">

    <thead>
        <tr>
            <th>Agent</th>
            <th>Document</th>
            <th>File</th>
            <th>Status</th>
            <th>Remarks</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>

        @foreach($documents as $document)

            <tr>

                <td>
                    {{ $document->agent->name }}
                </td>

                <td>
                    {{ strtoupper($document->document_type) }}
                </td>

                <td>
                    {{ $document->file_name }}
                </td>

                <td>
                    {{ ucfirst($document->status) }}
                </td>

                <td>
                    {{ $document->verification_remarks ?? '-' }}
                </td>

                <td>
                    <a
                        href="{{ route('admin.agent-documents.view', $document) }}"
                        target="_blank"
                    >
                        View
                    </a>

                    <form
                        action="{{ route('admin.agent-documents.status', $document) }}"
                        method="POST"
                    >

                        @csrf
                        @method('PATCH')

                        <select name="status">

                            <option value="pending"
                                {{ $document->status === 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>

                            <option value="verified"
                                {{ $document->status === 'verified' ? 'selected' : '' }}>
                                Verified
                            </option>

                            <option value="rejected"
                                {{ $document->status === 'rejected' ? 'selected' : '' }}>
                                Rejected
                            </option>

                        </select>

                        <br><br>

                        <textarea
                            name="verification_remarks"
                            placeholder="Verification remarks"
                        >{{ $document->verification_remarks ?? '' }}</textarea>

                        <br><br>

                        <button type="submit">
                            Update
                        </button>

                    </form>

                </td>

            </tr>

        @endforeach

    </tbody>

</table>