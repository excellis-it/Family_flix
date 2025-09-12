<tbody id="tableBodyContents">
    @if ($percentagesPage->isEmpty())
        <tr>
            <td colspan="4" class="text-center">No commission Percentage found</td>
        </tr>
    @else
        @foreach ($percentagesPage as $item)
            @php
                $percentage = $item->percentage;
                $rows = $commissionsForPage->get($percentage, collect());
                // collect affiliate names, filter nulls and uniques
                $affiliateNames = $rows->pluck('affiliate.name')
                    ->filter()
                    ->unique()
                    ->values()
                    ->all();
                    // dd($rows->toArray(), $affiliateNames);
                $affiliateNamesStr = count($affiliateNames) ? implode(', ', $affiliateNames) : 'N/A';
                // pick one id for data-id (optional)
                $firstId = $rows->first()->id ?? null;
            @endphp

            <tr class="tableRow" data-id="{{ $firstId }}">
                <td>{{ $affiliateNamesStr }}</td>
                <td>{{ $percentage }}%</td>
                <td>
                    @if($firstId)
                        <a title="Delete" data-route="{{ route('delete.commission-percentage', $firstId) }}"
                           class="delete_acma edit-btn" href="javascript:void(0);" id="delete">
                            <i class="fas fa-trash"></i>
                        </a>

                        <a href="{{ route('commission-percentage.edit', $firstId) }}" class="edit-btn">
                            <i class="fas fa-edit"></i>
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach

        <tr class="toxic">
            <td colspan="5" class="text-left">
                <div class="d-flex justify-content-between">
                    <div class="">
                        {!! $percentagesPage->links() !!}
                    </div>
                    <div>
                        (Showing {{ $percentagesPage->firstItem() }} – {{ $percentagesPage->lastItem() }} commission of
                        {{ $distinct_percentage_count }} percentage values)
                    </div>
                </div>
            </td>
        </tr>
    @endif
</tbody>
