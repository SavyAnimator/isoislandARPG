
<tr class="outflow">
    <td>{!! $log->item ? $log->item->displayName : '(Deleted Item)' !!}</td>
    <td>{!! $log->shop ? $log->shop->displayName : '(Deleted Shop)' !!}</td>
    <td>{!! $log->quantity !!}</td>
    <td>{!! $log->currency ? $log->currency->display($log->cost) : $log->cost . ' (Deleted Currency)' !!}</td>
    <td>{!! $log->shop->displayName !!}</td>
    <td>{!! $log->character_id ? $log->character->displayName : '' !!}</td>
    <td>{!! format_date($log->created_at) !!}</td>
</tr>
<div class="d-flex row flex-wrap col-12 mt-1 pt-1 px-0 ubt-top">
  <div class="col-12 col-md-2">{!! $log->item ? $log->item->displayName : '(Deleted Item)' !!}</div>
  <div class="col-12 col-md-2">{!! $log->quantity !!}</div>
  <div class="col-12 col-md-2">{!! $log->shop ? $log->shop->displayName : '(Deleted Shop)' !!}</div>
  <div class="col-12 col-md-2">{!! $log->character_id ? $log->character->displayName : '' !!}</div>
  <div class="col-12 col-md-2">{!! $log->currency ? $log->currency->display((int)$log->cost) : (int)$log->cost . ' (Deleted Currency)' !!}</div>
  <div class="col-12 col-md-2">{!! pretty_date($log->created_at) !!}</div>
</div>
