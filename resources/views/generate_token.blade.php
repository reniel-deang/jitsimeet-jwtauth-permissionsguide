<!-- resources/views/generate_token.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Join Jitsi Room</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Join Jitsi Room</h1>
    
    <form id="jitsi-form">
        <div>
            <label for="room_name">Room Name:</label>
            <input type="text" id="room_name" name="room_name" required>
        </div>
        <div>
            <label for="user_name">Your Name:</label>
            <input type="text" id="user_name" name="user_name" required>
        </div>
        <div>
            <label for="user_email">Your Email:</label>
            <input type="email" id="user_email" name="user_email" required>
        </div>
        <div>
            <label for="affiliation">Affiliation:</label>
            <select id="affiliation" name="affiliation" required>
                <option value="owner">Owner</option>
                <option value="member">Member</option>
            </select>
        </div>

        <button type="submit">Generate Token and Join Room</button>
    </form>

    <script>
        $(document).ready(function () {
            $('#jitsi-form').on('submit', function (e) {
                e.preventDefault();
                
                var room_name = $('#room_name').val();
                var user_name = $('#user_name').val();
                var user_email = $('#user_email').val();
                var affiliation = $('#affiliation').val();

                $.ajax({
                    url: '/generate-jitsi-token',
                    method: 'POST',
                    data: {
                        room_name: room_name,
                        user_name: user_name,
                        user_email: user_email,
                        affiliation: affiliation,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        // Redirect to the generated URL
                        window.location.href = response.url;
                    },
                    error: function (xhr) {
                        alert('Failed to generate token. Please try again.');
                    }
                });
            });
        });
    </script>
</body>
</html>
