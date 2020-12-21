<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logging out... | Belajar Ngeweb ID</title>
    <link rel="stylesheet" href="<?= base_url() ?>/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/css/auth.css">
    <meta name="google-signin-client_id" content="<?= env('GOOGLE_CLIENT_ID') ?>">  
</head>
<body>
    
<div class="container">
    <img src="<?= base_url() ?>/image/logo.jpg" alt="Logo Belajar Ngeweb ID" class="logo">
    <h2>Logging out...</h2>
    <form action="<?= route('admin/loginAction') ?>" class="rata-kiri mt-5" method="POST">
        <input type="hidden" id="login_uri" value="<?= route('loginWithGoogle') ?>">
        <div class="lebar-100 g-signin2" style="display: none;" data-onsuccess="onSignIn"></div>         
    </form>
</div>

<script src="<?= base_url() ?>/js/base.js"></script>
<script src="https://apis.google.com/js/platform.js" async defer></script>                      
<script>
    function onSignIn(user) {
        let profile = user.getBasicProfile();
        let idToken = user.getAuthResponse().id_token;
        gapi.auth2.getAuthInstance().disconnect().then(e => {
            window.location = "<?= route('/') ?>"
        })
    }
</script>

</body>
</html>