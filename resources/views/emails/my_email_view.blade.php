<!DOCTYPE html>
<html>
<head>
    <title>{{ $details['title'] }}</title>
</head>
<body>
    <h2>{{ $details['title'] }}</h2>
    
    <ul>
        @foreach($details['items'] as $label => $value)
            <li><strong>{{ $label }}:</strong> {{ $value }}</li>
        @endforeach
    </ul>
    <p><a href="{{ $details['link'] }}">Click here</a> {{ $details['type'] }}</p>
</body>
</html>