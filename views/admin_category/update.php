<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Адмінпанель</a></li>
                    <li><a href="/admin/category">Управління категоріями</a></li>
                    <li class="active">Редагувати категорію</li>
                </ol>
            </div>


            <h4>Редагувати категорію "<?php echo $category['name']; ?>"</h4>

            <br/>

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post">

                        <p>Назва</p>
                        <input type="text" name="name" placeholder="" value="<?php echo $category['name']; ?>">

                        <p>Порядковий номер</p>
                        <input type="text" name="sort_order" placeholder="" value="<?php echo $category['sort_order']; ?>"
                        <br>
                        <br>
                        Батьківська Категорія
                        <select name="main_category">
                            <?php

                            foreach ($allcategories as $key=>$value):?>

                                <option value="<?php echo $value['name'] ?>" selected="selected"><?php echo $value['name'] ?></option>

                            <?php endforeach; ?>
                        </select>

                        <br><br>
                        
                        <p>Статус</p>
                        <select name="status">
                            <option value="1" <?php if ($category['status'] == 1) echo ' selected="selected"'; ?>>Відображається</option>
                            <option value="0" <?php if ($category['status'] == 0) echo ' selected="selected"'; ?>>Приховано</option>
                        </select>

                        <br><br>
                        
                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

