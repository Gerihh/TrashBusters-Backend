<!-- resources/views/emails/profile_deletion_code.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Felhasználó törlése</title>
</head>
<body>
    <div>
        <p>Kedves {{ $user->username }},</p>
        <p>A felhasználója törléséhez szükséges kód: <strong>{{ $deletionCode }}</strong></p>
        <p>Ha nem ön kérvényezte ezt az email-t, nyugodtan hagyja figyelmen kívül ezt az üzenetet.</p>
        <p>Köszönjük!</p>
    </div>
</body>
</html>
