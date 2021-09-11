@if ($th)
<th class="py-2 {{$class}}">
    {{$slot}}
</th>
@else
<td class="py-4 text-center {{$class}}">
    {{$slot}}
</td>
@endif
