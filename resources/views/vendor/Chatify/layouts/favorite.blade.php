<div class="favorite-list-item">
    <div data-id="{{ $user->id }}" data-action="0" class="avatar av-m" 
        style="background-image: url('{{ $user->avatar['medium'] }}')">
    </div>
    <p>
        {{ strlen($user->name) > 5 ? trim(substr($user->name,0,6)).'..' : $user->name }}
    </p>
</div>