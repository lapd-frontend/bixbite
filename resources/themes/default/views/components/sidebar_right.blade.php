<aside class="sidebar sidebar-right" itemscope itemtype="http://schema.org/WPSideBar">
    <x-widgets.articles-featured :parameters="[
        'is_active' => true,
        'limit' => 5,
        {{-- 'cache_time' => 0, --}}
        {{-- 'sub_day' => 1, --}}
        {{-- 'order_by' => 'title', --}}
        {{-- 'direction' => 'asc', --}}
        {{-- 'id' => [6,8], --}}
        {{-- 'user_id' => [1,2], --}}
        {{-- 'categories' => [1,3,4], --}}
        {{-- 'tags' => ['бизнес','политика'], --}}

    ]" />

    @if (setting('comments.widget_used', true))
        <x-widgets.comments-latest :parameters="[
            {{-- 'cache_time' => 0, --}}

        ]" />
    @endif

    <x-widgets.tags-cloud :parameters="[
        {{-- 'title' => 'Облако меток', --}}
        {{-- 'is_active' => false, --}}
        {{-- 'template' => 'components.widgets.tags-cloud', --}}
        {{-- 'cache_time' => 0, --}}
        {{-- 'limit' => 8, --}}
        {{-- 'relation' => 'articles', --}}
        {{-- 'order_by' => 'articles_count', --}}
        {{-- 'direction' => 'desc', --}}

    ]" />

    <x-widgets.articles-archives :parameters="[
        'title' => 'Архив записей',
        {{-- 'is_active' => false, --}}
        {{-- 'cache_time' => 0, --}}
        {{-- 'limit' => 12, --}}
        {{-- 'has_count' => true,  --}}

    ]" />
</aside>
