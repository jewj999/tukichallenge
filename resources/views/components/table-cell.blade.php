@if ($th)
<th class="py-2 text-left {{$class}}">
    {{$slot}}
</th>
@else
<td class="py-3 h-20 {{$class}}">
    {{$slot}}
</td>
@endif
