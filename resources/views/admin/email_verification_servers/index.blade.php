@extends('layouts.core.backend')

@section('title', trans('messages.email_verification_servers'))

@section('page_header')

	<div class="page-title">
		<ul class="breadcrumb breadcrumb-caret position-right">
			<li class="breadcrumb-item"><a href="{{ action("Admin\HomeController@index") }}">{{ trans('messages.home') }}</a></li>
		</ul>
		<h1>
			<span class="text-semibold"><span class="material-icons-round">
                format_list_bulleted
                </span> {{ trans('messages.email_verification_servers') }}</span>
		</h1>
	</div>

@endsection

@section('content')
	<p>{{ trans('messages.email_verification_server.wording') }}</p>

	<div class="listing-form"
		sort-url="{{ action('Admin\EmailVerificationServerController@sort') }}"
		data-url="{{ action('Admin\EmailVerificationServerController@listing') }}"
		per-page="{{ Acelle\Model\EmailVerificationServer::$itemsPerPage }}"
	>
		<div class="d-flex top-list-controls top-sticky-content">
			<div class="me-auto">
				@if ($servers->count() >= 0)
					<div class="filter-box">
						<div class="checkbox inline check_all_list">
							<label>
								<input type="checkbox" name="page_checked" class="styled check_all">
							</label>
						</div>
						<div class="dropdown list_actions" style="display: none">
							<button role="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown">
								{{ trans('messages.actions') }} <span class="number"></span><span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item" link-confirm="{{ trans('messages.enable_email_verification_servers_confirm') }}" href="{{ action('Admin\EmailVerificationServerController@enable') }}"><span class="material-icons-outlined">
play_arrow
</span> {{ trans('messages.enable') }}</a></li>
								<li><a class="dropdown-item" link-confirm="{{ trans('messages.disable_email_verification_servers_confirm') }}" href="{{ action('Admin\EmailVerificationServerController@disable') }}"><span class="material-icons-outlined">
hide_source
</span> {{ trans('messages.disable') }}</a></li>
								<li><a class="dropdown-item" link-confirm="{{ trans('messages.delete_email_verification_servers_confirm') }}" href="{{ action('Admin\EmailVerificationServerController@delete') }}"><span class="material-icons-outlined">
delete_outline
</span> {{ trans('messages.delete') }}</a></li>
							</ul>
						</div>
						
						<span class="filter-group">
							<span class="title text-semibold text-muted">{{ trans('messages.sort_by') }}</span>
							<select class="select" name="sort_order">
								<option value="email_verification_servers.created_at">{{ trans('messages.created_at') }}</option>
								<option value="email_verification_servers.name">{{ trans('messages.name') }}</option>
								<option value="email_verification_servers.updated_at">{{ trans('messages.updated_at') }}</option>
							</select>
							<input type="hidden" name="sort_direction" value="desc" />
<button type="button" class="btn btn-xs sort-direction" data-popup="tooltip" title="{{ trans('messages.change_sort_direction') }}" role="button" class="btn btn-xs">
								<span class="material-icons-outlined desc">
sort
</span>
							</button>
						</span>
						<span class="filter-group">
							<span class="title text-semibold text-muted">{{ trans('messages.type') }}</span>
							<select class="select" name="type">
								<option value="">{{ trans('messages.all') }}</option>
								@foreach (Acelle\Model\EmailVerificationServer::typeSelectOptions() as $service)
									<option value="{{ $service['value'] }}">{{ $service['text'] }}</option>
								@endforeach
							</select>
						</span>
						<span class="text-nowrap">
							<input type="text" name="keyword" class="form-control search" value="{{ request()->keyword }}" placeholder="{{ trans('messages.type_to_search') }}" />
							<span class="material-icons-round">
search
</span>
						</span>
					</div>
				@endif
			</div>
			@if (Auth::user()->admin->can('create', new Acelle\Model\EmailVerificationServer()))
				<div class="text-end">
					<a href="{{ action("Admin\EmailVerificationServerController@create") }}" role="button" class="btn btn-secondary">
						<span class="material-icons-round">
add
</span> {{ trans('messages.create_email_verification_server') }}
					</a>
				</div>
			@endif
		</div>

		<div class="pml-table-container">
		</div>
	</div>

	<script>
        var ServersIndex = {
            getList: function() {
                return makeList({
                    url: '{{ action('Admin\EmailVerificationServerController@listing') }}',
                    container: $('.listing-form'),
                    content: $('.pml-table-container')
                });
            }
        };

        $(function() {
            ServersIndex.getList().load();
        });
    </script>
@endsection
