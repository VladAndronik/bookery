<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Адмінпанель</a></li>
                    <li><a href="/admin/product">Управління товарами</a></li>
                    <li class="active">Редагування інформації</li>
                </ol>
            </div>


            <h4>Редагувати книгу #<?php echo $id; ?></h4>

            <br/>

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <p>Назва книги</p>
                        <input type="text" name="name" placeholder="" value="<?php echo $product['name']; ?>">
                        <br/><br/>
                        <p>Артикул</p>
                        <input type="text" name="code" placeholder="" value="<?php echo $product['code']; ?>">
                        <br/><br/>
                        <p>Вартість, грн</p>
                        <input type="text" name="price" placeholder="" value="<?php echo $product['price']; ?>">
                        <br/><br/>
                        <p>Жанр</p>
                        <select name="category_id">
                            <?php if (is_array($categoriesList)): ?>
                                <?php foreach ($categoriesList as $category): ?>
                                    <option value="<?php echo $category['id']; ?>" 
                                        <?php if ($product['category_id'] == $category['id']) echo ' selected="selected"'; ?>>
                                        <?php echo $category['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        
                        <br/><br/>

                        <p>Автор</p>
                        <input type="text" name="author" placeholder="" value="<?php echo $product['author']; ?>">
                        <br/><br/>
                        <p>Фото книги</p>
                        <img src="<?php echo Product::getImage($product['id']); ?>" width="200" alt="" />
                        <input type="file" name="image" placeholder="" value="<?php echo $product['image']; ?>">
                        <br/><br/>
                        <p>Опис книги</p>
                        <textarea name="description" style="height:120px;"><?php echo $product['description']; ?></textarea>
                        
                        <br/><br/>

                        <p>Наявність на складі</p>
                        <select name="availability">
                            <option value="1" <?php if ($product['availability'] == 1) echo ' selected="selected"'; ?>>Так</option>
                            <option value="0" <?php if ($product['availability'] == 0) echo ' selected="selected"'; ?>>Ні</option>
                        </select>
                        
                        <br/><br/>
                        
                        

                        <p>Статус</p>
                        <select name="status">
                            <option value="1" <?php if ($product['status'] == 1) echo ' selected="selected"'; ?>>Відображається</option>
                            <option value="0" <?php if ($product['status'] == 0) echo ' selected="selected"'; ?>>Приховано</option>
                        </select>
                        
                        <br/><br/>
                        <br/><br/>
                        <input type="submit" name="submit" class="btn btn-default" value="Зберегти">
                        
                        <br/><br/>
                        
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

