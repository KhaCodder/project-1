
@extends('layouts.admin')
@section('title', __('Sửa Menu: '. $menuGroup->name))

@section('breadcrumb')
    {{ Breadcrumbs::render('admin.menus.edit', $menuGroup) }}
@endsection

@section('content')

<form action="{{ route('admin.menus.update', $menuGroup->id) }}" method="POST" class="needs-validation" novalidate>
    @csrf
    @method('PUT')
    
    <div class="mb-3">
        <label for="group_name" class="form-label">Tên Menu Group:</label>
        <input type="text" class="form-control" name="group_name" id="group_name" value="{{ $menuGroup->name }}" required>
        <div class="invalid-feedback">
            Vui lòng nhập tên menu group.
        </div>
    </div>

    <div class="mb-3">
        <label for="group_slug" class="form-label">Slug:</label>
        <input type="text" class="form-control" name="group_slug" id="group_slug" value="{{ $menuGroup->slug }}" required>
        <div class="invalid-feedback">
            Vui lòng nhập slug.
        </div>
    </div>

    <div id="menu-items">
        @foreach($menuGroup->items as $index => $item)
        <div class="row g-3 mb-3" id="item-{{ $index }}">
            <input type="hidden" name="items[{{ $index }}][id]" value="{{ $item->id }}">
            <div class="col-md-4">
                <label for="item_name_{{ $index }}" class="form-label">Tên Item:</label>
                <input type="text" class="form-control" name="items[{{ $index }}][name]" id="item_name_{{ $index }}" value="{{ $item->name }}" required>
                <div class="invalid-feedback">
                    Vui lòng nhập tên item.
                </div>
            </div>
            <div class="col-md-4">
                <label for="item_url_{{ $index }}" class="form-label">URL:</label>
                <input type="url" class="form-control" name="items[{{ $index }}][url]" id="item_url_{{ $index }}" value="{{ $item->url }}" required>
                <div class="invalid-feedback">
                    Vui lòng nhập URL hợp lệ.
                </div>
            </div>
            <div class="col-md-2">
                <label for="item_order_{{ $index }}" class="form-label">Thứ tự:</label>
                <input type="number" class="form-control" name="items[{{ $index }}][order]" id="item_order_{{ $index }}" value="{{ $item->order }}">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-danger remove-item" data-id="{{ $index }}">Xoá</button>
                <button type="button" class="btn btn-secondary add-sub-item" data-parent-id="{{ $index }}">Thêm Sub Item</button>
            </div>
        </div>
        @if(isset($item->children))
            @foreach($item->children as $subIndex => $subItem)
                <div class="row g-3 mb-3 sub-item" id="sub-item-{{ $index }}-{{ $subIndex }}">
                    <input type="hidden" name="items[{{ $index }}][children][{{ $subIndex }}][id]" value="{{ $subItem->id }}">
                    <div class="col-md-4">
                        <label for="sub_item_name_{{ $index }}_{{ $subIndex }}" class="form-label">Tên Sub Item:</label>
                        <input type="text" class="form-control" name="items[{{ $index }}][children][{{ $subIndex }}][name]" id="sub_item_name_{{ $index }}_{{ $subIndex }}" value="{{ $subItem->name }}" required>
                        <div class="invalid-feedback">
                            Vui lòng nhập tên sub item.
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="sub_item_url_{{ $index }}_{{ $subIndex }}" class="form-label">URL:</label>
                        <input type="url" class="form-control" name="items[{{ $index }}][children][{{ $subIndex }}][url]" id="sub_item_url_{{ $index }}_{{ $subIndex }}" value="{{ $subItem->url }}" required>
                        <div class="invalid-feedback">
                            Vui lòng nhập URL hợp lệ.
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="sub_item_order_{{ $index }}_{{ $subIndex }}" class="form-label">Thứ tự:</label>
                        <input type="number" class="form-control" name="items[{{ $index }}][children][{{ $subIndex }}][order]" id="sub_item_order_{{ $index }}_{{ $subIndex }}" value="{{ $subItem->order }}">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="button" class="btn btn-danger remove-sub-item" data-id="{{ $index }}-{{ $subIndex }}">Xoá</button>
                    </div>
                </div>
            @endforeach
        @endif
    @endforeach
    
    </div>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">Cập Nhật Menu</button>
        <button type="button" class="btn btn-secondary" id="add-item">Thêm Item</button>
    </div>
</form>


<script>
    document.getElementById('add-item').addEventListener('click', function() {
        // Sử dụng index của các item hiện tại
        let index = document.querySelectorAll('#menu-items .row').length;
        let itemHtml = `
            <div class="row g-3 mb-3" id="item-${index}">
                <div class="col-md-4">
                    <label for="item_name_${index}" class="form-label">Tên Item:</label>
                    <input type="text" class="form-control" name="items[${index}][name]" id="item_name_${index}" required>
                    <div class="invalid-feedback">Vui lòng nhập tên item.</div>
                </div>
                <div class="col-md-4">
                    <label for="item_url_${index}" class="form-label">URL:</label>
                    <input type="url" class="form-control" name="items[${index}][url]" id="item_url_${index}" required>
                    <div class="invalid-feedback">Vui lòng nhập URL hợp lệ.</div>
                </div>
                <div class="col-md-2">
                    <label for="item_order_${index}" class="form-label">Thứ tự:</label>
                    <input type="number" class="form-control" name="items[${index}][order]" id="item_order_${index}" value="0">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" class="btn btn-danger remove-item" data-id="${index}">Xoá</button>
                    <button type="button" class="btn btn-secondary add-sub-item" data-parent-id="${index}">Thêm Sub Item</button>
                </div>
            </div>
        `;
        document.getElementById('menu-items').insertAdjacentHTML('beforeend', itemHtml);
        attachRemoveItemEvent();
        attachAddSubItemEvent();
    });

    function attachAddSubItemEvent() {
        document.querySelectorAll('.add-sub-item').forEach(function(button) {
            button.addEventListener('click', function() {
                let parentId = this.getAttribute('data-parent-id');
                let index = document.querySelectorAll(`#item-${parentId} .sub-item`).length;
                let subItemHtml = `
                    <div class="row g-3 mb-3 sub-item" id="sub-item-${parentId}-${index}">
                        <div class="col-md-4">
                            <label for="sub_item_name_${parentId}_${index}" class="form-label">Tên Sub Item:</label>
                            <input type="text" class="form-control" name="items[${parentId}][children][${index}][name]" id="sub_item_name_${parentId}_${index}" required>
                            <div class="invalid-feedback">Vui lòng nhập tên sub item.</div>
                        </div>
                        <div class="col-md-4">
                            <label for="sub_item_url_${parentId}_${index}" class="form-label">URL:</label>
                            <input type="url" class="form-control" name="items[${parentId}][children][${index}][url]" id="sub_item_url_${parentId}_${index}" required>
                            <div class="invalid-feedback">Vui lòng nhập URL hợp lệ.</div>
                        </div>
                        <div class="col-md-2">
                            <label for="sub_item_order_${parentId}_${index}" class="form-label">Thứ tự:</label>
                            <input type="number" class="form-control" name="items[${parentId}][children][${index}][order]" id="sub_item_order_${parentId}_${index}" value="0">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="button" class="btn btn-danger remove-sub-item" data-id="${parentId}-${index}">Xoá</button>
                        </div>
                    </div>
                `;
                document.getElementById(`item-${parentId}`).insertAdjacentHTML('beforeend', subItemHtml);
                attachRemoveSubItemEvent();
            });
        });
    }

    function attachRemoveItemEvent() {
        document.querySelectorAll('.remove-item').forEach(function(button) {
            button.addEventListener('click', function() {
                let id = this.getAttribute('data-id');
                document.getElementById(`item-${id}`).remove();
            });
        });
    }

    function attachRemoveSubItemEvent() {
        document.querySelectorAll('.remove-sub-item').forEach(function(button) {
            button.addEventListener('click', function() {
                let id = this.getAttribute('data-id');
                document.getElementById(`sub-item-${id}`).remove();
            });
        });
    }

    // Khởi tạo các event listeners
    attachRemoveItemEvent();
    attachAddSubItemEvent();
    attachRemoveSubItemEvent();
</script>

@endsection