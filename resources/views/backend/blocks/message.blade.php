<div class="row">
	<div class="col-12">
		@if($errors->any())
		<div class="alert alert-danger alert-dismissible mb-0 mt-4 border-0 fade show" role="alert">
		    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		        <span aria-hidden="true">×</span>
		    </button>
	    	@forelse($errors->all() as $error)
	    		{{ $error }} </br>
	    	@empty
	    	@endforelse
		</div>
		@endif

		@if( session('error') )
		<div class="alert alert-danger alert-dismissible mb-0 mt-4 border-0 fade show" role="alert">
		    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		        <span aria-hidden="true">×</span>
		    </button>
		    {!! session('error') !!}
		</div>
		@endif

		@if( session('success') )
		<div class="alert alert-success alert-dismissible mb-0 mt-4 border-0 fade show" role="alert">
		    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		        <span aria-hidden="true">×</span>
		    </button>
		    {!! session('success') !!}
		</div>
		@endif
	</div>
</div>