@if(count($results))

<div class="row m-20">
    <div class="col-6">
            @if($results->count())              
              	Showing {{$results->firstItem()}} to {{$results->lastItem()}} of {{ $results->total() }} entries
            @endif
    </div> 
    <div class="col-6 right">
    {{ $results->links() }}          
    </div>   
	
</div>
@endif


