@if($result->lastPage() > 1)
<ul class="reviews-pagination">
	@for($i=1;$i<=$result->lastPage();$i++)
	<li @if($result->currentPage()==$i) class="active" @endif><a href="{{$result->url($i)}}#{{$location_onsite}}" >{{$i}}</a></li>
	@endfor
	<li><a href="{{$result->url($result->lastPage())}}#{{$location_onsite}}"><i class="fa fa-angle-right"></i></a></li>
</ul>
@endif