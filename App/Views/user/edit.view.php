<div class="mx-auto p-4 m-4 col-5 bg-light rounded shadow-lg">
<form action="/user/storeEditUser" method="post" enctype="multipart/form-data">
    <h2>Register User</h2>
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="" value="<?php echo $_SESSION['user_to_edit']['name']  ?? null?>" />
    </div>
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" name="username" id="username" aria-describedby="helpId" placeholder="" value="<?php echo $_SESSION['user_to_edit']['username'] ?? null?>" />
    </div>
    <div class="mb-3">
        <label for="mail" class="form-label">Mail</label>
        <input type="mail" class="form-control" name="mail" id="mail" aria-describedby="helpId" placeholder="" value="<?php echo $_SESSION['user_to_edit']['mail']?? null ?>" />
    </div>
    <div class="mb-3">
        <label for="date" class="form-label">Birthdate </label>
        <input type="date" class="form-control" name="date" id="date" aria-describedby="helpId" placeholder="" value="<?php echo $_SESSION['user_to_edit']['date']?? null ?>" />
    </div>
    <div class="mb-3">
        <label for="profile_image" class="form-label">Profile Image</label>
        <input type="file" class="form-control" name="profile_image" id="profile_image" aria-describedby="helpId" placeholder="" value="<?php echo $_SESSION['user_to_edit']['profile_image']?? null ?>" />
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="" value="<?php echo $_SESSION['user_to_edit']['mail']?? null ?>" />
    </div>
    <input type="hidden" name="id_user"  value="<?php echo $_SESSION['user_to_edit']['id_user']?>">
    <button type="submit" class="btn btn-primary">
        Submit
    </button>
</form>
</div>