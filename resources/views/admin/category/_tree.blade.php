{{-- عقدة شجرة الأقسام: بتستدعي نفسها للفروع بأي عمق --}}
<ul class="cat-tree">
    @foreach ($nodes as $node)
        <li>
            <div class="cat-tree__card {{ $node->status == 1 ? '' : 'cat-tree__card--hidden' }}">
                <img class="cat-tree__img"
                    src="{{ asset('admin_assets/images/categories/' . $node->image) }}"
                    onerror="this.style.display='none'">
                <div class="cat-tree__names">
                    <strong>{{ optional($node->translate('ar'))->name }}</strong>
                    <small>{{ optional($node->translate('en'))->name }}</small>
                </div>
                <span class="cat-tree__badge {{ $node->status == 1 ? 'cat-tree__badge--on' : 'cat-tree__badge--off' }}">
                    {{ $node->status == 1 ? 'ظاهر' : 'مخفي' }}
                </span>
                <span class="cat-tree__count">{{ $node->products()->count() }} منتج</span>
                <span class="cat-tree__actions">
                    <a href="{{ route('admin.category.create', ['parent_id' => $node->id]) }}"
                        class="btn btn-primary btn-xs" title="إضافة قسم فرعي داخل هذا القسم">+ فرعي</a>
                    <a href="{{ route('admin.category.edit', $node->id) }}" class="btn btn-success btn-xs">تعديل</a>
                </span>
            </div>
            @php $childNodes = $byParent->get($node->id, collect()); @endphp
            @if ($childNodes->isNotEmpty())
                @include('admin.category._tree', ['nodes' => $childNodes, 'byParent' => $byParent])
            @endif
        </li>
    @endforeach
</ul>
