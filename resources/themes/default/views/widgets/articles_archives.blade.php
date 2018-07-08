<section class="widget">
    <div class="widget__inner">
        <div class="widget__header">
            @role('owner')
                <a href="{{ route('system_care.clearcache', ['key' => $widget->cache_key]) }}" class="moder_panel">≡</a>
            @endrole
            <h4 class="widget__title">{{ $widget->title }}</h4>
        </div>
        <div class="widget__body">
            <ul class="list-unstyled">
                @forelse($widget->items as $item)
                    <li>
                        <a href="{{ route('articles.index', ['month' => $item->month, 'year'=> $item->year]) }}">
                            <span>{{ $item->monthname }} {{ $item->year }}</span>
                            <small class="pull-right">{{ $item->count }} {{ trans_choice('articles.num', $item->count) }}</small>
                        </a>
                    </li>
                @empty
                    @lang('common.msg.not_found')
                @endforelse
            </ul>
        </div>
    </div>
</section>
