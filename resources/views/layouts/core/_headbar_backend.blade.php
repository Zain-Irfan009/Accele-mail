
<div class="headbar d-flex">
    <div class="me-auto"></div>
    <div class="top-search-container"></div>
</div>

<script>
    $(function() {
        TopSearchBar.init({
            container: $('.top-search-container'),
            sections: [
                new SearchSection({
                    url: '{{ action('Admin\SearchController@general') }}',
                }),
                new SearchSection({
                    url: '{{ action('Admin\SearchController@customers') }}',
                }),
                new SearchSection({
                    url: '{{ action('Admin\SearchController@templates') }}',
                }),
                new SearchSection({
                    url: '{{ action('Admin\SearchController@plans') }}',
                }),
                new SearchSection({
                    url: '{{ action('Admin\SearchController@sending_servers') }}',
                }),
            ],
            lang: {
                no_keyword: `{!! trans('messages.search.type_to_search.wording') !!}`,
                empty_result: `{!! trans('messages.search.empty_result') !!}`,
                tooltip: `{!! trans('messages.click_open_app_search') !!}`,
            }
        });
    });
</script>