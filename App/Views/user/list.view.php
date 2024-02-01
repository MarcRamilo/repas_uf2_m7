<?php foreach ($params['users'] as $u) { ?>
<?php echo '<pre>';
var_dump($u);
echo '</pre>'; ?> ?>
    <a href="/user/edit/?id_user=<?php echo $u['id_user'] ?>" class="btn btn-primary">Editar User <?php echo $u['username']  ?></a>
    <a href="/user/delete/?id_user=<?php echo $u['id_user'] ?>" class="btn btn-danger">Delete User <?php echo $u['username']  ?></a>
    <img src="../../../Public/Assets/images/profile_images/<?php echo $u['profile_image'] ?>" style="width=100px">
<?php }
