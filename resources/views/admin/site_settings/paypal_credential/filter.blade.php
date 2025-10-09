@if (count($credentials) > 0)
    @foreach ($credentials as $credential)
        <tr>
            <td>{{ $credential->merchant_id ? (strlen($credential->merchant_id) > 35 ? substr($credential->merchant_id, 0, 35) . '...' : $credential->merchant_id) : 'N/A' }}</td>
            <td>{{ $credential->client_id ? (strlen($credential->client_id) > 35 ? substr($credential->client_id, 0, 35) . '...' : $credential->client_id) : 'N/A' }}</td>
            <td>
                <span class="secret-text" data-text="{{ $credential->client_secret ? $credential->client_secret : 'N/A' }}">
                    ******************************
                </span>
                <i class="toggle-secret fa fa-eye-slash" aria-hidden="true"></i>
            </td>
            <td>{{ Ucfirst($credential->credential_name) ?? 'N/A' }}</td>
            <td>
                @if ($credential->status == 1)
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-danger">Inactive</span>
                @endif
            </td>
            <td>
                <a href="{{ route('credentials.edit', $credential->id) }}" class="edit-btn"><i class="fas fa-edit"></i></a>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="8" class="text-center">No data found</td>
    </tr>
@endif
