<!DOCTYPE html>
<html>
<head>
    <title>CSRF Test</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>CSRF Test Page</h1>

    <h2>Session Info</h2>
    <ul>
        <li>Session ID: {{ session()->getId() }}</li>
        <li>CSRF Token: {{ csrf_token() }}</li>
        <li>Session Started: {{ session()->isStarted() ? 'Yes' : 'No' }}</li>
    </ul>

    <h2>Test Form</h2>
    <form method="POST" action="{{ route('test.csrf') }}">
        @csrf
        <input type="text" name="test_field" value="test_value" placeholder="Test Input">
        <button type="submit">Submit Test</button>
    </form>

    <h2>Ajax Test</h2>
    <button onclick="testAjax()">Test Ajax CSRF</button>
    <div id="ajax-result"></div>

    <script>
        // Set up CSRF token for Ajax requests
        window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!};

        function testAjax() {
            fetch('/test-csrf', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    test_field: 'ajax_test_value'
                })
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('ajax-result').innerHTML = '<pre>' + JSON.stringify(data, null, 2) + '</pre>';
            })
            .catch(error => {
                document.getElementById('ajax-result').innerHTML = '<pre style="color: red;">Error: ' + error + '</pre>';
            });
        }
    </script>
</body>
</html>
