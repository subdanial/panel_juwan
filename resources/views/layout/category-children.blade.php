<?php
$category_id = isset( $checked ) ? $checked : null;
?><ul>
    @foreach($children as $child)
        <li>
            <div class="form-check">
                <label class="form-check-label">
                <input type="radio"  class="form-check-input" name="category_id" value="{{ $child->id }}">
                <span>{{ $child->name }}</span>
            </label>
            </div>
            @if ( $child->children->isNotEmpty() )
                @include('layout.category-children',['children' => $child->children])
            @endif
        </li>
    @endforeach
</ul>
