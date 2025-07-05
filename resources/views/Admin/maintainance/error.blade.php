<!DOCTYPE html>
<html>
<head>
    <title>Site Under Maintenance</title>
</head>
<body>
    <h1>🔧 Site Under Maintenance</h1>
    <p>We're performing scheduled maintenance. Please check back soon.</p>
    @if(app()->isDownForMaintenance() && $secret = app()->maintenanceMode()->data['secret'] ?? null)
        <p>Admin access: <a href="{{ url("/$secret") }}">Bypass Maintenance Mode</a></p>
    @endif
</body>
</html>