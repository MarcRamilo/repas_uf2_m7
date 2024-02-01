<div class="mx-auto p-4 m-4 col-5 bg-light rounded shadow-lg">
<form action="/user/authenticate" method="post" enctype="multipart/form-data">
    <h2>Login User</h2>
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" name="username" id="username" aria-describedby="helpId" placeholder="" value="<?php echo $_POST['username'] ?? null?>" />
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="" value="<?php echo $_POST['mail']?? null ?>" />
    </div>
    <button type="submit" class="btn btn-primary">
        Submit
    </button>
</form>
</div>