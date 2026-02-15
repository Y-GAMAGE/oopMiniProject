
{{-- filepath: resources/views/admin/settings.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'System Settings')

@section('content')
<div style="margin-bottom: 30px;">
    <h1 style="font-size: 28px; font-weight: 600; color: #333;">System Settings</h1>
</div>

<div style="background: white; padding: 60px; border-radius: 12px; text-align: center; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
    <div style="font-size: 64px; margin-bottom: 20px;">⚙️</div>
    <h2 style="color: #333; margin-bottom: 10px;">System Configuration</h2>
    <p style="color: #999; margin-bottom: 30px;">System settings and configuration options coming soon</p>
    <a href="{{ route('admin.dashboard') }}" style="background: #667eea; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; display: inline-block;">
        Back to Dashboard
    </a>
</div>
@endsection
