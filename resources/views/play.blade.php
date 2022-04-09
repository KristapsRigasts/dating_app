
<div>
    <div>
        {{ $user->name }}
    </div>
</div>

<div>
    <a href="/users/{{ $user->id }}/yes">Yes</a>
</div>
<div>
    <a href="/users/{{ $user->id }}/no">No</a>
</div>
