@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<div class="panel-body">
					You have {{ count($user->emailMessages) }} email messages.
				</div>

				<div class="panel-body">
                    <h3>Trigger Email Addresses</h3>
                    @foreach ($user->triggerAddresses as $address)
                        <pre>{{ $address->address }}</pre>
                    @endforeach
                    <p>
                        <div class="new-address" id="new-address-form" style="display: none">
                            <form action="/triggers/add" method="post">
                                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                E-mail address: <input type="text" name="address"/> <input type="submit"/>
                            </form>
                        </div>

                        <a href="#!" onclick="document.getElementById('new-address-form').style.display='block'; this.style.display='none'">Add New Address</a>

                    </p>
                </div>
			</div>
		</div>
	</div>
</div>
@endsection
