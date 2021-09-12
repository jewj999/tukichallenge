@if ($th)
<th class="py-2 text-left {{$class}}">
    {{$slot}}
</th>
@else
<td class="py-4 {{$class}}">
    {{$slot}}
</td>
@endif
