<a class="nav-link" data-toggle="dropdown" href="#">
    <i class="far fa-bell"></i>
    <span class="badge badge-warning navbar-badge">15</span>
    @if (count(Auth::user()->unreadNotifications) > 5)
        <span class="badge badge-warning navbar-badge count" data-count="5">5 </span>

    @else
        <span class="badge badge-warning navbar-badge count count"
            data-count="{{ count(Auth::user()->unreadNotifications) }}">{{ count(Auth::user()->unreadNotifications) }}</span>
    @endif
</a>
<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
    <span class="dropdown-item dropdown-header">Notifications</span>

    @foreach (Auth::user()->unreadNotifications as $notification)

        <div class="dropdown-divider"></div>
        <a href="{{ route('admin.notification.show', $notification->id) }}"
            class=" dropdown-item @if ($notification->unread()) font-weight-bold @else small text-gray-500 @endif">
            <i class="fas {{ $notification->data['fas'] }}  mr-2"></i> {{ $notification->data['title'] }}
            <span class="float-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
        </a>
        @if ($loop->index + 1 == 5)
            @php
                break;
            @endphp
        @endif
    @endforeach
    <div class="dropdown-divider"></div>
    <a href="{{ route('admin.notification.index') }}" class="dropdown-item dropdown-footer">See All Notifications</a>
</div>
