<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="/api/typeEvent" method="POST">
        @csrf
        <input type="text" placeholder="libelleTypeEvent" name="libelleTypeEvent" id="">
        <input type="text" placeholder="descriptionTypeEvent" name="descriptionTypeEvent" id=""><br>
        <input type="text" placeholder="tel" name="telOrganisateur" id="">
        <input type="text" placeholder="descriptionOrganisateur" name="descriptionOrganisateur" id="">
        <input type="text" placeholder="url" name="urlPhotoOrganisateur" id="">

        <button type="submit" value="envoyer">Envoyer</button>
    </form>
</body>
</html>
